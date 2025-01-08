<template>
    <q-page class="q-pa-md">
      <q-card flat bordered>
        <q-card-section>
          <div class="text-h4">Gerenciar Categorias</div>
        </q-card-section>
  
        <q-card-section>
          <q-btn color="primary" label="Nova Categoria" @click="openDialog()" />
        </q-card-section>
  
        <q-card-section>
          <q-table
            :rows="categories"
            :columns="columns"
            row-key="id"
            :loading="loading"
          >
            <template v-slot:body="props">
              <q-tr :props="props">
                <q-td key="name" :props="props">
                  {{ props.row.name }}
                </q-td>
                <q-td key="color" :props="props">
                  <q-chip :style="{ backgroundColor: props.row.color }" text-color="white">
                    {{ props.row.color }}
                  </q-chip>
                </q-td>
                <q-td key="actions" :props="props">
                  <q-btn flat round color="primary" icon="edit" @click="openDialog(props.row)" />
                  <q-btn flat round color="negative" icon="delete" @click="deleteCategory(props.row.id)" />
                </q-td>
              </q-tr>
            </template>
          </q-table>
        </q-card-section>
      </q-card>
  
      <q-dialog v-model="dialogVisible" persistent>
        <q-card style="min-width: 350px">
          <q-card-section>
            <div class="text-h6">{{ editingCategory ? 'Editar' : 'Nova' }} Categoria</div>
          </q-card-section>
  
          <q-card-section>
            <q-input v-model="categoryForm.name" label="Nome" :rules="[val => !!val || 'O nome é obrigatório']" />
            <q-input v-model="categoryForm.color" label="Cor" :rules="[val => !!val || 'A cor é obrigatória']">
              <template v-slot:append>
                <q-icon name="colorize" class="cursor-pointer">
                  <q-popup-proxy cover transition-show="scale" transition-hide="scale">
                    <q-color v-model="categoryForm.color" />
                  </q-popup-proxy>
                </q-icon>
              </template>
            </q-input>
          </q-card-section>
  
          <q-card-actions align="right">
            <q-btn flat label="Cancelar" color="primary" v-close-popup />
            <q-btn flat label="Salvar" color="primary" @click="saveCategory" />
          </q-card-actions>
        </q-card>
      </q-dialog>
    </q-page>
  </template>
  
  <script setup>
  import { ref, reactive, onMounted } from 'vue'
  import { useQuasar } from 'quasar'
  
  const $q = useQuasar()
  
  const categories = ref([])
  const loading = ref(false)
  const dialogVisible = ref(false)
  const editingCategory = ref(null)
  const categoryForm = reactive({
    name: '',
    color: '#000000'
  })
  
  const columns = [
    { name: 'name', required: true, label: 'Nome', align: 'left', field: 'name', sortable: true },
    { name: 'color', required: true, label: 'Cor', align: 'left', field: 'color', sortable: true },
    { name: 'actions', required: true, label: 'Ações', align: 'center', field: 'actions' }
  ]
  
  onMounted(() => {
    fetchCategories()
  })
  
  const fetchCategories = async () => {
    loading.value = true
    try {
      // Simulating API call
      await new Promise(resolve => setTimeout(resolve, 1000))
      categories.value = [
        { id: 1, name: 'Trabalho', color: '#FF0000' },
        { id: 2, name: 'Pessoal', color: '#00FF00' },
        { id: 3, name: 'Estudo', color: '#0000FF' }
      ]
    } catch (error) {
      console.error('Erro ao buscar categorias:', error)
      $q.notify({
        color: 'negative',
        message: 'Erro ao carregar categorias'
      })
    } finally {
      loading.value = false
    }
  }
  
  const openDialog = (category = null) => {
    if (category) {
      editingCategory.value = category
      Object.assign(categoryForm, category)
    } else {
      editingCategory.value = null
      categoryForm.name = ''
      categoryForm.color = '#000000'
    }
    dialogVisible.value = true
  }
  
  const saveCategory = async () => {
    if (!categoryForm.name || !categoryForm.color) {
      $q.notify({
        color: 'negative',
        message: 'Por favor, preencha todos os campos'
      })
      return
    }
  
    try {
      // Simulating API call
      await new Promise(resolve => setTimeout(resolve, 1000))
      
      if (editingCategory.value) {
        const index = categories.value.findIndex(c => c.id === editingCategory.value.id)
        if (index !== -1) {
          categories.value[index] = { ...editingCategory.value, ...categoryForm }
        }
      } else {
        const newCategory = {
          id: categories.value.length + 1,
          ...categoryForm
        }
        categories.value.push(newCategory)
      }
  
      dialogVisible.value = false
      $q.notify({
        color: 'positive',
        message: `Categoria ${editingCategory.value ? 'atualizada' : 'criada'} com sucesso`
      })
    } catch (error) {
      console.error('Erro ao salvar categoria:', error)
      $q.notify({
        color: 'negative',
        message: 'Erro ao salvar categoria'
      })
    }
  }
  
  const deleteCategory = async (id) => {
    try {
      // Simulating API call
      await new Promise(resolve => setTimeout(resolve, 1000))
      categories.value = categories.value.filter(c => c.id !== id)
      $q.notify({
        color: 'positive',
        message: 'Categoria excluída com sucesso'
      })
    } catch (error) {
      console.error('Erro ao excluir categoria:', error)
      $q.notify({
        color: 'negative',
        message: 'Erro ao excluir categoria'
      })
    }
  }
  </script>