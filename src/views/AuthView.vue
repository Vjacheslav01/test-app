<template>
  <div class="auth-card">
    <h2>Войти</h2>
    <form @submit.prevent="auth()">
      <div class="input-group">
        <input type="email" v-model="form.email" placeholder="Email" required/>
        <span class="icon">✉️</span>
      </div>
      <div class="input-group">
        <input type="password" placeholder="Пароль" v-model="form.password" required>
        <span class="icon">🔒</span>
      </div>
      <button type="submit" class="btn btn-primary">Продолжить</button>
    </form>
  </div>
</template>

<script setup>
  import '../assets/auth.scss'

  import { ref } from 'vue';
  import { useAuthStore } from '../stores/AuthStore.js';
  import { useToast } from 'vue-toastification';
  import { useRouter } from 'vue-router';

  const toast = useToast();
  const authStore = useAuthStore();
  const router = useRouter();

  const form = ref({email: '', phone: '', password: ''});

  const auth = async () => {
    try {
      await authStore.auth(form.value);
      toast.success('Авторизация прошла успешно!');
      router.push('/');
    } catch (error) {
      toast.error(error.message);
    }
  };
</script>
