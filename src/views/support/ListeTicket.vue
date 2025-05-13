<template>
  <div v-if="!isCreationOrReadRoute">
    <h1>{{ isAdminSupportRoute ? 'Administration - Tous les tickets' : 'Système de support' }}</h1>
    <br />
    <div>
      <v-text-field
        class="mb-4"
        v-model="search"
        label="Rechercher dans vos tickets"
        variant="outlined"
        hide-details
        single-line
      ></v-text-field>

      <v-btn
        class="mb-4"
        size="small"
        variant="text"
        color="primary"
        @click="showClosed = !showClosed"
      >
        {{ showClosed ? 'Cacher les tickets fermés' : 'Afficher les tickets fermés' }}
      </v-btn>

      <br />

      <br />
    </div>
    <v-data-table
      :headers="headers"
      :items="filteredTickets"
      :class="tableClass"
      :search="search"
      :items-per-page-text="`Nombre de tickets par page`"
    >
      <template v-slot:item.actions="{ item }">
        <v-btn @click="consultTicket(item)">Consulter</v-btn>
      </template>
    </v-data-table>
  </div>
  <router-view v-else></router-view>
</template>

<script>
import { useRoute, useRouter } from 'vue-router'
import { computed, ref, onMounted } from 'vue'
import { VDataTable, VBtn, VTextField } from 'vuetify/components'
import axios from '@/plugins/axios'
import { watch } from 'vue'

export default {
  components: {
    VDataTable,
    VBtn,
    VTextField,
  },
  setup() {
    const search = ref('')
    const route = useRoute()
    const router = useRouter()
    const showClosed = ref(false)

    // Détection des types de routes
    const isCreationOrReadRoute = computed(
      () => route.path.includes('create') || route.path.includes('read'),
    )
    const isAdminSupportRoute = computed(() => route.fullPath.includes('/admin/support'))

    const ticketList = ref([])

    const filteredTickets = computed(() =>
      showClosed.value
        ? ticketList.value
        : ticketList.value.filter((ticket) => Number(ticket.status) !== 2),
    )

    const headers = [
      { title: 'Titre', key: 'titreTicket' },
      { title: 'Utilisateur', key: 'user' },
      { title: 'Priorité', key: 'Priorité' },
      { title: 'Status', key: 'libellestatus' },
      { title: '', key: 'actions' },
    ]
    const error = ref(null)

    // Récupérer l'utilisateur connecté depuis localStorage
    const connectedUserId = ref(null)
    const fetchConnectedUserId = () => {
      const user = JSON.parse(localStorage.getItem('user'))
      connectedUserId.value = user ? user.id : null
    }

    // Fonction pour récupérer les tickets
    const fetchTicketList = async () => {
      try {
        if (isAdminSupportRoute.value) {
          // Si sur la route /admin/support, récupérer tous les tickets
          const response = await axios.get("/Support/consult_tickets.php")
          ticketList.value = response.data.tickets.map((ticket) => ({
            titreTicket: ticket.titreTicket,
            user: ticket.user,
            Priorité: ticket.Priorite,
            id: ticket.idTicket,
            status: ticket.idstatus,
            libellestatus: ticket.libelleStatus,
          }))
        } else {
          if (!connectedUserId.value) {
            throw new Error('Utilisateur non connecté ou ID non trouvé.')
          }
          const response = await axios.get(
            `/Support/consult_tickets.php?idUser=${connectedUserId.value}`,
          )
          ticketList.value = response.data.tickets.map((ticket) => ({
            titreTicket: ticket.titreTicket,
            user: ticket.user,
            Priorité: ticket.Priorite,
            id: ticket.idTicket,
            status: ticket.idstatus,
            libellestatus: ticket.libelleStatus,
          }))
        }
      } catch (err) {
        error.value = `Erreur lors de la récupération des données : ${err.message}`
        console.error('Erreur lors de la récupération des données :', err)
      }
    }

    // Fonction pour consulter un ticket
    const consultTicket = (ticket) => {
      router.push(`/support/read/${ticket.id}`) // Use `ticket.id` instead of the whole ticket object
    }

    // Gestion des thèmes
    const tableClass = ref('')
    const updateTableClass = () => {
      const theme = document.documentElement.getAttribute('data-coreui-theme')
      tableClass.value = theme === 'dark' ? 'dark-table' : 'light-table'
    }

    // Observateur pour le changement de thème
    let observer
    const observeThemeChange = () => {
      observer = new MutationObserver(() => {
        updateTableClass()
      })
      observer.observe(document.documentElement, {
        attributes: true,
        attributeFilter: ['data-coreui-theme'],
      })
    }

    // Lifecycle hooks
    onMounted(() => {
      fetchConnectedUserId()
      observeThemeChange()
      updateTableClass()
      fetchTicketList()
    })
    watch(route, async () => {
      await fetchTicketList()
    })
    return {
      isCreationOrReadRoute,
      isAdminSupportRoute,
      ticketList,
      headers,
      consultTicket,
      error,
      tableClass,
      search,
      showClosed,
      filteredTickets,
    }
  },
}
</script>

<style>
.dark-table {
  background-color: #1d222b !important;
  color: white !important;
}

.light-table {
  background-color: #f3f4f7 !important;
  color: black !important;
}

.v-data-table__th:hover {
  color: #5856d6 !important;
}
</style>
