<template>
  <div class="home">
    <div class="home__container container">
      <DoubleBlock @moreDetails="moreDetails" :content="logoTitleInfo" btn="Записаться" />
      <AboutUs />
      <ServicesPrice />
      <OurSpecialists />
      <BannerAppointment ref="banner" btn="Записаться" type="blue" />
    </div>
  </div>
</template>

<script setup>
import DoubleBlock from '../components/DoubleBlock.vue';
import Dog from '../static/images/dog.png';
import OurSpecialists from '../sections/OurSpecialists.vue';
import ServicesPrice from '../sections/ServicesPrice.vue';
import AboutUs from '../sections/AboutUs.vue';
import BannerAppointment from '../components/BannerAppointment.vue';
import { ref } from 'vue';

const banner = ref(null);

const logoTitleInfo = {
  top: {
    title: 'Петвет',
    subtitle: 'Клиника',
  },
  bot: {
    title: 'Чекап для питомцев',
    description: 'Запишите питомца на обследование.',
    action: 'Пн-Пт 9:00-21:00',
  },
  image: Dog,
};

const moreDetails = () => {
  if (!banner.value) return;
  banner.value.appointment.scrollIntoView({ behavior: 'smooth' });
};
</script>

<style lang="scss" scoped>
.home {
  display: flex;
  flex-direction: column;
  width: 100%;
  max-width: 100%;

  &__container {
    display: flex;
    flex-direction: column;
    gap: 40px;
  }
}
</style>
