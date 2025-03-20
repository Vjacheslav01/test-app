import { defineStore } from 'pinia';

export const useDashboardStore = defineStore('dashboard', {
  state: () => ({
    notifications: [
    ],
  }),
  getters: {
    notificationCount: (state) => state.notifications.length
  }
});
