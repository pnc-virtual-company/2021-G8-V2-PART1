<template>
  <div>
    <navbar :userData="userData" @requestSignout="logout"></navbar>
    <router-view
      @register="registerNewUser"
      @signin="login"
      :existedEmailError="existedEmailError"
      :unauthorizedError="unauthorizedError"
      :userDataAppToEvent="userData"
    >
    </router-view>
  </div>
</template>

<script>
import axios from "./axios-http.js";
import Navbar from './components/menu/Narbar.vue';

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
  methods: {
    registerNewUser(newUserData) {
      axios.post('api/signup', newUserData)
      .then(() => {
        this.existedEmailError = '';
        this.errorMessage = '';
        this.unauthorizedError = '';
        this.$router.push('/signin');
      })
      .catch(error => {
        let serverCode = error.response.status;
        if(serverCode === 500) {
          this.existedEmailError = 'Email existed, use another email!'
        }
      })
    },
    login(userData) {
      axios.post('api/signin', userData)
      .then(res => {
        localStorage.setItem('userID', res.data.user.id);
        this.userData = res.data.user;
        this.unauthorizedError = '';
        this.errorMessage = '';
        this.existedEmailError = '';
        this.$router.push('/event');
      })
      .catch(error => {
        let serverCode = error.response.status;
        if(serverCode === 401) {
          this.unauthorizedError = 'Unauthorized! incorrect email or password';
        }
      })
    },
    logout() {
      this.userData = null;
      localStorage.removeItem('userID');
      this.$router.push('/signin');
    },
  },
  mounted() {
    window.onpopstate = () => {
      if (
        localStorage.getItem("userID") !== null &&
        (this.$route.path === "/signin" || this.$route.path === "/")
      ) {
        this.$router.push("/event");
      }
    };
    if(localStorage.userID) {
      axios.get('api/getAUser/' + localStorage.userID)
      .then(res => {
        this.userData = res.data;
      })
    } else {
      this.$router.push('/signin');
    }
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
:root {
  --main-color: #f6ba1f;
}


::-webkit-scrollbar {
  width: 10px;
  border-radius: 15px;
}
  ::-webkit-scrollbar-track {
  background: #f1f1f1; 
  border-radius: 15px;
}
  ::-webkit-scrollbar-thumb {
  background: rgb(182, 182, 182); 
    border-radius:10px;
}
::-webkit-scrollbar-thumb:hover {
  
  background: rgb(153, 153, 153); 
} 
</style>
