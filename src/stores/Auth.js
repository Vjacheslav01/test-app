import { defineStore } from 'pinia';
import api from '@/services/api';

export const useAuthStore = defineStore('auth', {
  state: () => ({
    user: null,
    token: null,
  }),
  actions: {
    async auth(formData) {
      try {
        const response = await api.post('/user/auth', formData);
        this.user = response.data.user;
        this.token = response.data.token;
        return response.data;
      } catch (error) {
        throw new Error(error.message || 'Ошибка авторизации');
      }
    }
  },
});
