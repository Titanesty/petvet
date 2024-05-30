<template>
  <div class="service">
    <SectionBlock :info="headerServicesAndPrices">
      <div class="service__list">
        <div class="service__row">
          <CardServices
            @click="goToPrice('1')"
            class="service__item"
            v-for="item of serviceOfRow(0, 3)"
            :key="item.id"
            :info="item" />
        </div>
        <div class="service__row">
          <CardServices
            @click="goToPrice('2')"
            class="service__item"
            v-for="item of serviceOfRow(3, 3)"
            :key="item.id"
            :info="item" />
        </div>
      </div>
      <template v-slot:btn>
        <div class="service__btn">
          <router-link class="service__btn-link link" to="/services">Подробнее</router-link>
        </div>
      </template>
    </SectionBlock>
  </div>
</template>

<script setup>
import SectionBlock from '../components/SectionBlock.vue';
import CardServices from '../components/CardServices.vue';
import { useRouter } from 'vue-router';
import Pet from '../static/images/pets/pet.png';
import Pet2 from '../static/images/pets/pet2.png';
import Pet3 from '../static/images/pets/pet3.png';
import Pet4 from '../static/images/pets/pet4.png';
import Pet5 from '../static/images/pets/pet5.png';
import Pet6 from '../static/images/pets/pet6.png';

const router = useRouter();

const headerServicesAndPrices = {
  title: 'Услуги и цены',
  description: '*цена может изменится в зависимости от размера работ',
};

const goToPrice = async value => {
  await router.push({ path: '/services', query: { section: value } });
};

const serviceOfRow = (start, count) => {
  return servicesAndPrices.slice(start, start + count);
};

const servicesAndPrices = [
  {
    id: 0,
    title: 'Ампутация хвоста',
    price: 1000,
    image: Pet6,
    color: '#ffeabd',
    textPos: {
      left: 24,
      top: 49,
    },
    imgPos: {
      left: 24,
      top: 49,
    },
  },
  {
    id: 1,
    title: 'Вакцинация',
    price: 1800,
    image: Pet5,
    color: '#8fd693',
    textPos: {
      left: 105,
      top: 35,
    },
    imgPos: {
      left: 24,
      top: 49,
    },
  },
  {
    id: 2,
    title: 'Общий анализ крови (гематология)',
    price: 1000,
    image: Pet4,
    color: '#ffb2ba',
    textPos: {
      left: 33,
      top: 47,
    },
    imgPos: {
      left: 24,
      top: 49,
    },
  },
  {
    id: 3,
    title: 'Цитологическое исследование',
    price: 2000,
    image: Pet3,
    color: '#5fcdc4',
    textPos: {
      left: 26,
      top: 75,
    },
    imgPos: {
      left: 24,
      top: 49,
    },
  },
  {
    id: 4,
    title: 'Стрижка когтей',
    price: 1000,
    image: Pet,
    color: '#c1d3fd',
    textPos: {
      left: 43,
      top: 36,
    },
    imgPos: {
      left: 24,
      top: 49,
    },
  },
  {
    id: 5,
    title: 'Груминг',
    price: 2000,
    image: Pet2,
    color: '#fba2da',
    textPos: {
      left: 28,
      top: 238,
    },
    imgPos: {
      left: 24,
      top: 49,
    },
  },
];
</script>

<style lang="scss" scoped>
.service {
  display: flex;
  justify-content: center;
  align-items: center;

  &__list {
    display: flex;
    flex-direction: column;
    width: 100%;
    gap: 31px;
  }

  &__row {
    gap: 33px;

    @include medium {
      display: flex !important;
      justify-content: space-between;
      align-items: center;
      padding: 0 15px;
    }

    @include little {
      display: flex !important;
      justify-content: space-between;
      align-items: center;
      padding: 0 15px;
      flex-wrap: wrap;
    }

    &:first-of-type {
      display: grid;
      grid-template-columns: 1fr 1fr 1.5fr;

      @include small {
        grid-template-columns: 1fr;
        padding: 0 15px;
        gap: 15px;
      }
    }

    &:nth-child(2) {
      display: grid;
      grid-template-columns: 1.5fr 1fr 1fr;

      @include small {
        grid-template-columns: 1fr;
        padding: 0 15px;
      }
    }
  }

  &__item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px;
    height: 355px;
    cursor: pointer;

    &:hover {
      @include active;
    }
  }

  &__btn {
    display: flex;
    align-items: center;
    text-align: center;
    align-self: center;
    background-color: #e6e6e6;
    color: #000000;
    border-radius: 56px;
    cursor: pointer;
    margin-top: 38px;
    height: 41px;

    &-link {
      padding: 11px 75px;
    }
  }
}
</style>
