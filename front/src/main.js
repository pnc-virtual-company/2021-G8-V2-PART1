import { createApp } from 'vue'
import App from './App.vue'

import CategoryForm from './components/category/CategoryForm';
import AddSearch from './components/category/AddSearch';
import CategoryCard from './components/category/CategoryCard';
import CategoryView from './components/category/CategoryView';

const app = createApp(App);
app.component("category-card", CategoryCard);
app.component("category-form", CategoryForm);
app.component("add-search", AddSearch);
app.component("category-view", CategoryView);
app.mount('#app');
