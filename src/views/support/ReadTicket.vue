<template>
  <h1 class="text-center">Consultation du Ticket #{{ ticketData.idTicket }}</h1>
  <br /><br />
  <CContainer>
    <CRow>
      <!-- Première colonne -->
      <CCol>
        <!-- Informations principales -->
        <CCard>
          <CCardBody>
            <CCardTitle class="text-center">Informations du Ticket</CCardTitle>
            <CListGroup>
              <CListGroupItem> Titre : {{ ticketData.titreTicket }} </CListGroupItem>
              <CListGroupItem> Description : {{ ticketData.descriptionTicket }} </CListGroupItem>
              <CListGroupItem> Catégorie : {{ ticketData.categorie }} </CListGroupItem>
              <CListGroupItem> Utilisateur : {{ ticketData.user }} </CListGroupItem>
            </CListGroup>
          </CCardBody>
        </CCard>

        <br />

        <!-- Historique -->
        <CCard>
          <CCardBody>
            <CCardTitle class="text-center">Historique</CCardTitle>
            <CListGroup>
              <CListGroupItem> Date de création : {{ ticketData.createdate }} </CListGroupItem>
              <CListGroupItem> Dernière mise à jour : {{ ticketData.updatedate }} </CListGroupItem>
            </CListGroup>
          </CCardBody>
        </CCard>
      </CCol>

      <!-- Deuxième colonne -->
      <CCol>
        <!-- Gestion du ticket -->
        <CCard>
          <CCardBody>
            <CCardTitle class="text-center">Gestion du Ticket</CCardTitle>
            <CListGroup>
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
                  <option v-for="status in statuses" :key="status.idstatus" :value="status.idstatus">
                    {{ status.libellestatus }}
                  </option>
                </select>
              </CListGroupItem>
            </CListGroup>
          </CCardBody>
        </CCard>
        <div class="d-grid gap-2 mt-3">
          <button class="btn btn-primary text-white" type="button" @click="saveNotes">Fermer Ticket</button>
          <button class="btn btn-success mt-2 text-white" @click="saveTickets">Sauvegarder Modification</button>

        </div>
      </CCol>
    </CRow>
  </CContainer>
  <CContainer class="mt-5">
    <CCard>
      <CCardBody>
        <CCardTitle class="text-center">Réponses au Ticket</CCardTitle>
        <CListGroup>
          <CListGroupItem v-for="(response, index) in ticketResponses" :key="index">
            <strong>{{ response.author }} :</strong> {{ response.message }}
            <div class="text-muted small">{{ response.date }}</div>
          </CListGroupItem>
        </CListGroup>
 <!-- Ajouter une réponse -->
        <div class="mt-4">
          <textarea v-model="newResponseMessage" class="form-control" rows="3" placeholder="Écrire une réponse..."></textarea>
          <button class="btn btn-success mt-2 text-white" @click="sendResponse">Envoyer</button>

        </div>
      </CCardBody>
    </CCard>
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
    const ticketId = route.params.id // ID du ticket

    const ticketData = ref({
      idTicket: '',
      titreTicket: '',
      descriptionTicket: '',
      categorie: '',
      user: '',
      priorite: '',
      status: '',
      createdate: '',
      updatedate: ''
    })

    const ticketResponses = ref([])

    const statuses = ref([])
    const newResponseMessage = ref('') 
    const userId = 1; 
    
    const fetchTicketData = async () => {
      try {
        const response = await axios.get(`/Support/consult_tickets.php?id=${ticketId}`)
        if (response.data?.ticket) {
          ticketData.value = {
            idTicket: response.data.ticket.idTicket,
            titreTicket: response.data.ticket.titreTicket,
            descriptionTicket: response.data.ticket.descriptionTicket,
            categorie: response.data.ticket.libelleCategorie,
            user: response.data.ticket.user,
            priorite: response.data.ticket.Priorite,
            status: response.data.ticket.idstatus,
            createdate: response.data.ticket.createDate,
            updatedate: response.data.ticket.UpdateDate
          }
        } else {
          console.error('Aucune donnée trouvée pour cet ID')
        }
      } catch (error) {
        console.error('Erreur ticket :', error)
      }
    }

    const fetchStatuses = async () => {
      try {
        const response = await axios.get('/Support/Get_details.php')
        if (response.data?.statuses) {
          statuses.value = response.data.statuses
        } else {
          console.error('Erreur statuts')
        }
      } catch (error) {
        console.error('Erreur statuts :', error)
      }
    }

    const saveTickets = async () => {
      try {
        const response = await axios.post('/Support/update_ticket.php', {
          idTicket: ticketData.value.idTicket,
          priorite: ticketData.value.priorite,
          status: ticketData.value.status
        })

        if (response.data?.success) {
          alert('Modifications sauvegardées avec succès.')
          fetchTicketData()
        } else {
          alert('Erreur sauvegarde.')
        }
      } catch (error) {
        console.error('Erreur sauvegarde :', error)
        alert('Erreur connexion serveur.')
      }
    }

    const sendResponse = async () => {
      if (!newResponseMessage.value.trim()) {
        alert('Veuillez écrire un message avant d\'envoyer.')
        return
      }

      try {
        const response = await axios.post('/Support/submit_response.php', {
          idTicket: ticketData.value.idTicket,
          idUser: userId,
          message: newResponseMessage.value.trim()
        })

        if (response.data?.success) {
          alert('Réponse envoyée avec succès.')
          newResponseMessage.value = '' // Reset le champ
          fetchTicketResponses() // Recharge la liste des réponses
        } else {
          alert('Erreur envoi réponse.')
        }
      } catch (error) {
        console.error('Erreur envoi réponse :', error)
        alert('Erreur serveur.')
      }
    }

    // --- Récupérer les réponses au ticket ---
    const fetchTicketResponses = async () => {
      try {
        const response = await axios.get(`/Support/get_reponses_ticket.php?id=${ticketId}`)
        if (response.data?.responses) {
          ticketResponses.value = response.data.responses
        } else {
          ticketResponses.value = []
        }
      } catch (error) {
        console.error('Erreur récupération réponses:', error)
      }
    }

    // --- Au montage ---
    onMounted(() => {
      fetchTicketData()
      fetchStatuses()
      fetchTicketResponses()
    })

    return {
      ticketData,
      ticketResponses,
      statuses,
      newResponseMessage,
      saveTickets,
      sendResponse
    }
  }
}
</script>
