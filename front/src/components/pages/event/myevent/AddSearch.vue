<template>
  <section>
    <div class="add-and-search">
      <div class="even-search">
        <input
          type="text"
          class="searchKey"
          placeholder="What are you looking for?"
          v-model="keyWord"
        />
        <button type="button" class="searchButton">
          X
        </button>
      </div>
      <div class="cate-add-btn">
        <button type="button" class="btn-add" @click="$emit('showForm')">Add+</button>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  data() {
    return {
      keyWord: ''
    };
  },
  // watch: {
  //   keyWord: function(newValue) {
  //     this.$emit('search', newValue);
  //   }
  // },
  methods: {
    clearSearch() {
      this.keyWord = '';
    }
  },
};
</script>

<style scoped>
.add-and-search {
  width: 82%;
  margin: auto;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.btn-add {
  margin: 0;
  width: 150px;
  background: var(--main-color);
  border: none;
  padding: 15px 20px;
  border-radius: 50px;
  color: white;
  font-weight: bold;
  cursor: pointer;
}
.btn-add:hover,
.searchButton:hover {
  color: rgb(173, 101, 233);
}

.even-search {
  width: 60%;
  display: flex;
}

.searchKey {
  width: 65%;
  border: 2px solid var(--main-color);
  border-right: none;
  padding: 15px;
  border-radius: 15px 0 0 15px;
  outline: none;
}

.searchButton {
  margin: 0;
  width: 45px;
  border: 1px solid var(--main-color);
  background: var(--main-color);
  color: #fff;
  border-radius: 0 15px 15px 0;
  cursor: pointer;
  font-size: 24px;
}
</style>
