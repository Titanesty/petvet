<template>
  <div class="price-page">
    <div class="price-page__container container">
      <DoubleBlock @appointment="appointment" class="price-page__header" :content="headerPriceInfo" btn="Записаться" />
      <PriceBlock ref="priceSection1" class="price-page__prices" :info="beautyServices" />
      <PriceBlock ref="priceSection2" class="price-page__prices" :info="veterinarianServices" />
      <TheButton @click="downloadPrice" class="price-page__btn">Загрузить цены</TheButton>
    </div>
  </div>
  <Teleport to="body">
    <OpenModal v-model:show="showModal">
      <BannerAppointment ref="banner" btn="Записаться" />
    </OpenModal>
  </Teleport>
</template>

<script setup>
import DoubleBlock from '../components/DoubleBlock.vue';
import PriceBlock from '../components/PriceBlock.vue';
import Cat from '../static/images/cat.png';
import { onMounted, ref } from 'vue';
import { useRoute, useRouter } from 'vue-router';
import Api from '@/api/api.js';
import TheButton from '@/components/common/TheButton.vue';
import OpenModal from '@/components/OpenModal.vue';
import BannerAppointment from '@/components/BannerAppointment.vue';

const route = useRoute();
const router = useRouter();
const showModal = ref(false);
const priceSection1 = ref(null);
const priceSection2 = ref(null);

const handleRouteChange = () => {
  if (!priceSection1.value?.priceBlockRef && !priceSection2.value?.priceBlockRef) return;
  if (route.query.section === '1') {
    priceSection1.value?.priceBlockRef.scrollIntoView({ behavior: 'smooth' });
  } else if (route.query.section === '2') {
    priceSection2.value?.priceBlockRef.scrollIntoView({ behavior: 'smooth' });
  }
};

onMounted(async () => {
  handleRouteChange();
});

const downloadPrice = async () => {
  const result = await Api.downloadPrice();

  const url = window.URL.createObjectURL(new Blob([result.data]));
  const a = document.createElement('a');
  a.style.display = 'none';
  a.href = url;
  a.download = 'price.xlsx'; // Имя файла для загрузки
  document.body.appendChild(a);
  a.click();
  window.URL.revokeObjectURL(url);
  console.log(result);
};

const headerPriceInfo = {
  top: {
    title: 'стоимость',
    subtitle: 'Услуг',
  },
  bot: {
    title: 'Открыта запись на услуги',
    description: 'Запишите питомца по номеру телефона или в личном кабинете.',
  },
  image: Cat,
};

const beautyServices = {
  title: 'Косметические услуги',
  description: '*Точную цену уточняйте при записи на процедуру',
  priceList: [
    { id: 0, title: 'Стрижка когтей', price: 1000 },
    { id: 1, title: 'Груминг', price: 2000 },
    { id: 2, title: 'Промывание ушных ходов', price: 1000 },
    { id: 3, title: 'Стрижка', price: 1000 },
    { id: 4, title: 'Ампутация хвоста', price: 1500 },
  ],
};

const veterinarianServices = {
  title: 'Услуги ветеринара',
  description: '*Точную цену уточняйте при записи на процедуру',
  priceList: [
    { id: 0, title: 'Общий анализ крови', price: 1000 },
    { id: 1, title: 'МРТ', price: 2000 },
    { id: 2, title: 'Вакцинация', price: 1800 },
    { id: 3, title: 'Цитологическое исследование', price: 2000 },
    { id: 4, title: 'Внутривенное введение препарата инфузоматом до 1 часа', price: 4500 },
    { id: 5, title: 'Спленэктомия', price: 14200 },
    { id: 6, title: 'Электрическая кардиоверсия', price: 17000 },
    { id: 6, title: 'Блефарорафия (оба глаза)', price: 16000 },
    { id: 6, title: 'Интравитреальная инъекция (включая анестезию)', price: 1400 },
  ],
};

const appointment = () => {
  if (localStorage.getItem('access_token') && localStorage.getItem('access_token') !== 'undefined') {
    router.push({ path: '/login', query: { to: 'appointment' } });
  } else {
    showModal.value = true;
  }
};
</script>

<style lang="scss" scoped>
.price-page {
  &__container {
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  &__header {
    margin-bottom: 75px;
  }

  &__prices {
    margin-bottom: 42px;
  }

  &__btn {
    background-color: #014bff;
    color: white;
  }
}
</style>
