import {createRouter, createWebHashHistory} from "vue-router";
import Home from "./pages/Home.vue"
import BookIndex from "./pages/Books/index.vue"


export default createRouter({
    history: createWebHashHistory(),
    routes: [
        {path: '/', name: 'home', component: Home},
        {path: '/books', name: 'books', component: BookIndex},
    ]
});
