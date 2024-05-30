<template>
  <div class="sign-up">
    <div class="sign-up__container container">
      <TitleBlock :info="{ title: 'Вход' }">
        <SendForm class="sign-up__form" @sendForm="register" :fields="forms" btn="Регистрация" />
        <div class="sign-up__sign-in">
          <div class="sign-up__sign-in-title">
            <span>У вас есть аккаунт?</span>
            <router-link class="sign-up__sign-in-title-link link" to="/sign-in">Вход</router-link>
          </div>
        </div>
      </TitleBlock>
    </div>
  </div>
</template>
<script setup>
import TitleBlock from '../components/TitleBlock.vue';
import SendForm from '../components/SendForm.vue';
import AuthApi from '../api/api.js';
import { toast } from 'vue3-toastify';

const forms = [
  { id: 0, placeholder: 'Логин', key: 'login', maxLength: 20 },
  { id: 1, placeholder: 'Ваше имя', key: 'name', maxLength: 20 },
  { id: 2, placeholder: 'Номер телефона', key: 'phone', type: 'tel' },
  { id: 3, placeholder: 'Пароль', key: 'password', type: 'password', maxLength: 20 },
  { id: 4, placeholder: 'Повторите пароль', key: 'password-copy', type: 'password', maxLength: 20 },
];

const register = async data => {
  try {
    if (!data.login || !data.name || !data.password || !data.phone || !data['password-copy']) {
      toast('Необходимо заполнить все поля!', {
        autoClose: 1000,
        type: 'warning',
      });
      throw new Error('Empty required field');
    }

    if (data.password.length < 8) {
      toast('Пароль менее 8 символов', {
        autoClose: 1000,
        type: 'warning',
      });
      throw new Error('Password no valid');
    }

    if (data.password !== data['password-copy']) {
      toast('Пароли не совпадают!', {
        autoClose: 1000,
        type: 'warning',
      });
      throw new Error('Password mismatch');
    }

    const result = await AuthApi.register(data);
    if (result) {
      toast('Вы успешно зарегистрировались, переадресация...', {
        autoClose: 1000,
        type: 'success',
      });
    } else {
      toast('Ошибка регистрации.', {
        autoClose: 1000,
        type: 'error',
      });
    }
  } catch (e) {
    if (e.message === 'Empty required field') {
      console.log(`Error register, ${e.message}`);
    } else if (e.message === 'Password mismatch') {
      console.log(`Error register, ${e.message}`);
    } else console.log(`Error register, ${e.message}`);
  }
};
</script>

<style lang="scss" scoped>
.sign-up {
  &__sign-in {
    max-width: 354px;
    width: 100%;

    span {
      margin-right: 7px;
    }

    &-title {
      display: flex;
      justify-content: space-between;
      align-self: center;
      font-size: 16px;
      font-family: Inter;
      font-weight: 400;
      letter-spacing: 0.64px;
      word-wrap: break-word;
      margin-top: 7px;

      &-link {
        text-align: center;
        flex: 1;
        color: #014bff;
      }
    }
  }

  &__form {
    max-width: 354px;
  }
}
</style>
