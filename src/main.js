import { createApp } from 'vue'
import { createPinia } from 'pinia'
import router from '@/router'
import vuetify from './plugins/vuetify'
import App from './App.vue'

import CoreuiVue from '@coreui/vue'
import CIcon from '@coreui/icons-vue'
import { iconsSet as icons } from '@/assets/icons'
import 'vuetify/dist/vuetify.min.css';


const app = createApp(App)
app.use(createPinia())
app.use(router)
app.use(CoreuiVue)
app.use(vuetify)
app.provide('icons', icons)
app.component('CIcon', CIcon)

app.mount('#app')