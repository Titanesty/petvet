<template>
  <div class="dropdown" ref="target" @click="isActiveList = !isActiveList">
    <div class="dropdown__title" :class="{ 'dropdown__title--active': isActiveList }">
      <span>{{ titleDropdown }}</span>
      <span>></span>
    </div>
    <div v-show="isActiveList" class="dropdown__list">
      <div
        class="dropdown__item"
        :class="{ 'dropdown__item--active': activeSelect(item.id) }"
        v-for="item of valueList.list"
        :key="item.id"
        @click="getOption(item)">
        <span>{{ item.value }}</span>
        <span>{{ item.description }}</span>
      </div>
    </div>
  </div>
</template>

<script setup>
import { computed, ref } from 'vue';
import { onClickOutside } from '@vueuse/core';

const props = defineProps({
  valueList: Object,
});
const dropdown = defineModel();

const target = ref(null);

const getOption = item => {
  if (props.valueList.id === 'vet') dropdown.value[props.valueList.id] = item.id;
  else dropdown.value[props.valueList.id] = item.value;
  const copyDropdown = JSON.parse(JSON.stringify(dropdown.value));
  delete copyDropdown['id'];
  if (Object.values(copyDropdown).every(i => !!i)) dropdown.value.id = Date.now();
};

const isActiveList = ref(false);

const titleDropdown = computed(() => {
  if (dropdown.value[props.valueList.id]) {
    if (props.valueList.id === 'vet')
      return props.valueList.list.find(i => i.id === dropdown.value[props.valueList.id]).value;
    return dropdown.value[props.valueList.id];
  }
  return props.valueList.title;
});

const activeSelect = value => {
  return value === dropdown.value[props.valueList?.id]?.id;
};

onClickOutside(target, () => (isActiveList.value = false));
</script>

<style lang="scss">
.dropdown {
  display: flex;
  flex-direction: column;
  justify-content: center;
  align-items: center;
  width: 100%;
  height: 100%;
  background: #e2e2e2;
  border-radius: 9px;
  cursor: pointer;
  position: relative;

  &__title {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
    padding: 10px;
    text-align: start;
    color: #343434;
    font-size: 15px;
    font-family: Inter;
    font-weight: 400;
    letter-spacing: 0.6px;
    word-wrap: break-word;
    line-height: 1.2;

    &--active span:nth-child(2) {
      transform: rotate(270deg) !important;
    }

    & span:nth-child(2) {
      transform: rotate(90deg);
    }
  }

  &__list {
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    align-items: center;
    background-color: #e2e2e2;
    width: 100%;
    border-radius: 0 0 9px 9px;
    height: 300px;
    overflow-y: scroll;
    overflow-x: hidden;
    position: absolute;
    top: calc(100% - 9px);
    left: 0;
    padding-top: 15px;
  }

  &__item {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    padding: 15px;
    width: 100%;
    gap: 15px;
    border-bottom: 1px solid #000000;

    &:hover {
      background-color: #b5b5b3;
    }

    &--active {
      background-color: #b5b5b3;
    }

    & span {
      display: block;
      width: 100%;
      font-size: 14px;
    }
  }
}
</style>
