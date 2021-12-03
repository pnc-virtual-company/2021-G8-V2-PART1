<template>
    <section>
        <add-search @showForm='showFormCategory'></add-search>
       
        <category-add-form 
            v-if="isShowAddForm"
            :createError="createError"
            @hideForm="hideFormCategory"
            @addCategory ="addNewCategory"
        ></category-add-form>
        <category-edit-form 
            v-if="isEditing"
            :editError="editError"
            :categoryToEdit="categoryToEdit"
            @hideForm="hideFormCategory"
            @updateCategory ="updateCategory"
        ></category-edit-form>
        <category-card 
            v-for="category of categories" 
            :key="category.id" 
            :category="category"
            @requestToRemove="removeCategory"
            @requestToEdit="showFormEdit"
            @updateCategory="updateCategory"
        ></category-card>
    </section>
</template>

<script>
import AddSearch from './AddSearch.vue';
import CategoryAddForm from './CategoryAddForm.vue';
import CategoryEditForm from './CategoryEditForm.vue';
import CategoryCard from './CategoryCard.vue';

import axios from 'axios';
const url = "http://127.0.0.1:8000/api/categories";

export default {
    components: {
        'add-search': AddSearch,
        'category-add-form': CategoryAddForm,
        'category-edit-form': CategoryEditForm,
        'category-card': CategoryCard,
    },
    data() {
        return {
            isShowAddForm: false,
            isEditing: false,
            categoryToEdit: null,
            categories: [],
            createError: '',
            editError: '',
        }
    },
    methods: {
        showFormCategory() {
            this.isShowAddForm = !this.isEditing;
        },
        hideFormCategory() {
            this.isShowAddForm = false;
            this.isEditing = false;
        },
        addNewCategory(categoryName){
            let data = {
                name: categoryName
            }
            axios.post(url, data)
            .then(res => {
                this.categories.unshift(res.data.data);
                this.isShowAddForm = false,
                this.createError = '';
            })
            .catch(error => {
                let serverCode = error.response.status;
                if(serverCode === 422) {
                    this.createError = 'Category is existed!'
                }
            })
        },
        removeCategory(id) {
            axios.delete(url + '/' + id)
            .then(() => {
                this.categories = this.categories.filter(cate => cate.id !== id);
            })
        },
        showFormEdit(id, name) {
            this.isEditing = !this.isShowAddForm;
            this.categoryToEdit = {
                id: id,
                name: name
            }
        },
        updateCategory(newCateName, id) {
            let data = {
                name: newCateName
            }
            axios.put(url + '/' + id, data)
            .then(res => {
                this.categories = this.categories.filter(cate => cate.id !== id);
                this.categories.unshift(res.data.data);
                this.isEditing = false;
            })
            .catch(error => {
                let serverCode = error.response.status;
                if(serverCode === 422) {
                    this.editError = 'Category name is not available!'
                }
            })
        }
    },
    mounted() {
        axios.get(url).then(res => {
            this.categories = res.data.data;
        })
    },
}
</script>

<style scoped>

</style>