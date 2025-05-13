<template>
  <h1 class="text-center">Consultation de {{ pcId }}</h1>
  <br /><br />
  <CContainer>
    <CRow>
      <CCol>
        <CCard>
          <CCardBody>
            <CCardTitle class="text-center">Informations système</CCardTitle>
            <CListGroup>
              <CListGroupItem> OS : {{ pcData.OSNAME }} </CListGroupItem>
              <CListGroupItem> OS Version : {{ pcData.OSVERSION }} </CListGroupItem>
              <CListGroupItem> Architecture : {{ pcData.ARCHITECTURE }} </CListGroupItem>
              <CListGroupItem> Utilisateur windows : {{ pcData.USER }} </CListGroupItem>
              <CListGroupItem> Licence status : {{ pcData.licensestatus }} </CListGroupItem>
              <CListGroupItem> Clé windows : {{ pcData.WINPRODKEY }} </CListGroupItem>
            </CListGroup>
          </CCardBody>
        </CCard>
        <br />
        <CCard>
          <CCardBody>
            <CCardTitle class="text-center">Hardware</CCardTitle>
            <CListGroup>
              <CListGroupItem> CPU : {{ pcData.CPU }} </CListGroupItem>
              <CListGroupItem> RAM : {{ pcData.MEMORY }} Go </CListGroupItem>
            </CListGroup>
          </CCardBody>
        </CCard>
      </CCol>
      <CCol>
        <CCard>
          <CCardBody>
            <CCardTitle class="text-center">Réseau</CCardTitle>
            <CListGroup>
              <CListGroupItem> Domaine : {{ pcData.DOMAIN }} </CListGroupItem>
              <CListGroupItem> Adresse IP : {{ pcData.IPADDR }} </CListGroupItem>
              <CListGroupItem> Adresse MAC : {{ pcData.MAC }} </CListGroupItem>
            </CListGroup>
          </CCardBody>
        </CCard>
        <br />
        <CCard>
          <CCardBody>
            <CCardTitle class="text-center">Agent</CCardTitle>
            <CListGroup>
              <!-- <CListGroupItem> User agent : {{ pcData.USERAGENT }} </CListGroupItem> -->
              <CListGroupItem> Dernier inventaire : {{ pcData.LASTDATE }} </CListGroupItem>
              <CListGroupItem> Dernier contact : {{ pcData.LASTCOME }} </CListGroupItem>
            </CListGroup>
          </CCardBody>
        </CCard>
        <br />
        <CCard>
          <CCardBody>
            <CCardTitle class="text-center">Notes</CCardTitle>
            <textarea class="form-control" aria-label="Notes" v-model="note"></textarea>
            <div class="d-grid gap-2 mt-3">
              <button class="btn btn-primary text-white" type="button" @click="saveNotes">
                Sauvegarder
              </button>
            </div>
          </CCardBody>
        </CCard>
      </CCol>
    </CRow>
  </CContainer>
</template>
<script setup>
import { CRow, CCol, CCard, CCardBody, CCardTitle, CListGroup, CListGroupItem } from '@coreui/vue'
import { defineProps, ref, onMounted } from 'vue'
import { useRoute } from 'vue-router'
import axios from '@/plugins/axios'

// Define the props
const props = defineProps({
  id: String,
})

// Define reactive data properties
const pcData = ref({
  OSVERSION: '',
  OSNAME: '',
  ARCHITECTURE: '',
  USER: '',
  WINPRODID: '',
  WINPRODKEY: '',
  CPU: '',
  MEMORY: '',
  MAC: '',
  DOMAIN: '',
  IPADDR: '',
  USERAGENT: '',
  LASTDATE: '',
  LASTCOME: '',
  licensestatus: '',
  NOTE: '',
})

const route = useRoute()
const pcId = route.params.id

const note = ref('')

// Fetch data from API
const fetchPcData = async (id) => {
  try {
    const response = await axios.get(`/Pc/consult_pc.php?pc=${id}`)
    if (response.data?.pc && response.data.pc.length > 0) {
      pcData.value = response.data.pc[0]
      note.value = pcData.value.NOTE
    } else {
      console.error("Aucune donnée trouvée pour l'ID spécifié")
    }
  } catch (error) {
    console.error('Erreur lors de la récupération des données:', error)
  }
}

// Fetch data on component mount
onMounted(() => {
  fetchPcData(pcId)
})

const saveNotes = async () => {
  try {
    const response = await axios.post(
      '/Pc/consult_notes.php',
      {
        pc: pcId,
        note: note.value,
      },
      {
        headers: {
          'Content-Type': 'application/json',
        },
      },
    )

    if (response.data.success) {
      alert('Note sauvegardée avec succès.')
    } else {
      alert('Erreur lors de la sauvegarde de la note.')
    }
  } catch (error) {
    console.error('Erreur lors de la sauvegarde de la note:', error)
    alert('Erreur serveur lors de la sauvegarde de la note.')
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
