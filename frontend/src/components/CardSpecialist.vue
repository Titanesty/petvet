<template>
  <div class="vet">
    <div class="vet__img-block">
      <img class="vet__img img" :src="info.photo" :alt="info.photo" />
    </div>
    <div class="vet__block">
      <div class="vet__block-name">
        <span>{{ info.name }}</span>
      </div>
      <div class="vet__block-job">
        <span>{{ info.job }}</span>
      </div>
    </div>
  </div>
</template>

<script setup>
defineProps({
  info: {
    name: String,
    job: String,
    photo: String,
  },
});
</script>

<style lang="scss" scoped>
.vet {
  width: 100%;
  height: 100%;
  cursor: pointer;
  background: content-box no-repeat center;
  overflow: hidden;
  border-radius: 56px;
  position: relative;

  @include small {
    border-radius: 0;
  }

  &__img {
    &-block {
      display: flex;
      height: 100%;
    }
  }

  &:hover &__block {
    opacity: 1;
    transition: opacity 0.3s ease-in-out;
  }

  &__block {
    left: 0;
    right: 0;
    margin-left: auto;
    margin-right: auto;
    position: absolute;
    bottom: 14px;
    opacity: 0;
    color: #000000;
    background-color: #ffffff;
    border-radius: 27px;
    padding: 19px 33px 18px 19px;
    max-width: 90%;
    height: auto;

    @include small {
      opacity: 1;
    }

    &-name {
      font-size: 15px;
      font-family: Inter;
      font-weight: 400;
      letter-spacing: 0.6px;
      word-wrap: break-word;
    }

    &-job {
      color: #6c6c6c;
      font-size: 12px;
      font-family: Inter;
      font-weight: 400;
      letter-spacing: 0.48px;
      word-wrap: break-word;
    }
  }
}
</style>
