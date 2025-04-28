<template>
  <div v-if="!isCreationOrReadRoute">
    <h1>Système de support</h1>
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
      <br />
    </div>
    <v-data-table
      :headers="headers"
      :items="ticketList"
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
    const isCreationOrReadRoute = computed(() => route.path.includes('create') || route.path.includes('read'))
    console.log(isCreationOrReadRoute)
    const ticketList = ref([])
    const headers = [
      { title: 'Titre', key: 'titreTicket' },
      { title: 'Utilisateur', key: 'user' },
      { title: 'Priorité', key: 'Priorité' },
      { title: '', key: 'actions' },
    ]
    const error = ref(null)

    const fetchTicketList = async () => {
      try {
        const response = await axios.get('https://10.29.128.180/apisimple/consult_tickets.php')
        ticketList.value = response.data.tickets.map((ticket) => ({
          titreTicket: ticket.titreTicket,
          user: ticket.user,
          Priorité: ticket.Priorite,
          id: ticket.idTicket, // Assurez-vous que l'ID est récupéré ici
        }))
      } catch (err) {
        error.value = `Erreur lors de la récupération des données: ${err.message}`
        console.error('Erreur lors de la récupération des données:', err)
      }
    }

    onMounted(() => {
      observeThemeChange()
      updateTableClass()
      fetchTicketList()
    })

    const consultTicket = (ticket) => {
  router.push(`/support/read/${ticket.id}`)  // Use `ticket.id` instead of the whole ticket object
}

    const tableClass = ref('')

    const updateTableClass = () => {
      const theme = document.documentElement.getAttribute('data-coreui-theme')
      tableClass.value = theme === 'dark' ? 'dark-table' : 'light-table'
    }

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

    return {
      isCreationOrReadRoute,
      ticketList,
      headers,
      consultTicket,
      error,
      tableClass,
      search,
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
