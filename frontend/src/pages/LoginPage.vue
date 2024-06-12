<template>
  <div class="login">
    <div class="login__container container">
      <TitleBlock :info="{ title: 'Личный кабинет' }">
        <div class="login__wrapper">
          <div class="login__info">
            <div class="login__text">
              <h2>Личные данные</h2>
              <div>
                Ваше имя:
                <div
                  class="login__content"
                  :class="{ 'login__content--active': isActiveContent.name }"
                  ref="name"
                  @click="handleContenteditable('name', $event)">
                  {{ profileInfo.name }}
                </div>
              </div>
              <div>Логин: {{ profileInfo.login }}</div>
              <div>
                Телефон:
                <div
                  class="login__content login__content-phone"
                  :class="{ 'login__content--active': isActiveContent.phone }"
                  ref="phone">
                  {{ mask(profileInfo.phone) }}
                </div>
              </div>
            </div>

            <div class="login__info-wrapper">
              <TheButton class="login__info-btn" @click="logOut"><span>Выйти из аккаунта</span></TheButton>
            </div>
          </div>
          <div class="login__record" ref="recordBlock">
            <h2>Онлайн-запись питомца на прием</h2>
            <div class="login__record-wrapper">
              <DropdownList
                class="login__record-dropdown"
                v-for="item of recordList"
                :valueList="item"
                :key="item.id"
                v-model="recordData" />
            </div>
            <TheButton class="login__record-btn" @click="record"><span>Записаться</span></TheButton>
          </div>
          <div class="login__archive">
            <h2>Записи</h2>
            <div class="login__archive-list">
              <table>
                <tr>
                  <th>Номер</th>
                  <th>Пациент</th>
                  <th>Запись от</th>
                  <th>до</th>
                  <th>Ветеринар</th>
                </tr>
                <tr v-for="(archive, index) of archiveList" :key="index">
                  <td>{{ ++index }}</td>
                  <td>{{ archive.animal }}</td>
                  <td>{{ archive.time_from }}</td>
                  <td>{{ archive.time_to }}</td>
                  <td>{{ archive.vet.full_name }}</td>
                  <td>{{ archive.vet.position }}</td>
                </tr>
              </table>
            </div>
          </div>
        </div>
      </TitleBlock>
    </div>
  </div>
</template>

<script setup>
import TitleBlock from '../components/TitleBlock.vue';
import TheButton from '../components/common/TheButton.vue';
import { onMounted, ref, watch } from 'vue';
import Api from '../api/api.js';
import { useRoute, useRouter } from 'vue-router';
import DropdownList from '@/components/DropdownList.vue';
import { isEqual } from 'lodash';
import { toast } from 'vue3-toastify';

const router = useRouter();
const route = useRoute();

const name = ref(null);
const phone = ref(null);
const recordBlock = ref(null);
const archiveList = ref([]);

const getVet = async vetId => {
  try {
    const result = await Api.vet(vetId);
    return result.data;
  } catch (e) {}
};

onMounted(async () => {
  await getProfileInfo();
  await getVets();
  await getArchive();
  if (route.query.to === 'appointment') recordBlock.value?.scrollIntoView({ behavior: 'smooth' });
  watch(
    profileInfo.value,
    (value, oldValue) => {
      saveActive.value = isEqual(value, oldValue);
    },
    { deep: true }
  );
});

const mask = value => {
  if (value && value.length === 13)
    return `+${value.slice(0, 1)} (${value.slice(1, 4)}) ${value.slice(5, 8)}-${value.slice(8, 11)}-${value.slice(11, 13)}`;
  return value;
};

const isActiveContent = ref({
  name: false,
  phone: false,
});

const getArchive = async () => {
  try {
    const result = await Api.getRecords();
    const list = [];
    for (let item of result.data) {
      item.vet = await getVet(item.veterinarian_id);
      delete item.veterinarian_id;
      list.push(item);
    }
    archiveList.value = list;
  } catch (e) {
    console.error(`Error get archive, ${e.message}`);
  }
};

const record = async () => {
  try {
    const currentDate = new Date();
    const year = currentDate.getFullYear();
    const month = String(currentDate.getMonth() + 1).padStart(2, '0'); // Месяцы в JS начинаются с 0, поэтому добавляем 1
    const day = String(currentDate.getDate()).padStart(2, '0');
    const [timeFrom, timeTo] = recordData.value.date.split('-');
    const record = {
      animal: recordData.value.pet,
      veterinarian_id: recordData.value.vet.toString(),
      time_from: `${year}-${month}-${day}T${timeFrom}:00`,
      time_to: `${year}-${month}-${day}T${timeTo}:00`,
    };
    const result = await Api.records(record);
    if (result) {
      toast('Вы успешно записались!', {
        autoClose: 2000,
        type: 'success',
      });
      await getArchive();
    }
  } catch (e) {
    console.error(`Error record, ${e.message}`);
    toast('Ошибка записи', {
      autoClose: 2000,
      type: 'error',
    });
  }
};

const handleContenteditable = (value, event) => {
  isActiveContent.value[value] = true;
  profileInfoCopy.value[value] = profileInfo.value[value];
  profileInfo.value[value] = '';
  event.target.innerText = '';
};

