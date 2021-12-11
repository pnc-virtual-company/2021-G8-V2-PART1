<template>
  <section>
    <div class="add-and-search">
      <div class="even-search">
        <input
          type="text"
          class="searchKey"
          placeholder="What are you looking for?"
          v-model="cardKeyWord"
        />
        <button type="button" class="searchButton" @click="clearSearch">
          X
        </button>
      </div>
      <div class="city-search">
        <input
          type="text"
          class="city-searchKey"
          placeholder="Select your city"
        />
        <button type="button" class="city-searchButton" @click="clearSearch">
          X
        </button>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  data() {
    return {
      cardKeyWord: '',
    };
  },
  watch: {
    cardKeyWord: function(newValue) {
      this.$emit('cardSearch', newValue);
    },
  },
  methods: {
    clearSearch() {
      this.cardKeyWord = '';
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
.searchButton:hover, .city-searchButton:hover {
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

.city-search{
  width: 60%;
  display: flex;
  justify-content: flex-end;
}

.city-searchKey {
  width: 40%;
  border: 2px solid rgb(34, 152, 207);
  border-right: none;
  padding: 15px;
  border-radius: 15px 0 0 15px;
  outline: none;
}
.city-searchButton {
    margin: 0;
  width: 45px;
  border: 1px solid rgb(34, 152, 207);
  background: rgb(34, 152, 207);
  color: #fff;
  border-radius: 0 15px 15px 0;
  cursor: pointer;
  font-size: 24px;
}
</style>
