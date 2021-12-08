<template>
    <section>
        <add-search @showForm='showAddForm' @search='search'></add-search>
        <base-dialog
            v-if="dialogDisplayed"
            :title="dialogTitle"
            :mode="dialogMode"
            @close="closeDialog"
        >
            <input type="text" placeholder="Name..." v-model="categoryName"/>
            <div
                v-if="cateNameError" 
                :class="getErrorClass">
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
    </section>
</template>

<script>
import AddSearch from './AddSearch.vue';
import CategoryCard from './CategoryCard.vue';

import axios from 'axios';
const url = "http://127.0.0.1:8000/api/categories/";

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
        }
    },
    watch: {
        categoryName: function(newValue) {
            if(newValue === '') {
                this.cateNameError = 'Please enter category name';
            } else {
                this.cateNameError = '';
                for(let cate of this.categories) {
                    if(cate.name.toLowerCase() === newValue.toLowerCase()) {
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
        },
        getErrorClass() {
            if(this.cateNameError === '') {
                return 'frontOk';
            }
            return 'frontError';
        }
    },
    methods: {
        showAddForm() {
            this.dialogMode = 'create';
            this.dialogDisplayed = true;
            this.cateNameError = '';
        },
        closeDialog() {
            this.dialogDisplayed = false;
            this.categoryName = '';
            this.cateNameError = '';
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
        },
        removeCategory(id) {
            axios.delete(url + id)
            .then(() => {
                this.categories = this.categories.filter(cate => cate.id !== id);
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
            let data = {
                name: newCateName
            }
            axios.put(url + id, data)
            .then(res => {
                this.categories.forEach((cate, index) => {
                    if(cate.id == id) {
                        this.categories.splice(index, 1, res.data.data);
                    }
                });
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
                axios.get(url).then(res => {
                    this.categories = res.data.data;
                });
            } else {
                axios.get(url + 'search/' + key).then(res => {
                    this.categories = res.data;
                })
            }
        }
    },
    mounted() {
        axios.get(url).then(res => {
            this.categories = res.data;
        })
    },
}
</script>

<style scoped>
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
.frontOk,
.frontError {
    width: 400px;
    text-align: center;
}
.frontOk {
    color: rgb(56, 56, 255);
}
.frontError {
    color: rgba(255, 0, 0, 0.575);
}
</style>