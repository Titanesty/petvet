<template>
  <div class="appointment" ref="appointment" :class="typeBanner">
    <SendForm class="appointment__form" :fields="forms" @sendForm="sendForm" :btn="btn" :type="type" />
    <div class="appointment__info">
      <div class="appointment__title">
        <span>Запишитесь к специалисту прямо сейчас</span>
      </div>
      <div class="appointment__description">
        <span>Наш менеджер свяжется с вами в течение 5 минут, чтобы подтвердить запись и уточнить все детали</span>
      </div>
    </div>
  </div>
</template>
<script setup>
import SendForm from './SendForm.vue';
import { computed, ref } from 'vue';

const appointment = ref(null);

defineExpose({
  appointment,
});

const props = defineProps({
  type: String,
  btn: String,
});
const emit = defineEmits(['sendForm']);
const forms = [
  { id: 0, placeholder: 'Ваше имя', key: 'name' },
  { id: 1, placeholder: '+7 (999) 999 99 99', key: 'phone' },
];

const sendForm = value => {
  emit('sendForm', value);
};

const typeBanner = computed(() => {
  if (props.type === 'blue') return 'appointment--blue';
  return 'appointment--white';
});
</script>

<style lang="scss" scoped>
.appointment {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 89px 257px 59px 271px;
  width: 100%;
  border-radius: 56px;
  gap: 55px;

  @include medium {
    padding: 35px 95px;
  }

  @include little {
    padding: 25px;
  }

  @include small {
    flex-direction: column-reverse;
    padding: 15px;
    border-radius: 0;
  }

  &__form {
    width: 100%;
    max-width: 423px;
  }

  &--blue {
    background-color: #014bff;
    color: #ffffff;
  }

  &--white {
    background-color: #ffffff;
    color: #000000;
  }

  &__info {
    display: flex;
    flex-direction: column;
  }

  &__title {
    text-align: right;
    font-size: 40px;
    font-family: Inter;
    font-weight: 700;
    letter-spacing: 2px;
    word-wrap: break-word;
    margin-bottom: 34px;
    max-width: 302px;
    align-self: end;
    line-height: 1;

    @include small {
      font-size: 18px;
      text-align: center;
      align-self: center;
    }
  }

  &__description {
    text-align: right;
    font-size: 16px;
    font-family: Inter;
    font-weight: 400;
    letter-spacing: 0.64px;
    word-wrap: break-word;
    max-width: 359px;

    @include small {
      text-align: center;
      align-self: center;
    }
  }
}
</style>
