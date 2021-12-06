<template>
  <div class="card-container">
    <div class="image">
      <img
        src="https://cdn.pixabay.com/photo/2015/06/22/08/40/child-817373__480.jpg"
        alt=""
      />
    </div>
    <div class="infor">
      <div class="text">
        <h1>{{ event.title }}</h1>
        <p>{{ event.description }}</p>
      </div>
      <div class="date">
        <h3>{{ event.date }}</h3>
        <h3>{{ event.time }}</h3>
        <div class="btn">
          <button :class="isJoin ? 'quit' : 'join'" @click="joined">
            <p>{{ isJoin ? "Quit" : "Join" }}</p>
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["event"],
  data() {
    return {
      isJoin: false,
    };
  },
  methods: {
    joined() {
      this.isJoin = !this.isJoin;
    },
  },
};
</script>

<style scoped>
.card-container {
  display: flex;
  width: 100%;
  padding: 10px 0px;
}
.image {
  width: 180px;
  height: 180px;
  position: relative;
  top: 11px;
  left: 140px;
}
.image img {
  width: 100%;
  height: 100%;
  border-radius: 10px;
}
.infor {
  background: rgb(238, 235, 90);
  height: 160px;
  width: 70%;
  display: flex;
  background: #ffffff;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.26);
  border-radius: 10px;
  border: 2px solid rgb(255, 230, 0);
  padding: 20px;
}
.text {
  margin-left: 300px;
}
.btn button {
  margin-top: 15px;
  padding: 5px 15px;
}
.btn button p {
  font-size: 24px;
  margin: 5px 10px;
  color: white;
}
.date {
  padding-left: 200px;
}
.join {
  background: rgb(247, 217, 51);
  border-radius: 10px;
  border: none;
}
.quit {
  background: red;
  border-radius: 10px;
  border: none;
}
</style>