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
    async fetchRequests(filter) {
      try {
        const response = await api.get('/lead/list', {params: filter});
        if (response.data.success) {
          this.leads = response.data.data;
        }
      } catch (error) {
        throw new Error(error.message || 'Ошибка');
      }
    },
    async submitRequest(formData) {
      try {
        const response = await api.post('/lead/submit', formData);
      } catch (error) {
        throw new Error(error.message || 'Ошибка');
      }
    },
    async updateRequest(id, data) {
      try {
        const response = await api.post('/lead/update', {id: id, data});
      } catch (error) {
        throw new Error(error.message || 'Ошибка');
      }
    }
  }
});
