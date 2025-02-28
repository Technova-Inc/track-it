<template>
  <div v-if="!isConsultationRoute">
    <h1 class="text-center">
      Liste des PC
    </h1>
    <v-data-table
      :headers="headers"
      :items="pcList"
      :color="white"
      items-per-page-text='Nombre de PC par page'
      :loading=false
      class="transparent-table border-lg border-primary	"
    >
      <template #item.actions="{ item }">
        <v-btn
          text
          color="primary"
          @click="consultPc(item)"
        >
          Consulter le PC
        </v-btn>
      </template>
    </v-data-table>
  </div>
  <router-view v-else></router-view>
</template>

<script>
import { useRoute, useRouter } from 'vue-router'
import { computed, ref } from 'vue'
import { VDataTable, VBtn } from 'vuetify/components'

export default {
  components: {
    VDataTable,
    VBtn
  },
  setup() {
    const route = useRoute()
    const router = useRouter()
    const isConsultationRoute = computed(() => route.path.includes('consultation'))
    const pcList = ref([
      {
        nom: 'PC-01',
        dernierContact: '2025-02-28',
        dernierInventaire: '2025-02-27'
      },{
        nom: 'PC-02',
        dernierContact: '2025-02-29',
        dernierInventaire: '2025-02-27'
      }
    ])
    const headers = [
      { title: 'Nom', key: 'nom' },
      { title: 'Dernier contact', key: 'dernierContact' },
      { title: 'Dernier inventaire', key: 'dernierInventaire' },
      { title: '', key: 'actions'}
    ]

    const consultPc = (pc) => {
      router.push(`/liste/consultation/${pc.nom}`)
    }

    return {
      isConsultationRoute,
      pcList,
      headers,
      consultPc
    }
  }
}
</script>

<style>
.v-data-table.transparent-table {
  background-color: #1d222b !important;
  color: white !important;
}
.v-data-table__th:hover {
  color: #5856d6 !important;
}
</style>