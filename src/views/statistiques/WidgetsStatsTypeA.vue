<script setup>
import { onMounted, ref } from 'vue'
import { getStyle } from '@coreui/utils'

const widgetChartRef1 = ref()
const widgetChartRef2 = ref()

onMounted(() => {
  document.documentElement.addEventListener('ColorSchemeChange', () => {
    if (widgetChartRef1.value) {
      widgetChartRef1.value.chart.data.datasets[0].pointBackgroundColor = getStyle('--cui-primary')
      widgetChartRef1.value.chart.update()
    }

    if (widgetChartRef2.value) {
      widgetChartRef2.value.chart.data.datasets[0].pointBackgroundColor = getStyle('--cui-info')
      widgetChartRef2.value.chart.update()
    }
  })
})
</script>

<template>
  <CRow :xs="{ gutter: 4 }">
    <CCol :sm="6" :xl="4" :xxl="3">
      <CWidgetStatsA color="primary">
        <template #value
          >26K
          <span class="fs-6 fw-normal"> (-12.4% <CIcon icon="cil-arrow-bottom" />) </span>
        </template>
        <template #title>Windows</template>
      </CWidgetStatsA>
    </CCol>
    <CCol :sm="6" :xl="4" :xxl="3">
      <CWidgetStatsA color="primary">
        <template #value
          >26K
          <span class="fs-6 fw-normal"> (-12.4% <CIcon icon="cil-arrow-bottom" />) </span>
        </template>
        <template #title>Windows</template>
      </CWidgetStatsA>
    </CCol>
    <CCol :sm="6" :xl="4" :xxl="3">
      <CWidgetStatsA color="primary">
        <template #value
          >26K
          <span class="fs-6 fw-normal"> (-12.4% <CIcon icon="cil-arrow-bottom" />) </span>
        </template>
        <template #title>Windows</template>
      </CWidgetStatsA>
    </CCol>
  </CRow>
</template>
