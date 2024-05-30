<template>
  <div class="form">
    <div class="form__input-list">
      <div
        class="form__input-block"
        :class="{
          'form__input-block--active': activeInputId === field.id || form[field.key],
          'form__input-block--white': props.type === 'blue',
        }"
        v-for="field of fields"
        :key="field.id">
        <input
          class="form__input"
          :class="{ 'form__input--white': props.type === 'blue' }"
          @blur="activeInputId = null"
          @focus="activeInputId = field.id"
          v-model="form[field.key]"
          @keydown.enter="sendForm"
          :placeholder="field.placeholder"
          :type="field.type ? field.type : 'text'"
          :maxlength="field.maxLength ? field.maxLength : ''"
          v-maska
          :data-maska="getDateMaska(field.key)"
          @input="handleInput(field.key, $event)" />
      </div>
    </div>
    <TheButton class="form__btn" :class="{ 'form__btn--active': activeButton }" @click="sendForm"
      ><span>{{ btn }}</span></TheButton
    >
  </div>
</template>

<script setup>
import TheButton from './common/TheButton.vue';
import { ref, watch } from 'vue';
import { vMaska } from 'maska';

const getDateMaska = value => {
  if (value === 'phone') return '+#(###)-###-##-##';
};

const props = defineProps({
  fields: Array,
  btn: String,
  type: String,
});
const activeInputId = ref(null);
const emit = defineEmits(['sendForm']);
const activeButton = ref(false);
const form = ref({});
const sendForm = () => {
  emit('sendForm', form.value);
};

const handleInput = (value, event) => {
  if (value === 'name') {
    if (form.value.name) {
      form.value.name = event.target.value.replace(/[^a-zA-Zа-яА-ЯёЁ]/g, '');
      if (form.value.name) form.value.name = form.value.name[0].toUpperCase() + form.value.name.slice(1);
    }
  } else if (value === 'login') {
    if (form.value.login) form.value.login = event.target.value.replace(/[^a-zA-Z0-9]/g, '');
  }
};

watch(
  form,
  value => {
    activeButton.value = props.fields.every(field => !!value[field.key]);
  },
  { deep: true }
);
</script>

<style lang="scss" scoped>
.form {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  gap: 58px;
  width: 100%;

  &__input-list {
    display: flex;
    flex-direction: column;
    justify-content: center;
    gap: 65px;
    width: 100%;
  }

  &__input {
    appearance: none;
    width: 100%;

    &--white {
      border-radius: 56px;
      padding: 12px;
    }

    &-block {
      display: inline-block;
      position: relative;
      width: 100%;

      &--white {
        &:after {
          display: none;
        }
      }

      &:after {
        content: '';
        width: 100%;
        background-color: #000000;
        height: 1px;
        bottom: -11px;
        left: 0;
        position: absolute;
        opacity: 0.2;
      }

      &--active {
        &:after {
          opacity: 1;
        }
      }
    }
  }

  &__btn {
    color: #434343;
    background: #c8c8c8;
    height: 38px;
    width: 100%;
    max-width: 218px;

    &--active {
      color: #ffffff;
      background-color: #014bff;
    }
  }
}
</style>
