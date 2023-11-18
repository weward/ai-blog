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
      hide-header
      v-model:pagination="data.pagination"
      rows-per-page-options=""
      @request="getAllData"
      class="tw-flex">
    </q-table>
  </div>
</template>

<script setup>
  import { reactive } from 'vue'

  const data = reactive({
    loading: false,
    rows: [],
    columns: {},
    pagination: {
      page: 1,
      rowsPerPage: 12,
      rowsNumber: 0, // total
    },
  })

  const getAllData = async ({ pagination }) => {
    const { page } = await pagination

    data.loading = true

    await axios.get({ page })
      .then(async (res) => {
        data.rows = await res.data
        data.pagination.rowsNumber = await res.meta.total
      }).finally(() => {
        data.loading = false
      })
  }

</script>
