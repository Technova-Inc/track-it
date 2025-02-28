<template>
  <div v-if="!isConsultationRoute">
    <h1 class="text-center">
      Liste des PC
    </h1>
    <v-data-table
      :headers="headers"
      :items="pcList"
      class="transparent-table"
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
      }
    ])
    const headers = [
      { text: 'Nom', value: 'nom' },
      { text: 'Dernier contact', value: 'dernierContact' },
      { text: 'Dernier inventaire', value: 'dernierInventaire' },
      { text: 'Actions', value: 'actions', sortable: false }
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
.transparent-table .v-data-table {
  background-color: #212631 !important;
}
</style>