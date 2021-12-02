import { createApp } from 'vue'
import App from './App.vue'
import { createRouter, createWebHistory } from 'vue-router'

import CategoryForm from './components/pages/category/CategoryForm';
import AddSearch from './components/pages/category/AddSearch';
import CategoryCard from './components/pages/category/CategoryCard';
import CategoryView from './components/pages/category/CategoryView';

import SignIn from './components/authentication/SignIn.vue';
import SignUp from './components/authentication/SignUp.vue';
import Navbar from './components/menu/Navbar.vue';
import Event from './components/pages/event/Event.vue';

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {path: '/',component: SignIn},
        {path: '/signin',component: SignIn},
        {path: '/signup',component: SignUp},
        {path: '/navbar',component: Navbar},
    ]
})
const app = createApp(App);
app.component("navbar", Navbar);
app.component("sign-in", SignIn);
app.component("sign-up", SignUp);
app.component("event", Event);
app.component("category-card", CategoryCard);
app.component("category-form", CategoryForm);
app.component("add-search", AddSearch);
app.component("category-view", CategoryView);
app.use(router);
app.mount('#app');
