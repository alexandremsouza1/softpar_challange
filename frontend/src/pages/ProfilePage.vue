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
                  <div class="text-h6">Missões Concluídas</div>
                  <div class="text-h3">{{ completedTasksCount }} / {{ achievements.length }}</div>
                </q-card-section>
              </q-card>
            </div>
          </div>
        </q-card-section>
  
        <q-card-section>
          <div class="text-h5 q-mb-md">Legenda - Conquistas</div>
          <q-list bordered separator>
            <q-item v-for="achievement in achievements" :key="achievement.id">
              <q-item-section avatar>
                <q-icon 
                  :name="checkCompleted(achievement) ? 'check_circle' : 'cancel'"
                  :color="checkCompleted(achievement) ? 'primary' : 'secondary'"
                  :size="'md'"
                  :onClick="() => updateScore(achievement.id)"
                  class="cursor-pointer"
                />
              </q-item-section>
              <q-item-section>
                <q-item-label >{{ achievement.name }}</q-item-label>
                <q-item-label caption>{{ achievement.description }}</q-item-label>
              </q-item-section>
              <q-item-section side>
                <q-chip color="primary" text-color="white">
                  {{ achievement.points }} pontos
                </q-chip>
              </q-item-section>
            </q-item>
          </q-list>
        </q-card-section>
      </q-card>
    </q-page>
  </template>
  
  <script setup>
  import { ref, computed, onMounted } from 'vue'
  import UserService from "../services/UserService";

  onMounted(() => {
    fetchUser()
    fetchAchievements()
    fetchUserAchievement()
  })

  const user = ref({})
  
  const achievements = ref([
    // { id: 1, title: 'Completar perfil', points: 10, completed: false },
    // { id: 2, title: 'Verificar e-mail', points: 5, completed: false },
    // { id: 3, title: 'Configurar preferências', points: 15, completed: false },
    // { id: 4, title: 'Concluir primeira tarefa', points: 20, completed: false },
    // { id: 5, title: 'Convidar um amigo', points: 25, completed: false }
  ])

  const tasks = ref({})
  

  const fetchUser = async () => {
    const response = await UserService.get()
    if (response)
      user.value = response
  }

  const fetchAchievements = async () => {
    const response = await UserService.getAchievements()
    if (response)
      achievements.value = response
  }

  const fetchUserAchievement = async () => {
    const response = await UserService.getUserAchievement()
    if (response)
      tasks.value = response
  }

  const totalScore = computed(() => {
    if (!tasks.value.completed_achievements) return 0
    return tasks.value.completed_achievements.reduce((total, achievement) => {
      return total + achievement.points
    }, 0)
  })
  
  const completedTasksCount = computed(() => {
    if (!tasks.value.completed_achievements) return 0
    return tasks.value.completed_achievements.length
  })
    
  const progressPercentage = computed(() => {
    if (!achievements.value || achievements.value.length === 0) return 0

    const totalPossiblePoints = achievements.value.reduce((total, achievement) => {
      return total + achievement.points
    }, 0)

    if (totalPossiblePoints === 0) return 0

    return totalScore.value / totalPossiblePoints
  })
  
  const updateScore = (task) => {
    console.log(`Tarefa "${task.title}" ${task.completed ? 'concluída' : 'não concluída'}`)
  }

  const checkCompleted = (task) => {
    if (!tasks.value.completed_achievements || !Array.isArray(tasks.value.completed_achievements)) {
      return false
    }
    return tasks.value.completed_achievements.some(achievement => achievement.id === task.id)
  }
  </script>
  
  <style scoped>
  .text-strike {
    text-decoration: line-through;
  }
  </style>