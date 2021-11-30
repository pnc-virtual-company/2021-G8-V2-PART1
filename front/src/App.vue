<template>
  <div>
    <!-- <navbar></navbar> -->
    <router-view></router-view>
    <category-form></category-form>
  </div>
</template>

<script>
import CategoryForm from './components/category/CategoryForm';
export default {
  components: {'category-form': CategoryForm}
}
</script>

<style>
*{
  padding:0;
  margin: 0;
}
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  color: #2c3e50;
}
</style>
