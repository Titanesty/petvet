<template>
  <div class="specialist-page">
    <div class="specialist-page__container container">
      <TitleBlock class="specialist-page__header" :info="{ title: 'Наши специалисты' }">
        <div class="specialist-page__header-description">
          <span
            >Наши сотрудники досконально знают свое дело, увлечены профессией и постоянно совершенствуются в ней</span
          >
        </div>
      </TitleBlock>
      <SectionBlock class="specialist-page__list" :info="{ title: '', description: '' }">
        <div v-if="!specialistList.length" v-for="n of 8" :key="n" class="empty"><div class="loader"></div></div>
        <CardSpecialist
          class="specialist-page__item"
          v-for="specialist of specialistList"
          :key="specialist.id"
          :info="specialist"
          @click="goToPageVet(specialist.id)" />
      </SectionBlock>
      <div class="specialist-page__row">
        <div class="specialist-page__text specialist-page__col">
          <h2>Наши принципы:</h2>
          <span
            >Мы внимательны к животным и людям, и искреннее хотим помочь. Мы считаем, что лечение должно проходить без
            лишнего стресса и создаем условия для того, чтобы всем было комфортно. Наши сотрудники досконально знают
            свое дело, увлечены своей профессией и постоянно совершенствуются.</span
          >
        </div>
        <div class="specialist-page__image specialist-page__col" :style="{ backgroundImage: `url('${Vets}')` }"></div>
      </div>
      <BannerAppointment class="specialist-page__appointment" @sendForm="sendForm" btn="Авторизация" />
    </div>
  </div>
</template>
<script setup>
import TitleBlock from '../components/TitleBlock.vue';
import SectionBlock from '../components/SectionBlock.vue';
import CardSpecialist from '../components/CardSpecialist.vue';
import BannerAppointment from '../components/BannerAppointment.vue';
import Vets from '../static/images/vets.png';
import Vet1 from '../static/images/vets/vet1.png';
import Vet2 from '../static/images/vets/vet2.png';
import Vet3 from '../static/images/vets/vet3.png';
import Vet4 from '../static/images/vets/vet4.png';
import Vet5 from '../static/images/vets/vet5.png';
import Vet6 from '../static/images/vets/vet6.png';
import Vet7 from '../static/images/vets/vet7.png';
import Vet8 from '../static/images/vets/vet8.png';
import { onMounted, ref } from 'vue';
import Api from '@/api/api.js';
import { useRouter } from 'vue-router';

const router = useRouter();
const vetsImage = [Vet8, Vet2, Vet3, Vet4, Vet1, Vet6, Vet7, Vet5];

onMounted(async () => {
  await getVets();
});

const goToPageVet = id => {
  router.push({ name: `Специалст`, params: { id: id } });
};

const getVets = async () => {
  try {
    const result = await Api.vets();
    const vets = result.data.vets;
    specialistList.value = vets.map(({ id, full_name, position }) => {
      return { id, name: full_name, job: position, photo: vetsImage[id - 1] };
    });
  } catch (e) {
    specialistList.value = specialistMock;
  }
};

const specialistList = ref([]);

const specialistMock = [
  {
    id: 0,
    name: 'Кулешова Виктория Андреевна',
    job: 'Ведущий ветеринар врач стамотолог',
    photo: Vet8,
  },
  { id: 1, name: 'Еремеев Константин Игоревич', job: 'Заведующий стационарным отделением', photo: Vet2 },
  { id: 2, name: 'Олейников Дмитрий Аркадьевич', job: 'Врач-терапевт', photo: Vet3 },
  { id: 3, name: 'Назарова Мария Владимировна', job: 'Доктор по лечебной работе, кардиолог', photo: Vet4 },
  {
    id: 4,
    name: 'Дубовицкая Ольга Александровна',
    job: 'Заведующий отделением неврологии и реабилитации',
    photo: Vet1,
  },
  { id: 5, name: 'Алиева Мария Андреевна', job: 'Заведующий отделением стоматологии', photo: Vet6 },
  { id: 6, name: 'Афанасьева Алевтина Сергеевна', job: 'Ветеринарный врач - эндокринолог', photo: Vet7 },
  { id: 7, name: 'Григорова Наталия Эдуардовна', job: 'Врач-терапевт', photo: Vet5 },
];

const sendForm = value => {
  console.log(value);
};
</script>

<style lang="scss" scoped>
.specialist-page {
  display: flex;
  width: 100%;

  &__header {
    margin-bottom: 20px;
  }

  &__list {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    width: 100%;
    margin-bottom: 13px;
    padding-bottom: 61px;
    column-gap: 69px;
    row-gap: 36px;

    @include desktop {
      grid-template-columns: repeat(3, 1fr);
    }

    @include medium {
      grid-template-columns: repeat(2, 1fr);
    }

    @include little {
      grid-template-columns: repeat(2, 1fr);
    }

    @include small {
      grid-template-columns: 1fr;
      row-gap: 15px;
    }

    @include xs {
      grid-template-columns: 1fr;
      row-gap: 15px;
    }
  }

  &__item {
    height: 410px;
    max-width: 302px;

    @include little {
      height: 350px;
    }

    @include small {
      max-width: 100%;
    }
  }

  &__appointment {
    width: 100%;
  }

  &__row {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 27px;
    width: 100%;
    margin-bottom: 28px;

    @include small {
      grid-template-columns: 1fr;
    }
  }

  &__col {
    width: 100%;
  }

  &__text {
    color: #ffffff;
    background-color: #a093be;
    padding: 77px 18px 137px 56px;
    border-radius: 55px;

    @include small {
      padding: 35px;
    }

    @include little {
      padding: 35px;
    }

    h2 {
      font-size: 43px;
      font-family: Inter;
      font-weight: 700;
      letter-spacing: 1.72px;
      word-wrap: break-word;
      margin-bottom: 60px;

      @include small {
        font-size: 25px;
        margin-bottom: 30px;
      }
    }

    span {
      font-size: 14px;
      font-family: Inter;
      font-weight: 400;
      letter-spacing: 1.72px;
      word-wrap: break-word;
    }
  }

  &__image {
    flex: 1 1;
    width: 100%;
    min-height: 100%;
    border-radius: 55px;
    overflow: hidden;
    background-repeat: no-repeat;
  }
}

.empty {
  display: flex;
  justify-content: center;
  align-items: center;
  width: 100%;
  height: 300px;
  box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);
  border-radius: 56px;

  @include small {
    border-radius: 0;
  }
}

.loader {
  border: 16px solid #f3f3f3;
  border-top: 16px solid #3498db;
  border-radius: 50%;
  width: 120px;
  height: 120px;
  animation: spin 2s linear infinite;
}

@keyframes spin {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
</style>
