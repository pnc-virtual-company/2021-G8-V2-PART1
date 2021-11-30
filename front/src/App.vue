<template>
  <div>
    <router-view
    @register="registerNewUser"
    @signin="login"
    @requestSignout="logout"
    :userData="userData"
    :isLogin="isLogin"
    :existedEmailError = "existedEmailError"
    :unauthorizedError = "unauthorizedError"
    >
    </router-view>
  </div>
</template>

<script>
import axios from 'axios';
const url = "http://127.0.0.1:8000/api/";

export default{
  data() {
    return {
      isLogin: 0,
      userData: {},
      existedEmailError: '',
      unauthorizedError: '',
    }
  },
  methods: {
    registerNewUser(newUserData) {
      axios.post(url+'signup', newUserData)
      .then(res => {
        this.existedEmailError = '';
        this.$router.push('/signin');
        this.errorMessage = '';
        console.log(res.data);
      })
      .catch(error => {
        let serverCode = error.response.status;
        if(serverCode === 500) {
          this.existedEmailError = 'Email existed, use another email!'
          this.$router.push('/signup');
        }
      })
    },
    login(userData) {
      axios.post(url+'signin', userData)
      .then(res => {
        this.isLogin = 1;
        this.unauthorizedError = '';
        this.$router.push('/navbar');
        this.userData = res.data.user;
        this.errorMessage = '';
        console.log(this.userData);
      })
      .catch(error => {
        let serverCode = error.response.status;
        if(serverCode === 401) {
          this.unauthorizedError = 'Unauthorized! incorrect email or password';
          this.$router.push('/signin');
        }
      })
    },
    logout() {
      this.isLogin = 0;
      this.$router.push('/signin');
    }
  }
}
</script>

<style>
*{
  padding:0;
  margin: 0;
}
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  color: #2c3e50;
}
</style>
