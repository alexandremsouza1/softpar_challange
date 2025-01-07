<template>
    <q-page class="q-pa-md">
        <q-list bordered>
                <q-item
                    v-for="task in tasks"
                    :key="task.id"
                >
                    <q-item-section class="cursor-pointer" @click="navigateToTaskDetails(task.id)" >
                        <q-item-label>{{ task.name }}</q-item-label>
                    </q-item-section>

                    <q-item-section side>
                        <q-btn
                            icon="check"
                            color="green"
                            @click="toggleTaskStatus(task)"
                            :disabled="task.status === 'removed'"
                        />
                        <q-btn
                            icon="delete"
                            color="red"
                            @click="deleteTask(task)"
                        />
                    </q-item-section>
                </q-item>
            </q-list>
    </q-page>
</template>

<script setup>
import { ref } from 'vue';

// State para as tarefas
const tasks = ref([
    { id: 1, name: 'Estudar Quasar Framework' },
    { id: 2, name: 'Configurar Vue Router com Quasar' },
    { id: 3, name: 'Criar layout responsivo' },
]);

// Função para adicionar uma nova tarefa
const addTask = () => {
    const newTaskId = tasks.value.length + 1;
    tasks.value.push({ id: newTaskId, name: `Nova tarefa ${newTaskId}` });
};
</script>

<style scoped>
.text-h6 {
    font-weight: bold;
}

.q-list {
    max-height: 300px;
    overflow-y: auto;
}
</style>