<template >
  <div class="menu-container">
      <div class="username" v-if="isLogin">
        <p id="username">{{ userData.firstname }}</p>
      </div>
      <ul v-if="isLogin">
          <li >
            <router-link 
            to="" 
            :class="activePage === 'event' ? 'active' : ''" 
            @click="changeActivePage('event')"
            >Event
            </router-link>
          </li>
          <li>
            <router-link 
            to=""
            :class="activePage === 'myEvent' ? 'active' : ''"
            @click="changeActivePage('myEvent')"
            >My Event
            </router-link>
          </li>
          <li>
            <router-link 
            to=""
            :class="activePage === 'category' ? 'active' : ''"
            @click="changeActivePage('category')"
            >Category
            </router-link>
          </li>
      </ul>
      <div v-if="isLogin">
        <button id="logoutBtn" @click="emitSignout">Sign out</button>
      </div>
  </div>
</template>
<script>
export default {
  emit: ['emitSignout', 'emitActivePage'],
  props: ['userData', 'isLogin', 'activePage'],
  data() {
    return {
      
    }
  },
  methods: {
    emitSignout() {
      this.$emit('requestSignout');
    },
    changeActivePage(activePage) {
      if(this.activePage !== activePage)
      this.$emit('changeActive', activePage);
    }
  },
  mounted() {
    if(!this.isLogin) {
      this.$router.push('/signin');
    }
  },
};
</script>

<style>
.menu-container {
  display: flex;
  justify-content: space-between;
  background: #f6ba1f;
  border-bottom:2px solid rgb(240, 76, 11);
  height: 50px;
  padding: 5px 50px;
  margin-bottom: 50px;
}
.menu-container ul {
  display: flex;
  list-style: none;
  justify-content: space-between;
  align-items: center;
}
.menu-container ul li{
  margin: 0 10px;
  padding: 10px;
}
.menu-container ul li a{
    color: white;
    font-weight:bold;
}
.menu-container ul li a:hover{
    color: rgb(240, 76, 11);
}
.menu-container div {
  font-size: 28px;
  display: flex;
  align-items: center;
  color: white;
  font-weight: bold;
}
#logoutBtn {
  width: 100px;
  background: rgb(255, 102, 0);
  border-radius: 15px;
  border: none;
  padding: 10px;
  color: white;
  font-weight: bold;
}
#logoutBtn:hover {
  color: rgb(173, 101, 233);
}
.menu-container a {
  text-decoration: none;
}

/* active menu style */
.menu-container ul li .active {
  color: rgb(255, 102, 0);
}


/* responsive media */
@media screen and (min-width:300px) and (max-width:500px){
  .menu-container{
    height: auto;
  }
  .menu-container ul{
    display: flex;
    flex-direction: column;
  }
  .menu-container ul li a{
    font-size: 10px;
  }
}
</style>