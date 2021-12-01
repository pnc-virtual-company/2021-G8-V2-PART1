<template>
  <div>
   <category-view :categories='categories'></category-view>
  </div>
</template>

<script>
export default {
  data() {
    return {
      categories: [
        {id: 1, name: 'party', created_at: '1/2/2020  2:30pm'},
        {id: 2, name: 'dek', created_at: '1/2/2020  2:30pm'},
        {id: 3, name: 'der', created_at: '1/2/2020  2:30pm'},
        {id: 4, name: 'phek', created_at: '1/2/2020  2:30pm'},
      ]
    }
  },
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
