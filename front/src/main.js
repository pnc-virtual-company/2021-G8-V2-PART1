import { createApp } from 'vue'
import App from './App.vue'
import {createRouter, createWebHistory} from 'vue-router';

import SignIn from './components/authentication/sign_in.vue';
import SignUp from './components/authentication/sign_up.vue';
import Navbar from './components/menu/navbar.vue';
import Category from './components/pages/Category/category.vue';
import Events from './components/pages/Event/event.vue';

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {path: '/',component: SignIn},
        {path: '/signin',component: SignIn},
        {path: '/signup',component: SignUp},
        {path: '/category',component: Category},
        {path: '/events',component: Events},
        {path: '/navbar',component: Navbar},
    ]
})
const app = createApp(App);
app.component("navbar", Navbar);
app.component("sign-in", SignIn);
app.component("sign-up", SignUp);
app.use(router);
app.mount('#app');
