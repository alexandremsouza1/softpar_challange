<template>
    <q-page class="flex flex-center">
      <q-card class="login-card">
        <!-- Título -->
        <q-card-section class="text-center">
          <div class="text-h6">Bem-vindo! Faça Login</div>
          <div class="text-subtitle2 q-mt-sm">Insira suas credenciais abaixo:</div>
        </q-card-section>
  
        <!-- Formulário de Login -->
        <q-card-section>
          <q-form @submit.prevent="handleSignIn" ref="loginForm">
            <!-- Campo de Email -->
            <q-input
              v-model="email"
              label="Email"
              type="email"
              outlined
              dense
              :rules="[rules.required, rules.email]"
              autofocus
            />
  
            <!-- Campo de Senha -->
            <q-input
              v-model="password"
              label="Senha"
              type="password"
              outlined
              dense
              class="q-mt-md"
              :rules="[rules.required]"
            />
  
            <!-- Botão de Ação -->
            <q-btn
              label="Entrar"
              color="primary"
              type="submit"
              class="full-width q-mt-lg"
            />
  
            <!-- Link para registro -->
            <q-btn
              flat
              label="Criar conta"
              color="secondary"
              class="full-width q-mt-md"
              @click="goToRegister"
            />
          </q-form>
        </q-card-section>
  
        <!-- Rodapé -->
        <q-card-actions align="center" class="text-grey-6">
          <span>© 2025 - Sua Empresa</span>
        </q-card-actions>
      </q-card>
    </q-page>
  </template>
  
  <script setup lang="ts">
  import { ref } from "vue";
  import { useRouter } from "vue-router";
  import AuthenticationService from "../services/AuthenticationService";
  
  // Definição dos campos do formulário
  const email = ref("");
  const password = ref("");
  
  // Regras de validação
  const rules = {
    required: (val: string) => !!val || "Campo obrigatório",
    email: (val: string) =>
      /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val) || "Email inválido",
  };
  
  // Manipulação de rotas
  const router = useRouter();
  
  // Função para login
  const handleSignIn = async () => {
    try {
      const response = await AuthenticationService.signin(email.value, password.value);
      const token = response.data.access_token;
  
      // Armazena o token no localStorage
      localStorage.setItem("access_token", token);
  
      // Redireciona para a página principal
      router.push("/");
    } catch (error) {
      console.error("Falha no login:", error);
      alert("Erro ao fazer login. Verifique suas credenciais.");
    }
  };
  
  // Redireciona para a página de registro
  const goToRegister = () => {
    router.push("/register");
  };
  </script>
  
  <style scoped>
  .login-card {
    width: 400px;
    max-width: 90%;
  }
  
  .full-width {
    width: 100%;
  }
  </style>
  