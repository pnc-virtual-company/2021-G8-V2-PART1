<template>
  <div>
    <navbar :userData="userData" @requestSignout="logout"></navbar>
    <router-view
      @register="registerNewUser"
      @signin="login"
      :userData="userData"
      :existedEmailError="existedEmailError"
      :unauthorizedError="unauthorizedError"
    >
    </router-view>
  </div>
</template>

<script>


import Navbar from './components/menu/Navbar.vue';
import axios from 'axios';
const url = "http://127.0.0.1:8000/api/";

export default {
  components: {
    'navbar': Navbar,
  },
  data() {
    return {
      userData: null,

      existedEmailError: '',
      unauthorizedError: '',
    }
  },

  computed: {
    isLogin() {
      return this.userData !== null;
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
        this.userData = res.data.user;
        this.unauthorizedError = '';
        this.errorMessage = '';
        this.$router.push('/event');
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
      this.userData = null;
      this.$router.push('/signin');
    },
  }
}
</script>

<style>
* {
  padding: 0;
  margin: 0;
}
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  color: #2c3e50;
}
</style>
