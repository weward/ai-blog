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
import EssentialLink from 'components/EssentialLink.vue'
import { linksList } from '../utils/navMenu.js'

const APP_NAME = import.meta.env.VITE_APP_NAME
const leftDrawerOpen = ref(false)
const essentialLinks = linksList

const toggleLeftDrawer = () => {
  leftDrawerOpen.value = !leftDrawerOpen.value
}

</script>
