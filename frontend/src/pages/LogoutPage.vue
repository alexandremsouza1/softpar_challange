<template>
  <q-page class="flex flex-center">
    <div class="text-center">
      <p class="text-h5 q-mb-md">Deslogando</p>
      <q-spinner color="primary" size="3em" />
    </div>
  </q-page>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import { useQuasar } from 'quasar';
import { useRouter } from 'vue-router';
import { useStore } from 'vuex';
import AuthenticationService from "../services/AuthenticationService";

const $q = useQuasar();
const router = useRouter();
const store = useStore();
const isLoggingOut = ref(false);

const logout = async () => {
  if (isLoggingOut.value) return; 

  isLoggingOut.value = true;
  try {
    await AuthenticationService.signout();
    await store.dispatch('logout'); 
    router.replace('/login');
  } catch (error) {
    console.error('Erro ao deslogar:', error);
    router.replace('/login');
  } finally {
    isLoggingOut.value = false;
  }
};

onMounted(() => {
  logout();
});
</script>