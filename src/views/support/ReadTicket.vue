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
    const ticketId = route.params.id // Retrieve ticket ID from the route

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
      }
    ])

    const statuses = ref([])

    // Fetch ticket data
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
          console.error('Aucune donnée trouvée pour l\'ID spécifié')
        }
      } catch (error) {
        console.error('Erreur lors de la récupération des données:', error)
      }
    }

    // Fetch statuses
    const fetchStatuses = async () => {
      try {
        const response = await axios.get('/Support/Get_details.php')
        if (response.data?.statuses) {
          statuses.value = response.data.statuses
        } else {
          console.error('Erreur lors de la récupération des statuts.')
        }
      } catch (error) {
        console.error('Erreur lors de la récupération des statuts:', error)
      }
    }

    // Fetch ticket data and statuses on component mount
    onMounted(() => {
      fetchTicketData()
      fetchStatuses()
    })

    return {
      ticketData,
      ticketResponses,
      statuses
    }
  }
}
</script>