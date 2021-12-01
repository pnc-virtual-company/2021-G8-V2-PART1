<template>
  <section>
    <form>
      <div class="title">
        <h2>Add Category</h2>
      </div>
      <div>
        <input type="text" placeholder="Name..." />
      </div>
      <!-- <p class="messageError">Error</p> -->
      <div class="btn">
        <button class="btn-cancel">CANCEL</button>
        <button class="btn-accept">CREATE</button>
      </div>
    </form>
  </section>
</template>

<script>
export default {};
</script>

<style scoped>
form {
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.26);
  margin: 1rem auto;
  border-radius: 10px;
  padding: 1rem;
  text-align: center;
  width: 70%;
  max-width: 30rem;
}

form input {
  padding: 5px;
  margin-left: 30px;
  width: 55%;
}

form div {
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

.btn-cancel {
  background-color: rgb(255, 50, 50);
  color: white;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.26);
}

.btn-accept {
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
