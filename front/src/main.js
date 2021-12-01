import { createApp } from 'vue'
import App from './App.vue'
import {createRouter, createWebHistory} from 'vue-router';

import SignIn from './components/authentication/SignIn.vue';
import SignUp from './components/authentication/SignUp.vue';
import Navbar from './components/menu/Navbar.vue';
import Category from './components/pages/category/Category.vue';
import Events from './components/pages/event/Event.vue';

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
