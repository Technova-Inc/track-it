<template>
  <h1 class="text-center">Créer un ticket de support</h1>
  <br /><br />
  <CContainer>
    <CRow>
      <CCol>
        <CCard>
          <CCardBody>
            <CCardTitle class="text-center">Formulaire de création de ticket</CCardTitle>
            <form @submit.prevent="submitTicket">
              <CListGroup>
                <CListGroupItem>
                  <label for="category">Catégorie</label>
                  <select id="category" v-model="ticketData.category" class="form-control">
                    <option value="bug">Bug</option>
                    <option value="feature">Demande de fonctionnalité</option>
                    <option value="support">Assistance</option>
                  </select>
                </CListGroupItem>
                <CListGroupItem>
                  <label for="os">Système d'exploitation</label>
                  <input
                    type="text"
                    id="os"
                    v-model="ticketData.os"
                    class="form-control"
                    readonly
                  />
                </CListGroupItem>
                <CListGroupItem>
                  <label for="priority">Priorité</label>
                  <select id="priority" v-model="ticketData.priority" class="form-control">
                    <option value="low">Faible</option>
                    <option value="medium">Moyenne</option>
                    <option value="high">Élevée</option>
                  </select>
                </CListGroupItem>
                <CListGroupItem>
                  <label for="title">Titre</label>
                  <input
                    type="text"
                    id="title"
                    v-model="ticketData.title"
                    class="form-control"
                    required
                  />
                </CListGroupItem>
                <CListGroupItem>
                  <label for="description">Description</label>
                  <textarea
                    id="description"
                    v-model="ticketData.description"
                    class="form-control"
                    required
                  ></textarea>
                </CListGroupItem>
              </CListGroup>
              <div class="d-grid gap-2 mt-3">
                <button class="btn btn-primary" type="submit">Soumettre</button>
              </div>
            </form>
          </CCardBody>
        </CCard>
      </CCol>
    </CRow>
  </CContainer>
</template>

<script setup>
import { CRow, CCol, CCard, CCardBody, CCardTitle, CListGroup, CListGroupItem } from '@coreui/vue'
import { ref, onMounted } from 'vue'
import axios from '@/plugins/axios'

// Define reactive data properties
const ticketData = ref({
  category: '',
  os: '',
  priority: '',
  title: '',
  description: '',
})

// Detect OS
const detectOS = () => {
  // Simple OS detection logic (this can be enhanced)
  const userAgent = window.navigator.userAgent
  let os = 'Unknown OS'

  if (userAgent.indexOf('Win') !== -1) os = 'Windows'
  else if (userAgent.indexOf('Mac') !== -1) os = 'MacOS'
  else if (userAgent.indexOf('Linux') !== -1) os = 'Linux'
  else if (userAgent.indexOf('Android') !== -1) os = 'Android'
  else if (userAgent.indexOf('like Mac') !== -1) os = 'iOS'

  ticketData.value.os = os
}

onMounted(() => {
  detectOS()
})

const submitTicket = async () => {
  try {
    const response = await axios.post('/submit-ticket', ticketData.value)
    if (response.status === 200) {
      alert('Ticket soumis avec succès!')
    } else {
      alert('Erreur lors de la soumission du ticket.')
    }
  } catch (error) {
    console.error('Erreur lors de la soumission du ticket:', error)
    alert('Erreur lors de la soumission du ticket.')
  }
}
</script>
