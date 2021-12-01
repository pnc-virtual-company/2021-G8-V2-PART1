<template>
<div>
  <section>
    <form action="">
    <div class="cate-card">
      <div>
        <h2>{{ category.name }}</h2>
      </div>
      <span>{{ category.created_at }}</span>
      <div class="btn">
        <button class="btn-change">EDIT</button>
        <button class="btn-remove">REMOVE</button>
      </div>
    </div>
    </form>
  </section>
  </div>
</template>

<script>
export default {
  props: ['category'],
};
</script>

<style scoped>
section {
  margin: 2rem auto;
  padding: 1rem;
  border: 1px solid #ccc;
  border-radius: 12px;
  max-width: 45rem;
  border: 1px solid #ccc;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.26);
   margin-top: 30px;
}

button {
  text-decoration: none;
  padding: 5px 12px;
  border-radius: 50px;
  border: none;
  cursor: pointer;
}

.btn-change {
  background-color: #f6ba1f;
  color: white;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.26);
  margin-right: 8px;
}

.btn-remove {
  background-color: rgb(255, 50, 50);
  color: white;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.26);
}

.btn {
  padding: 6px;
}
.cate-card {
  display: flex;
  justify-content: space-between;
  align-items: center;
}
  
</style>