<template>
    <h1 class="text-center">Consultation du Ticket #{{ ticketData.idTicket }}</h1>
    <br /><br />
    <CContainer>
      <CRow>
        <CCol>
          <CCard>
            <CCardBody>
              <CCardTitle class="text-center">Informations du Ticket</CCardTitle>
              <CListGroup>
                <CListGroupItem> Titre : {{ ticketData.titreTicket }} </CListGroupItem>
                <CListGroupItem> Description : {{ ticketData.descriptionTicket }} </CListGroupItem>
                <CListGroupItem> Catégorie : {{ ticketData.categorie }} </CListGroupItem>
                <CListGroupItem> Utilisateur : {{ ticketData.user }} </CListGroupItem>
  
                <CListGroupItem>
                  Priorité :
                  <select v-model="ticketData.priorite" class="form-control mt-2">
                    <option value="Haute">Haute</option>
                    <option value="Moyenne">Moyenne</option>
                    <option value="Basse">Basse</option>
                  </select>
                </CListGroupItem>
  
                <CListGroupItem>
                  Statut :
                  <select v-model="ticketData.status" class="form-control mt-2">
                    <option value="0">Ouvert</option>
                    <option value="1">En cours</option>
                    <option value="2">Fermé</option>
                  </select>
                </CListGroupItem>
  
                <CListGroupItem> Date de création : {{ ticketData.createdate }} </CListGroupItem>
                <CListGroupItem> Dernière mise à jour : {{ ticketData.updatedate }} </CListGroupItem>
              </CListGroup>
            </CCardBody>
          </CCard>
        </CCol>
      </CRow>
    </CContainer>
  </template>
  
  <script>
import { CRow, CCol, CCard, CCardBody, CCardTitle, CListGroup, CListGroupItem } from '@coreui/vue'
import { ref, onMounted } from 'vue'
import { useRoute } from 'vue-router'
import axios from '@/plugins/axios'

export default {
  setup() {
    const route = useRoute()
    const ticketId = route.params.id  // Retrieve ticket ID from the route
    console.log('Ticket ID:', ticketId); // Vérifie l'ID du ticket


    const ticketData = ref({
      idTicket: '',
      titreTicket: '',
      descriptionTicket: '',
      categorie: '',
      user: '',
      priorite: '',  // Corrected property name to match the v-model
      status: '',    // Corrected property name to match the v-model
      createdate: '',
      updatedate: ''
    })

    const fetchTicketData = async () => {
  try {
    const response = await axios.get(`https://10.29.128.180/apisimple/Support/consult_tickets.php?id=${ticketId}`)
    console.log(response); // Vérifie la réponse de l'API
    if (response.data?.ticket) {
      // Mappe correctement les données reçues
      ticketData.value = {
        idTicket: response.data.ticket.idTicket,
        titreTicket: response.data.ticket.titreTicket,
        descriptionTicket: response.data.ticket.descriptionTicket,
        categorie: response.data.ticket.libelleCategorie,  // Correspond à "libelleCategorie"
        user: response.data.ticket.user,
        Priorite: response.data.ticket.Priorite,
        status: response.data.ticket.idstatus,  // Ou adapte pour "status" si tu veux un libellé plus explicite
        createdate: response.data.ticket.createDate,  // Correspond à "createDate"
        updatedate: response.data.ticket.UpdateDate,  // Correspond à "UpdateDate"
      }
    } else {
      console.error("Aucune donnée trouvée pour l'ID spécifié")
    }
  } catch (error) {
    console.error('Erreur lors de la récupération des données:', error)
  }
}
    // Fetch ticket data on component mount
    onMounted(() => {
      fetchTicketData()
    })

    return {
      ticketData
    }
  }
}
</script>