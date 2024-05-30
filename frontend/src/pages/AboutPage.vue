<template>
  <div class="about-page">
    <div class="about-page__container container">
      <TitleBlock class="about-page__header" :info="{ title: 'О ветеринарной клинике' }"
        ><div class="about-page__description">
          <span
            >Мы — современный многопрофильный ветеринарный госпиталь с полным спектром услуг: от диагностики и лечения
            до медицинского сопровождения домашних питомцев разного вида, веса и возраста.</span
          >
        </div></TitleBlock
      >
      <div class="about-page__row">
        <div class="about-page__row-wrapper">
          <div class="about-page__col1 about-page__col about-page__text">
            <h3>Основными задачами учреждения являются:</h3>
            <span
              >Предупреждение и ликвидация заразных и массовых незаразных болезней животных. <br />
              Защита населения от болезней общих для человека и животных. <br />
              Охрана территории Таганрога и Российской Федерации от заноса заразных болезней животных из иностранных
              государств.</span
            >
          </div>
          <div class="about-page__col1 about-page__col" :style="{ backgroundImage: `url('${Husky}')` }"></div>
        </div>
        <div class="about-page__col2 about-page__col" :style="{ backgroundImage: `url('${Veterinar}')` }">
          <div class="about-page__block">
            <h3>Врачи и специалисты высочайшей квалификации</h3>
            <span
              >Наши сотрудники досконально знают свое дело, увлечены профессией и постоянно совершенствуются в ней</span
            >
          </div>
        </div>
        <div class="about-page__col4 about-page__col" :style="{ backgroundImage: `url('${Pet}')` }">
          <h3>Результат, к которому мы стремимся</h3>
          <div class="about-page__quote">
            <span>— здоровый питомец и довольный хозяин</span>
          </div>
          <div class="about-page__info-list">
            <div class="about-page__info-item" v-for="item of infoList" :key="item.id">
              <img class="about-page__info-item-img" :src="item.icon" alt="i" />
              <span>{{ item.title }}</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import TitleBlock from '../components/TitleBlock.vue';
import Husky from '../static/images/husky.png';
import Veterinar from '../static/images/veterinar-958x520.png';
import Pet from '../static/images/pet.png';
import Icon from '@/static/images/icon/icon.png';
import Icon2 from '@/static/images/icon/icon2.png';
import Icon3 from '@/static/images/icon/icon3.png';
import Icon4 from '@/static/images/icon/icon4.png';

const infoList = [
  { id: 0, icon: Icon, title: 'Работаем круглосуточно, без праздников и выходных' },
  { id: 0, icon: Icon4, title: 'Реанимационное отделение и стационар' },
  { id: 0, icon: Icon3, title: 'Круглосуточный кабинет УЗИ, КТ и рентген' },
  { id: 0, icon: Icon2, title: 'Приемное терапевтическое отделение' },
];
</script>

<style lang="scss" scoped>
.about-page {
  &__container {
  }

  &__header {
    margin-bottom: 22px;
  }

  &__description {
    text-align: center;
    color: #353535;
    font-size: 22px;
    font-family: Inter;
    font-weight: 400;
    letter-spacing: 0.88px;
    word-wrap: break-word;
  }

  &__row {
    display: flex;
    justify-content: space-between;
    flex-direction: column;
    width: 100%;
    gap: 25px;

    &-wrapper {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 25px;
      width: 100%;

      @include small {
        grid-template-columns: 1fr;
      }
    }
  }

  &__text {
    color: #ffffff;
    width: 100%;
    background-color: #a093be;
    padding: 79px 2px 112px 38px;
    font-family: Inter;
    word-wrap: break-word;

    @include medium {
      padding: 30px;
    }

    h3 {
      font-weight: 700;
      letter-spacing: 1.72px;
      margin-bottom: 60px;
      font-size: 30px;
    }

    span {
      font-weight: 400;
      letter-spacing: 0.96px;
    }
  }

  &__col {
    width: 100%;
    overflow: hidden;
    border-radius: 56px;

    h3 {
      align-self: center;
      text-align: center;
      color: white;
      font-size: 32px;
      font-family: Inter;
      font-weight: 700;
      letter-spacing: 1.28px;
      word-wrap: break-word;
      max-width: 400px;
    }
  }

  &__col1 {
    background-repeat: no-repeat;
    background-position: center center;
    width: 100%;

    @include small {
      height: 550px;
      background-origin: content-box;
    }
  }

  &__col2 {
    max-width: 1621px;
    height: 589px;
    width: 100%;
    position: relative;

    @include small {
      background-position: center;
    }
  }

  &__col4 {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: center;
    width: 100%;
    height: 987px;
    padding: 52.6px 147px 24px 86px;
    position: relative;
    background: no-repeat center;

    @include medium {
      padding: 15px;
      height: auto;
      background-size: cover;
    }

    @include little {
      padding: 15px;
      background-size: cover;
    }

    @include small {
      padding: 15px;
      height: auto;
      background-size: cover;
    }
  }

  &__quote {
    align-self: start;
    text-align: start;
    max-width: 524px;
    width: 100%;

    span {
      color: white;
      font-size: 71px;
      font-family: Inter;
      font-weight: 800;
      letter-spacing: 2.84px;
      word-wrap: break-word;
      line-height: 1.1;

      @include small {
        font-size: 25px;
      }
    }
  }

  &__block {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: start;
    padding: 71px 16px 76px 36px;
    border-radius: 37px;
    background-color: #ffffff;
    max-width: 529px;
    width: 100%;
    position: absolute;
    bottom: 18px;
    right: 73px;
    gap: 46px;

    @include medium {
      top: 50%;
      left: 50%;
      transform: translate(-50%);
    }

    @include small {
      height: 500px;
      max-width: 300px;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }

    h3 {
      align-self: start;
      text-align: left;
      font-size: 24px;
      font-family: Inter;
      font-weight: 600;
      letter-spacing: 0.96px;
      word-wrap: break-word;
      color: #000000;
    }

    span {
      display: block;
      color: black;
      font-size: 20px;
      font-family: Inter;
      font-weight: 400;
      letter-spacing: 0.8px;
      word-wrap: break-word;
    }
  }

  &__info-list {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    width: 100%;
    gap: 48px;
    max-width: 1296px;

    @include medium {
      grid-template-columns: repeat(2, 1fr);
      gap: 15px;
      margin-top: 85px;
    }

    @include little {
      grid-template-columns: repeat(2, 1fr);
      gap: 15px;
      margin-top: 85px;
    }

    @include small {
      grid-template-columns: 1fr;
      margin-top: 85px;
      gap: 15px;
    }
  }

  &__info-item {
    display: flex;
    justify-content: space-around;
    flex-direction: column;
    gap: 25px;
    cursor: pointer;
    padding: 25px 30px 35px 27px;
    background-color: #ffffff;
    box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);
    border-radius: 56px;
    color: #040404;
    font-size: 20px;
    font-family: Inter;
    font-weight: 400;
    letter-spacing: 0.8px;
    word-wrap: break-word;

    @include medium {
      padding: 25px;
      flex-direction: row;
    }

    @include small {
      padding: 25px;
      flex-direction: row;
    }

    &:hover {
      @include active;
    }

    &-img {
      max-width: 65px;
      max-height: 85px;

      @include small {
        max-width: 45px;
        max-height: 55px;
      }
    }
  }
}
</style>
