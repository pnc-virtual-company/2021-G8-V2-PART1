<template>
  <section>
    <div class="eventForm">
      <div class="header">
        <h3>Add Event</h3>
      </div>
      <div class="category">
        <label for>Category:</label>
        <select name id>
          <option value>Party</option>
          <option value>Party</option>
          <option value>Party</option>
        </select>
      </div>
      <div class="title">
        <input type="text" placeholder="Title" v-model="title" />
      </div>
      <div class="description">
        <textarea name id placeholder="Description" v-model="description"></textarea>
      </div>
      <div class="city">
        <label for>City:</label>
        <select name id>
          <option value>PhnomPenh</option>
          <option value>PhnomPenh</option>
          <option value>PhnomPenh</option>
        </select>
      </div>
      <div class="date">
        <div class="startDate">
          <label for>Start Date</label>
          <input type="date" placeholder="start date" v-model="startDateTime" />
          <label for>Start Time</label>
          <input type="time"/>
        </div>
        <div class="endDate">
          <label for>End Date</label>
          <input type="date" v-model="endDateTime"/>
          <label for>End Time</label>
          <input type="time" />
        </div>
      </div>
      <div class="btnAction">
        <button id="cancel">CANCEL</button>
        <button id="create" @click="createEvent">CREATE</button>
        <button id="update">UPDATE</button>
      </div>
    </div>
  </section>
</template>
<script>
export default {
  data() {
    return {
      myEventData: [],
      title: "",
      decription: "",
      startDateTime: "",
      endDateTime: "",
    };
  },
  methods: {
    createEvent() {
      if(this.title !== '' 
      && this.description !== '' 
      && this.startDateTime !== '' 
      && this.endDateTime) {
      let newEvent = {
        title: this.title,
        description: this.description,
        startDateTime: this.startDateTime,
        endDateTime: this.endDateTime,
      };
       this.$emit('addNewMyEvent',newEvent);
    }
     
    },
  },
};
</script>

<style scoped>
.eventForm {
  width: 35%;
  height: 75vh;
  background-color: rgb(255, 255, 255);
  margin: auto;
  padding: 20px;
  box-shadow: inset 0px 4px 4px rgba(0, 0, 0, 0.25);
  border-radius: 20px;
}
.eventForm div {
  width: 100%;
}
.header {
  text-align: center;
}
.title input,
.description textarea {
  width: 100%;
  padding: 0;
  margin: 0;
  border: none;
}
.city {
  padding: 0;
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.city label {
  width: 10%;
}
.city select {
  width: 85%;
}
.date {
  display: flex;
  justify-content: center;
  padding: 0x;
  margin: 10px;
}
.startDate {
  margin-right: 10px;
}
.startDate input,
.endDate input {
  width: 95%;
  border: none;
  padding-left: 10px;
}
.category {
  padding: 0;
  height: 50px;
  display: flex;
  align-items: center;
  justify-content: space-between;
}
.btnAction {
  display: flex;
  justify-content: flex-end;
}
.btnAction button {
  margin: 10px;
  padding: 6px;
  border-radius: 10px;
  border: none;
  color: white;
}
.btnAction #cancel {
  background-color: red;
}
.btnAction #create {
  background-color: rgb(63, 236, 63);
}
.btnAction #update {
  background-color: blue;
}
.category label {
  width: 30%;
}
.category select {
  width: 70%;
}

.title input,
.description textarea,
.city select,
.startDate input,
.endDate input,
.category select {
  height: 35px;
  background: #fffdfd;
  box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
  border-radius: 5px;
}
::placeholder {
  padding: 5px;
  margin: 0;
  font-size: 1.5em;
}
.title,
.description,
.city,
.date,
.category {
  margin: 10px 0;
}
</style>