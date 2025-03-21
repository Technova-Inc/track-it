<template>
  <v-data-table :headers="headers" :items="pcList" :class="tableClass">
    <template v-slot:item.actions="{ item }">
      <v-btn @click="consultPc(item)">Consulter</v-btn>
    </template>
  </v-data-table>
</template>

<script>
import { useRoute, useRouter } from 'vue-router'
import { computed, ref, onMounted } from 'vue'
import { VDataTable, VBtn } from 'vuetify/components'
import axios from '@/plugins/axios'

export default {
  components: {
    VDataTable,
    VBtn
  },
  setup() {
    const route = useRoute()
    const router = useRouter()
    const isConsultationRoute = computed(() => route.path.includes('consultation'))
    const pcList = ref([])
    const headers = [
      { title: 'Nom', key: 'nom' },
      { title: 'Dernier contact', key: 'dernierContact' },
      { title: 'Dernier inventaire', key: 'dernierInventaire' },
      { title: '', key: 'actions'}
    ]
    const error = ref(null)

    const fetchPcList = async () => {
      try {
        const response = await axios.get('/ListPC')
        pcList.value = response.data.lstpc.map(pc => ({
          nom: pc.NAME,
          dernierContact: pc.LASTDATE,
          dernierInventaire: pc.LASTCOME
        }))
      } catch (err) {
        error.value = `Erreur lors de la récupération des données: ${err.message}`
        console.error('Erreur lors de la récupération des données:', err)
      }
    }

    onMounted(() => {
      fetchPcList()
    })

    const consultPc = (pc) => {
      router.push(`/liste/consultation/${pc.nom}`)
    }
    // Utilisez le composant Vuetify useTheme pour détecter le thème actuel
    const tableClass = computed(() => {
      const urlParams = new URLSearchParams(window.location.href.split('?')[1])
      return urlParams.get('theme') === 'dark' ? 'dark-table' : 'light-table'
    })
    return {
      isConsultationRoute,
      pcList,
      headers,
      consultPc,
      error,
      tableClass
    }
  }
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