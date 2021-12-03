<template>
  <section>
    <div class="add-and-search">
      <div class="cate-search">
        <input
          type="text"
          class="searchKey"
          placeholder="What are you looking for?"
        />
        <button type="button" class="searchButton">
          x
        </button>
      </div>
      <div class="cate-add-btn">
        <button type="button" class="btn-add" @click="showFormCategory">Add+</button>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  emit: ["showFormCategory"],
  data() {
    return {};
  },
  methods: {
    showFormCategory() {
      this.$emit("showForm");
    },
  },
};
</script>

<style scoped>
.add-and-search {
  width: 70%;
  margin: auto;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.btn-add {
  margin: 0;
  background: #f6ba1f;
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

.cate-search {
  width: 60%;
  display: flex;
}

.searchKey {
  width: 65%;
  border: 2px solid #f6ba1f;
  border-right: none;
  padding: 15px;
  border-radius: 15px 0 0 15px;
  outline: none;
}

.searchButton {
  margin: 0;
  width: 45px;
  border: 1px solid #f6ba1f;
  background: #f6ba1f;
  color: #fff;
  border-radius: 0 15px 15px 0;
  cursor: pointer;
  font-size: 24px;
}
</style>
