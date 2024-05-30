<template>
  <div class="service">
    <div class="service__wrapper">
      <div class="service__title">
        <h3>{{ info.title }}</h3>
      </div>
      <div class="service__price">
        <span>{{ info.price }}</span>
        <span>₽</span>
      </div>
    </div>
    <div class="service__img">
      <img class="img" :src="info.image" :alt="'image ' + info.title" />
    </div>
  </div>
</template>

<script setup>
defineProps({
  info: {
    id: Number,
    title: String,
    price: Number,
    image: String,
    color: String,
    textPos: Object,
  },
});
</script>

<style lang="scss" scoped>
.service {
  display: flex;
  flex-direction: column;
  padding: 35px;
  border-radius: 56px;
  background-color: v-bind('info.color');
  position: relative;
  width: 100%;
  overflow: hidden;

  @include small {
    border-radius: 0;
  }

  &__wrapper {
    display: flex;
    flex-direction: column;
    gap: 14px;
    position: absolute;
    top: v-bind('info.textPos.top+"px"');
    left: v-bind('info.textPos.left+"px"');
    max-width: 230px;
    width: 100%;
  }

  &__title {
    color: black;
    font-size: 20px;
    font-family: Inter;
    font-weight: 400;
    letter-spacing: 0.8px;
    word-wrap: break-word;

    @include medium {
      max-width: 180px;
      width: 100%;
    }
  }

  &__price {
    font-size: 20px;
    font-family: Inter;
    font-weight: 600;
    letter-spacing: 0.8px;
    word-wrap: break-word;
  }

  &__img {
    position: absolute;
    bottom: -10px;
    right: -5px;
  }
}
</style>
