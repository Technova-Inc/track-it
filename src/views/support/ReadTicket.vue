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
              <CListGroupItem> Date de création : {{ formatDate(ticketData.createdate) }} </CListGroupItem>
              <CListGroupItem> Dernière mise à jour : {{ formatDate(ticketData.updatedate) }} </CListGroupItem>
            </CListGroup>
          </CCardBody>
        </CCard>
      </CCol>

      <!-- Deuxième colonne -->
      <CCol v-if="idRole > 1">
        <!-- Gestion du ticket -->
        <CCard>
          <CCardBody>
            <CCardTitle class="text-center">Gestion du Ticket</CCardTitle>
            <CListGroup>
              <CListGroupItem>
                Priorité :
                <select v-model="ticketData.priorite" class="form-control mt-2">
                  <option value="Faible">Faible</option>
                  <option value="Moyenne">Moyenne</option>
                  <option value="Élevée">Élevée</option>
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
          <button class="btn btn-success mt-2 text-white" @click="updateTicket">Sauvegarder Modification</button>
          <button class="btn btn-danger text-white" type="button" @click="deleteTicket">Supprimer Ticket</button>

        </div>
      </CCol>
    </CRow>
  </CContainer>
  
  <!-- Affichage des réponses du ticket -->
  <CContainer class="mt-5">
    <CCard>
      <CCardBody>
        <CCardTitle class="text-center">Réponses au Ticket</CCardTitle>
        <CListGroup>
          <CListGroupItem v-for="(response, index) in ticketResponses" :key="index">
            <strong>{{ response.userLogin }} :</strong> {{ response.commentaire }}
            <div class="text-muted small">{{ formatDate(response.DatePublication) }}</div>
          </CListGroupItem>
        </CListGroup>

        <!-- Ajouter une réponse -->
        <div class="mt-4">
          <textarea v-model="newResponseMessage" required class="form-control" rows="3" placeholder="Écrire une réponse..."></textarea>
          <button class="btn btn-success mt-2 text-white" @click="sendResponse">Envoyer</button>
        </div>
      </CCardBody>
    </CCard>
  </CContainer>
  <br />
</template>

<script>
import { ref, onMounted } from 'vue'
import { useRoute, useRouter } from 'vue-router'
import axios from '@/plugins/axios'

export default {
  setup() {
    const route = useRoute()
    const router = useRouter()

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
    const user = JSON.parse(localStorage.getItem('user'));
    const userId = user.id; 
    const idRole = user.role;

    // --- Récupérer les informations du ticket ---
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
          ticketResponses.value = response.data.ticket.reponses || []
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

    // --- Mettre à jour le ticket ---
    const updateTicket = async () => {
  const updatedTicket = {
    idTicket: ticketData.value.idTicket,
    status: ticketData.value.status, // <-- correction ici
    priority: ticketData.value.priorite,
  };

  try {
    const response = await axios.post('/Support/update_ticket.php', updatedTicket);
    if (response.data.success) {
      fetchTicketData();
    } else {
    }
  } catch (error) {
    console.error('Erreur de mise à jour du ticket:', error);
  }
};

 // --- Mettre à jour le ticket ---
 const deleteTicket = async () => {
  const updatedTicket = {
    idTicket: ticketData.value.idTicket,
  };

  try {
    const response = await axios.post('/Support/delete_ticket.php', updatedTicket);
    if (response.data.success) {
      router.push(`/support`)

    } else {
    }
  } catch (error) {
    console.error('Erreur de mise à jour du ticket:', error);
  }
};

    // --- Formater les dates ---
    const formatDate = (dateString) => {
      if (!dateString) return ''
      const date = new Date(dateString)
      return date.toLocaleString('fr-FR', {
        hour: '2-digit',
        minute: '2-digit',
        day: '2-digit',
        month: '2-digit',
        year: 'numeric'
      }).replace(',', ' -')
    }

    // --- Enregistrer les réponses ---
    const sendResponse = async () => {
      if (!newResponseMessage.value.trim()) {
        return
      }

      try {
        const response = await axios.post('/Support/submit_response.php', {
          idTicket: ticketData.value.idTicket,
          idUser: userId, // ici bien idUser
          commentaire: newResponseMessage.value.trim() // ici bien commentaire
        })

        if (response.data?.success) {
          newResponseMessage.value = '' // Reset champ
          fetchTicketData() // Recharge les réponses
        } else {
        }
      } catch (error) {
        console.error('Erreur envoi de la réponse :', error)
      }
    }

    // --- Au montage ---
    onMounted(() => {
      fetchTicketData()
      fetchStatuses()

    })

    return {
      ticketData,
      ticketResponses,
      statuses,
      newResponseMessage,
      sendResponse,
      formatDate,
      idRole,
      updateTicket,
      deleteTicket
    }
  }
}
</script>