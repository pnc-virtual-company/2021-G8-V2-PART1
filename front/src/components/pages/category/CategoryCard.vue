<template>
  <section class="cate-card">
    <div class="cate-name">
      <h2>{{ category.name }}</h2>
    </div>
    <div  class="cate-date">
      <p>{{ category.created_at }}</p>
    </div>
    <div class="cate-btn">
      <button type="button" class="btn-change" @click="edit(category.id, category.name)">Edit</button>
      <button type="button" class="btn-remove" @click="remove(category.id)">Remove</button>
    </div>
  </section>
</template>

<script>
export default {
  emits: ['requestToRemove', 'requestToEdit'],
  props: ['category'],
  methods: {
    remove(id) {
      this.$emit('requestToRemove', id);
    },
    edit(id, name) {
      this.$emit('requestToEdit', id, name);
    }
  },
};
</script>

<style scoped>
.cate-card {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin: 20px auto;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 12px;
  width: 80%;
  border: 1px solid #ccc;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.26);
}

button {
  text-decoration: none;
  padding: 5px 12px;
  border-radius: 50px;
  border: none;
  cursor: pointer;
}
.btn-change:hover,
.btn-remove:hover {
  color: rgb(173, 101, 233);
}
.btn-change {
  background-color: rgb(34, 152, 207);
  color: white;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.26);
  margin-right: 8px;
}

.btn-remove {
  background-color: rgb(255, 50, 50);
  color: white;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.26);
}

.cate-btn {
  width: 30%;
  padding: 6px;
  text-align: right;
}
.cate-name,
.cate-date {
  width: 40%;
}
</style>