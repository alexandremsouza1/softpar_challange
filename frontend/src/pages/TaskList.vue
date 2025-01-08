<template>
  <div class="q-pa-md">
    <h1 class="text-h4 q-mb-md">Task Manager</h1>

    <q-form @submit="addTask" class="q-mb-md">
      <div class="row q-col-gutter-md">
        <q-input
          v-model="newTask.title"
          dense
          outlined
          class="col-12"
          label="Task Title"
          :rules="[val => !!val || 'Title is required']"
        />
        <q-input
          v-model="newTask.description"
          type="textarea"
          dense
          outlined
          class="col-12"
          label="Description"
        />
        <q-select
          v-model="newTask.category_id"
          :options="categories"
          dense
          outlined
          class="col-12 col-md-6"
          label="Category"
          option-value="id"
          option-label="name"
          emit-value
          map-options
        />
        <q-input
          v-model="newTask.deadline"
          dense
          outlined
          class="col-12 col-md-6"
          label="Deadline"
          type="datetime"
        >
          <template v-slot:append>
            <q-icon name="event" class="cursor-pointer">
              <q-popup-proxy cover transition-show="scale" transition-hide="scale">
                <q-date v-model="newTask.deadline">
                  <div class="row items-center justify-end">
                    <q-btn v-close-popup label="Close" color="primary" flat />
                  </div>
                </q-date>
              </q-popup-proxy>
            </q-icon>
          </template>
        </q-input>
        <div class="col-12">
          <q-checkbox v-model="newTask.is_urgent" label="Urgent" />
          <q-checkbox v-model="newTask.is_important" label="Important" />
        </div>
      </div>
      <q-select
        v-model="newTask.subtasks"
        multiple
        :options="convertTasks(tasks)"
        label="Selecione as sub-tarefas"
        use-chips
        clearable
      />
      <div class="row justify-end q-mt-md">
        <q-btn
          color="primary"
          icon="add"
          label="Add Task"
          type="submit"
          :disable="!newTask.title"
        />
      </div>
    </q-form>

    <q-list bordered separator>
      <q-item v-for="task in tasks" :key="task.id" clickable v-ripple>
        <q-item-section avatar>
          <q-checkbox v-model="task.is_completed" @update:model-value="updateTask(task)" />
        </q-item-section>

        <q-item-section>
          <q-item-label :class="{ 'text-strike': task.is_completed }">{{ task.title }}</q-item-label>
          <q-item-label caption>{{ task.description }}</q-item-label>
        </q-item-section>

        <q-item-section side>
          <div class="text-grey-8 q-gutter-xs">
            <q-badge color="red" v-if="task.is_urgent">Urgent</q-badge>
            <q-badge color="orange" v-if="task.is_important">Important</q-badge>
            <q-badge color="blue" v-if="task.deadline">
              {{ new Date(task.deadline).toLocaleDateString() }}
            </q-badge>
            <q-btn
              flat
              round
              color="negative"
              icon="delete"
              @click="deleteTask(task.id)"
            />
          </div>
        </q-item-section>
      </q-item>
    </q-list>
  </div>
</template>

<script setup>
import { ref, reactive, onMounted } from 'vue'
import TaskService from "../services/TaskService";
import CategoryService from "../services/CategoryService";
import { useQuasar } from 'quasar'

const $q = useQuasar()

const tasks = ref([])
const categories = ref([])

onMounted(() => {
    fetchTasks()
    fetchCategories()
  })
const newTask = reactive({
  title: '',
  description: '',
  category_id: null,
  deadline: '',
  is_urgent: false,
  is_important: false,
  subtasks: []
})

const convertTasks = (tasks) => {
  return tasks.map(task => ({
    id: task.id,
    label: task.title
  }));
}

const fetchTasks = async () => {
    const response = await TaskService.getTasks()
    if (response)
      tasks.value = response
}

const fetchCategories = async () => {
    const response = await CategoryService.getAll()
    if (response)
      categories.value = response
}


const addTask = async () => {
  try {
    const response = await TaskService.create(newTask)
    tasks.value.push(response.data)
    $q.notify({
      color: 'positive',
      message: 'Task added successfully',
      icon: 'check'
    })

    fetchTasks()
    resetForm()

  } catch (error) {
    console.error('Error adding task:', error)
    $q.notify({
      color: 'negative',
      message: 'Failed to add task. Please try again.',
      icon: 'error'
    })
  }
}

const updateTask = async (task) => {
  try {
    await TaskService.update(task)
    $q.notify({
      color: 'positive',
      message: 'Task updated successfully',
      icon: 'check'
    })
  } catch (error) {
    console.error('Error updating task:', error)
    $q.notify({
      color: 'negative',
      message: 'Failed to update task. Please try again.',
      icon: 'error'
    })
  }
}

const resetForm = () => {
  newTask.title = ''
  newTask.description = ''
  newTask.category_id = null
  newTask.deadline = ''
  newTask.is_urgent = false
  newTask.is_important = false
  newTask.subtasks = []
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