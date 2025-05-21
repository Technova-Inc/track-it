<script setup>
import { onMounted, ref } from 'vue'
import MainChart from '@/views/statistiques/MainChart.vue'
import WidgetsStatsA from '@/views/statistiques/WidgetsStatsTypeA.vue'
import WidgetsStatsD from '@/views/statistiques/WidgetsStatsTypeD.vue' // Import du widget D
import ChartTickets from '@/views/statistiques/ChartsTickets.vue'

const isSupport = ref(false)

// Vérification du rôle utilisateur au montage
onMounted(() => {
  const storedUser = JSON.parse(localStorage.getItem('user'))
  if (storedUser) {
    if (storedUser.role === 2) {
      // Vérifie si l'utilisateur a le rôle de support (role === 2)
      console.log('🛠️ Utilisateur support détecté')
      isSupport.value = true
    } else {
      console.log('👤 Utilisateur non-support')
      console.log(storedUser.role)
      isSupport.value = false
    }
  } else {
    console.warn('⚠️ Aucun utilisateur trouvé dans localStorage')
  }
})
</script>

<template>
  <div>
    <!-- Affiche WidgetsStatsA par défaut pour les utilisateurs non-support -->
    <WidgetsStatsA class="mb-4" />

    <CRow>
      <CCol :md="12">
        <CCard class="mb-4">
          <CCardBody>
            <CRow>
              <CCol :sm="5">
                <h4 id="traffic" class="card-title mb-0">Nombre de contact par mois</h4>
              </CCol>
              <CCol :sm="7" class="d-none d-md-block">
                <CButton color="primary" class="float-end">
                  <CIcon icon="cil-cloud-download" />
                </CButton>
              </CCol>
            </CRow>
            <CRow>
              <MainChart style="height: 100%; max-height: 400px; margin-top: 40px" />
            </CRow>
          </CCardBody>
        </CCard>

        <!-- Affiche WidgetsStatsTypeD uniquement pour les utilisateurs support -->
      </CCol>
    </CRow>
    <WidgetsStatsD class="mb-4" v-if="isSupport" />
    <CRow>
      <CCol :md="12">
        <CCard class="mb-4" v-if="isSupport">
          <CCardBody>
            <CRow>
              <CCol :sm="5">
                <h4 id="traffic" class="card-title mb-0">Nombre de tickets par mois</h4>
              </CCol>
              <CCol :sm="7" class="d-none d-md-block">
                <CButton color="primary" class="float-end">
                  <CIcon icon="cil-cloud-download" />
                </CButton>
              </CCol>
            </CRow>
            <CRow>
              <ChartTickets style="height: 100%; max-height: 300px; margin-top: 40px" />
            </CRow>
          </CCardBody>
        </CCard>

        <br />
      </CCol>
    </CRow>
  </div>
</template>
