import { createApp } from 'vue'
import App from './App.vue'
import {createRouter, createWebHistory} from 'vue-router'
//import component 
import SignIn from './components/authentication/sign_in.vue';
import SignUp from './components/authentication/sign_up.vue';
import Main from './components/main/main.vue';
const router = createRouter({
    history: createWebHistory(),
    routes: [
        {path: '/',component: SignIn},
        {path: '/signin',component: SignIn},
        {path: '/signup',component: SignUp},
        {path: '/main', component: Main}
    ]
})
const app = createApp(App);
app.use(router);
app.mount('#app');
