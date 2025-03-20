import { createApp } from 'vue';
import { createPinia } from 'pinia';

import App    from './App.vue';
import router from './router';

import 'bootstrap/dist/css/bootstrap.min.css';
import 'bootstrap';

import { usePayloadStore } from './stores/PayloadStore.js';

const app = createApp(App);

app.use(createPinia());
app.use(router);

router.beforeEach(async (to, from, next) => {
    const payloadStore = usePayloadStore();
    await payloadStore.initUser();

    if (to.matched.some(record => record.name === 'auth')) {
        console.log(payloadStore.user);
        if (payloadStore.user.logged) {
            next('/');
        }
    }
    // Проверяем, требует ли маршрут авторизации
    if (to.matched.some(record => record.meta.requiresAuth)) {
        if (!payloadStore.user.logged) {
            next('/auth');
        } else {
            next();
        }
    } else {
        next();
    }
});

app.mount('#app');
