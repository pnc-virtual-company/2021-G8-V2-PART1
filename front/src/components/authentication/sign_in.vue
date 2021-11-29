<template>
  <section>
    <div class="header"></div>
    <form>
      <h2>SIGN IN HERE</h2>
      <input type="email" placeholder="Email" v-model="email" />
      <input type="password" placeholder="Password" v-model="password" />
      <router-link to="/signup">Create an account?</router-link>
      <div class="error" v-if="errorMessage">
        <p v-text="errorMessage"></p>
      </div>
       <div class="button-container">
        <button type="button" @click="signIn">Sign in</button>
      </div>
    </form>
  </section>
</template>

<script>
import axios from 'axios';
const url = "http://127.0.0.1:8000/api/signin";
export default {
  data() {
    return {
      userData: {},
      email: "",
      password: "",
      errorMessage: "",
    };
  },
  methods: {
    signIn() {
      let userData = {
        email: this.email,
        password: this.password,
      };

      axios.post(url, userData)
      .then(res => {
        this.userData = res.data.user;
        this.$router.push('/main');
        this.errorMessage = '';
        console.log(this.userData);
      })
      .catch(error => {
        let statusCode = error.response.status;
        if(statusCode === 401) {
          this.errorMessage = 'Invalid data, please try again';
        }
      })
    }
  },
  provide() {
    return {userData: this.userData};
  }
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
  cursor: pointer;
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

.error {
  text-align: center;
  color: red;
}
</style>