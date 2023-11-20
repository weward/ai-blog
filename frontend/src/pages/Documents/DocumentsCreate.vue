<template>
  <q-page class="tw-w-full">

    <q-card class="my-card tw-w-full tw-pt-6 md:tw-p-6">

      <q-card-section>
        <div class="tw-flex tw-justify-between tw-flex-col md:tw-flex-row">
          <div class="tw-text-center md:tw-text-left">
            <div class="tw-text-4xl tw-font-semibold">New Document</div>
            <div class="tw-text-gray-600">Generate a new content with A.I.</div>
          </div>

          <div class="tw-self-center tw-my-6 md:tw-my-0">
            <q-btn
              to="/documents"
              label="Back to list"
              color="white"
              text-color="black"
              icon="arrow_left"
              rounded
            />
          </div>
        </div>
      </q-card-section>

      <q-separator />

      <q-card-section class="tw-pt-12">

        <DocumentsForm />

      </q-card-section>

    </q-card>

  </q-page>
</template>

<script setup>
import DocumentsForm from 'src/components/Documents/DocumentsForm.vue'

</script>
