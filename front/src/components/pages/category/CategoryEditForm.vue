<template>
  <section >
    <form class="createForm">
      <div class="title">
        <h2>Edit Category</h2>
      </div>
      <div>
        <input type="text" placeholder="Name..." v-model="categoryName"/>
        <div class="error" v-if="cateNameError">
          <p v-text="cateNameError"></p>
        </div>
        <div class="error" v-if="editError">
          <p v-text="editError"></p>
        </div>
      </div>
      <div class="btn">
        <button type="button" class="btnCancel" @click="cancel">CANCEL</button>
        <button type="button"  class="btnUpdate" @click="emitUpdateCategory">UPDATE</button>
      </div>
    </form>
  </section>
</template>

<script>
export default {
  emit: ['updateCategory', 'cancel'],
  props: ['categoryToEdit', 'editError'],
  data() {
    return {
      categoryName: this.categoryToEdit.name,
      cateNameError:'',
    }
  },
  watch: {
    categoryName: function(value) {
      if(value !== '') {
        this.cateNameError = '';
      } else if(this.editError === '') {
        this.cateNameError = 'invalid category name';
      }
    }
  },
  methods: {
    cancel() {
      this.$emit('hideForm')
    },
    emitUpdateCategory() {
      if(this.cateNameError === '') {
        this.$emit('updateCategory', this.categoryName, this.categoryToEdit.id);
      }
    },
  },
};
</script>

<style scoped>
.createForm {
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.26);
  margin: 1rem auto;
  border-radius: 10px;
  padding: 1rem;
  text-align: center;
  width: 70%;
  max-width: 30rem;
  scroll-behavior: smooth;

}

.createForm input {
  padding: 5px;
  margin-left: 30px;
  width: 55%;
}

.createForm div {
  margin: 1em 0;
}

h2 {
  font-size: 20px;
  color: #f6ba1f;
  margin: 0 0 1rem 0;
}

button {
  text-decoration: none;
  width: 20%;
  padding: 5px 12px;
  margin: 8px;
  border-radius: 50px;
  border: none;
  cursor: pointer;
}

.btnCancel,
.btnCreate,
.btnUpdate {
  background-color: rgb(255, 50, 50);
  color: white;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.26);
}

.btnCancel:hover,
.btnCreate:hover,
.btnUpdate:hover {
  color: rgb(173, 101, 233);
}

.btnCreate {
  background-color: #f6ba1f;
}

.btnUpdate {
  background-color: #1f95f6;
}
.error {
  color: red;
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

input {
  padding: 10px;
  border-radius: 10px;
}

input[type="text"]:focus {
  border: 2px solid #fcc924;
}
</style>