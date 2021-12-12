<template>
    <section>
        
        <add-search @showForm='showAddForm' @search='search'></add-search>
        <div v-if="isEmpty">
        <base-dialog
            v-if="dialogDisplayed"
            :title="dialogTitle"
            :mode="dialogMode"
            @close="closeDialog"
        >
            <input type="text" id="formInput" placeholder="Name..." v-model="categoryName"/>
            <div
                v-if="cateNameError" 
                class="error">
                <p v-text="cateNameError"></p>
            </div>

            <template #actions>
                <base-button 
                    @click="onConfirm" 
                    :class="isValidated ? 'buttonActive' : 'buttonInactive'"
                    >{{ dialogButtton }}
                </base-button>
            </template>
        </base-dialog>
        <category-card 
            v-for="category of categories" 
            :key="category.id" 
            :category="category"
            @requestToRemove="removeCategory"
            @requestToEdit="showEditForm"
            @updateCategory="updateCategory"
        ></category-card>
        </div>
        <div class="emptyCategory" v-else>
            <h1>NO CATEGORY YET!!</h1>
        </div>
    </section>
</template>

<script>
import AddSearch from '../components/pages/category/AddSearch.vue';
import CategoryCard from '../components/pages/category/CategoryCard.vue';

import axios from "../axios-http.js";
export default {
    components: {
        'add-search': AddSearch,
        'category-card': CategoryCard,
    },
    data() {
        return {
            dialogMode: 'create',
            dialogDisplayed: false,
            categoryName: '',
            categoryKeySearch: '',
            categoryToEdit: null,
            categories: [],
            cateNameError:'',
            isEmpty: true,
        }
    },
    watch: {
        categoryName: function(newValue) {
            if(newValue === '') {
                this.cateNameError = 'Please enter category name';
            } else {
                this.cateNameError = '';
                for(let cate of this.categories) {
                    if((cate.name.toLowerCase() === newValue.toLowerCase()) && 
                        (this.dialogMode === 'create' || newValue !== this.categoryToEdit.name)) {
                        this.cateNameError = 'Category name already existed';
                    }
                }
            }
        }
    },
    computed: {
        dialogTitle() {
            return this.dialogMode === 'edit' ? 'EDIT CATEGORY' : 'CREATE CATEGORY';
        },
        dialogButtton() {
            return this.dialogMode === 'edit' ? 'EDIT' : 'CREATE';
        },
        isValidated() {
            return (
                this.cateNameError === '' && this.categoryName !== ''
            );
        }
    },
    methods: {
        showAddForm() {
            this.dialogMode = 'create';
            this.dialogDisplayed = true;
            this.cateNameError = '';
            this.isEmpty = true;
        },
        closeDialog() {
            this.dialogDisplayed = false;
            this.categoryName = '';
            this.cateNameError = '';
            this.isEmpty = true;
        },
        addNewCategory(categoryName){
            this.isEmpty = true;
            this.dialogDisplayed = true;
            let data = {
                name: categoryName
            }
            axios.post('api/categories', data)
            .then(res => {
                this.categories.unshift(res.data.data);
                this.isShowAddForm = false,
                this.createError = '';

                let storedCategories = JSON.parse(localStorage.getItem("getCategories"));
                storedCategories.unshift(res.data.data);
                localStorage.setItem("getCategories", JSON.stringify(storedCategories));
            })
        },
        removeCategory(id) {
            axios.delete('api/categories/' + id)
            .then(() => {
                this.categories = this.categories.filter(cate => cate.id !== id);

                let storedCategories = JSON.parse(localStorage.getItem("getCategories"));
                storedCategories = storedCategories.filter(cate => cate.id !== id);
                localStorage.setItem("getCategories", JSON.stringify(storedCategories));
            })
        },
        showEditForm(id, name) {
            this.dialogMode = 'edit';
            this.dialogDisplayed = true;
            this.categoryToEdit = {
                id: id,
                name: name
            }
            this.categoryName = this.categoryToEdit.name;
            this.cateNameError = '';
        },
        updateCategory(newCateName, id) {
            this.isEmpty = true;
            let data = {
                name: newCateName
            }
            axios.put('api/categories/' + id, data)
            .then(res => {
                this.categories.forEach((cate, index) => {
                    if(cate.id == id) {
                        this.categories.splice(index, 1, res.data.data);
                    }
                });

                let storedCategories = JSON.parse(localStorage.getItem("getCategories"));
                storedCategories.forEach((cate, index) => {
                    if(cate.id == id) {
                        storedCategories.splice(index, 1, res.data.data);
                    }
                });
               
                localStorage.setItem("getCategories", JSON.stringify(storedCategories));
                this.isEditing = false;
                this.editError = '';
                this.cateNameError = '';
            })
        },
        onConfirm() {
            if(this.isValidated) {
                if (this.dialogMode === 'create') {
                    this.addNewCategory(this.categoryName);
                } else if (this.dialogMode === 'edit') {
                    this.updateCategory(this.categoryName, this.categoryToEdit.id);
                }
                this.closeDialog();
            }
        },
        search(key) {
            if(key === '') {
                this.categories = JSON.parse(localStorage.getItem("getCategories"));
            } else {
                let categoryList = JSON.parse(localStorage.getItem("getCategories"));
                this.categories = categoryList.filter(cate => cate.name.toLowerCase().includes(key.toLowerCase()));
            }
        },
        getCategory() {
            axios.get('api/categories').then(res => {
            this.categories = res.data.data;
            if(this.categories == '') {
                this.isEmpty = false;
            }
            localStorage.setItem("getCategories", JSON.stringify(this.categories));
        })
        }
    },
    mounted() {
        this.getCategory();
    },
}
</script>

<style scoped>
.emptyCategory {
    text-align: center;
    opacity: 0.2;
    margin-top: 10%;
}
input {
  padding: 15px;
}
input[type="text"] {
  padding: 10px;
  border: 0;
  width: 80%;
  padding: 12px 20px;
  margin: 8px 0;
  box-sizing: border-box;
  border: 2px solid #ccc;
  outline: none;
}
input[type="text"]:focus {
  border: 2px solid var(--main-color);
}
#formInput {
    width: 350px;
}
.error {
    text-align: center;
    color: rgba(255, 0, 0, 0.575);
}
</style>