<template>
  <div>
    <h1>Dashboard</h1>
    <CRow :xs="{ gutter: 4 }">
      <CCol :sm="6" :xl="4" :xxl="3" v-for="(stat, index) in listStats" :key="index">
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

const listStats = ref([
  {
    title: 'Machines Windows',
    value: '0',
    color: 'primary',
  },
  {
    title: 'Machines Linux',
    value: '0',
    color: 'info',
  },
  {
    title: 'Machines MacOS',
    value: '0',
    color: 'warning',
  },
  {
    title: 'Machines Android',
    value: '0',
    color: 'success',
  },
])

const fetchData = async () => {
  try {
    const response = await axios.get('/Dashboard/dashboard.php')
    const data = response.data.data  // <-- Accès correct aux vraies valeurs

    listStats.value = [
      {
        title: 'Machines Windows',
        value: data.windows,
        color: 'primary',
      },
      {
        title: 'Machines Unix',
        value: data.unix,
        color: 'info',
      },
      {
        title: 'Machines MacOS',
        value: data.macos,
        color: 'warning',
      },
      {
        title: 'Machines Android',
        value: data.android,
        color: 'success',
      },
    ]
  } catch (err) {
    console.error('Erreur lors de la récupération des données:', err)
  }
}

onMounted(() => {
  fetchData()
})
</script>
