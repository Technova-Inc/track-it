<script setup>
import avatar from '@/assets/images/avatars/8.jpg'
import { useRouter } from 'vue-router'

const router = useRouter()

// Fonction pour gérer la déconnexion
const handleLogout = () => {
  // Supprimer les données d'utilisateur du localStorage
  localStorage.removeItem('user')

  // Rediriger vers la page de connexion
  router.push('/login')
}
</script>

<template>
  <CDropdown placement="bottom-end" variant="nav-item">
    <CDropdownToggle class="py-0 pe-0" :caret="false">
      <CAvatar :src="avatar" size="md" />
    </CDropdownToggle>
    <CDropdownMenu class="pt-0">
      <!--<CDropdownDivider />-->
      <CDropdownItem @click="handleLogout">
        <CIcon icon="cil-lock-locked" /> Logout
      </CDropdownItem>
    </CDropdownMenu>
  </CDropdown>
</template>