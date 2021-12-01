<template>
    <section>
        <category-form 
        v-if="isShowAddForm" 
        :isShowForm='isShowAddForm' 
        :isEditing='isEditing'
        @hideForm="hideFormCategory"
        @addCategory ='addCategory'
        ></category-form>
        <add-search @showForm='showFormCategory'></add-search>
        <section>
            <category-card v-for="category of categories" :key="category.id" :category='category'></category-card>
        </section>
    </section>
</template>

<script>
export default {
    props: ['categories'],
    data() {
        return {
            isShowAddForm: 0,
            isEditing: 0,
            categoryAlreadyExist:'',
        }
    },
    methods: {
        showFormCategory() {
            this.isShowAddForm = 1;
        },
        hideFormCategory() {
            this.isShowAddForm = 0;
        },
        addCategory(categoryName){
            console.log(categoryName)
            this.$emit('addCategory',categoryName)
        }
    },
}
</script>

<style scoped>

</style>