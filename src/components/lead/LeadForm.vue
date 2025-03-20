<!-- src/components/RequestForm.vue -->
<template>
  <form @submit.prevent="submitRequest">
    <div class="mb-3">
      <label for="name" class="form-label">Имя</label>
      <input type="text" class="form-control" id="name" v-model="request.name" required>
    </div>
    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" class="form-control" id="email" v-model="request.email" required>
    </div>
    <div class="mb-3">
      <label for="message" class="form-label">Сообщение</label>
      <textarea class="form-control" id="message" v-model="request.message" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Отправить</button>
  </form>
</template>

<script>
  import { ref } from 'vue';
  import { useLeadStore } from '../../stores/LeadStore.js';

  export default {
    setup() {
      const request = ref({
        name: '',
        email: '',
        message: ''
      });
      const lead = useLeadStore();

      const submitRequest = async () => {
        await lead.submitRequest(request.value);
        alert('Заявка отправлена!');
        request.value = { name: '', email: '', message: '' };
      };
      return { request, submitRequest };
    }
  };
</script>
