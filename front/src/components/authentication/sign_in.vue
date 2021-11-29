<template>
  <section>
    <div class="header"></div>
    <form @submit.prevent="singIn()">
      <h2>SIGN IN HERE</h2>
      <input type="email" placeholder="Email" v-model="email" />
      <input type="password" placeholder="Password" v-model="password" />
      <router-link to="/signup">Create an account?</router-link>
      <div class="button-container">
        <router-link to="#" id="signin">Sign in</router-link>
      </div>
    </form>
  </section>
</template>

<script>
export default {
  data() {
    return {
      userList: [],
      email: "",
      password: "",
    };
  },
  methods: {},
};
</script>

<style >
form {
  margin: auto;
  width: 300px;
  padding: 30px;
  display: flex;
  flex-direction: column;
  background: #ffffff;
  box-shadow: inset 0px 4px 4px rgba(0, 0, 0, 0.25);
  border-radius: 20px;
  margin-bottom: 50px;
}
form input,
a,
button {
  margin: 10px;
  font-size: 17px;
}
form .button-container {
  width: 100%;
  display: flex;
  justify-content: flex-end;
}
form #signin:hover {
  color: rgb(173, 101, 233);
  border: 2px solid rgb(206, 146, 255);
}
form input {
  background: #fffdfd;
  box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
  border-radius: 5px;
  border: none;
  height: 30px;
  padding: 0px 10px;
}
form h2 {
  text-align: center;
}

a {
  text-decoration: none;
}
#signin {
  border: 1px solid #f6ba1f;
  width: 85px;
  padding: 5px;
  background: #f6ba1f;
  border-radius: 5px;
}
</style>