import { createApp } from 'vue'
import App from './App.vue'
import {createRouter, createWebHistory} from 'vue-router'
//import component 
import Navbar from './components/menu/navbar.vue';
import Category from './components/pages/Category/category.vue';
import Events from './components/pages/Event/event.vue';
import MyEvent from './components/pages/MyEvent/my_event.vue';

const router = createRouter({
    history: createWebHistory(),                                                                
    routes: [
        // {path: '/',component: Navbar},
        // {path: '/navbar',component: Navbar},
        {path: '/category',component: Category},
        {path: '/events',component: Events},
        {path: '/myevent',component: MyEvent},
    ]
})
const app = createApp(App);
<<<<<<< HEAD
app.component("navbar",Navbar);
=======
app.component("navbar", Navbar);
>>>>>>> c4a8b8ccb612294644d074000e993c90d642f1e3
app.use(router);
app.mount('#app');