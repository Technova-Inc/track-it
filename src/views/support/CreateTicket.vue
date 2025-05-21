<template>
  <h1 class="text-center">Créer un ticket de support</h1>
  <br /><br />
  <CContainer>
    <CRow>
      <CCol>
        <CCard>
          <CCardBody>
            <CCardTitle class="text-center">Formulaire de création de ticket</CCardTitle>
            <CListGroup>
              <CListGroupItem>
                <label for="category">Catégorie</label>
                <select id="category" v-model="ticketData.category" class="form-control">
                  <option
                    v-for="category in categories"
                    :key="category.idCategorie"
                    :value="category.libelleCategorie"
                  >
                    {{ category.libelleCategorie }}
                  </option>
                </select>
              </CListGroupItem>
              <CListGroupItem>
                <label for="os">Système d'exploitation</label>
                <input type="text" id="os" v-model="ticketData.os" class="form-control" readonly />
              </CListGroupItem>
              <CListGroupItem>
                <label for="priority">Priorité</label>
                <select id="priority" v-model="ticketData.priority" class="form-control">
                  <option value="Faible">Faible</option>
                  <option value="Moyenne">Moyenne</option>
                  <option value="Élevée">Élevée</option>
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
              <button class="btn btn-primary" type="button" @click="submitTicket">Soumettre</button>
            </div>
          </CCardBody>
        </CCard>
      </CCol>
    </CRow>
  </CContainer>
</template>

<script setup>
import { useRoute, useRouter } from 'vue-router'
import { ref, onMounted } from 'vue'
import { CRow, CCol, CCard, CCardBody, CCardTitle, CListGroup, CListGroupItem } from '@coreui/vue'
import axios from '@/plugins/axios'

// Define reactive data properties for ticket and categories
const ticketData = ref({
  category: '',
  os: '',
  priority: '',
  title: '',
  description: '',
})

const categories = ref([])
const router = useRouter()

// Detect OS
const detectOS = () => {
  const userAgent = window.navigator.userAgent
  let os = 'Unknown OS'

  if (userAgent.indexOf('Win') !== -1) os = 'Windows'
  else if (userAgent.indexOf('Mac') !== -1) os = 'MacOS'
  else if (userAgent.indexOf('Linux') !== -1) os = 'Linux'
  else if (userAgent.indexOf('Android') !== -1) os = 'Android'
  else if (userAgent.indexOf('like Mac') !== -1) os = 'iOS'

  ticketData.value.os = os
}

// Fetch categories from the API
const fetchCategories = async () => {
  try {
    const response = await axios.get('/Support/Get_details.php')
    if (response.data.categories) {
      categories.value = response.data.categories
    } else {
      alert('Erreur lors de la récupération des catégories.')
    }
  } catch (error) {
    console.error('Erreur lors de la récupération des catégories:', error)
    alert('Erreur lors de la récupération des catégories.')
  }
}

// Submit ticket
const user = JSON.parse(localStorage.getItem('user'))
const userId = user ? user.id : null
const submitTicket = async () => {
  try {
    const response = await axios.post(
      '/Support/submit_ticket.php',
      {
        category: ticketData.value.category,
        os: ticketData.value.os,
        priority: ticketData.value.priority,
        title: ticketData.value.title,
        description: ticketData.value.description,
        userid: userId,
      },
      {
        headers: {
          'Content-Type': 'application/json',
        },
      },
    )

    if (response.data.success) {
      router.push('/support')
    } else {
    }
  } catch (error) {
    console.error('Erreur lors de la soumission du ticket:', error)
    alert('Erreur lors de la soumission du ticket.')
  }
}

// On component mount, detect OS and fetch categories
onMounted(() => {
  detectOS()
  fetchCategories()
})
</script>
