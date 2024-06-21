<template>
  <OpenModal @close="close" :show="isShowModel">
    <div v-if="vetData" class="specialist">
      <div class="specialist__img">
        <img class="img" :src="vetsImage[vetData.id - 1]" alt="vet" />
      </div>
      <div class="specialist__wrapper">
        <div class="specialist__title">{{ vetData.full_name }}</div>
        <div class="specialist__pos">{{ vetData.position }}</div>
        <div class="specialist__reviews">
          <div class="specialist__reviews-title"><h2>Отзывы на врача</h2></div>
          <div class="specialist__reviews-wrapper">
            <textarea class="specialist__reviews-textarea" placeholder="Оставтьте свой отзыв"></textarea>
            <TheButton class="specialist__reviews-btn">Оставить отзыв</TheButton>
          </div>
          <div class="specialist__reviews-list">
            <div class="specialist__reviews-item" v-for="review of reviewsList" :key="review.id">
              {{ review.title }}
            </div>
          </div>
        </div>
      </div>
    </div>
  </OpenModal>
</template>

<script setup>
import OpenModal from '@/components/OpenModal.vue';
import { onMounted, ref } from 'vue';
import Api from '@/api/api.js';
import { useRoute, useRouter } from 'vue-router';
import Vet8 from '@/static/images/vets/vet8.png';
import Vet2 from '@/static/images/vets/vet2.png';
import Vet3 from '@/static/images/vets/vet3.png';
import Vet4 from '@/static/images/vets/vet4.png';
import Vet1 from '@/static/images/vets/vet1.png';
import Vet6 from '@/static/images/vets/vet6.png';
import Vet7 from '@/static/images/vets/vet7.png';
import Vet5 from '@/static/images/vets/vet5.png';
import TheButton from '@/components/common/TheButton.vue';

const route = useRoute();
const router = useRouter();
const vetData = ref(null);
const vetsImage = [Vet8, Vet2, Vet3, Vet4, Vet1, Vet6, Vet7, Vet5];

const isShowModel = ref(true);

onMounted(async () => {
  const result = await Api.vet(route.params.id);
  vetData.value = result.data;
});

const close = () => {
  router.push({ path: '/specialists' });
};
</script>

<style scoped lang="scss">
.specialist {
  display: flex;
  flex-direction: row;
  justify-content: space-between;
  align-items: flex-start;
  gap: 20px;
  width: 100%;

  &__img {
  }

  &__title {
    color: #000000;
    font-size: 18px;
    font-family: Inter;
    font-weight: 700;
    letter-spacing: 1.28px;
    word-wrap: break-word;
  }

  &__wrapper {
    flex: 1 1;
  }

  &__reviews {
    border-top: 1px solid #000000;
    margin-top: 25px;
    width: 100%;

    &-title {
      color: #000000;
      font-size: 18px;
      font-family: Inter;
      font-weight: 700;
      letter-spacing: 1.28px;
      word-wrap: break-word;
    }

    &-wrapper {
      display: flex;
      justify-content: space-between;
      align-items: center;
      gap: 35px;
    }

    &-textarea {
      display: block;
      width: 100%;
      border-bottom: 1px solid #000000;
      text-align: left;
      height: 100%;
      margin-top: 15px;
    }

    &-btn {
      max-width: 230px;
      width: 100%;
      background-color: #014bff;
      color: white;
    }
  }
}
</style>
