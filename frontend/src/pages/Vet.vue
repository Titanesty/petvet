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
          <div v-if="accessToken" class="specialist__reviews-wrapper">
            <textarea
              @keydown.enter="addReview"
              v-model="textReview"
              class="specialist__reviews-textarea"
              placeholder="Оставтьте свой отзыв"></textarea>
            <TheButton class="specialist__reviews-btn" @click="addReview">Оставить отзыв</TheButton>
          </div>
          <div class="specialist__reviews-list">
            <div class="specialist__reviews-item" v-for="review of reviewsList" :key="review.id">
              <div class="specialist__reviews-client-wrapper">
                <div class="specialist__reviews-client-name">{{ review.client }}</div>
                <div class="specialist__reviews-client-date">{{ dateToRu(review.date) }}</div>
              </div>
              <div class="specialist__reviews-client-text">{{ review.text }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </OpenModal>
</template>

<script setup>
import OpenModal from '@/components/OpenModal.vue';
import { computed, onMounted, ref, watch } from 'vue';
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

const accessToken = ref(null);

const reviewsList = ref([]);

const textReview = ref('');

const dateToRu = date => {
  return new Date(date).toLocaleString('ru');
};

const addReview = async () => {
  try {
    if (!textReview.value) return;
    const result = await Api.respond({
      text: textReview.value,
      veterinarian_id: route.params.id,
    });
    if (result && result.data?.message === 'Successfully recorded') {
      console.log(result);
      delete result.data?.reviews?.veterinarian_id;
      const resultClient = await Api.client(result.data?.reviews?.client_id);
      result.data.reviews.client = resultClient.data;
      delete result.data?.reviews?.client_id;
      reviewsList.value.push(result.data.reviews);
      textReview.value = '';
    }
  } catch (e) {
    console.log('Error add review', e.message);
  }
};

onMounted(async () => {
  if (localStorage.access_token) {
    accessToken.value = localStorage.access_token;
  }
  const result = await Api.vet(route.params.id);
  vetData.value = result.data;

  const resultReviews = await Api.reviews(route.params.id);

  for (let review of resultReviews.data) {
    const resultClient = await Api.client(review.client_id);
    review.client = resultClient.data;
    delete review.client_id;
    delete review.veterinarian_id;
  }

  reviewsList.value = resultReviews.data;
});

watch(accessToken, value => {
  localStorage.access_token = value;
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

    &-list {
      display: flex;
      flex-direction: column;
      overflow-y: scroll;
      height: 40vh;
      max-height: 100%;
    }

    &-client {
      &-wrapper {
        display: flex;
        justify-content: flex-start;
        align-items: center;
        gap: 25px;
      }

      &-date {
        text-align: center;
        color: rgba(0, 0, 0, 0.5);
        font-size: 14px;
      }
    }
  }
}
</style>
