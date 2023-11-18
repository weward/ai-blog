<template>
  <div>
    <q-table
      flat
      bordered
      title=""
      :rows="data.rows"
      :columns="data.columns"
      :loading="data.loading"
      row-key="id"
      v-model:pagination="data.pagination"
      rows-per-page-options=""
      @request="getAllData"
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
    const { page } = await pagination

    data.loading = true


    const params = await { page }

    await api.get('/documents', { params })
      .then(async (res) => {
        data.rows = await res.data.data
        data.pagination.rowsNumber = await res.data.meta.total
        data.pagination = await {...pagination}
        await router.push({ name: 'documents.index', params })
      }).finally(() => {
        data.loading = false
      })
  }

  onMounted(async () => {
    await getAllData()
  })

</script>
