<!-- App.vue -->
<template>
  <div>
    <Sidebar />
    <div class="main-content">
        <Navbar />
        <div class="mt-4 pl-2">
          <h1>Список заявок</h1>
          <p>Здесь вы можете просмотреть весь список заявок.</p>
        </div>
        <div class="mt-4">
          <lead-list/>
        </div>
      </div>
    <Footer />
  </div>
</template>

<script>
  import '@fortawesome/fontawesome-free/css/all.min.css';
  import '../assets/main.scss';

  import Sidebar  from '../components/main/Sidebar.vue';
  import Navbar   from '../components/main/Navbar.vue';
  import Footer   from '../components/main/Footer.vue';
  import LeadList from '../components/lead/LeadList.vue';

  import { onMounted } from 'vue';

  export default {
    components: {
      Sidebar,
      Navbar,
      Footer,
      LeadList
    },
    setup() {
      onMounted(() => {
      });
    }
  };
</script>
