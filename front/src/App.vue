<template>
  <div>
<<<<<<< HEAD
    <navbar v-if="!isLogin"></navbar>
    <router-view
    @register="registerNewUser"
    @signin="login"
    @requestSignout="logout"
    @changeActive="setActivePage"
    :userData="userData"
    :isLogin="isLogin"
    :activePage="activePage"
    :existedEmailError = "existedEmailError"
    :unauthorizedError = "unauthorizedError"
    >
    </router-view>
    <body v-if="isLogin">
      <event v-if="activePage === 'event' || activePage === 'myEvent'"></event>
      <category-view v-if="activePage === 'category'"></category-view>
    </body>
=======
   <category-view :categories='categories' @addCategory='addNewCategory'></category-view>
>>>>>>> f9068204bc8e6ce7ec5e1a8a51f2f2db683139e3
  </div>
</template>

<script>
import axios from 'axios';
const url = "http://127.0.0.1:8000/api/";

export default {
  
  data() {
    return {
<<<<<<< HEAD
      isLogin: 0,
      activePage: 'event',
      userData: {},
      existedEmailError: '',
      unauthorizedError: '',
=======
      categories: [
        {id: 1, name: 'party', created_at: '1/2/2020  2:30pm'},
        {id: 2, name: 'dek', created_at: '1/2/2020  2:30pm'},
        {id: 3, name: 'der', created_at: '1/2/2020  2:30pm'},
        {id: 4, name: 'phek', created_at: '1/2/2020  2:30pm'},
      ],
      messageExist: 'Already Exist!',
    }
  },
  methods: {
    addNewCategory(categoryName){
      let newCategory = {
        name: categoryName
      }
      this.categories.unshift(newCategory);
>>>>>>> f9068204bc8e6ce7ec5e1a8a51f2f2db683139e3
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
      this.activePage = 'event';
      this.eventList = [];
      this.categoryList = [];
      this.$router.push('/signin');
    },
    setActivePage(currentActivePage) {
      this.activePage = currentActivePage;
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
<<<<<<< HEAD

</style>
=======
body{
  scroll-behavior: smooth;
}
</style>
>>>>>>> f9068204bc8e6ce7ec5e1a8a51f2f2db683139e3
