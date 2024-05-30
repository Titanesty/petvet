import axios from './index.js';
import axiosBase from 'axios';

export default class Api {
  static async register(data) {
    return axios.post('/api/registration.php', {
      name: data.name,
      login: data.login,
      phone: data.phone,
      password: data.password,
    });
  }
  static async login(data) {
    return axios.post('/api/login.php', {
      login: data.login,
      password: data.password,
    });
  }

  static async profile() {
    return axios.get('/api/profile.php');
  }

  static async vets() {
    return axios.get('/api/vets.php');
  }

  static async vet(id) {
    return axios.get('/api/vets.php', {
      params: {
        id,
      },
    });
  }

  static async getRecords() {
    return axios.get('/api/records.php');
  }

  static async records(data) {
    return axios.post('/api/records.php', {
      data,
    });
  }

  static async downloadPrice() {
    return axios.get('/api/price.php', {
      responseType: 'blob',
      headers: {
        'Content-Type': 'application/octet-stream',
      },
    });
  }
}
