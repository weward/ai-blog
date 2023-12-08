<template>
  <div>
    <q-table
      flat
      bordered
      title=""
      :grid="$q.screen.xs"
      :rows="data.rows"
      :columns="data.columns"
      :loading="data.loading"
      row-key="id"
      v-model:pagination="data.pagination"
      rows-per-page-options=""
      wrap-cells="true"
      @request="getAllData"
      @row-click="(evt, row, index) => viewDocument(row)"
      class="tw-flex">
    </q-table>
  </div>
</template>

<script setup>
  import { onMounted, reactive } from 'vue'
  import { useRouter } from 'vue-router'
  import { api } from 'src/boot/axios'
  import { documentsTableColumns } from 'src/utils/tableColumns'

  const router = useRouter()

  const data = reactive({
    loading: false,
    rows: [],
    columns: documentsTableColumns,
    pagination: {
      page: 1,
      rowsPerPage: 12,
      rowsNumber: 0, // total
    },
  })

  const getAllData = async (tableProps) => {
    let pagination = await tableProps?.pagination ?? data.pagination

    const { page, rowsPerPage } = await pagination

    data.loading = true

    const params = await { page, rowsPerPage }

    await api.get('/documents', {
      headers: {
        'Content-Type': 'application/json',
        'Authorization': `Bearer ${localStorage.getItem('authToken')}`,
      },
      params,
    }).then(async (res) => {
      data.rows = await res.data.data
      data.pagination.rowsNumber = await res.data.meta.total
      data.pagination = await {...pagination}
      await router.push({ name: 'documents.index', params })
    }).finally(() => {
      data.loading = false
    })
  }

  const viewDocument = (row) => {
    router.push({ name: 'documents.show', params: {id: row.id} })
  }

  onMounted(async () => {
    await getAllData()
  })

</script>
