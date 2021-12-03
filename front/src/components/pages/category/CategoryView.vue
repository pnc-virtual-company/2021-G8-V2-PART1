<template>
    <section>
        <add-search @showForm='showFormCategory'></add-search>
        <category-form 
        v-if="isShowAddForm" 
        :isShowForm="isShowAddForm"
        :isEditing="isEditing"
        @hideForm="hideFormCategory"
        @addCategory ="addCategory"
        ></category-form>
        <category-card v-for="category of categories" :key="category.id" :category="category"></category-card>
    </section>
</template>

<script>
import AddSearch from './AddSearch.vue';
import CategoryForm from './CategoryForm.vue';
import CategoryCard from './CategoryCard.vue';

import axios from 'axios';
const url = "http://127.0.0.1:8000/api/categories";

export default {
    components: {
        'add-search': AddSearch,
        'category-form': CategoryForm,
        'category-card': CategoryCard,
    },
    data() {
        return {
            isShowAddForm: 0,
            categories: [],
        }
    },
    methods: {
        showFormCategory() {
            this.isShowAddForm = 1;
        },
        hideFormCategory() {
            this.isShowAddForm = 0;
        },
        // addCategory(categoryName){
        //     axios.post(url, categoryName).then(res => {
        //         console.log(res.data);
        //         this.isShowAddForm = 0;
        //     })
        // }
    },
    mounted() {
        axios.get(url).then(res => {
            this.categories = res.data.data;
            console.log(this.categories);
        })
    },
}
</script>

<style scoped>

</style>