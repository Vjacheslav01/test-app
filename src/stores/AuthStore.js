import { defineStore } from 'pinia';
import api from '@/services/api';

export const useAuthStore = defineStore('auth', {
  state: () => ({
    token: null,
  }),
  actions: {
    async auth(formData) {
      try {
        const response = await api.post('/user/auth', formData);
        if (response.success) {
          localStorage.setItem(
            'token', this.token
          );
          this.token = response.data.data.token;
        }
      } catch (error) {
        throw new Error(error.message || 'Ошибка авторизации');
      }
    },
    async logout() {
      try {
        const response = await api.post('/user/logout');
        if (response.success) {
          localStorage.removeItem('token');
        }
      } catch (error) {
        throw new Error(error.message || 'Ошибка авторизации');
      }
    }
  },
});
