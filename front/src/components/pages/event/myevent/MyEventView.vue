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
            <div class="error" v-if="titleError">
              <p v-text="titleError"></p>
            </div>
          </div>
          <div class="description">
            <textarea
              placeholder="Description"
              v-model="description"
            ></textarea>
            <div class="error" v-if="descError">
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
              <button type="button" @click="showCategoryList">
                Choose Category
              </button>
              <p>selected</p>

              <category-city-dialog
                v-if="categoryListDisplayed"
                @closeCategoryList="closeCategoryList"
              >
                <div class="cate-search">
                    <input
                        type="text"
                        class="searchKey"
                        placeholder="search category"
                        v-model="CateKeyWord"
                    />
                    <button type="button" class="clearButton" @click="clearSearch">X</button>
                </div>
                <div class="categoryContainer">
                    <ul>
                        <li v-for="cate of categories" :key="cate.id">{{ cate.name }}</li>
                    </ul>
                </div>
              </category-city-dialog>
            </div>
            <div class="city">
              <button type="button"  @click="showCityList">Choose City</button>
              <p>selected</p>

              <category-city-dialog
                v-if="cityListDisplayed"
                @closeCategoryList="closeCategoryList"
              >
                <div class="cate-search">
                    <input
                        type="text"
                        class="searchKey"
                        placeholder="search city"
                        v-model="cityKeyWord"
                    />
                    <button type="button" class="clearButton" @click="clearSearch">X</button>
                </div>
                <div class="categoryContainer">
                    <ul>
                        <li v-for="cate of categories" :key="cate.id">{{ cate.name }}</li>
                    </ul>
                </div>
              </category-city-dialog>
            </div>
          </div>
        </div>
        <div class="right-side">
          <input type="file" />
          <img src="../../../../assets/empty.jpg" alt="EMPTY PICTURE" />
        </div>
      </div>

      <template #actions>
        <base-button
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
// import CategoryCityDialog from "../../../UI/CategoryCityDialog.vue";

import axios from 'axios';
export default {
  components: { MyEventCard, AddSearch  },
  data() {
    return {
        dialogDisplayed: false,
        categoryListDisplayed: false,
        cityListDisplayed: false,
        dialogMode: "create",
        eventKeySearch: "",
        cateKeySearch: "",
        cityKeySearch: "",
        eventToEdit: null,
        titleError: "title is required",
        descError: "Description is required",
        categories: [],
        myEvents: [
            {
                id: 1,
                title: "CSS",
                description: "Alien is a 1979 science fiction horror film directed by Ridley Scott and written by Dan O'Bannon.",
                category: "Party",
                city: "Phnom Penh, Cambodia",
                members: "6",
                startDateTime: "10/20/2021 10:00AM",
                endDateTime: "10/20/2021 10:00AM",
            },
            {
                id: 2,
                title: "HTML",
                description: "Alien is a 1979 science fiction horror film directed by Ridley Scott and written by Dan O'Bannon.",
                category: "Party",
                city: "Phnom Penh, Cambodia",
                members: "6",
                startDateTime: "10/20/2021 10:00AM",
                endDateTime: "10/20/2021 10:00AM",
            },
            {
                id: 3,
                title: "JS",
                description: "JAlien is a 1979 science fiction horror film directed by Ridley Scott and written by Dan O'Bannon.",
                category: "Party",
                city: "Phnom Penh, Cambodia",
                members: "6",
                startDateTime: "10/20/2021 10:00AM",
                endDateTime: "10/20/2021 10:00AM",
            },
        ],
    };
  },
  watch: {
      cateKeySearch: function(key) {
          console.log(key);
            if(key === '') {
                axios.get('http://127.0.0.1:8000/api/categories').then(res => {
                    this.categories = res.data.data;
                });
            } else {
                axios.get('http://127.0.0.1:8000/api/categories' + '/search/' + key).then(res => {
                    this.categories = res.data;
                })
            }
        }
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
    getCategoryData(data) {
      this.categoryData = data;
    },
    createMyNewEvent(newEvent) {
      this.myEventData.unshift(newEvent);
      console.log(this.myEventData);
    },
    showAddForm() {
      this.dialogMode = "create";
      this.dialogDisplayed = true;
    },
    closeDialog() {
      this.dialogDisplayed = false;
      this.categoryName = "";
    },
    showCategoryList() {
      this.categoryListDisplayed = true;
    },
    showCityList() {
      this.cityListDisplayed = true;
    },
    closeCategoryList() {
        this.categoryListDisplayed = false;
        this.cityListDisplayed = false;
    },
  },
  mounted() {
      axios.get("http://127.0.0.1:8000/api/categories")
      .then((res) => {
        this.categories = res.data.data;
      })
  },
};
</script>

<style scoped>
.categoryContainer {
  overflow-y: scroll;
  height: 45vh;
}
.categoryContainer input {
  width: 90%;
}
.categoryContainer ul {
  list-style: none;
}
.categoryContainer ul li {
  margin: 5px;
}

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

/* categorylist style */
.clearButton:hover {
  color: rgb(173, 101, 233);
}
.cate-search {
  width: 100%;
  display: flex;
  margin-bottom: 5px;
}

.searchKey {
  width: 65%;
  border: 2px solid var(--main-color);
  border-right: none;
  padding: 0 15px;
  border-radius: 15px 0 0 15px;
  outline: none;
}
.cate-search .searchKey:focus {
    border: 2px solid var(--main-color);
    border-right: none;
}
.clearButton {
  margin: 0;
  width: 45px;
  border: 1px solid var(--main-color);
  background: var(--main-color);
  color: #fff;
  border-radius: 0 15px 15px 0;
  cursor: pointer;
  font-size: 24px;
}
.categoryContainer {
    margin-top: 5px;
}
.categoryContainer ul li {
    text-align: left;
    cursor: pointer;
}
</style>
