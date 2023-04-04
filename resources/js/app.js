import './bootstrap';
import 'vuetify/dist/vuetify.min.css'
import vuetify from './vuetify';
import router from './router';
import pinia from './pinia';
import {createApp} from 'vue';
import axios from 'axios';

import navBar from './components/global/navBar.vue'

const app = createApp({});

app.use(vuetify);
app.use(router);
app.use(pinia);

app.component('nav-bar', navBar);

app.config.globalProperties.$http = axios;

app.mount('#app');
