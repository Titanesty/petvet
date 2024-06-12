<template>
  <footer class="footer">
    <div class="footer__container container">
      <div class="footer__wrapper">
        <div class="footer__contact">
          <span
            >Адрес: {{ address }} Телефон: <br />
            <a class="footer__contact-tel" :href="`tel:${telNumber}`">{{ telNumber }}</a></span
          >
        </div>
        <div class="footer__list">
          <div class="footer__item" v-for="item of footerList" :key="item.id">
            <router-link class="footer__item-link link" :to="item.path">{{ item.title }}</router-link>
          </div>
        </div>
        <SubscribeNewsletter
          class="footer__banner"
          :class="{ 'footer__banner--active': isActiveBanner }"
          @blur="isActiveBanner = false"
          @focus="isActiveBanner = true"
          @subscribe="toSubscribe" />
      </div>
      <div class="footer__description">
        <span>Информация на сайте носит ознакомительный характер и не является публичной офертой.</span>
      </div>
    </div>
  </footer>
</template>

<script setup>
import SubscribeNewsletter from '../SubscribeNewsletter.vue';
import { ref } from 'vue';
import { toast } from 'vue3-toastify';
import Api from '@/api/api.js';

const isActiveBanner = ref(false);

const footerList = [
  { id: 0, title: 'о нас', path: '/about' },
  { id: 1, title: 'услуги', path: '/services' },
  { id: 2, title: 'специалисты', path: '/specialists' },
  { id: 3, title: 'контакты', path: '/contacts' },
  { id: 4, title: 'личный кабинет', path: '/login' },
];

const address = 'Таганрог, ул. Чехова, д. 75';
const telNumber = '+7 499 455-68-73';

const toSubscribe = async value => {
  try {
    const result = await Api.subscribe(value);
    toast(`Вы успешно подписались ${value}`, {
      autoClose: 2000,
      type: 'success',
    });
  } catch (e) {
    if (e.response.status === 400) {
      toast(`Вы уже подписаны на рассылку`, {
        autoClose: 1000,
        type: 'info',
      });
    } else {
      toast(`Ошибка подписки`, {
        autoClose: 1000,
        type: 'error',
      });
    }
  }
};
</script>

<style lang="scss" scoped>
@mixin active {
  transform: scale(1.05);
  transition: 0.1s;
}

.footer {
  width: 100%;
  max-width: 100%;
  padding: 93px 0 81px 0;

  @include little {
    padding: 10px 0 15px;
  }

  @include small {
    padding: 10px 0 15px;
  }

  &__container {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: center;
    gap: 87px;

    @include small {
      gap: 15px;
    }
  }

  &__wrapper {
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: end;

    @include little {
      gap: 10px;
    }

    @include small {
      flex-direction: column-reverse;
      align-items: flex-start;
    }
  }

  &__contact {
    width: 100%;
    max-width: 196px;
    color: #7a7a7a;
    font: {
      size: 20px;
      family: Inter;
      weight: 400;
    }

    @include small {
      max-width: 100%;
    }

    &-tel {
      color: #ffffff;
    }
  }

  &__list {
    display: flex;
    flex-direction: column;
    justify-content: space-around;
    gap: 2px;

    @include small {
      margin-bottom: 15px;
    }
  }

  &__item {
    cursor: pointer;
    color: white;
    word-wrap: break-word;

    &:hover {
      @include active;
    }

    &-link {
      display: inline-block;
      height: 100%;
      width: 100%;
      color: #ffffff;
      font: {
        size: 20px;
        family: Inter;
        weight: 400;
      }
    }
  }

  &__description {
    text-align: left;
    font: {
      size: 12px;
      family: Inter;
      weight: 400;
    }
    word-wrap: break-word;
    width: 100%;
    max-width: 297px;
    color: #b4b1b1;
    line-height: 14px;

    &:before {
      content: '*';
    }
  }

  &__banner {
    width: 100%;
    max-width: 509px;
    flex: 1;

    &--active {
      @include active;
    }

    &:hover {
      @include active;
    }

    @include small {
      margin-bottom: 15px;
      border-radius: 0;
      width: calc(100% + 30px);
      position: relative;
      left: -15px;
    }
  }
}
</style>
