<template>
  <section  >
    <div class="createForm">
      <div class="title">
        <h2>Add Category</h2>
      </div>
      <div>
        <input type="text" placeholder="Name..." v-model="categoryName"/>
      </div>
      <div class="btn">
        <button class="btnCancel" @click="cancel">CANCEL</button>
        <button class="btnAccept" @click="create" v-if="!isEditing">CREATE</button>
        <button class="btnAccept" @click="update" v-if="isEditing">UPDATE</button>
      </div>
    </div>
  </section>
</template>

<script>
export default {
  emit: ['create', 'cancel'],
  props: ['isShowForm', 'isEditing'],
  data() {
    return {
      categoryName: '',
    }
  },

  methods: {
    create() {
      this.$emit('addCategory', this.categoryName);
    },
    cancel() {
      this.$emit('hideForm')
    }
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
  font-size: 30px;
  color: #f6ba1f;
  margin: 0 0 1rem 0;
}

button {
  text-decoration: none;
  width: 20%;
  padding: 12px;
  margin: 8px;
  border-radius: 50px;
  border: none;
  cursor: pointer;
}

.btnCancel {
  background-color: rgb(255, 50, 50);
  color: white;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.26);
}

.btnAccept {
  background-color: #f6ba1f;
  color: white;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.26);
}

.btn {
  display: flex;
  justify-content: flex-end;
}

input[type="text"] {
  padding: 10px;
  border: 0;
  width: 80%;
  padding: 12px 20px;
  margin: 8px 0;
  box-sizing: border-box;
  border: 3px solid #ccc;
  outline: none;
}

input {
  padding: 10px;
  border-radius: 10px;
}

.messageError {
  color: red;
}

input[type="text"]:focus {
  border: 2px solid #fcc924;
}
</style>