<template>
  <div>
    <div class="tw-w-full tw-mx-auto tw-my-12 md:tw-w-1/2">
      <q-card flat bordered class="my-card">
        <q-card-section>
          <div class="text-h6">{{ data.entity.subject }}</div>
        </q-card-section>

        <q-separator inset class="tw-mb-6"/>

        <q-card-section>
          <div class="text-subtitle2 tw-pb-3">Summary</div>
          {{ data.entity.summary }}
        </q-card-section>

        <q-card-section>
          <div class="text-subtitle2 tw-pb-3">Topics</div>
          <div v-html="data.entity.bullets" style="white-space: pre-line;"></div>
        </q-card-section>


        <q-card-section>
          <div class="text-subtitle2 tw-py-3">Content</div>
          <div v-html="data.entity.result"></div>
        </q-card-section>
      </q-card>
    </div>
  </div>
</template>

<script setup>
import { watchEffect, reactive } from 'vue'
import {useRoute } from 'vue-router'
import { api } from 'src/boot/axios'

const route = useRoute()

const data = reactive({
  loading: false,
  entity: {},
})

const loadData = async (id) => {
  await api.get(`/documents/${id}`)
    .then(async (res) => {
      data.entity = await res.data.data
    }).finally(() => {
      data.loading = false
    })
}

watchEffect(async () => {
  await loadData(route.params.id)
})

</script>
