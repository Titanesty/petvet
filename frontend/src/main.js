import { createApp } from 'vue';
import './assets/styles/style.scss';
import App from './App.vue';
import router from '../router/index.js';
import 'vue3-toastify/dist/index.css';

const app = createApp(App);
app.use(router);
app.mount('#app');
