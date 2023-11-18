<template>
  <q-page class="tw-w-full">

    <q-card class="my-card tw-w-full tw-p-6">

      <q-card-section>
        <div class="tw-flex tw-justify-between">
          <div>
            <div class="tw-text-4xl tw-font-semibold">New Document</div>
            <div class="tw-text-gray-600">Generate a new content with A.I.</div>
          </div>
          <div>
            <q-btn
              href="/"
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

        <div class="tw-w-full tw-pb-3 tw-mx-auto xl:tw-w-4/6">
          <q-input
            type="textarea"
            v-model="form.keyword"
            label="Keyword"
            rows="5"
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
              filled
              autogrow
            />
          </div>

        </div>

        <div class="tw-text-center tw-py-12">
          <q-btn
            v-if="!data.hasResults"
            @click="() => generate()"
            color="amber-6"
            label="Generate"
            class="tw-mr-3"
            rounded
            unelevated
          />

          <q-btn
            v-if="data.hasResults"
            label="Copy Results"
            color="white"
            text-color="black"
            icon="content_copy"
            class="tw-mr-3"
            rounded
          />

          <q-btn
            v-if="data.hasResults"
            @click="() => reset()"
            label="Reset"
            color="amber-6"
            icon="refresh"
            rounded
            unelevated
          />
        </div>

      </q-card-section>

    </q-card>

  </q-page>
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

const generate = () => {
  data.loading = true
  data.hasResults = true
  data.loading = false
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
