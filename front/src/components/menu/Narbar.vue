<template>
  <nav class="container">
    <div v-if="userData !== null" class="navbar">
      <div class="username">
        <p id="username">{{ userData.firstname }}</p>
      </div>
      <ul>
        <li>
          <router-link to="/event">Find Events </router-link>
        </li>
        <li>
          <router-link to="/myEvent">My Events </router-link>
        </li>
        <li>
          <router-link to="/categoryView">Categories </router-link>
        </li>
      </ul>
      <div  class="btn">
        <button id="logoutBtn" @click="emitSignout">Sign out</button>
      </div>
    </div>
  </nav>
</template>

<script>
export default {
  emit: ["requestSignout"],
  props: ["userData"],

  methods: {
    emitSignout() {
      this.$emit("requestSignout");
    },
  },
};
</script>

<style scoped>
.container {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background: var(--main-color);
  height: 50px;
  padding: 5px 50px;
  margin-bottom: 50px;
  color: white;
  font-weight: bold;
}
.navbar {
  width: 100%;
  display: flex;
  justify-content: space-between;
}
ul {
  display: flex;
  list-style: none;
}
ul li {
  margin: 0 10px;
  padding: 10px;
}
.navbar ul li a {
  color: white;
  font-weight: bold;
}
.navbar ul li a:hover {
  color: rgb(240, 76, 11);
}
.navbar div {
  width: 25%;
  font-size: 28px;
  align-items: center;
}
.btn {
  text-align: right;
}
#logoutBtn {
  width: 100px;
  background: rgb(255, 102, 0);
  border-radius: 15px;
  border: none;
  padding: 10px;
  color: white;
  font-weight: bold;
  cursor: pointer;
}
#logoutBtn:hover {
  color: rgb(173, 101, 233);
}
#username {
  cursor: pointer;
}
a {
  text-decoration: none;
}
.navbar ul li .router-link-active{
  color: red;
}
</style>
