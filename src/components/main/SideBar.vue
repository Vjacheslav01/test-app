<template>
  <div class="sidebar">
    <div class="text-center mb-4">
      <h3>APP TEST</h3>
    </div>
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link active" href="#">
          <i class="fas fa-home"></i> Оставить заявку
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="fas fa-home"></i> Список заявок
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">
          <i class="fas fa-sign-out-alt"></i> Выйти
        </a>
      </li>
    </ul>
  </div>
</template>

<script>
  export default {
    name: 'Sidebar'
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
