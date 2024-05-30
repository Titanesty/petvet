export const onRequestSuccess = config => {
  const accessKey = localStorage.getItem('access_token');
  if (accessKey !== null) {
    config.headers.Authorization = `Bearer ${accessKey}`;
  }

  return config;
};

export const onRequestError = error => Promise.reject(error);

export const onResponseSuccess = response => response;

export const onResponseError = error => {
  return Promise.reject(error);
};
