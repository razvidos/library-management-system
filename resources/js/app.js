import './bootstrap';
import 'vuetify/dist/vuetify.min.css'
import vuetify from './vuetify';
import router from './router';
import pinia from './pinia';
import {createApp} from 'vue';
import axios from 'axios';


const app = createApp({});

app.use(vuetify);
app.use(router);
app.use(pinia);

app.config.globalProperties.$http = axios;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */
Object.entries(import.meta.glob('./components/global/*.vue', { eager: true })).forEach(([path, definition]) => {
    app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
});

app.mount('#app');
