// src/stores/requests.js
import { defineStore } from 'pinia';
import api from '@/services/api';

export const useLeadStore = defineStore('leads', {
  state: () => ({
    leads: [],
    filters: {
      status: '',
      startDate: '',
      endDate: ''
    }
  }),
  actions: {
    async submitRequest(formData) {
      try {
        const response = await api.post('/lead/submit', formData);
      } catch (error) {
        throw new Error(error.message || 'Ошибка');
      }
    }
  }
});
