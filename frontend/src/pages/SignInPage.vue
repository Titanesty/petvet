<template>
  <div class="sign-in">
    <div class="sign-in__container container">
      <TitleBlock class="sign-in__block" :info="{ title: 'Вход' }">
        <div class="sign-in__wrapper">
          <SendForm @sendForm="auth" class="sign-in__form" :fields="forms" btn="Авторизация" />
          <div class="sign-in__sign-up">
            <span>У вас нет аккаунта?</span>
            <router-link class="sign-in__sign-up-link link" to="/sign-up">Регистрация</router-link>
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
import { useRouter } from 'vue-router';
import { toast } from 'vue3-toastify';

const router = useRouter();

const forms = [
  { id: 0, placeholder: 'Логин', key: 'login' },
  { id: 1, placeholder: 'Пароль', key: 'password', type: 'password' },
];

const auth = async value => {
  try {
    const data = await AuthApi.login(value);
    if (!data || !data.data?.token) {
      toast('Неверный логин или пароль', {
        autoClose: 1000,
        type: 'warning',
      });
      return;
    }
    toast('Вы успешно авторизовались! Переход в личный кабинет', {
      autoClose: 2000,
      type: 'success',
    });
    localStorage.setItem('access_token', data.data?.token);
    await new Promise(resolve => setTimeout(() => resolve(), 2000));
    await router.push({ path: '/login' });
  } catch (e) {
    toast('Ошибка авторизации, неверный логин или пароль', {
      autoClose: 1000,
      type: 'error',
    });
    console.log(`Error auth, ${e.message}`);
  }
};
</script>

<style lang="scss" scoped>
.sign-in {
  width: 100%;

  &__container {
    width: 100%;
  }

  &__form {
    margin-bottom: 44px;
  }

  &__block {
    width: 100%;
    display: flex;
  }

  &__wrapper {
    display: flex;
    flex-direction: column;
    max-width: 354px;
    width: 100%;
  }

  &__sign-up {
    display: flex;
    justify-content: space-between;
    align-self: center;
    width: 100%;

    &-title {
      font-size: 16px;
      font-family: Inter;
      font-weight: 400;
      letter-spacing: 0.64px;
      word-wrap: break-word;
    }

    span {
      margin-right: 7px;
    }

    &-link {
      text-align: center;
      flex: 1;
      color: #014bff;
    }
  }
}
</style>
