<template>
  <section class="about-us" :style="{ backgroundImage: `url('${BannerAboutUs}')` }">
    <div class="about-us__block">
      <div class="about-us__block-title">
        <h2>
          <span class="about-us__block-title--blue">Мы — </span> современный ветеринарный госпиталь с полным спектром
          услуг
        </h2>
      </div>
      <div class="about-us__block-wrapper">
        <div class="about-us__block-btn">
          <router-link class="about-us__block-btn-link link" to="/about"><span>О нас</span></router-link>
        </div>
        <div class="about-us__block-description">
          <span>Мы внимательны к животным и людям</span>
        </div>
      </div>
    </div>
  </section>
</template>

<script setup>
import BannerAboutUs from '@/static/images/vet.png';
</script>

<style lang="scss" scoped>
.about-us {
  display: flex;
  background: no-repeat center fixed;
  background-size: cover;
  width: 100%;
  height: 483px;
  position: relative;
  border-radius: 56px;

  @include small {
    border-radius: 0;
  }

  &__block {
    display: flex;
    justify-content: space-around;
    flex-direction: column;
    align-items: center;
    gap: 41px;
    padding: 47px 38px 38px 52px;
    background-color: #ffffff;
    border-radius: 56px;
    position: absolute;
    right: 39px;
    bottom: 23px;
    width: 100%;
    max-width: 469px;
    height: 328px;

    @include small {
      left: 50%;
      transform: translate(-50%, 0);
      max-width: 90%;
      padding: 35px;
      gap: 25px;
    }

    &-title {
      align-self: start;
      width: 100%;
      max-width: 153px;
      letter-spacing: 0.8px;
      line-height: 20px;
      word-wrap: break-word;
      font: {
        size: 20px;
        family: Inter;
        weight: 500;
      }

      &--blue {
        color: #014bff;
      }
    }

    &-wrapper {
      display: flex;
      justify-content: space-between;
      align-items: center;
      width: 100%;

      @include small {
        flex-direction: column-reverse;
        gap: 15px;
      }
    }

    &-description {
      font-weight: 400;
      letter-spacing: 0.52px;
      text-align: right;
      width: 100%;
      font-size: 13px;
      max-width: 205px;

      @include small {
        text-align: center;
      }
    }

    &-btn {
      text-align: center;
      border-radius: 56px;
      background-color: #014bff;
      padding: 3px 4px;
      cursor: pointer;
      width: 100%;
      max-width: 98px;

      &:hover {
        @include active;
      }

      &-link {
        color: #ffffff;
      }
    }
  }
}
</style>
