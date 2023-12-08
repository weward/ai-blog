<template>
  <div>
    <div class="tw-w-full tw-pb-3 tw-mx-auto xl:tw-w-4/6">
      <q-input
        type="textarea"
        v-model="form.subject"
        label="Subject"
        rows="5"
        :error="errors.form.hasOwnProperty('subject') ?? false"
        :error-message="errors.form.subject?.[0] ?? ''"
        :rules="[val => val.length > 1 || 'Please input a longer subject.']"
        :loading="data.loading"
        :disable="data.loading"
        outlined
        autogrow
      />
    </div>

    <div v-if="data.hasPlot">

      <div class="tw-w-full tw-pb-3 tw-mx-auto md:tw-w-4/6">
        <q-input
          type="textarea"
          v-model="form.summary"
          label="Summary"
          rows="5"
          :loading="data.loading"
          :readonly="data.loading"
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
          :error="errors.form.hasOwnProperty('bullets') ?? false"
          :error-message="errors.form.bullets?.[0] ?? ''"
          :loading="data.loading"
          :readonly="data.loading"
          filled
          autogrow
        />
      </div>

    </div>

    <div v-if="data.hasResult">

      <div class="tw-w-full tw-pb-3 tw-mx-auto md:tw-w-4/6">
        <q-input
          type="textarea"
          v-model="form.result"
          label="Result"
          rows="10"
          :error="errors.form.hasOwnProperty('result') ?? false"
          :error-message="errors.form.result?.[0] ?? ''"
          :loading="data.loading"
          :readonly="data.loading"
          filled
          autogrow
        />
      </div>

    </div>

    <div class="tw-text-center tw-py-12">
      <q-btn
        v-if="!data.hasPlot"
        @click="generatePlot"
        color="amber-6"
        label="Generate"
        class="tw-mr-3"
        :disable="form.subject?.length < 2 || data.loading"
        :loading="data.loading"
        rounded
        unelevated
      />

      <q-btn
        v-if="data.hasPlot && !data.hasResult"
        @click="generateResult"
        color="amber-6"
        label="Process"
        class="tw-mr-3"
        :disable="form.subject?.length < 2 || data.loading"
        :loading="data.loading"
        rounded
        unelevated
      />

      <q-btn
        v-if="data.hasResult"
        @click="save"
        label="Save"
        color="amber-6"
        icon="save"
        class="tw-mr-3"
        :disable="form.result?.trim().length == 0 || data.loading"
        :loading="data.loading"
        rounded
        unelevated
      />

      <q-btn
        v-if="data.hasPlot"
        @click="reset"
        label="Reset"
        color="white"
        text-color="black"
        icon="refresh"
        :disable="data.loading"
        rounded
        outline
        unelevated
      />
    </div>
  </div>
</template>

<script setup>

import { onMounted, reactive } from 'vue'
import { api } from 'src/boot/axios'
import { useRouter } from 'vue-router'

const router = useRouter()

const form = reactive({
  subject: '',
  summary: '',
  bullets: '',
  result: '',
})

const data = reactive({
  formDefault: {},
  loading: false,
  hasPlot: false,
  hasResult: false,
})

const errors = reactive({
  form: {},
})

const generatePlot = () => {
  clearErrors()
  data.loading = true
  data.hasPlot = false
  data.hasResult = false

  api.post('/documents/article-plot', {
    subject: form.subject,
  },
  {
    headers: {
      'Content-Type': 'application/json',
      'Authorization': `Bearer ${localStorage.getItem('authToken')}`,
    }
  }).then((res) => {
    form.summary = res.data.summary
    form.bullets = res.data.bullets
    data.hasPlot = true
  }).catch((err) => {
    showError(err, 'subject', 'Failed to generate.')
  }).finally(() => {
    data.loading = false
  })

}

const generateResult = () => {
  clearErrors()
  data.loading = true
  data.hasResult = false

  api.post('/documents/article-result', {
    bullets: form.bullets,
  },
  {
    headers: {
      'Content-Type': 'application/json',
      'Authorization': `Bearer ${localStorage.getItem('authToken')}`,
    }
  }).then((res) => {
    form.result = res.data
    data.hasResult = true
  }).catch((err) => {
    showError(err, 'bullets', 'Failed to generate! Please try again.')
  }).finally(() => {
    data.loading = false
  })

}

const save = () => {
  clearErrors()
  data.loading = true

  api.post('/documents', form, {
    headers: {
      'Content-Type': 'application/json',
      'Authorization': `Bearer ${localStorage.getItem('authToken')}`,
    }
  }).then(() => {
    router.push({ name: 'documents.index' })
  }).catch((err) => {
    showError(err, 'result', 'Saving failed! Please try again.')
  }).finally(() => {
    data.loading = false
  })
}

const reset = () => {
  data.loading = true
  data.hasPlot = false
  data.hasResult = false
  resetResultFields()
  data.loading = false
}

const clearErrors = () => {
  errors.form = {}
}

const showError = (err, field, msg) => {
  if ([404, 500].includes(err.response?.status)) {
    errors.form[`${field}`] = []
    errors.form[`${field}`][0] = msg
  }
  if (err.response?.status == 422) {
    errors.form = err.response?.data?.errors
  }
}

const resetResultFields = () => {
  Object.assign(form, data.formDefault)
}

onMounted(() => {
  data.formDefault = { ...form }
})

</script>
