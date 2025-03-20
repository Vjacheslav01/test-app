<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Панель управления</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="notificationDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="fas fa-bell"></i>
              <span class="notification-badge">{{ notificationCount }}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationDropdown">
              <li><h6 class="dropdown-header">Последние уведомления</h6></li>
              <li v-for="notification in notifications" :key="notification.id">
                <a class="dropdown-item" href="#">{{ notification.text }}</a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
              <i class="fas fa-user"></i> Профиль
            </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>

<script>
  import { mapState, mapGetters } from 'pinia';
  import { useDashboardStore } from '@/stores/DashboardStore.js';

  export default {
    computed: {
      ...mapState(useDashboardStore, ['notifications']),
      ...mapGetters(useDashboardStore, ['notificationCount'])
    }
  };
</script>

<style scoped>
  /* Стили для навбара */
  .navbar {
    background-color: #fff;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  }

  .notification-badge {
    position: absolute;
    top: 5px;
    right: 5px;
    background-color: red;
    color: white;
    border-radius: 50%;
    padding: 2px 6px;
    font-size: 12px;
  }

  .dropdown-menu {
    min-width: 300px;
  }
</style>
