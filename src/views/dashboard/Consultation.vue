<template>
  <h1 class="text-center">Consultation de {{ id }}</h1>
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
              <CListGroupItem> Architecture : {{ pcData.ARCH }} </CListGroupItem>
              <CListGroupItem> Utilisateur windows : {{ pcData.WINOWNER }} </CListGroupItem>
              <CListGroupItem> Licence windows : {{ pcData.WINPRODID }} </CListGroupItem>
              <CListGroupItem> Clé windows : {{ pcData.WINPRODKEY }} </CListGroupItem>
            </CListGroup>
          </CCardBody>
        </CCard>
        <br />
        <CCard>
          <CCardBody>
            <CCardTitle class="text-center">Hardware</CCardTitle>
            <CListGroup>
              <CListGroupItem> Swap : {{ pcData.SWAP }} </CListGroupItem>
              <CListGroupItem> RAM : {{ pcData.MEMORY }} octets </CListGroupItem>
              <CListGroupItem> UUID : {{ pcData.UUID }} </CListGroupItem>
            </CListGroup>
          </CCardBody>
        </CCard>
      </CCol>
      <CCol>
        <CCard>
          <CCardBody>
            <CCardTitle class="text-center">Réseau</CCardTitle>
            <CListGroup>
              <CListGroupItem> Domaine : {{ pcData.WORKGROUP }} </CListGroupItem>
              <CListGroupItem> Adresse IP : {{ pcData.IPADDR }} </CListGroupItem>
            </CListGroup>
          </CCardBody>
        </CCard>
        <br />
        <CCard>
          <CCardBody>
            <CCardTitle class="text-center">Agent</CCardTitle>
            <CListGroup>
              <CListGroupItem> User agent : {{ pcData.USERAGENT }} </CListGroupItem>
              <CListGroupItem> Dernier inventaire : {{ pcData.LASTDATE }} </CListGroupItem>
              <CListGroupItem> Dernier contact : {{ pcData.LASTCOME }} </CListGroupItem>
            </CListGroup>
          </CCardBody>
        </CCard>
        <br />
        <CCard>
          <CCardBody>
            <CCardTitle class="text-center">Notes</CCardTitle>
            <textarea class="form-control" aria-label="Notes"></textarea>
            <div class="d-grid gap-2 mt-3">
              <button class="btn btn-primary" type="button" @click="saveNotes">Sauvegarder</button>
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
  OSNAME: '',
  OSVERSION: '',
  ARCH: '',
  WINOWNER: '',
  WINPRODID: '',
  WINPRODKEY: '',
  SWAP: '',
  MEMORY: '',
  UUID: '',
  WORKGROUP: '',
  IPADDR: '',
  USERAGENT: '',
  LASTDATE: '',
  LASTCOME: '',
})

const route = useRoute()
const pcId = route.params.id

// Fetch data from API
const fetchPcData = async (id) => {
  try {
    const response = await axios.get(`/Consultation?pc=${pcId}`)
    if (response.data?.pc && response.data.pc.length > 0) {
      pcData.value = response.data.pc[0]
    } else {
      console.error("Aucune donnée trouvée pour l'ID spécifié")
    }
  } catch (error) {
    console.error('Erreur lors de la récupération des données:', error)
  }
}

// Fetch data on component mount
onMounted(() => {
  fetchPcData(props.id)
})

const saveNotes = () => {
  // Your save notes logic here
}
</script>
