<template>
  <div class="notfound">
    <TitleBlock :info="{ title: 'Страница не найдена' }">
      <h2>Ошибка 404</h2>
    </TitleBlock>
  </div>
</template>
<script setup>
import TitleBlock from '@/components/TitleBlock.vue';
</script>

<style lang="scss">
.notfound {
  & h2 {
    font-size: 95px;

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
</style>
