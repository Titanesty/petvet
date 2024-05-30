import axios from 'axios';

import { onRequestError, onRequestSuccess, onResponseError, onResponseSuccess } from './interceptors.js';

const BASE_URL = import.meta.env.MODE === 'production' ? 'http://31.128.37.156:8000' : 'http://localhost:8000';

const defaultOptions = {
  baseURL: BASE_URL,
};

export const createAxiosInstance = (options = defaultOptions) => {
  const axiosInstance = axios.create(options);
  axiosInstance.interceptors.request.use(onRequestSuccess, onRequestError);
  axiosInstance.interceptors.response.use(onResponseSuccess, error => onResponseError(error, options));
  return axiosInstance;
};

const axiosBase = createAxiosInstance();

export default axiosBase;
