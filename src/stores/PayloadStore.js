import { defineStore } from 'pinia';
import api from '@/services/api';

export const usePayloadStore = defineStore('payload', {
  state: () => ({
    user: {
      id: null, name: null, role: null, logged: false
    }
  }),
  actions: {
    async initUser() {
      try {
        const response = await api.post('/user/payload');
        if (response.data.success) {
          this.user.id     = response.data.data.id;
          this.user.name   = response.data.data.name;
          this.user.email  = response.data.data.email;
          this.user.logged = true;
        }
      } catch (error) {
        throw new Error(error.message || 'Ошибка авторизации');
      }
    }
  },
});