const getVets = async () => {
  const result = await Api.vets();
  if (result.data.vets && result.data.vets.length)
    recordList.value[0].list = [
      ...result.data.vets.map(({ id, full_name, position }) => {
        return { id, value: full_name, description: position };
      }),
    ];
};

const recordList = ref([
  {
    id: 'vet',
    title: 'Выберите врача',
    list: [],
  },
  {
    id: 'pet',
    title: 'Выберете домашнее животное',
    list: [
      { id: 0, value: 'Собака' },
      { id: 1, value: 'Кошка' },
      { id: 2, value: 'Хомяк' },
      { id: 3, value: 'Крыса' },
      { id: 4, value: 'Кролик' },
      { id: 5, value: 'Шиншила' },
      { id: 6, value: 'Морская свинка' },
      { id: 7, value: 'Хорёк' },
      { id: 8, value: 'Попугай' },
    ],
  },
  {
    id: 'date',
    title: 'Выберете дату и время',
    list: [
      { id: 0, value: '06:00-07:00' },
      { id: 0, value: '07:00-08:00' },
      { id: 0, value: '08:00-09:00' },
      { id: 0, value: '09:00-10:00' },
      { id: 1, value: '10:00-11:00' },
      { id: 2, value: '11:00-12:00' },
      { id: 3, value: '12:00-13:00' },
      { id: 4, value: '13:00-14:00' },
      { id: 5, value: '14:00-15:00' },
      { id: 6, value: '15:00-16:00' },
      { id: 7, value: '16:00-17:00' },
      { id: 8, value: '17:00-18:00' },
      { id: 8, value: '18:00-19:00' },
      { id: 8, value: '19:00-20:00' },
      { id: 8, value: '20:00-21:00' },
      { id: 8, value: '21:00-22:00' },
      { id: 8, value: '22:00-23:00' },
      { id: 8, value: '23:00-24:00' },
      { id: 8, value: '24:00-01:00' },
      { id: 8, value: '01:00-02:00' },
      { id: 8, value: '02:00-03:00' },
      { id: 8, value: '03:00-04:00' },
      { id: 8, value: '04:00-05:00' },
      { id: 8, value: '05:00-06:00' },
    ],
  },
]);

const recordData = ref({
  id: null,
  vet: '',
  pet: '',
  date: null,
});

const profileInfo = ref({
  name: null,
  login: null,
  phone: null,
});

const profileInfoCopy = ref({
  name: null,
  login: null,
  phone: null,
});

const saveActive = ref(false);

const getProfileInfo = async () => {
  try {
    const data = await Api.profile();
    profileInfo.value.name = data.data.user.name;
    profileInfo.value.login = data.data.user.login;
    profileInfo.value.phone = data.data.user.phone;
  } catch (e) {
    console.log(`Error get profile info, ${e.message}`);
  }
};

const logOut = () => {
  localStorage.removeItem('access_token');
  router.push({ path: '/sign-in' });
};
</script>

<style lang="scss" scoped>
.login {
  width: 100%;

  & h2 {
    text-align: center;
    align-self: center;
    color: black;
    font-size: 20px;
    font-family: Inter;
    font-weight: 500;
    letter-spacing: 0.8px;
    word-wrap: break-word;
    margin-bottom: 31px;
  }

  &__wrapper {
    display: flex;
    flex-direction: column;
    gap: 54px;
    width: 100%;

    @include small {
      gap: 15px;
    }
  }

  &__info {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: flex-start;
    padding: 43px 158px;
    position: relative;
    width: 100%;
    gap: 20px;

    @include small {
      padding: 15px;
    }

    &:before {
      content: '';
      height: 1px;
      width: calc(100% + 32px + 49px);
      background-color: #000000;
      top: -43px;
      transform: translateX(-158px - 49px);
      position: absolute;

      @include small {
        transform: translateX(-20px);
        width: calc(100% + 15px);
        top: -15px;
      }
    }

    &-wrapper {
      display: flex;
      gap: 25px;
    }

    &-btn {
      height: 32px;
      color: #ffffff;
      background-color: #014bff;
      margin-top: 5px;

      &--active {
        background-color: #014bff;
      }

      &--disable {
        background-color: #4a4a4a;
      }
    }
  }

  &__content {
    &--active {
      font-size: 16px;
      color: #014bff;
    }
  }

  &__text {
    display: flex;
    flex-direction: column;

    & h2 {
      align-self: start;
    }

    & div {
      display: inline-block;
    }
  }

  &__record {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: center;
    width: 100%;

    &-wrapper {
      display: flex;
      justify-content: center;
      align-items: flex-start;
      width: 100%;
      gap: 58px;
      margin-bottom: 44px;

      @include small {
        gap: 15px;
      }
    }

    &-btn {
      width: 100%;
      max-width: 125px;
      height: 29px;
      color: #ffffff;
      background-color: #014bff;
    }

    &-dropdown {
      width: 100%;
      max-width: 255px;
      height: 51px;
    }
  }

  &__archive {
    &-list {
      width: 100%;

      & table {
        width: 100%;

        & tr {
          width: 100%;
        }

        & th {
          text-align: start;
        }
      }
    }
  }
}
</style>
