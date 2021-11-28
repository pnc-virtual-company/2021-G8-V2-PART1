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
  padding: 15px;
}
.list-menu {
  display: flex;
}
ul li a{
    color: white;
    padding:0px  10px;
    text-decoration: none;
}
ul li a:hover{
    color: rgb(164, 62, 248);
    text-decoration: underline;
    text-decoration-color:white;
    font-weight:lighter;
}
#signout {
  border: 1px solid #f6ba1f;
  width: 85px;
  padding: 10px;
  background: white;
  border-radius: 5px;
  color:#f6ba1f;
}
#signout:hover {
  color: rgb(173, 101, 233);
  border: 2px solid rgb(197, 175, 248);
  background: #ffda7d;
}
#username{
    font-size: 20px;
}
</style>