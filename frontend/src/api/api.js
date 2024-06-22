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
      params: { id },
    });
  }

  static async client(id) {
    return axios.get('/api/client.php', {
      params: { id },
    });
  }

  static async getRecords() {
    return axios.get('/api/records.php');
  }

  static async records(data) {
    return axios.post('/api/records.php', {
      animal: data.animal,
      time_from: data.time_from,
      time_to: data.time_to,
      veterinarian_id: data.veterinarian_id,
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

  static async subscribe(email) {
    return axios.post('/api/subscribe.php', {
      email,
    });
  }

  static async appointment(data) {
    return axios.post('/api/appointment.php', {
      phone: data.phone,
      name: data.name,
    });
  }

  static async reviews(id) {
    return axios.get('/api/reviews.php', {
      params: { id },
    });
  }

  static async respond(data) {
    return axios.post('/api/reviews.php', {
      text: data.text,
      veterinarian_id: data.veterinarian_id,
    });
  }
}
