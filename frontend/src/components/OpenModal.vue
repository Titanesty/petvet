<template>
  <div v-if="show" @click.self="close" class="modal">
    <div class="modal__close" @click.self="close"></div>
    <div class="modal__wrapper">
      <div class="modal__container container">
        <div class="modal__body">
          <slot />
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import { watch } from 'vue';

const emit = defineEmits(['close']);

const show = defineModel('show');

watch(show, value => {
  if (value) {
    document.body.style.overflow = 'hidden';
    document.body.style.paddingRight = '15px';
  } else {
    document.body.style.overflow = 'visible';
    document.body.style.paddingRight = '0';
  }
});

const close = () => {
  emit('close');
  show.value = false;
};
</script>

<style lang="scss" scoped>
.modal {
  background: rgba(0, 0, 0, 0.8);
  top: 0;
  left: 0;
  bottom: 0;
  right: 0;
  position: fixed;
  width: 100%;
  height: 100%;
  cursor: pointer;
  z-index: 1;
  padding: 30px 0;

  &__wrapper {
    position: absolute;
    width: 80%;
    border-radius: 10px;
    background-color: rgb(255, 255, 255);
    cursor: default;
    padding: 30px;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
  }

  &__close {
    position: absolute;
    top: 5%;
    right: 5%;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    color: #040404;
    cursor: pointer;
    z-index: 9;
    background: rgba(255, 255, 255, 0.3);

    &:hover {
      transform: scale(1.05);
    }

    &:before {
      transform: translate(-50%, -50%) rotate(45deg);
    }

    &:after {
      transform: translate(-50%, -50%) rotate(-45deg);
    }

    &:after,
    &:before {
      content: '';
      position: absolute;
      height: 1px;
      background-color: #040404;
      width: 90%;
      top: 50%;
      left: 50%;
    }
  }

  &__container {
    padding: 20px;
    background-color: #fff;
    border-radius: 2px;
  }
}
</style>
