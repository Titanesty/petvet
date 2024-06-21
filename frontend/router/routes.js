import HomePage from '../src/pages/HomePage.vue';
import PricePage from '../src/pages/PricePage.vue';
import ContactPage from '../src/pages/ContactPage.vue';
import SpecialistsPage from '../src/pages/SpecialistsPage.vue';
import SignInPage from '../src/pages/SignInPage.vue';
import SignUpPage from '../src/pages/SignUpPage.vue';
import AboutPage from '../src/pages/AboutPage.vue';
import LoginPage from '../src/pages/LoginPage.vue';
import NotFound from '../src/pages/NotFound.vue';
import Vet from '@/pages/Vet.vue';

export default [
  {
    path: '/',
    component: HomePage,
    name: 'Домашняя',
  },
  { path: '/about', component: AboutPage, name: 'О нас' },
  { path: '/services', component: PricePage, name: 'Услуги' },
  { path: '/specialists', component: SpecialistsPage, name: 'Наши специалисты' },
  { path: '/specialist/:id', component: Vet, name: 'Специалст' },
  { path: '/contacts', component: ContactPage, name: 'Контакты' },
  {
    path: '/login',
    component: LoginPage,
    name: 'Личный кабинет',
  },
  {
    path: '/sign-in',
    component: SignInPage,
    name: 'Авторизация',
  },
  { path: '/sign-up', component: SignUpPage, name: 'Регистрация' },
  {
    // path: "*",
    path: '/:catchAll(.*)',
    name: '404',
    component: NotFound,
    meta: {
      requiresAuth: false,
    },
  },
];
