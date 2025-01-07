<template>
    <q-layout view="lHh LpR lFf">
      <!-- Cabeçalho opcional -->
      <q-header class="bg-primary text-white">
        <q-toolbar>
          <q-toolbar-title>Login</q-toolbar-title>
        </q-toolbar>
      </q-header>
  
      <!-- Conteúdo principal -->
      <q-page-container>
        <q-page padding>
          <!-- Aqui será injetado o conteúdo das páginas de login/registro -->
          <slot />
        </q-page>
      </q-page-container>
  
      <!-- Rodapé opcional -->
      <q-footer class="bg-grey-2 text-grey-9">
        <div class="text-center q-pa-sm">
          © 2025 - Sua Empresa
        </div>
      </q-footer>
    </q-layout>
  </template>
  
  <script setup lang="ts">
  // Nenhuma lógica é necessária aqui, já que o layout apenas organiza as páginas de autenticação.
  </script>
  
  <style scoped>
  /* Opcional: estilos personalizados para o layout */
  </style>