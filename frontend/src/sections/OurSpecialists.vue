<template>
  <section class="specialists">
    <SectionBlock class="specialists__block" :info="headerSpecialist">
      <div class="specialists__list">
        <CardSpecialist
          class="specialists__item"
          v-for="specialist of specialistList"
          :key="specialist.id"
          :info="specialist" />
      </div>
      <template v-slot:btn>
        <div class="specialists__btn">
          <router-link class="specialists__btn-link link" to="/specialists">Подробнее</router-link>
        </div>
      </template>
    </SectionBlock>
  </section>
</template>

<script setup>
import CardSpecialist from '../components/CardSpecialist.vue';
import Vet1 from '../static/images/vets/vet1.png';
import Vet6 from '../static/images/vets/vet6.png';
import Vet7 from '../static/images/vets/vet7.png';
import SectionBlock from '../components/SectionBlock.vue';

const headerSpecialist = {
  title: 'Наши специалисты',
  description: '*подробная информация о сотрудниках доступна на странице “специалисты”',
};

const specialistList = [
  {
    id: 0,
    name: 'Дубовицкая Ольга Александровна',
    job: 'Заведующий отделением неврологии и реабилитации',
    photo: Vet1,
  },
  { id: 1, name: 'Алиева Мария Андреевна', job: 'Заведующий отделением стоматологии', photo: Vet6 },
  { id: 2, name: 'Афанасьева Алевтина Сергеевна', job: 'Ветеринарный врач - эндокринолог', photo: Vet7 },
];
</script>

<style lang="scss" scoped>
.specialists {
  width: 100%;

  &__block {
    display: flex;
    flex-direction: column;
  }

  &__list {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    padding: 0 42px;
    gap: 67px;

    @include little {
      grid-template-columns: repeat(2, 1fr);
      padding: 0 15px;
      gap: 15px;
    }

    @include small {
      grid-template-columns: 1fr;
      padding: 0 15px;
      gap: 15px;
    }
  }

  &__item {
    height: auto;

    @include small {
      height: 400px;
    }
  }

  &__btn {
    display: flex;
    align-items: center;
    text-align: center;
    padding: 11px 75px;
    align-self: center;
    background-color: #e6e6e6;
    color: #000000;
    border-radius: 56px;
    cursor: pointer;
    margin-top: 38px;
    height: 41px;

    &:hover {
      @include active;
    }
  }
}
</style>
