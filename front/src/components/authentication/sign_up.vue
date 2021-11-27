<template>
  <section>
    <div class="formcontain"></div>
    <form @submit.prevent="singUp()">
      <h2>REGISTER HERE</h2>
      <div class="username">
        <input type="text" placeholder="First Name" v-model="firstName"/>
        <input type="text" placeholder="Last Name" v-model="lastName"/>
      </div>
      <input type="email" placeholder="Email" v-model="email"/>
      <input type="password" placeholder="Password" v-model="password"/>
      <input type="password" placeholder="Confirm Password" v-model="confirmPassword"/>
      <router-link to="signin">Have an account?</router-link>
      <div class="button-container">
        <router-link to="/signin">Register</router-link>
      </div>
    </form>
  </section>
</template>

<script>
export default {
  data(){
    return{
      userList: [],
      firstName:'',
      lastName:'',
      email:'',
      password:'',
      confirmPassword:'',
    }
  },
  methods: {
    
  },
};
</script>

<style >
.formcontain {
  height: 50px;
  background: #f6ba1f;
  margin-bottom: 30px;
}
form {
  margin: auto;
  width:300px;
  padding: 30px;
  display: flex;
  flex-direction: column;
  background: #ffffff;
  box-shadow: inset 0px 4px 4px rgba(0, 0, 0, 0.25);
  border-radius: 20px;
  margin-bottom: 50px;
}
.username {
  display: flex;
  justify-content: space-between;
}
.username input {
  width: 45%;
}
form input,
a,
button {
  margin: 10px;
  font-size: 17px;
}
/* display:flex; justify-content:flex-end; width:100%; padding:0; */
form .button-container {
  width: 100%;
  display: flex;
  justify-content: flex-end;
}
form button {
  width: 90px;
  height: 29px;
  color: white;
  border: none;
  background: #f6ba1f;
  border-radius: 5px;
}
form button:hover {
  color: rgb(173, 101, 233);
  border: 2px solid rgb(197, 175, 248);
}
form input {
  background: #fffdfd;
  box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
  border-radius: 5px;
  border: none;
  height: 30px;
  padding:0px 10px;
}
form h2 {
  text-align: center;
}

a {
  text-decoration: none;
}
</style>