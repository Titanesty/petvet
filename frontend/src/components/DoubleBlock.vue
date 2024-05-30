<template>
  <div class="info-section">
    <div class="info-section__top">
      <div v-if="route.name !== 'Домашняя'" class="info-section__bread-crumbs">
        <router-link to="/">Главная</router-link>
        <span>→</span>
        <router-link :to="route.path">{{ route.name }}</router-link>
      </div>
      <div class="info-section__top-subtitle">
        <span>{{ content.top.subtitle }}</span>
      </div>
      <div class="info-section__top-title">
        <span>{{ content.top.title }}</span>
      </div>
    </div>
    <div class="info-section__bot">
      <div class="info-section__bot-title">
        <span>{{ content.bot.title }}</span>
      </div>
      <div class="info-section__bot-description">
        <span>{{ content.bot.description }}</span>
      </div>
      <div v-if="content.bot.action" class="info-section__bot-action">
        <span>{{ content.bot.action }}</span>
      </div>
      <TheButton @click="appointment" class="info-section__btn"
        ><span>{{ btn }}</span></TheButton
      >
    </div>
    <div class="info-section__block-image">
      <img class="info-section__image" :src="content.image" alt="" />
    </div>
  </div>
</template>

<script setup>
import TheButton from './common/TheButton.vue';
import { useRoute } from 'vue-router';

defineProps({
  content: {
    top: {
      title: String,
      subtitle: String,
    },
    bot: {
      title: String,
      description: String,
      action: String | undefined,
    },
    image: String,
  },
  btn: String,
});
const route = useRoute();
const emit = defineEmits(['appointment']);

const appointment = () => {
  emit('appointment');
};
</script>

<style lang="scss" scoped>
.info-section {
  display: flex;
  flex-direction: column;
  justify-content: space-between;
  width: 100%;
  position: relative;
  overflow: hidden;

  &__bread-crumbs {
    display: flex;
    justify-content: space-between;
    align-items: center;
    text-align: center;
    align-self: center;
    gap: 12px;
    margin: 21px 0 12px 0;
  }

  &__top {
    display: flex;
    flex-direction: column;
    background-color: #ffffff;
    border-radius: 56px;
    margin-bottom: 8px;
    color: #1b1b29;
    gap: 10px;
    width: 100%;

    @include small {
      border-radius: 0;
    }

    &-subtitle {
      padding: 45px 32px 0 0;
      text-align: end;
      width: 100%;

      @include little {
        padding: 15px;
      }

      @include small {
        padding: 15px;
      }

      & span {
        font-size: 84px;
        font-family: 'Inter', sans-serif;
        font-weight: 700;
        letter-spacing: 3.36px;
        word-wrap: break-word;

        @include little {
          font-size: 55px;
        }

        @include small {
          font-size: 25px;
        }
      }
    }

    &-title {
      text-align: center;
      padding: 97px 0 30px 0;
      width: 100%;

      @include little {
        padding: 30px;
      }

      @include small {
        padding: 30px;
      }

      & span {
        font-size: 200px;
        font-family: 'Inter', sans-serif;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 24px;
        word-wrap: break-word;

        @include tabletplus {
          font-size: 105px;
          letter-spacing: 5px;
        }

        @include tablet {
          font-size: 105px;
          letter-spacing: 5px;
        }

        @include medium {
          font-size: 85px;
          letter-spacing: 5px;
        }

        @include little {
          font-size: 40px;
        }

        @include small {
          font-size: 30px;
          letter-spacing: 5px;
        }
      }
    }
  }

  &__bot {
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    align-items: flex-start;
    background-color: #014bff;
    border-radius: 56px;
    padding: 50px 0 28px 89px;
    color: #ffffff;
    box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);
    border: 1px black solid;
    overflow: hidden;

    @include small {
      padding: 25px;
      border-radius: 0;
    }

    &-title {
      font-size: 29px;
      font-family: 'Inter', sans-serif;
      font-weight: 700;
      letter-spacing: 1.16px;
      word-wrap: break-word;
      padding-bottom: 60px;
      width: 100%;
      max-width: 265px;
    }

    &-description {
      font-size: 17px;
      font-family: 'Inter', sans-serif;
      font-weight: 400;
      letter-spacing: 0.68px;
      word-wrap: break-word;
      padding-bottom: 30px;
      max-width: 215px;
    }

    &-action {
      padding-bottom: 25px;
    }
  }

  &__block-image {
    display: flex;
    justify-content: center;
    align-items: center;
    position: absolute;
    bottom: 0;
    left: 30%;
    border-radius: 56px;
    overflow: hidden;

    @include small {
      width: 50%;
      bottom: 0;
      left: auto;
      right: 0;
      border-radius: 0;
    }
  }

  &__image {
    display: block;
    width: 100%;
    height: 100%;
  }

  &__btn {
    height: 28px;
    color: #000000;
    padding: 8px 42px;
    font-weight: 400;
    letter-spacing: 0.4px;
    word-wrap: break-word;
    font-size: 10px;
    background: radial-gradient(100% 100% at 50% 50%, rgba(255, 255, 255, 0.88) 20%, rgba(204, 204, 204, 0.8) 100%);
  }
}
</style>
