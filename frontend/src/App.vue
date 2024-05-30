<script setup>
import TheHeader from './components/common/TheHeader.vue';
import TheFooter from './components/common/TheFooter.vue';
</script>

<template>
  <TheHeader />
  <main class="main">
    <router-view />
  </main>
  <TheFooter />
</template>

<style lang="scss" scoped>
.main {
  flex: 1 1 auto;
  width: 100%;

  @include small {
    background-color: #ffffff;
  }
}
</style>
