<template>
  <div class="subscribe-newsletter">
    <div class="subscribe-newsletter__title">
      <span>Подпишитесь на нашу рассылку:</span>
    </div>
    <div class="subscribe-newsletter__send">
      <input
        class="subscribe-newsletter__send-input"
        maxlength="200"
        @blur="$emit('blur')"
        @focus="$emit('focus')"
        v-model="emailNewsletter"
        @keydown.enter="subscribe"
        type="text"
        placeholder="Ваш Email" />
      <div
        class="subscribe-newsletter__send-btn"
        :class="{ 'subscribe-newsletter__send-btn--active': emailNewsletter || focused }"
        @click="subscribe">
        <span>Подписаться</span>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref } from 'vue';
import { toast } from 'vue3-toastify';

const emits = defineEmits(['blur', 'focus', 'subscribe']);
const emailNewsletter = ref('');
const focused = ref(false);

const subscribe = () => {
  if (!emailNewsletter.value) {
    toast('Введите ваш email', {
      autoClose: 2000,
      type: 'warning',
    });
    return;
  }

  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  const isRegex = emailRegex.test(emailNewsletter.value);

  if (!isRegex) {
    toast('Неверный формат для email', {
      autoClose: 2000,
      type: 'warning',
    });
    return;
  }

  emits('subscribe', emailNewsletter.value);
  emailNewsletter.value = '';
};
</script>

<style lang="scss" scoped>
.subscribe-newsletter {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  gap: 50px;
  background-color: #ffffff;
  padding: 33px 13px 26px 17px;
  border-radius: 42px;

  &__title {
    width: 100%;
    max-width: 235px;
    letter-spacing: 0.8px;
    word-wrap: break-word;
    font: {
      size: 20px;
      family: Inter;
      weight: 400;
    }
  }

  &__send {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-radius: 168.5px;
    overflow: hidden;
    position: relative;

    &-input {
      background-color: #ebeaea;
      appearance: none;
      padding: 18px 25px;
      width: 100%;
    }

    &-btn {
      cursor: pointer;
      background-color: #c1d3fd;
      color: #ffffff;
      position: absolute;
      right: 0;
      height: 100%;
      display: flex;
      align-items: center;
      text-align: center;
      border-radius: 168.5px;
      padding: 0 60px;
      user-select: none;

      @include little {
        padding: 0 20px;
      }

      @include small {
        padding: 0 20px;
      }

      &--active {
        background-color: #014bff;
      }
    }
  }
}
</style>
