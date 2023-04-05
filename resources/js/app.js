import './bootstrap';
import 'vuetify/dist/vuetify.min.css'
import vuetify from './vuetify';
import router from './router';
import pinia from './pinia';
import {createApp} from 'vue';
import axios from 'axios';
import App from "./app.vue";
import {useAuthStore} from "./stores/auth";

const app = createApp(App);

app.use(vuetify);
app.use(router);
app.use(pinia);

app.config.globalProperties.$http = axios;
app.config.globalProperties.$authStore = useAuthStore();
// console.log(app.config.globalProperties.$authStore)

app.mount('#app');
