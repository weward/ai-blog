<template>
  <q-page class="tw-w-full">

    <q-card class="my-card tw-w-full tw-p-6">

      <q-card-section>
        <div class="tw-flex tw-justify-between">
          <div>
            <div class="tw-text-4xl tw-font-semibold">Documents</div>
            <div class="tw-text-gray-600">Your list of AI-generated content</div>
          </div>

          <div>
            <q-btn
              href="/new"
              color="amber-6"
              label="Create New"
              class="tw-mr-3"
              rounded
              unelevated
            />
          </div>
        </div>
      </q-card-section>

      <q-separator/>

      <q-card-section class="tw-pt-12">

        <DocumentsTable />

      </q-card-section>

    </q-card>

  </q-page>
</template>

<script setup>
import { onMounted, reactive } from 'vue'
import DocumentsTable from 'src/components/Documents/DocumentsTable.vue'

const data = reactive({
  formDefault: {},
  loading: false,
  hasResults: false,
})

onMounted(() => {

})

</script>
