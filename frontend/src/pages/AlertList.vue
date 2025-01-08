<template>
    <q-page class="q-pa-md">
      <q-card flat bordered>
        <q-card-section>
          <div class="text-h4">Tarefas em Atraso</div>
        </q-card-section>
  
        <q-card-section v-if="loading">
          <q-spinner color="primary" size="3em" />
        </q-card-section>
  
        <q-card-section v-else-if="tasks.length === 0">
          <q-banner class="bg-positive text-white">
            Parabéns! Você não tem tarefas em atraso.
          </q-banner>
        </q-card-section>
  
        <q-card-section v-else>
          <q-list bordered separator>
            <q-item v-for="task in tasks" :key="task.id" clickable v-ripple>
              <q-item-section avatar>
                <q-icon name="warning" color="negative" />
              </q-item-section>
              <q-item-section>
                <q-item-label>{{ task.title }}</q-item-label>
                <q-item-label caption>
                  Vencimento: {{ formatDate(task.deadline) }}
                </q-item-label>
              </q-item-section>
              <q-item-section side>
                <q-btn flat round color="primary" icon="done" @click="markAsCompleted(task)" />
              </q-item-section>
            </q-item>
          </q-list>
        </q-card-section>
      </q-card>
    </q-page>
  </template>
  
  <script setup>
  import { ref, computed, onMounted } from 'vue'
  import { date } from 'quasar'
  import { useQuasar } from 'quasar'

  import TaskService from "../services/TaskService";
  
  const $q = useQuasar()
  
  const tasks = ref([])
  const loading = ref(true)
  

  const fetchTasks = async () => {
    loading.value = true
    try {
      // Simulating API call
      const response = await TaskService.delayed()
      tasks.value = response
      // [
      //   { id: 1, title: 'Relatório mensal', dueDate: '2023-05-01', completed: false },
      //   { id: 2, title: 'Reunião com cliente', dueDate: '2023-05-03', completed: false },
      //   { id: 3, title: 'Atualizar documentação', dueDate: '2023-05-05', completed: false },
      //   { id: 4, title: 'Revisar código', dueDate: '2023-05-10', completed: false },
      // ]
    } catch (error) {
      console.error('Erro ao buscar tarefas:', error)
      $q.notify({
        color: 'negative',
        message: 'Erro ao carregar tarefas'
      })
    } finally {
      loading.value = false
    }
  }
  
  const formatDate = (dateString) => {
    return date.formatDate(dateString, 'DD/MM/YYYY')
  }
  
  const markAsCompleted = async (task) => {
    try {
      task.is_completed = true
      await TaskService.update(task)
      fetchTasks()
      $q.notify({
        color: 'positive',
        message: 'Tarefa atualizada com sucesso'
      })
    } catch (error) {
      console.error('Erro ao marcar tarefa como concluída:', error)
      $q.notify({
        color: 'negative',
        message: 'Erro ao atualizar tarefa'
      })
    }
  }
  
  onMounted(() => {
    fetchTasks()
  })
  </script>