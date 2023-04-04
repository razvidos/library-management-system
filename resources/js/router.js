import {createRouter, createWebHashHistory} from "vue-router";
import Home from "./pages/Home.vue"
import BookIndex from "./pages/Books/index.vue"
import BookShow from "./pages/Books/show.vue"
import BookEdit from "./pages/Books/edit.vue"
import BookCreate from "./pages/Books/create.vue"


export default createRouter({
    history: createWebHashHistory(),
    routes: [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/books',
            name: 'books',
            component: BookIndex
        },
        {
            path: '/books/create',
            name: 'books.create',
            component: BookCreate,
            meta: {requiresAuth: true}
        },
        {
            path: '/books/:id',
            name: 'books.show',
            component: BookShow,
            props: true
        },
        {
            path: '/books/:id/edit',
            name: 'books.edit',
            component: BookEdit,
            props: true,
            meta: {requiresAuth: true}
        },

    ]
});
