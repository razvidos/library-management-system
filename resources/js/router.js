import {createRouter, createWebHashHistory} from "vue-router";
import Home from "./pages/Home.vue"
import Profile from "./pages/Profile.vue"

export default createRouter({
    history: createWebHashHistory(),
    routes: [
        {path: '/', name: 'home', component: Home},
        {path: '/profile', name: 'profile', component: Profile},
    ]
});
