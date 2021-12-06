<template>
  <section>
    <add-search @showForm="showAddForm" @search="search"></add-search>
    <base-dialog
      v-if="dialogDisplayed"
      :title="dialogTitle"
      :mode="dialogMode"
      @close="closeDialog"
    >
      <div class="eventForm">
        <div class="left-side">
            <div class="title">
                <input type="text" placeholder="Title" v-model="title" />
                <div class="error"
                    v-if="titleError">
                    <p v-text="titleError"></p>
                </div>
            </div>
            <div class="description">
                <textarea
                    placeholder="Description"
                    v-model="description"
                ></textarea>
                <div class="error"
                    v-if="descError">
                    <p v-text="descError"></p>
                </div>
            </div>
        </div>
        <div class="middle">
          <div class="date">
            <label for>Start Date</label>
            <input
              type="date"
              placeholder="start date"
              v-model="startDateTime"
            />
          </div>
          <div class="time">
                <label for>Start Time</label>
                <input type="time" />
          </div>
          <div class="date">
            <label for>End Date</label>
            <input type="date" v-model="endDateTime" />
          </div>
          <div class="time">
                <label for>End Time</label>
                <input type="time" />
          </div>
          <div class="city-cate">
              <div class="category">
                <button type="button">Choose Category</button>
                <p>selected</p>
              </div>
              <div class="city">
                <button type="button">Choose City</button>
                <p>selected</p>
              </div>
          </div>
        </div>
        <div class="right-side">
            <input type="file">
            <img src="../../../../assets/empty.jpg" alt="EMPTY PICTURE"/>
        </div>
      </div>

      <template #actions>
        <base-button
          @click="onConfirm"
          :class="isValidated ? 'buttonActive' : 'buttonInactive'"
          >{{ dialogButtton }}
        </base-button>
      </template>
    </base-dialog>
    <my-event-card
      v-for="myEvent of myEvents"
      :key="myEvent.id"
      :myEvent="myEvent"
    ></my-event-card>
  </section>
</template>

<script>
import MyEventCard from "./MyEventCard.vue";
import AddSearch from "./AddSearch.vue";
export default {
  components: { MyEventCard, AddSearch },
  data() {
    return {
      dialogMode: "create",
      dialogDisplayed: true,
      eventKeySearch: "",
      eventToEdit: null,
      titleError: 'title is required',
      descError: 'Description is required',
      myEvents: [
        {
          id: 1,
          title: "CSS",
          description: "css course",
          startDateTime: "10/20/2021 10:00AM",
          endDateTime: "10/20/2021 10:00AM",
        },
        {
          id: 2,
          title: "HTML",
          description: "HTML course",
          startDateTime: "10/20/2021 10:00AM",
          endDateTime: "10/20/2021 10:00AM",
        },
        {
          id: 3,
          title: "JS",
          description: "JS course",
          startDateTime: "10/20/2021 10:00AM",
          endDateTime: "10/20/2021 10:00AM",
        },
      ],
    };
  },
  computed: {
    dialogTitle() {
      return this.dialogMode === "edit" ? "EDIT MY EVENT" : "CREATE MY EVENT";
    },
    dialogButtton() {
      return this.dialogMode === "edit" ? "EDIT" : "CREATE";
    },
  },
  methods: {
    createMyNewEvent(newEvent) {
      this.myEventData.unshift(newEvent);
      console.log(this.myEventData);
    },
    showAddForm() {
        this.dialogMode = 'create';
        this.dialogDisplayed = true;
    },
    closeDialog() {
        this.dialogDisplayed = false;
        this.categoryName = '';
    },
  },
};
</script>

<style scoped>
.eventForm {
    width: 1000px;
    display: flex;
    justify-content: space-between;
    padding: 20px;
}
.left-side,
.right-side {
    width: 33%;
    text-align: left;
}
.middle {
    width: 30%;
    text-align: left;
}
.title input,
.description textarea {
    width: 100%;
    margin-bottom: 10px;
    padding: 15px;
    font-size: 17px;
    cursor: pointer;
    box-sizing: border-box;
    box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
    border-radius: 5px;
    border: 1px solid white;
    outline: none;
}
textarea {
    height: 200px;
    resize: none;
}
textarea::-webkit-scrollbar {
   display: none;
}
.city-cate {
    width: 100%;
    display: flex;
    justify-content: space-between;
}
.city-cate button {
    width: 100%;
    padding: 5px 10px;
    margin-bottom: 10px;
    text-align: center;
    background: var(--main-color);
    border: none;
    outline: none;
    border-radius: 15px;
    cursor: pointer;
    color: white;
}
.city-cate button:hover {
    color: rgb(173, 101, 233);
}
.city,
.category {
    width: 45%;
    display: flex;
    justify-content: space-around;
    flex-wrap: wrap;
}
.city-cate p {
    width: 100%;
    text-align: center;
}
.date,
.time {
    display: flex;
    justify-content: space-between;
}
.date label,
.time label {
    width: 35%;
}
.date input,
.time input {
    width: 60%;
    padding: 5px 10px;
    text-align: left;
    margin-bottom: 15px;
    outline: none;
    border: 1px solid white;
    border-radius: 15px;
    box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
}

.right-side input {
    margin-bottom: 15px;
    padding: 15px;
    font-size: 17px;
    width: 100%;
    cursor: pointer;
    box-sizing: border-box;
    box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25);
    border-radius: 5px;
    border: 1px solid white;
    outline: none;
}
img {
    width: 100%;
    height: 225px;
}



.buttonActive button {
  background: var(--main-color);
}
.buttonInactive button {
  background: grey;
}
.buttonActive:hover {
  color: rgb(173, 101, 233);
  border: 1px solid rgb(173, 101, 233);
}
input:focus,
textarea:focus {
  border: 1px solid var(--main-color);
}

.error {
  color: rgb(255, 97, 97);
  margin: 5px 0;
  font-size: 12px;
}

</style>
