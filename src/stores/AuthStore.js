import { defineStore } from 'pinia';
import api from '@/services/api';

export const useAuthStore = defineStore('auth', {
  state: () => ({
  }),
  actions: {
    async auth(formData) {
      try {
        return await api.post('/user/auth', formData);
      } catch (error) {
        throw new Error(error.message || 'Ошибка авторизации');
      }
    },
    async logout() {
      try {
        return  await api.post('/user/logout');
      } catch (error) {
        throw new Error(error.message || 'Ошибка авторизации');
      }
    }
  },
});
