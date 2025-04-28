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
                  <option value="0">Ouvert</option>
                  <option value="1">En cours</option>
                  <option value="2">Fermé</option>
                </select>
              </CListGroupItem>
            </CListGroup>
          </CCardBody>
        </CCard>
        <div class="d-grid gap-2 mt-3">
              <button class="btn btn-primary text-white" type="button" @click="saveNotes">Fermer Ticket</button>
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
    </CCardBody>
  </CCard>
</CContainer>
<br />
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

    const ticketResponses = ref([
  {
    author: 'Agent Support',
    message: 'Nous avons bien reçu votre demande et travaillons dessus.',
    date: '2025-04-26 14:30'
  },
  {
    author: 'Utilisateur',
    message: 'Merci pour votre retour rapide.',
    date: '2025-04-26 15:00'
  },
  {
    author: 'Utilisateur',
    message: 'Merci pour votre retour rapide.',
    date: '2025-04-26 15:00'
  },
  {
    author: 'Utilisateur',
    message: 'Merci pour votre retour rapide.',
    date: '2025-04-26 15:00'
  }
])

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
      ticketData,
      ticketResponses
    }
  }
}
</script>