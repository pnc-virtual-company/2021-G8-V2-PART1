import { createApp } from 'vue'
import App from './App.vue'
import {createRouter, createWebHistory} from 'vue-router';

import SignIn from './components/authentication/SignIn.vue';
import SignUp from './components/authentication/SignUp.vue';
import Category from './components/pages/category/Category.vue';
import Event from './components/pages/event/Event.vue';
import MyEvent from './components/pages/myevent/MyEvent.vue';

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {path: '/',component: MyEvent},
        {path: '/signin',component: SignIn},
        {path: '/signup',component: SignUp},
        {path: '/category',component: Category},
        {path: '/event',component: Event},
        {path: '/myEvent',component: MyEvent},
     
    ]
})
const app = createApp(App);

app.use(router);
app.mount('#app');
