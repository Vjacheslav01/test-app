<template>
  <div>
    <div class="col-lg-12 d-flex align-items-end">
      <div style="padding-right: 25px;" class="mb-3 col-lg-4">
        <label for="statusFilter" class="form-label">Статус</label>
        <select class="form-select" id="statusFilter" v-model="filters.status">
          <option value="">Все</option>
          <option value="Active">Активные</option>
          <option value="Resolved">Завершенные</option>
        </select>
      </div>
      <div style="padding-right: 25px;" class="mb-3 col-lg-4">
        <label for="startDate" class="form-label">Дата начала</label>
        <input type="date" class="form-control" id="startDate" v-model="filters.startDate">
      </div>
      <div style="padding-right: 25px;"class="mb-3 col-lg-3">
        <label for="endDate" class="form-label">Дата окончания</label>
        <input type="date" class="form-control" id="endDate" v-model="filters.endDate">
      </div>
      <div class="mb-3 col-lg-1">
        <button class="btn btn-primary" @click="fetchRequests">
          <i class="fas fa-arrow-right"></i>
        </button>
      </div>
    </div>
    <table class="table">
      <thead>
      <tr>
        <th>ID</th>
        <th>Имя</th>
        <th>Email</th>
        <th>Сообщение</th>
        <th>Статус</th>
        <th>Комментарий</th>
        <th>Действия</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="lead in lead.leads" :key="lead.id">
        <td>{{ lead.id }}</td>
        <td>{{ lead.name }}</td>
        <td>{{ lead.email }}</td>
        <td>{{ lead.message }}</td>
        <td>{{ lead.status }}</td>
        <td>{{ lead.comment }}</td>
        <td>
          <button class="btn btn-success" @click="resolveRequest(lead.id)" v-if="lead.status === 'Active'">Завершить</button>
        </td>
      </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
  import { ref } from 'vue';
  import { useLeadStore } from '../../stores/LeadStore.js';

  const lead = useLeadStore();

  const filters = ref({
    status: '',
    startDate: '',
    endDate: ''
  });

  const fetchRequests = async () => {
    lead.filters = filters.value;
    await lead.fetchRequests();

  };

  const resolveRequest = async (id) => {
    const comment = prompt('Введите комментарий:');
    if (comment) {
      await lead.updateRequest(id, {status: 'Resolve', comment: comment});
      await lead.fetchRequests();
    }
  };

  fetchRequests();
</script>
