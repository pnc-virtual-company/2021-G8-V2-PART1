import { createApp } from 'vue'
import App from './App.vue'
import { createRouter, createWebHistory } from 'vue-router'

import SignIn from './components/authentication/SignIn.vue';
import SignUp from './components/authentication/SignUp.vue';
import CategoryView from './components/pages/category/CategoryView.vue';
import EventView from './components/pages/event/EventView.vue';
import MyEventView from './components/pages/event/MyEventView.vue';
import BaseDialog from './components/UI/BaseDialog.vue';
import BaseButton from './components/UI/BaseButton.vue';

const router = createRouter({
    history: createWebHistory(),
    routes: [
        {path: '/',component: SignIn},
        {path: '/signin',component: SignIn},
        {path: '/signup',component: SignUp},
        {path: '/categoryView',component: CategoryView},
        {path: '/event',component: EventView},
        {path: '/myEvent',component: MyEventView},
    ]
})
const app = createApp(App);
app.component('base-dialog', BaseDialog);
app.component('base-button', BaseButton);
app.use(router);
app.mount('#app');
