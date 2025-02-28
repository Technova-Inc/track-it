<template>
    <h1 class="text-center">Consultation de {{ $route.params.id }}</h1>
    <br><br>
    <CContainer>
        <CRow>
            <CCol>
                <CCard>
                    <CCardBody>
                        <CCardTitle class="text-center">Informations système</CCardTitle>
                        <CListGroup>
                            <CListGroupItem>
                               OS : {{ os }}
                            </CListGroupItem>
                            <CListGroupItem>
                               OS Version : {{ osVersion }}
                            </CListGroupItem>
                            <CListGroupItem>
                                Architecture  : {{ architecture }}
                            </CListGroupItem>
                            <CListGroupItem>
                                Utilisateur windows  : {{ userWindows }}
                            </CListGroupItem>
                            <CListGroupItem>
                                Licence windows  : {{ licenceWindows }}
                            </CListGroupItem>
                            <CListGroupItem>
                                Clé windows  : {{ keyWindows }}
                            </CListGroupItem>
                        </CListGroup>
                    </CCardBody>
                </CCard>
                <br>
                <CCard>
                    <CCardBody>
                        <CCardTitle class="text-center">Hardware</CCardTitle>
                        <CListGroup>
                            <CListGroupItem>
                                Swap : {{ swap }}
                            </CListGroupItem>
                            <CListGroupItem>
                                RAM : {{ ram }} octets
                            </CListGroupItem>
                            <CListGroupItem>
                                UUID : {{ uuid }}
                            </CListGroupItem>
                        </CListGroup>
                    </CCardBody>
                </CCard>
            </CCol>
            <CCol>
                <CCard>
                    <CCardBody>
                        <CCardTitle class="text-center">Réseau</CCardTitle>
                        <CListGroup>
                            <CListGroupItem>
                               Domaine : {{ domaine }}
                            </CListGroupItem>
                            <CListGroupItem>
                                Adresse IP : {{ ipAdress }}
                            </CListGroupItem>
                        </CListGroup>
                    </CCardBody>
                </CCard>
                <br>
                <CCard>
                    <CCardBody>
                        <CCardTitle class="text-center">Agent</CCardTitle>
                        <CListGroup>
                            <CListGroupItem>
                                User agent : {{ userAgent }}
                            </CListGroupItem>
                            <CListGroupItem>
                                Dernier inventaire  : {{ lastInventory }}
                            </CListGroupItem>
                            <CListGroupItem>
                                Dernier contact  : {{ lastContact }}
                            </CListGroupItem>
                        </CListGroup>
                    </CCardBody>
                </CCard>
                <br>
                <CCard>
                    <CCardBody>
                        <CCardTitle class="text-center">Notes</CCardTitle>
                        <textarea class="form-control" aria-label="Notes"></textarea>
                        <div class="d-grid gap-2 mt-3">
                            <button 
                                class="btn btn-primary"
                                type="button"
                                @click="saveNotes"
                            >
                                    Sauvegarder
                            </button>
                        </div>
                    </CCardBody>
                </CCard>
            </CCol>
        </CRow>
    </CContainer>
</template> 
<script setup>
import { CRow } from '@coreui/vue';

</script>