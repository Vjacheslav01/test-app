<template>
  <div class="auth-main auth-background">
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
        <button type="submit" :class="{'btn-check': button.pushed, 'btn-primary': !button.pushed}" class="btn">
          Продолжить
        </button>
      </form>
      <p v-if="noty.message.length" class="text-danger text-small text-center mt-1">
        {{ noty.message }}
      </p>
      <p class="text-white text-center mt-2">Вернуться на <a href="/">главную</a></p>
    </div>
  </div>
</template>

<script setup>
  import { ref } from 'vue';
  import { useRouter } from 'vue-router';
  import { useAuthStore } from '../stores/AuthStore.js';

  const authStore = useAuthStore();
  const router    = useRouter();

  const noty   = ref({message: ''});
  const button = ref({pushed: false});
  const form   = ref({email: '', phone: '', password: ''});

  const auth = async () => {
    try {
      button.value.pushed = true;

      const result = await authStore.auth(form.value);

      if (result.data.success) {
        localStorage.setItem(
          'token', result.data.data.token
        )
        window.location.reload();
      }

      if (!result.data.success) {
        noty.value.message = result.data.message;
        button.value.pushed = false;
      }
    } catch (error) {
      // toast.error(error.message);
    }
  };
</script>

<style scoped src="../assets/auth.scss"></style>
