<template>
  <section>
    <form action="#">
      <div class="add-and-search">
        <div class="wrap">
          <div class="search">
            <input
              type="text"
              class="searchTerm"
              placeholder="What are you looking for?"
            />
            <button type="submit" class="searchButton">
              <i class="fa fa-search"></i>
            </button>
          </div>
        </div>
        <div class="add">
          <button class="btn-add" @click="showFormCategory">Add+</button>
        </div>
      </div>
    </form>
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
  width: 63%;
  margin: auto;
  display: flex;
  justify-content: space-between;
}

.btn-add {
  background-color: #f6ba1f;
  border: none;
  padding: 15px 35px;
  border-radius: 50px;
  color: white;
  margin-top: 7px;
  font-weight: bold;
  cursor: pointer;
}

.search {
  display: flex;
}

.searchTerm {
  width: 100%;
  border: 3px solid #f6ba1f;
  border-right: none;
  padding: 11px;
  height: 10px;
  border-radius: 5px 0 0 5px;
  outline: none;
  color: #9dbfaf;
}

.searchTerm:focus {
  color: #f6ba1f;
}

.searchButton {
  width: 45px;
  height: 38px;
  border: 1px solid #f6ba1f;
  background: #f6ba1f;
  text-align: center;
  color: #fff;
  border-radius: 0 5px 5px 0;
  cursor: pointer;
  font-size: 20px;
}

.wrap {
  width: 50%;
  margin-top: 10px;
}
</style>
