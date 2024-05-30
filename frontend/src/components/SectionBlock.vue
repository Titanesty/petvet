<template>
  <div class="card">
    <div v-if="info.title" class="card__title">
      <h2>{{ info.title }}</h2>
    </div>
    <div v-if="info.description" class="card__description">
      <span>{{ info.description }}</span>
    </div>
    <slot />
    <slot name="btn" />
  </div>
</template>
<script setup>
defineProps({
  info: {
    title: String | undefined,
    description: String | undefined,
  },
});
</script>
<style lang="scss" scoped>
.card {
  display: flex;
  flex-direction: column;
  width: 100%;
  padding: 49px 85px 25px;
  background-color: #ffffff;
  border-radius: 56px;

  @include small {
    border-radius: 25px;
    padding: 5px;
  }

  &__title {
    color: #000000;
    letter-spacing: 2.4px;
    word-wrap: break-word;
    margin-bottom: 24px;
    font: {
      size: 40px;
      family: Inter;
      weight: 700;
    }

    @include small {
      text-align: center;
    }
  }

  &__description {
    color: #4a4a4a;
    letter-spacing: 1.19px;
    word-wrap: break-word;
    font: {
      size: 17px;
      family: Josefin Sans;
      weight: 100;
    }
    margin-bottom: 50px;

    @include small {
      text-align: center;
      margin-bottom: 20px;
    }
  }

  @include small {
    text-align: center;
  }
}
</style>
