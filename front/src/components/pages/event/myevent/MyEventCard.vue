<template>
  <div>
    <div class="card-container">
      <div class="image">
        <img src="https://static.bangkokpost.com/media/content/20191004/c1_1764659_191004103525.jpg" alt />
      </div>
      <div class="infor">
        <div class="text">
          <h1>{{myEvent.title}}</h1>
          <p>{{myEvent.description}}</p>
        </div>
        <div class="date">
          <h3>{{myEvent.startDateTime}}</h3>
          <h3>{{myEvent.endDateTime}}</h3>
          <div class="btn-action">
            <div class="btn-eventme">
              <button class="edit">Edit</button>
              <button class="delete">Delete</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["myEvent"],
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
  margin-top: 4%;
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
.btn-action {
  display: flex;
}

.date {
  padding-left: 200px;
}

.btn-eventme {
  display: flex;
  margin-top: 35%;
}
.edit {
  background: rgb(0, 60, 255);
  border-radius: 10px;
  border: none;
  font-size: 24px;
  margin: 0px 10px 0px 10px;
  margin-top: 15px;
  padding: 5px 15px;
  color: white;
}
.delete {
  background: rgb(252, 4, 4);
  border-radius: 10px;
  border: none;
  font-size: 24px;
  margin-top: 15px;
  padding: 5px 15px;
  color: white;
}
</style>