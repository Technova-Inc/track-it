<template>
  <div class="wrapper min-vh-100 d-flex flex-row align-items-center">
    <CContainer>
      <CRow class="justify-content-center">
        <CCol :md="8">
          <CCardGroup>
            <CCard class="p-4">
              <CCardBody>
                <CForm @submit.prevent="handleLogin">
                  <h1>Connexion</h1>
                  <p class="text-body-secondary">Connectez-vous à votre compte</p>
                  <CInputGroup class="mb-3">
                    <CInputGroupText>
                      <CIcon icon="cil-user" />
                    </CInputGroupText>
                    <CFormInput
                      v-model="formData.username"
                      placeholder="Nom d'utilisateur"
                      autocomplete="username"
                      required
                    />
                  </CInputGroup>
                  <CInputGroup class="mb-4">
                    <CInputGroupText>
                      <CIcon icon="cil-lock-locked" />
                    </CInputGroupText>
                    <CFormInput
                      v-model="formData.password"
                      type="password"
                      placeholder="Mot de passe"
                      autocomplete="current-password"
                      required
                    />
                  </CInputGroup>
                  <CRow>
                    <CCol :xs="6">
                      <CButton type="submit" color="primary" class="px-4 text-white">
                        Se connecter
                      </CButton>
                    </CCol>
                  </CRow>
                  <p v-if="errorMessage" class="text-danger mt-3">{{ errorMessage }}</p>
                </CForm>
              </CCardBody>
            </CCard>
            <CCard class="text-white bg-primary py-5" style="width: 44%">
              <CCardBody class="text-center">
                <div>
                  <h2>Créer un compte</h2>
                  <p>
                    Vous pouvez créer un compte utilisateur pour accéder au système de support.
                  </p>
                  <CButton color="light" variant="outline" class="mt-3" disabled>
                    Créer votre compte!
                  </CButton>
                </div>
              </CCardBody>
            </CCard>
          </CCardGroup>
        </CCol>
      </CRow>
    </CContainer>
  </div>
</template>

<script>
export default {
  data() {
    return {
      formData: {
        username: '',
        password: ''
      },
      errorMessage: null
    };
  },
  methods: {
    async handleLogin() {
      try {
        const response = await fetch('https://10.29.123.50/trackit-simple/Connexion/authentification.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(this.formData)
        });

        if (!response.ok) {
          throw new Error('Nom d’utilisateur ou mot de passe incorrect.');
        }

        const data = await response.json();
        // Stockez le token dans le localStorage ou Vuex
        localStorage.setItem('token', data.token);

        // Redirigez l'utilisateur après la connexion
        this.$router.push('/dashboard');
      } catch (error) {
        this.errorMessage = error.message;
      }
    }
  }
};
</script>

<style scoped>
/* Ajoutez vos styles ici si nécessaire */
</style>