<template>
  <div>
    <div class="tw-w-full tw-pb-3 tw-mx-auto xl:tw-w-4/6">
      <q-input
        type="textarea"
        v-model="form.keyword"
        label="Keyword"
        rows="5"
        :error="errors.form.hasOwnProperty('keyword') ?? false"
        :error-message="errors.form.keyword?.[0] ?? ''"
        outlined
        autogrow
      />
    </div>

    <div v-if="data.hasResults">

      <div class="tw-w-full tw-pb-3 tw-mx-auto md:tw-w-4/6">
        <q-input
          type="textarea"
          v-model="form.summary"
          label="Summary"
          rows="5"
          filled
          autogrow
        />
      </div>

      <div class="tw-w-full tw-pb-3 tw-mx-auto md:tw-w-4/6">
        <q-input
          type="textarea"
          v-model="form.bullets"
          label="Bullets"
          rows="10"
          filled
          autogrow
        />
      </div>

      <div class="tw-w-full tw-pb-3 tw-mx-auto md:tw-w-4/6">
        <q-input
          type="t`extarea"
          v-model="form.results"
          label="Results"
          rows="10"
          :error="errors.form.hasOwnProperty('results') ?? false"
          :error-message="errors.form.results?.[0] ?? ''"
          filled
          autogrow
        />
      </div>

    </div>

    <div class="tw-text-center tw-py-12">
      <q-btn
        v-if="!data.hasResults"
        @click="generate"
        color="amber-6"
        label="Generate"
        class="tw-mr-3"
        rounded
        unelevated
      />

      <q-btn
        v-if="data.hasResults"
        @click="save"
        label="Save"
        color="amber-6"
        icon="save"
        class="tw-mr-3"
        rounded
        unelevated
      />

      <q-btn
        v-if="data.hasResults"
        @click="reset"
        label="Reset"
        color="white"
        text-color="black"
        icon="refresh"
        rounded
        outline
        unelevated
      />
    </div>
  </div>
</template>

<script setup>

import { onMounted, reactive, toRefs } from 'vue'

const form = reactive({
  keyword: '',
  summary: '',
  bullets: '',
  result: '',
})

const data = reactive({
  formDefault: {},
  loading: false,
  hasResults: false,
})

const errors = reactive({
  form: {},
})


const generate = () => {
  data.loading = true
  data.hasResults = true
  data.loading = false
}

const save = () => {
  data.loading = true

  axios.post(url, {
    keyword: data.keyword,
    summary: data.summary,
    bullets: data.bullets,
    result: data.result,
  }).then(() => {

  }).catch(() => {
    if ([404, 500].includes(err.response?.status)) {
      notify(err.response?.data)
    }
    if (err.response?.status == 422) {
      reject(err.response?.data?.errors)
      return
    }
  }).finally(() => {
    data.loading = false
  })
}

const reset = () => {
  data.loading = true
  data.hasResults = false
  resetResultFields()
  data.loading = false
}

const resetResultFields = () => {
  Object.assign(form, data.formDefault)
}

onMounted(() => {
  data.formDefault = { ...form }
})

</script>
