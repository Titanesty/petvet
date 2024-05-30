<template>
  <div class="block-header">
    <div class="block-header__bread-crumbs">
      <router-link to="/">Главная</router-link>
      <span>→</span>
      <router-link :to="route.path">{{ route.name }}</router-link>
    </div>
    <div class="block-header__title">
      <h1>{{ info.title }}</h1>
    </div>
    <slot />
  </div>
</template>

<script setup>
import { useRoute } from 'vue-router';

const route = useRoute();
defineProps({
  info: {
    title: String,
  },
});
</script>

<style lang="scss" scoped>
.block-header {
  display: flex;
  flex-direction: column;
  align-items: center;
  width: 100%;
  background: #ffffff;
  box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);
  border-radius: 56px;
  padding: 21px 32px 48px 49px;

  @include small {
    padding: 45px 15px;
    box-shadow: none;
  }

  &__bread-crumbs {
    display: flex;
    align-items: center;
    text-align: center;
    gap: 11px;
    margin-bottom: 95px;
    font-size: 15px;

    @include small {
      margin-bottom: 15px;
    }
  }

  &__title {
    text-align: center;
    color: black;
    font-size: 32px;
    font-family: Inter;
    font-weight: 500;
    letter-spacing: 1.28px;
    word-wrap: break-word;
    margin-bottom: 67px;

    @include small {
      margin-bottom: 15px;
    }
  }
}
</style>
