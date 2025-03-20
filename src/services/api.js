import axios from 'axios';

const api = axios.create({
  baseURL: 'http://api.test-app.loc:81',
  headers: {
    'Authorization': `Bearer ${localStorage.getItem('token')}`,
    'Content-Type': 'application/json',
  },
});

// Перехватчик для обработки ошибок
api.interceptors.response.use(
  (response) => response,
  (error) => {
    if (error.response) {
      return Promise.reject(error.response.data);
    } else if (error.request) {
      return Promise.reject({ message: 'Network Error' });
    } else {
      return Promise.reject({ message: error.message });
    }
  }
);

export default api;
