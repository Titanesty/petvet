<template>
  <div class="button">
    <div class="button__title">
      <slot />
    </div>
  </div>
</template>
<script setup>
defineProps();
</script>

<style lang="scss" scoped>
.button {
  display: flex;
  justify-content: center;
  align-items: center;
  text-align: center;
  border-radius: 19.5px;
  //background: radial-gradient(100% 100%, rgba(255, 255, 255, 0.88) 20%, rgba(204, 204, 204, 0.8) 100%);
  cursor: pointer;
  padding: 8px 16px;

  &:hover {
    @include active;
  }
}
</style>
