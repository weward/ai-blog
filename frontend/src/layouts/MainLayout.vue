<template>
  <q-layout view="hHr lpR lFr">
    <q-header elevated>
      <q-toolbar class="tw-bg-rose-800 tw-border-b-4 tw-border-b-amber-400">
        <q-btn
          flat
          dense
          round
          icon="menu"
          aria-label="Menu"
          @click="toggleLeftDrawer"
        />

        <q-toolbar-title>
          <span>{{ APP_NAME }}</span>
        </q-toolbar-title>

        <div>
          <q-btn-dropdown color="amber-6" :label="USERNAME" flat>
            <q-list>

              <q-item clickable v-close-popup @click="() => logout()">
                <q-item-section>
                  <q-item-label>Logout</q-item-label>
                </q-item-section>
              </q-item>

            </q-list>
          </q-btn-dropdown>
        </div>

      </q-toolbar>
    </q-header>

    <q-drawer
      v-model="leftDrawerOpen"
      show-if-above
      bordered
    >
      <q-list>
        <q-item-label
          header
        >
          Menu
        </q-item-label>

        <EssentialLink
          v-for="link in essentialLinks"
          :key="link.title"
          v-bind="link"
        />
      </q-list>
    </q-drawer>

    <q-page-container>
      <router-view />
    </q-page-container>
  </q-layout>
</template>

<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import EssentialLink from 'components/EssentialLink.vue'
import { linksList } from '../utils/navMenu.js'
import { api } from 'src/boot/axios'

const APP_NAME = import.meta.env.VITE_APP_NAME
const USERNAME = JSON.parse(localStorage.getItem('authUser'))?.name
const leftDrawerOpen = ref(false)
const essentialLinks = linksList

const router = useRouter()

const toggleLeftDrawer = () => {
  leftDrawerOpen.value = !leftDrawerOpen.value
}


const logout = () => {
  api.post('auth/logout', {}, {
    headers: {
      'Content-Type': 'application/json',
      'Authorization': `Bearer ${localStorage.getItem('authToken')}`
    }
  }).then((res) => {
    localStorage.removeItem('authToken')
    localStorage.removeItem('authUser')
    router.push({ name: 'auth.login' })
  }).catch((err) => {
    if (err.response.status == 404) {
      $q.notify({
        color: 'negative',
        position: 'top',
        message: 'Failed to logout.',
        icon: 'report_problem'
      })
    }
  })
}

</script>
