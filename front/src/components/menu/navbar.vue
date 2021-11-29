<template>
  <div class="menu-container">
    <div class="username">
      <p id="username">Username</p>
    </div>
    <ul>
        <li><router-link to="/events">Event</router-link></li>
        <li><router-link to="/myevent">My Event</router-link></li>
        <li><router-link to='/category'>Category</router-link></li>
    </ul>
    <button id="logoutBtn"><router-link to="" id="signout">Sign out</router-link></button>
  </div>
</template>
<script>
export default {};
</script>

<style>
.menu-container {
  display: flex;
  justify-content: space-between;
  background: #f6ba1f;
  height: 50px;
  padding: 5px 50px;
}
.menu-container ul {
  display: flex;
  list-style: none;
  justify-content: space-between;
  align-items: center;
}
ul li a{
    color: white;
    font-weight:bold;
}
ul li a:hover{
    color: rgb(240, 76, 11);
}
.username {
  font-size: 28px;
  display: flex;
  align-items: center;
  color: white;
  font-weight: bold;
}
#logoutBtn {
  background: rgb(255, 102, 0);
  border-radius: 50px;
  border: none;
}
#logoutBtn a {
  color: white;
  font-weight: bold;
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