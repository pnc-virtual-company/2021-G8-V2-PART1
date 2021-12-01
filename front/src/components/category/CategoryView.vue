<template>
    <section>
        <category-form 
        v-if="isShowAddForm" 
        :isShowForm='isShowAddForm' 
        :isEditing='isEditing'
        @hideForm="hideFormCategory"
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
        }
    },
    methods: {
        showFormCategory() {
            this.isShowAddForm = 1;
        },
        hideFormCategory() {
            this.isShowAddForm = 0;
        }

    },
}
</script>

<style scoped>

</style>