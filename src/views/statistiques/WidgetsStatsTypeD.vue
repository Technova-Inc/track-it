<template>
  <div>
    <h1>Tickets</h1>
    <CRow :xs="{ gutter: 4 }">
      <!-- Affichage des statistiques pour l'utilisateur support -->
      <CCol
        :sm="6"
        :xl="4"
        :xxl="3"
        v-for="(stat, index) in supportStats"
        :key="'support-' + index"
      >
        <CWidgetStatsA :color="stat.color">
          <template #value>{{ stat.value }}</template>
          <template #title>{{ stat.title }}</template>
        </CWidgetStatsA>
      </CCol>
    </CRow>
  </div>
</template>

<script setup>
import { onMounted, ref } from 'vue'
import axios from '@/plugins/axios'

const supportStats = ref([
  {
    title: 'Taux de clôture',
    value: '0%',
    color: 'danger', // Couleur par défaut pour un taux de clôture faible
  },
  {
    title: 'Temps moyen de résolution',
    value: '0h 00m',
    color: 'dark', // Couleur par défaut
  },
  {
    title: 'Tickets en cours',
    value: '0',
    color: 'warning',
  },
  {
    title: 'Tickets totaux',
    value: '0',
    color: 'secondary',
  },
  {
    title: 'Tickets ouverts ce mois',
    value: '0',
    color: 'info',
  },
  {
    title: 'Tickets résolus',
    value: '0',
    color: 'success',
  },
  {
    title: "Tickets résolus aujourd'hui",
    value: '0',
    color: 'primary',
  },
  {
    title: 'Tickets en attente depuis plus de 48h',
    value: '0',
    color: 'danger', // Critique si > 48h
  },
])

onMounted(() => {
  fetchSupportStats()
})

// Fonction pour récupérer les statistiques support
const fetchSupportStats = async () => {
  try {
    const response = await axios.get('/Support/stats_tickets.php')
    const data = response.data.data

    // Mise à jour dynamique des statistiques et des couleurs
    supportStats.value = [
      {
        title: 'Taux de clôture',
        value: data.closure_rate_percent + '%',
        color: parseFloat(data.closure_rate_percent) < 50 ? 'danger' : 'success', // Si < 50%, couleur danger, sinon success
      },
      {
        title: 'Temps moyen de résolution',
        value: formatResolutionTime(data.avg_resolution_time_hours),
        color: parseFloat(data.avg_resolution_time_hours) > 24 ? 'danger' : 'success', // Plus de 24h = danger, sinon success
      },
      {
        title: 'Tickets en cours',
        value: data.tickets_in_progress_count,
        color: 'warning', // Tickets en cours = warning
      },
      {
        title: 'Tickets totaux',
        value: data.total_tickets,
        color: 'secondary', // Information générale, pas de priorité élevée
      },
      {
        title: 'Tickets ouverts ce mois',
        value: data.monthly_tickets,
        color: 'info', // Activité du mois
      },
      {
        title: 'Tickets résolus',
        value: data.resolved_tickets,
        color: 'success', // Résolus = succès
      },
      {
        title: "Tickets résolus aujourd'hui",
        value: data.resolved_today,
        color: 'primary', // Statistique en temps réel, donc priorité
      },
      {
        title: 'Tickets en attente depuis plus de 48h',
        value: data.stale_tickets,
        color: data.stale_tickets > 0 ? 'danger' : 'secondary', // Si > 0 tickets vieux > 48h, danger, sinon light
      },
    ]
  } catch (error) {
    console.error('Erreur lors du chargement des stats support :', error)
  }
}

// Fonction pour formater le temps moyen de résolution en format lisible
const formatResolutionTime = (time) => {
  if (time.includes('j')) {
    // Si c'est un temps en jours (format "1.1 j"), on convertit en heures
    const days = parseFloat(time)
    const hours = Math.round(days * 24) // Convertir les jours en heures
    return `${hours}h`
  }
  return time // Si ce n'est pas en jours, on retourne tel quel
}
</script>
