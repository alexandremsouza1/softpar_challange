<template>
    <q-page class="q-pa-md">
      <q-card flat bordered>
        <q-card-section>
          <div class="text-h4 q-mb-md">Perfil do Usuário</div>
          <q-separator />
        </q-card-section>
  
        <q-card-section>
          <q-list>
            <q-item>
              <q-item-section>
                <q-item-label overline>Nome</q-item-label>
                <q-item-label class="text-h6">{{ user.name }}</q-item-label>
              </q-item-section>
            </q-item>
            <q-item>
              <q-item-section>
                <q-item-label overline>Email</q-item-label>
                <q-item-label class="text-h6">{{ user.email }}</q-item-label>
              </q-item-section>
            </q-item>
          </q-list>
        </q-card-section>
  
        <q-card-section>
          <div class="text-h5 q-mb-md">Pontuação e Progresso</div>
          <q-linear-progress
            :value="progressPercentage"
            color="primary"
            class="q-mb-md"
            size="25px"
            :label="true"
            :label-value="`${Math.round(progressPercentage * 100)}%`"
          />
          <div class="row q-col-gutter-md">
            <div class="col-12 col-sm-6">
              <q-card class="bg-primary text-white">
                <q-card-section>
                  <div class="text-h6">Pontuação Total</div>
                  <div class="text-h3">{{ totalScore }}</div>
                </q-card-section>
              </q-card>
            </div>
            <div class="col-12 col-sm-6">
              <q-card class="bg-secondary text-white">
                <q-card-section>
                  <div class="text-h6">Tarefas Concluídas</div>
                  <div class="text-h3">{{ completedTasksCount }} / {{ tasks.length }}</div>
                </q-card-section>
              </q-card>
            </div>
          </div>
        </q-card-section>
  
        <q-card-section>
          <div class="text-h5 q-mb-md">Tarefas</div>
          <q-list bordered separator>
            <q-item v-for="task in tasks" :key="task.id">
              <q-item-section avatar>
                <q-checkbox v-model="task.completed" @update:model-value="updateScore(task)" />
              </q-item-section>
              <q-item-section>
                <q-item-label :class="{ 'text-strike': task.completed }">{{ task.title }}</q-item-label>
              </q-item-section>
              <q-item-section side>
                <q-chip color="primary" text-color="white">
                  {{ task.points }} pontos
                </q-chip>
              </q-item-section>
            </q-item>
          </q-list>
        </q-card-section>
      </q-card>
    </q-page>
  </template>
  
  <script setup>
  import { ref, computed } from 'vue'
  
  const user = ref({
    name: 'João Silva',
    email: 'joao.silva@example.com'
  })
  
  const tasks = ref([
    { id: 1, title: 'Completar perfil', points: 10, completed: false },
    { id: 2, title: 'Verificar e-mail', points: 5, completed: false },
    { id: 3, title: 'Configurar preferências', points: 15, completed: false },
    { id: 4, title: 'Concluir primeira tarefa', points: 20, completed: false },
    { id: 5, title: 'Convidar um amigo', points: 25, completed: false }
  ])
  
  const totalScore = computed(() => {
    return tasks.value.reduce((total, task) => {
      return total + (task.completed ? task.points : 0)
    }, 0)
  })
  
  const completedTasksCount = computed(() => {
    return tasks.value.filter(task => task.completed).length
  })
  
  const progressPercentage = computed(() => {
    const totalPoints = tasks.value.reduce((total, task) => total + task.points, 0)
    return totalScore.value / totalPoints
  })
  
  const updateScore = (task) => {
    console.log(`Tarefa "${task.title}" ${task.completed ? 'concluída' : 'não concluída'}`)
  }
  </script>
  
  <style scoped>
  .text-strike {
    text-decoration: line-through;
  }
  </style>