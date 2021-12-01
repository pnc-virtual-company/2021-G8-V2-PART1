<template>
<div>
  <section>
    <div class="cate-card">
      <div>
        <h2>Category Name</h2>
      </div>
      <div class="btn">
        <button class="btn-change">EDIT</button>
        <button class="btn-remove">REMOVE</button>
      </div>
    </div>
  </section>
  </div>
</template>

<script>
export default {
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
}

button {
  text-decoration: none;
  width: 35%;
  padding: 12px;
  margin: 8px;
  border-radius: 50px;
  border: none;
  cursor: pointer;
}

.btn-change {
  background-color: #f6ba1f;
  color: white;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.26);
  margin-left: 45px;
}

.btn-remove {
  background-color: rgb(255, 50, 50);
  color: white;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.26);
}

.btn {
  width: 35%;
  padding: 6px;
}
.cate-card {
  display: flex;
  justify-content: space-around;
}

</style>