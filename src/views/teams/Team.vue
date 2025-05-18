<template>
  <h1 class="text-center">Présentation de l'équipe</h1>
  <br />

  <CContainer>
    <!-- Présentation du projet -->
    <CCard class="mb-4">
      <CCardBody>
        <CCardTitle class="text-center">Notre projet</CCardTitle>
        <p>
          Ce projet consiste à développer une <strong>application web de gestion de parc informatique</strong> destinée aux entreprises. Elle permet :
        </p>
        <ul>
          <li>📋 D'inventorier automatiquement les postes informatiques (système, matériel, réseau)</li>
          <li>🖥️ D'afficher les informations critiques de chaque machine</li>
          <li>🎫 De gérer les tickets de support (incidents, demandes, suivi)</li>
        </ul>
        <p>
          L'objectif est de fournir une interface centralisée, intuitive et réactive pour l'administration du parc informatique.
        </p>
      </CCardBody>
    </CCard>

    <!-- Équipe -->
    <CRow>
      <CCol v-for="member in team" :key="member.name" md="4" class="mb-4">
        <CCard class="h-100"> <!-- Carte ayant une hauteur fixe -->
          <CCardBody class="text-center">
            <img :src="member.photo" alt="Photo" class="avatar-img" />
            <h5>{{ member.name }}</h5>
            <p class="text-muted">{{ member.role }}</p>
            <p>{{ member.bio }}</p>
            <div class="d-flex justify-content-center gap-4 mt-3">
              <a :href="member.linkedin" target="_blank" aria-label="LinkedIn" class="icon-link">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#0a66c2" viewBox="0 0 16 16">
                  <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 
                  1.146H1.175C.526 16 0 15.487 0 14.854V1.146zM4.943 13V6.169H2.542V13h2.401zM3.743 5.128c.837 
                  0 1.358-.554 1.358-1.248-.015-.709-.521-1.248-1.342-1.248-.82 0-1.358.539-1.358 
                  1.248 0 .694.521 1.248 1.327 1.248h.015zM13.458 13V9.359c0-1.935-1.034-2.836-2.413-2.836-1.112 
                  0-1.607.613-1.885 1.045v-0.897H6.759c.03.593 0 6.329 0 6.329h2.401v-3.535c0-.189.014-.379.07-.516.154-.379.504-.772 
                  1.092-.772.771 0 1.079.582 1.079 1.436V13h2.057z"/>
                </svg>
              </a>
              <a :href="member.github" target="_blank" aria-label="GitHub" class="icon-link">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#333" viewBox="0 0 16 16">
                  <path d="M8 0C3.58 0 0 3.58 0 8a8.001 8.001 0 0 0 5.47 7.59c.4.07.55-.17.55-.38 
                  0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 
                  1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.5-1.07-1.78-.2-3.64-.89-3.64-3.95 
                  0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.13 0 0 .67-.21 2.2.82a7.68 7.68 0 0 1 2-.27 
                  7.68 7.68 0 0 1 2 .27c1.53-1.04 2.2-.82 2.2-.82.44 1.11.16 1.93.08 
                  2.13.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 
                  0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.001 8.001 0 0 0 16 8c0-4.42-3.58-8-8-8z"/>
                </svg>
              </a>
            </div>
          </CCardBody>
        </CCard>
      </CCol>
    </CRow>
  </CContainer>
</template>

<script setup>
import { ref } from 'vue'
import {
  CContainer,
  CRow,
  CCol,
  CCard,
  CCardBody,
  CCardTitle
} from '@coreui/vue'

// Importation des images locales
import MarinPhoto from '@/assets/images/team/Marin_CD.jpg'
import NicolasPhoto from '@/assets/images/team/Nicolas_JD.JPG'
import QuentinPhoto from '@/assets/images/team/Quentin_P.JPG'

const team = ref([
  {
    name: 'Nicolas Jouin Derrien',
    role: 'Chef de projet / Développeur',
    bio: 'Passionné par Vue.js et l’UX design.',
    photo: NicolasPhoto,
    linkedin: 'https://www.linkedin.com/in/nicolas-jde/',
    github: 'https://github.com/alicedupont'
  },
  {
    name: 'Marin Cadro',
    role: 'Développeur',
    bio: 'Spécialisé en APIs REST et base de données.',
    photo: MarinPhoto,
    linkedin: 'https://www.linkedin.com/in/marin-cadro/',
    github: 'https://github.com/alicedupont'
  },
  {
    name: 'Quentin Parc',
    role: 'Administrateur Système',
    bio: 'Mise en place du parc informatique, réalisation du script.',
    photo: QuentinPhoto,
    linkedin: 'https://www.linkedin.com/in/quentin-parc-77a07b288/',
    github: 'https://github.com/alicedupont'
  }
])
</script>

<style scoped>
.avatar-img {
  width: 200px;
  height: 200px;
  border-radius: 50%;
  object-fit: cover;
  margin-bottom: 10px;
}

.icon-link svg {
  transition: transform 0.2s ease;
}
.icon-link:hover svg {
  transform: scale(1.2);
}

.ccard {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  height: 100%;
}

.ccard .card-body {
  flex: 1;
}
</style>
