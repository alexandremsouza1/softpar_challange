<template>
    <q-page class="flex flex-center">
      <div class="todo-container q-pa-md" style="width: 100%; max-width: 40%">
        <h1 class="text-h4 text-center q-mb-lg">Todo List</h1>
  
        <!-- Add Task Form -->
        <q-form @submit="addTask" class="q-mb-md">
          <div class="row">
            <q-input
              v-model="newTask"
              dense
              outlined
              class="col"
              placeholder="Add New Task..."
              :rules="[val => !!val || 'Task is required']"
            />
            <q-btn
              flat
              color="primary"
              icon="add"
              type="submit"
              class="q-ml-sm"
              :disable="!newTask"
            />
          </div>
        </q-form>
  
        <!-- Tasks List -->
        <q-list separator>
          <q-item
            v-for="task in tasks"
            :key="task.id"
            class="q-py-md"
          >
            <q-item-section avatar>
              <q-btn
                flat
                round
                :color="task.completed ? 'positive' : 'grey'"
                :icon="task.completed ? 'check' : 'check_box_outline_blank'"
                @click="toggleTask(task.id)"
              />
            </q-item-section>
  
            <q-item-section>
              <q-item-label :class="{ 'text-strike': task.completed }">
                {{ task.text }}
              </q-item-label>
            </q-item-section>
  
            <q-item-section side>
              <q-btn
                flat
                round
                color="negative"
                icon="delete"
                @click="deleteTask(task.id)"
              />
            </q-item-section>
          </q-item>
        </q-list>
      </div>
    </q-page>
  </template>
  
  <script setup>
  import { ref } from 'vue'
  
  const newTask = ref('')
  const tasks = ref([
    { id: 1, text: 'Hello World', completed: true },
    { id: 2, text: 'Workout', completed: false },
    { id: 3, text: 'Team Meeting', completed: true },
    { id: 4, text: 'Read some book', completed: true }
  ])
  
  const addTask = () => {
    if (newTask.value.trim()) {
      tasks.value.push({
        id: Date.now(),
        text: newTask.value,
        completed: false
      })
      newTask.value = ''
    }
  }
  
  const toggleTask = (id) => {
    const task = tasks.value.find(t => t.id === id)
    if (task) {
      task.completed = !task.completed
    }
  }
  
  const deleteTask = (id) => {
    tasks.value = tasks.value.filter(t => t.id !== id)
  }
  </script>
  
  <style scoped>
  .todo-container {
    background: white;
    border-radius: 8px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
  }
  
  /* Smooth transitions for task interactions */
  .q-item {
    transition: all 0.3s ease;
  }
  
  .text-strike {
    text-decoration: line-through;
    color: #999;
  }
  </style>