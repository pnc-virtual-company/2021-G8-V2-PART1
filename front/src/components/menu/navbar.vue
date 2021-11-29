<template>
  <div class="menu-container">
    <ul>
      <li><router-link to="myevent" id="username">Username</router-link></li>
      <div class="list-menu">
        <li><router-link to="/events">Event</router-link></li>
        <li><router-link to="/myevent">My Event</router-link></li>
        <li><router-link to='/category'>Category</router-link></li>
      </div>
      <li><router-link to="#" id="signout">Sign out</router-link></li>
    </ul>
  </div>
</template>
<script>
export default {};
</script>

<style>
.menu-container {
  background: #f6ba1f;
  height: 50px;
}
.menu-container ul {
  display: flex;
  list-style: none;
  justify-content: space-between;
  padding-top: 25px;
  
}
.list-menu {
  display: flex;
}
ul li a{
    color: white;
    padding: 10px;
    text-decoration: none;
}
ul li a:hover{
    color: rgb(240, 76, 11);
    text-decoration: underline;
    text-decoration-color:white;
    font-weight:lighter;
}


#username{
    font-size: 20px;
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
  ul li a{
    font-size: 10px;
  }
}
</style>