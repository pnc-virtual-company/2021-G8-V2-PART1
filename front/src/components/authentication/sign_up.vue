<template>
  <section>
    <div class="header"></div>
    <form @submit.prevent="singUp()">
      <h2>REGISTER HERE</h2>
      <div class="username">
        <input type="text" placeholder="First Name" v-model="firstName" />
        <input type="text" placeholder="Last Name" v-model="lastName" />
      </div>
      <input type="email" placeholder="Email" v-model="email" />
      <input type="password" placeholder="Password" v-model="password" />
      <input
        type="password"
        placeholder="Confirm Password"
        v-model="confirmPassword"
      />
      <router-link to="signin">Have an account?</router-link>
      <div class="error" v-if="errorMessage">
        <p v-text="errorMessage"></p>
      </div>
      <div class="button-container">
        <button type="button" id="register" @click="register">Register</button>
      </div>
    </form>
  </section>
</template>

<script>
import axios from 'axios';
const url = "http://127.0.0.1:8000/api/signup";
export default {
  data() {
    return {
      firstName: "",
      lastName: "",
      email: "",
      password: "",
      confirmPassword: "",
      errorMessage: ""
    };
  },
  methods: {
    register() {
      let newUserData = {
        firstname: this.firstName,
        lastname: this.lastName,
        email: this.email,
        password: this.password,
        password_confirmation: this.confirmPassword
      };

      axios.post(url, newUserData)
      .then(res => {
        this.$router.push('/signin');
        this.errorMessage = '';
        console.log(res.data);
      })
      .catch(error => {
        let statusCode = error.response.status;
        if(statusCode === 422) {
          this.errorMessage = 'Invalid data, please try again';
        }
      })
    }
  },
};
</script>

<style >
.header {
  height: 50px;
  background: #f6ba1f;
  margin-bottom: 50px;
}
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
form .button-container {
  width: 100%;
  display: flex;
  justify-content: flex-end;
  text-align: center;
}
form button {
  width: 90px;
  height: 29px;
  color: white;
  border: none;
  background: #f6ba1f;
  border-radius: 15px;
}
form #register:hover {
  color: rgb(173, 101, 233);
  border: 2px solid rgb(197, 175, 248);
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
#register {
  border: 1px solid #f6ba1f;
  width: 85px;
  padding: 5px;
  background: #f6ba1f;
  border-radius: 5px;
}
.error {
  text-align: center;
  color: red;
}
</style>