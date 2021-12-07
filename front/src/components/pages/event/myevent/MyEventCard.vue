<template>
  <section>
    <div class="card-container">
      <div class="left-side">
        <img src="https://static.bangkokpost.com/media/content/20191004/c1_1764659_191004103525.jpg"/>
      </div>
      <div class="right-side">
          <div class="right-top">
            <h1>{{myEvent.title}}</h1>
            <div class="date">
              <p>Date: {{myEvent.start_date}}</p>
              <p>- {{myEvent.end_date}}</p>
            </div>
            <p>{{myEvent.description}}</p>
          </div>
          <div class="right-bottom">
            <div class="bottom-info">
              <div class="bottom-left">
                <p>{{myEvent.category.name}} at {{myEvent.city}}</p>
                <p>{{myEvent.members}} people joined</p>
              </div>
              <div class="bottom-right">
                <button class="edit">Edit</button>
                <button class="delete">Remove</button>
              </div>
            </div>
          </div>
      </div>
    </div>
  </section>
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
  justify-content: space-between;
  align-items: center;
  margin: 20px auto;
  padding: 10px;
  border: 1px solid #ccc;
  border-radius: 12px;
  width: 80%;
  border: 1px solid #ccc;
  box-shadow: 0 2px 8px rgba(0, 0, 0, 0.26);
}
.left-side {
  width: 25%;
  height: 180px;
}
.right-side {
  width: 75%;
  height: 180px;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}
img {
  width: 90%;
  height: 100%;
  border-radius: 10px;
}
.date {
  display: flex;
  margin-bottom: 10px;
}
.bottom-info {
  display: flex;
  justify-content: space-between;
  align-items: flex-end;
}
.bottom-left,
.date {
  font-size: 14px;
}
.date p {
  margin-right: 10px;
}

button {
  text-decoration: none;
  padding: 5px 12px;
  border-radius: 50px;
  border: none;
  cursor: pointer;
}
.edit:hover,
.delete:hover {
  color: rgb(173, 101, 233);
}
.edit {
  background-color: rgb(34, 152, 207);
  color: white;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.26);
  margin-right: 8px;
}

.delete {
  background-color: rgb(255, 50, 50);
  color: white;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.26);
}
</style>