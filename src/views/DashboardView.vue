<!-- App.vue -->
<template>
  <div>
    <Sidebar />
    <div class="main-content">
        <Navbar />
        <div class="row container mt-4">
          <h1>Добро пожаловать в тестовое приложение</h1>
          <p>Здесь вы можете создать тестовый лид (заявку), так-же просмотреть весь список заявок.</p>
        </div>
      </div>
    <Footer />
  </div>
</template>

<script>
  import '@fortawesome/fontawesome-free/css/all.min.css';
  import '../assets/main.scss';

  import Sidebar from '../components/main/Sidebar.vue';
  import Navbar  from '../components/main/Navbar.vue';
  import Footer  from '../components/main/Footer.vue';

  import { onMounted } from 'vue';

  export default {
    components: {
      Sidebar,
      Navbar,
      Footer
    },
    setup() {
      onMounted(() => {
      });
    }
  };
</script>
