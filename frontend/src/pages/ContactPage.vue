<template>
  <div class="contact-page">
    <div class="contact-page__container container">
      <TitleBlock class="contact-page__block" :info="{ title: 'Контакты' }">
        <div class="contact-page__logo">
          <img :src="IconContact" alt="24часа" />
        </div>
        <div class="contact-page__description">
          <span>Работаем круглосуточно!</span>
        </div>
        <div class="contact-page__wrapper">
          <div class="contact-page__info">
            <span>Телефон:</span>
            <a class="contact-page__info-tel contact-page__info--bold" href="tel:+79504556873">+7 950 455-68-73</a>
          </div>
          <div class="contact-page__info">
            <span>Адрес:</span>
            <span class="contact-page__info-address contact-page__info--bold">Таганрог, ул. Чехова, д. 75</span>
          </div>
        </div>
        <div class="contact-page__map">
          <div class="contact-page__map-yandex" style="position: relative; overflow: hidden">
            <a
              href="https://yandex.ru/maps/org/taganrogskiy_aviatsionny_kolledzh_imeni_v_m_petlyakova/1359066019/?utm_medium=mapframe&utm_source=maps"
              style="color: #eee; font-size: 12px; position: absolute; top: 0px"
              >Таганрогский авиационный колледж имени В. М. Петлякова</a
            ><a
              href="https://yandex.ru/maps/971/taganrog/category/college/184106236/?utm_medium=mapframe&utm_source=maps"
              style="color: #eee; font-size: 12px; position: absolute; top: 14px"
              >Колледж в Таганроге</a
            ><iframe
              src="https://yandex.ru/map-widget/v1/?ll=38.929822%2C47.207597&mode=search&oid=1359066019&ol=biz&z=17"
              width="100%"
              height="375px"
              frameborder="1"
              allowfullscreen="true"
              style="position: relative"></iframe>
          </div>
        </div>
      </TitleBlock>
      <BannerAppointment @sendForm="sendForm" type="white" btn="Записаться" />
    </div>
  </div>
</template>

<script setup>
import TitleBlock from '../components/TitleBlock.vue';
import BannerAppointment from '../components/BannerAppointment.vue';
import IconContact from '../static/images/icon-contacts.png';

const sendForm = value => {
  Object.keys(value).forEach(key => delete value[key]);
  console.log(3, value);
};
</script>

<style lang="scss" scoped>
.contact-page {
  width: 100%;

  &__block {
    margin-bottom: 18px;
  }

  &__title {
    margin-bottom: 67px;
    text-align: center;
    color: black;
    font-size: 20px;
    font-family: Inter;
    font-weight: 500;
    letter-spacing: 0.8px;
    word-wrap: break-word;
  }

  &__description {
    text-align: center;
    color: #343434;
    font-size: 20px;
    font-family: Inter;
    font-weight: 400;
    letter-spacing: 0.8px;
    word-wrap: break-word;
    margin-bottom: 143px;

    @include small {
      margin-bottom: 25px;
    }
  }

  &__wrapper {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
    position: relative;

    @include small {
      align-items: start;
      flex-direction: column;
    }

    &:after {
      content: '';
      position: absolute;
      height: 1px;
      background-color: #000000;
      width: calc(100% + 49px + 32px);
      top: -62px;
      left: -49px;
      right: 0;

      @include small {
        top: -5px;
      }
    }
  }

  &__info {
    padding: 62px 51px 58px 64px;
    display: flex;
    flex-direction: column;
    color: #343434;
    font-size: 20px;
    font-family: Inter;
    font-weight: 400;
    letter-spacing: 0.8px;
    word-wrap: break-word;

    @include medium {
      width: 100%;
      padding: 25px;
    }

    @include little {
      width: 100%;
      padding: 25px;
    }

    @include small {
      width: 100%;
      padding: 10px;
    }

    &--bold {
      margin-top: 12px;
      font-size: 32px;
      font-family: Inter;
      font-weight: 500;
      word-wrap: break-word;
    }

    &-tel {
      color: #000000;
      padding-left: 23px;

      @include little {
        text-align: center;
        font-size: 25px;
        padding-left: 5px;
      }

      @include small {
        text-align: center;
        font-size: 18px;
        padding-left: 5px;
      }
    }

    &-address {
      padding-left: 41px;

      @include little {
        text-align: center;
        font-size: 25px;
        padding-left: 5px;
      }

      @include small {
        font-size: 18px;
        padding-left: 5px;
        text-align: center;
      }
    }
  }

  &__map {
    width: 100%;

    &-yandex {
      width: 100%;
    }
  }
}
</style>
