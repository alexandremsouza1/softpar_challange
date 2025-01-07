<template>
  <q-layout view="lHh Lpr lFf">
    <q-header elevated>
      <q-toolbar>
        <q-btn
          flat
          dense
          round
          icon="menu"
          aria-label="Menu"
          @click="toggleLeftDrawer"
        />

        <q-toolbar-title align="center">
          Todo List 
        </q-toolbar-title>

        <div>Version v{{ appVersion }}</div>
      </q-toolbar>
    </q-header>

    <!-- Drawer / Menu Lateral -->
    <q-drawer
      v-model="leftDrawerOpen"
      show-if-above
      bordered
      class="bg-grey-1"
    >
      <q-list>
        <q-item-label header>Menu</q-item-label>

        <q-item
          v-for="item in menuItems"
          :key="item.label"
          :to="item.route"
          clickable
          v-ripple
        >
          <q-item-section avatar>
            <q-icon :name="item.icon" />
          </q-item-section>

          <q-item-section>
            {{ item.label }}
          </q-item-section>
        </q-item>
      </q-list>
    </q-drawer>

    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script setup lang="ts">
import { ref } from 'vue'

const appVersion = import.meta.env.VITE_APP_VERSION || 'Unknown'
const leftDrawerOpen = ref(false)

const menuItems = [
  {
    label: 'Tarefas',
    icon: 'task',
    route: '/'
  },
  {
    label: 'Relatório',
    icon: 'assessment',
    route: '/relatorio'
  },
  {
    label: 'Pontuação',
    icon: 'stars',
    route: '/pontuacao'
  }
]

const toggleLeftDrawer = () => {
  leftDrawerOpen.value = !leftDrawerOpen.value
}
</script>

<style scoped>
.q-toolbar {
  min-height: 60px;
}

.q-drawer {
  background: white;
}
</style>