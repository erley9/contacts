<script setup>
import { RouterLink, RouterView } from 'vue-router'
import Navbar from './components/Navbar.vue';
import SelectLanguage from './components/SelectLanguage.vue';
</script>

<template>
  <div>
    <Navbar/>
    <SelectLanguage/>
    <RouterView />
  </div>
</template>

<style scoped>


</style>