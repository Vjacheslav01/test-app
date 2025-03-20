<template>
  <div class="sidebar">
    <div class="text-center mb-4">
      <h3>APP TEST</h3>
    </div>
    <ul class="nav flex-column">
      <li class="nav-item">
        <RouterLink active-class="active" class="nav-link" to="/">
          <i class="fas fa-home"></i> Главная
        </RouterLink>
      </li>
      <li class="nav-item">
        <RouterLink active-class="active" class="nav-link" to="/lead/lead-request">
          <i class="fas fa-pen"></i> Оставить заявку
        </RouterLink>
      </li>
      <li v-if="payloadStore.user.logged" class="nav-item">
        <RouterLink active-class="active" class="nav-link" to="/lead/lead-list">
          <i class="fas fa-columns"></i> Список заявок
        </RouterLink>
      </li>
      <li v-if="payloadStore.user.logged" class="nav-item">
        <a href="#" class="nav-link" @click="logout()">
          <i class="fas fa-sign-out-alt"></i> Выйти
        </a>
      </li>
      <li v-else class="nav-item">
        <RouterLink active-class="active" class="nav-link" to="/auth">
          <i class="fas fa-sign-in"></i> Войти
        </RouterLink>
      </li>
    </ul>
  </div>
</template>

<script setup>
  import { RouterLink, RouterView } from 'vue-router'

  import { useAuthStore }    from '../../stores/AuthStore.js';
  import { usePayloadStore } from '../../stores/PayloadStore.js';

  const authStore    = useAuthStore();
  const payloadStore = usePayloadStore();

  const logout = async () => {
    try {
      const result = await authStore.logout();
      if (result.data.success) {
        localStorage.removeItem('token');
        window.location.reload();
      }
    } catch (error) {
      // toast.error(error.message);
    }
  };
</script>

<style scoped>
  .sidebar {
    height: 100vh;
    position: fixed;
    top: 0;
    left: 0;
    width: 250px;
    background-color: #343a40;
    color: #fff;
    padding-top: 20px;
  }
  .sidebar .nav-link {
    color: #fff;
    padding: 10px 20px;
    margin: 5px 0;
    border-radius: 5px;
    transition: background-color 0.3s;
  }
  .sidebar .nav-link:hover {
    background-color: #495057;
  }
  .sidebar .nav-link.active {
    background-color: #007bff;
  }
</style>
