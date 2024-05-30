<template>
  <div class="price-block" ref="priceBlockRef">
    <div class="price-block__title">
      <h2>{{ info.title }}</h2>
    </div>
    <div class="price-block__description">
      <span>{{ info.description }}</span>
    </div>
    <div class="price-block__list">
      <div class="price-block__item" v-for="item of info.priceList" :key="item.id">
        <span>{{ item.title }}</span>
        <span class="price-block__item-price">{{ item.price }}</span>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';

const priceBlockRef = ref(null);

defineExpose({
  priceBlockRef,
});

defineProps({
  info: {
    title: String,
    description: String,
    priceList: Array,
  },
});
</script>

<style lang="scss" scoped>
.price-block {
  background-color: #ffffff;
  width: 100%;
  padding: 62px 84px 53px 93px;
  box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);
  border-radius: 56px;
  overflow: hidden;

  @include small {
    padding: 25px;
    border-radius: 0;
    box-shadow: none;
  }

  &__title {
    font: {
      size: 40px;
      family: Inter;
      weight: 700;
    }
    color: #040404;
    letter-spacing: 1.6px;
    word-wrap: break-word;
    margin-bottom: 16px;

    @include small {
      font-size: 35px;
    }
  }

  &__description {
    font: {
      size: 20px;
      family: Inter;
      weight: 400;
    }
    letter-spacing: 0.8px;
    word-wrap: break-word;
    margin-bottom: 47px;
    max-width: 326px;
    color: black;
    font-size: 20px;
    font-family: Inter;
    font-weight: 400;
  }

  &__list {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    gap: 30px;
    width: 100%;
  }

  &__item {
    display: flex;
    justify-content: space-between;
    width: 100%;
    position: relative;

    &:before {
      content: ' ';
      background: #000000;
      width: 100%;
      height: 1px;
      bottom: -13px;
      position: absolute;
    }

    &-price {
      &::before {
        content: 'от ';
      }

      &::after {
        content: '₽';
      }
    }
  }
}
</style>
