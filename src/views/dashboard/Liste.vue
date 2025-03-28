<template>
  <div v-if="!isConsultationRoute">
    <h1>Liste des PCs</h1>
    <br>
    <div>
      <v-text-field
        class="mb-4"
        v-model="search"
        label="Rechercher"
        variant="outlined"
        hide-details
        single-line
      ></v-text-field>
      <br>
    </div>
    <v-data-table :headers="headers" :items="pcList" :class="tableClass" :search="search">
      <template v-slot:item.actions="{ item }">
        <v-btn @click="consultPc(item)">Consulter</v-btn>
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
    VTextField
  },
  setup() {
    const search = ref('')
    const route = useRoute()
    const router = useRouter()
    const isConsultationRoute = computed(() => route.path.includes('consultation'))
    const pcList = ref([])
    const headers = [
      { title: 'Nom', key: 'nom' },
      { title: 'Dernier contact', key: 'dernierContact' },
      { title: 'Dernier inventaire', key: 'dernierInventaire' },
      { title: '', key: 'actions' },
    ]
    const error = ref(null)

    const fetchPcList = async () => {
      try {
        const response = await axios.get('/ListPC')
        pcList.value = response.data.lstpc.map((pc) => ({
          nom: pc.NAME,
          dernierContact: pc.LASTDATE,
          dernierInventaire: pc.LASTCOME,
        }))
      } catch (err) {
        error.value = `Erreur lors de la récupération des données: ${err.message}`
        console.error('Erreur lors de la récupération des données:', err)
      }
    }

    onMounted(() => {
      fetchPcList()
      updateTableClass()
      observeThemeChange()
    })

    const consultPc = (pc) => {
      router.push(`/liste/consultation/${pc.nom}`)
    }

    const tableClass = ref('')

    const updateTableClass = () => {
      const theme = document.documentElement.getAttribute('data-coreui-theme')
      tableClass.value = theme === 'dark' ? 'dark-table' : 'light-table'
    }

    const observeThemeChange = () => {
      const observer = new MutationObserver(() => {
        updateTableClass()
      })
      observer.observe(document.documentElement, {
        attributes: true,
        attributeFilter: ['data-coreui-theme']
      })
    }

    return {
      isConsultationRoute,
      pcList,
      headers,
      consultPc,
      error,
      tableClass,
      search

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
