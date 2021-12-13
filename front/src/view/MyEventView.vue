<template>
  <section>
    <add-search @showForm="showAddForm" @search="search"></add-search>
    <div v-if="isEmpty">
      <base-dialog
        v-if="dialogDisplayed"
        :title="dialogTitle"
        :mode="dialogMode"
        @close="closeDialog"
      >
        <!-- event from  -->
        <div class="eventForm" v-if="this.dialogMode !== 'delete'">
          <div class="title-date">
            <label for="title">Event Title</label>
            <input type="text" placeholder="Title" v-model="myEventTitle" />
            <div class="error" v-if="myEventTitleError">
              <p v-text="myEventTitleError"></p>
            </div>
            <div class="start-date">
              <label for>Start Date</label>
              <input type="datetime-local" v-model="startDateTime" />
              <div class="error" v-if="startDateError">
                <p v-text="startDateError"></p>
              </div>
            </div>
            <div class="end-date">
              <label for>End Date</label>
              <input type="datetime-local" v-model="endDate" />
              <div class="error" v-if="endDateError">
                <p v-text="endDateError"></p>
              </div>
            </div>
          </div>
          <div class="city-cate-container">
            <!-- ===============CITY & CATEGORY RESULT================ -->

            <!-- ===================CATEGORY AREA================== -->

            <div class="category-main-container">
              <!-- category action -->
              <label v-if="!isSelectedCate" for="category">Category</label>
              <label v-else for="category">Category: {{ category.name }}</label>
              <div class="category-container-actions">
                <input
                  type="text"
                  class="searchKey"
                  placeholder="Search category"
                  v-model="cateKeySearch"
                />
                <button
                  type="button"
                  class="btnOpenCategoryList"
                  @click="showCategoryList"
                  v-if="!categoryListDisplayed"
                >
                  ▽
                </button>
                <button
                  v-else
                  type="button"
                  class="btnCloseCategoryList"
                  @click="closeCategoryList"
                >
                  △
                </button>
              </div>
              <!-- category list  -->
              <div v-if="categoryListDisplayed" class="category-list">
                <ul>
                  <li
                    v-for="cate of this.categories"
                    :key="cate.id"
                    @click="setCate(cate.id, cate.name)"
                  >
                    {{ cate.name }}
                  </li>
                </ul>
              </div>
            </div>
            <!-- CITY AREA -->

            <div class="city-main-container">
              <label v-if="!isSelectedCity" for="city">City</label>
              <label v-else for="city">City: {{ city }}</label>
              <!-- city action -->
              <div class="city-container-actions">
                <input
                  type="text"
                  class="searchKey"
                  placeholder="Search city"
                  v-model="cityKeySearch"
                />
                <button
                  type="button"
                  class="btnOpenCityList"
                  v-if="!cityListDisplayed"
                  @click="showCityList"
                >
                  ▽
                </button>
                <button
                  v-else
                  type="button"
                  class="btnCloseCityList"
                  @click="closCityList"
                >
                  △
                </button>
              </div>
              <!-- city list  -->
              <div v-if="cityListDisplayed" class="city-list">
                <ul>
                  <li
                    v-for="(countryCity, index) of countriesCities"
                    :key="index"
                    @click="setCity(countryCity.city, countryCity.country)"
                  >
                    {{ countryCity.city }}
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <!-- ============================================= -->
          <div class="more">
            <a href="#description"
              ><p @click="showMoreChoice" id="see-more" v-if="!isShowMore">
                See more..
              </p></a
            >
          </div>

          <div id="description" class="showMoreInfo" v-if="isShowMore">
            <div class="description">
              <textarea
                placeholder="Description"
                v-model="description"
              ></textarea>
              <div class="des">
                <p>Description (optional)</p>
              </div>
            </div>
            <div class="right-side">
              <input type="file" @change="getImage" />
              <img
                v-if="!this.imageTitle"
                src="https://st4.depositphotos.com/14953852/24787/v/600/depositphotos_247872612-stock-illustration-no-image-available-icon-vector.jpg "
                alt="EMPTY PICTURE"
              />
              <img v-else :src="imageTitle" alt="EMPTY PICTURE" />
            </div>
            <a href="#see-more">
              <p id="see-less" @click="showLessChoice">See less..</p>
            </a>
          </div>
          <div class="right-side">
            <input type="file" @change="getImage" />
            <img v-if="!this.imageTitle" src="" alt="EMPTY PICTURE" />
            <img v-else :src="imageTitle" alt="EMPTY PICTURE" />
          </div>
          <a href="#see-more">
            <p id="see-less" @click="showLessChoice">See less..</p>
          </a>
        </div>

        <!-- event from  -->

        <!---------------------- myevent card and from -->
        <template #actions>
          <base-button
            :class="isValidated ? 'buttonActive' : 'buttonInactive'"
            @click="onConfirm"
            >{{ dialogButtton }}
          </base-button>
        </template>
      </base-dialog>
      <my-event-card
        v-for="(event, name, index) in myEvents"
        :key="name"
        :id="index"
        :myEvent="event"
        :buttonMode="onMyEventMode"
        @deleteMyEvent="showFormConfirmDelete"
        @updateMyEvent="showFormMyEventUpdate"
      ></my-event-card>
      <!------------------------- myevent card and from -->
    </div>
    <div class="emptyMyevent" v-else>
      <h1>NO MY EVENT YET!!</h1>
    </div>
  </section>
</template>

<script>
// const url = 'http://127.0.0.1:8000/storage/images/';

import MyEventCard from "../components/pages/event/myevent/MyEventCard.vue";
import AddSearch from "../components/pages/event/myevent/AddSearch.vue";
import BaseButton from "../components/UI/BaseButton.vue";

import axios from "../axios-http.js";
import moment from "moment";
export default {
  components: { MyEventCard, AddSearch, BaseButton },
  data() {
    return {
      imageForUpdate: "",
      myEvent: "",
      myEventTitle: "",
      startDateTime: "",
      endDate: "",
      description: "",
      category: "",
      city: "",
      imageTitle: "",
      file: null,

      myEventTitleError: "",
      startDateError: "",
      endDateError: "",
      isEmpty: true,

      onMyEventMode: "myEvent",
      isShowMore: false,
      dialogDisplayed: false,
      categoryListDisplayed: false,
      cityListDisplayed: false,
      dialogMode: "create",
      eventKeySearch: "",
      cateKeySearch: "",
      cityKeySearch: "",
      eventToEdit: null,

      countriesCitiesInitial: [],
      countriesCities: [],
      categories: [],
      myEvents: [],
      isSelectedCate: false,
      isSelectedCity: false,
    };
  },
  watch: {
    cateKeySearch: function (key) {
      if (key === "") {
        if (this.isSelectedCate) {
          this.categoryListDisplayed = false;
        } else {
          this.categoryListDisplayed = true;
        }
        axios.get("api/categories").then((res) => {
          this.categories = res.data.data;
        });
      } else {
        axios.get("api/categories" + "/search/" + key).then((res) => {
          this.categories = res.data;
          this.categoryListDisplayed = true;
          this.isSelectedCate = false;
        });
      }
    },
    cityKeySearch: function (key) {
      if (key === "") {
        this.countriesCities = this.countriesCitiesInitial;
        if (this.isSelectedCity) {
          this.cityListDisplayed = !this.isSelectedCity;
        }
      } else {
        this.countriesCities = [];
        for (let countryCity of this.countriesCitiesInitial) {
          if (
            countryCity.city.toLowerCase().includes(key.toLowerCase()) ||
            countryCity.country.toLowerCase().includes(key.toLowerCase())
          ) {
            this.countriesCities.push(countryCity);
            this.cityListDisplayed = true;
            this.isSelectedCity = false;
          }
        }
      }
    },
    myEventTitle: function (newValue) {
      if (newValue === "") {
        this.myEventTitleError = "title is required";
      } else {
        this.myEventTitleError = "";
      }
    },
    startDateTime: function (newValue) {
      let currentDate = new Date();
      if (moment(newValue).isBefore(currentDate)) {
        this.startDateError = "start datetime must be after now";
      } else {
        this.startDateError = "";
        if (this.endDate && !moment(newValue).isBefore(this.endDate)) {
          this.endDateError = "end datetime must be after start datetime";
        } else {
          this.endDateError = "";
        }
      }
    },
    endDate: function (newValue) {
      if (
        this.startDateTime &&
        !moment(this.startDateTime).isBefore(newValue)
      ) {
        this.endDateError = "end datetime must be after start datetime";
      } else {
        this.endDateError = "";
      }
    },
  },
  computed: {
    dialogTitle() {
      // return this.dialogMode === "edit" ? "EDIT MY EVENT" : "CREATE MY EVENT";
      let message = "";
      if (this.dialogMode === "edit") {
        message = "EDIT MY EVENT";
      } else if (this.dialogMode === "create") {
        message = "CREATE MY EVENT";
      } else {
        message = "Are you sure you want to delete this Event?";
      }
      return message;
    },
    dialogButtton() {
      let message = "";
      if (this.dialogMode === "edit") {
        message = "EDIT";
      } else if (this.dialogMode === "create") {
        message = "CREATE";
      } else {
        message = "DELETE";
      }
      return message;
    },
    isValidated() {
      return (
        (this.myEventTitleError === "" &&
          this.startDateError === "" &&
          this.endDateError === "" &&
          this.myEventTitle !== "" &&
          (this.startDateTime !== "" || this.dialogMode === "edit") &&
          (this.endDate !== "" || this.dialogMode === "edit") &&
          this.category !== "" &&
          this.city !== "") ||
        this.dialogMode === "delete"
      );
    },
  },
  methods: {
    getCategoryData(data) {
      this.categoryData = data;
    },
    showAddForm() {
      this.dialogMode = "create";
      this.dialogDisplayed = true;
      this.myEventTitle = "";
      this.startDateTime = "";
      this.end_date = "";
      this.city = "";
      this.description = "";
      this.imageTitle = "";
      this.category = "";
      this.isSelectedCity = false;
      this.isSelectedCate = false;
      this.endDateError = "";
      this.myEventTitleError = "";
      this.isEmpty = true;
    },
    closeDialog() {
      this.dialogDisplayed = false;
      this.categoryName = "";
      this.myEventTitle = "";
      this.startDateTime = "";
      this.endDate = "";
      this.description = "";
      this.isShowMore = false;
      this.isEmpty = true;
    },
    showCategoryList() {
      this.categoryListDisplayed = true;
      axios.get("api/categories").then((res) => {
        this.categories = res.data.data;
      });
    },
    showCityList() {
      this.cityListDisplayed = true;
    },
    closeCategoryList() {
      this.categoryListDisplayed = false;
      this.cateKeySearch = "";
      if (this.category !== "") {
        this.isSelectedCate = true;
      } else {
        this.isSelectedCate = false;
      }
    },
    closCityList() {
      this.cityListDisplayed = false;
      this.cityKeySearch = "";
      if (this.city !== "") {
        this.isSelectedCity = true;
      } else {
        this.isSelectedCity = false;
      }
    },
    showMoreChoice() {
      this.isShowMore = true;
    },
    showLessChoice() {
      this.isShowMore = false;
    },

    setCity(city, country) {
      this.city = city + ", " + country;
      this.cityKeySearch = "";
      this.isSelectedCity = true;
      this.closCityList();
    },
    setCate(id, name) {
      this.category = {
        id: id,
        name: name,
      };
      this.cateKeySearch = "";
      this.isSelectedCate = true;
      this.closeCategoryList();
    },
    //===========================get image
    getImage(e) {
      this.file = e.target.files[0];
      this.imageTitle = URL.createObjectURL(this.file);
    },
    //===========================search myevent
    search(key) {
      if (key === "") {
        this.myEvents = JSON.parse(localStorage.getItem("getMyEvents"));
      } else {
        let listEvents = JSON.parse(localStorage.getItem("getMyEvents"));
        this.myEvents = listEvents.filter((event) =>
          event.title.toLowerCase().includes(key.toLowerCase())
        );
      }
    },
    /// =======================crud=====================
    onConfirm() {
      if (this.isValidated) {
        if (this.dialogMode === "create") {
          this.addNewEvent();
        } else if (this.dialogMode === "edit") {
          this.updateMyEventCard(this.myEvent);
        } else if (this.dialogMode === "delete") {
          this.deleteMyEventCard(this.eventToEditDelete.id);
        }
        this.closeDialog();
      }
    },
    addNewEvent() {
      this.isEmpty = false;
      let myNewEvent = new FormData();
      let user_id = localStorage.getItem("userID");

      myNewEvent.append("category_id", this.category.id);
      myNewEvent.append("user_id", user_id);
      myNewEvent.append("title", this.myEventTitle);
      myNewEvent.append("start_date", this.startDateTime);
      myNewEvent.append("end_date", this.endDate);
      myNewEvent.append("city", this.city);
      if (this.description !== "") {
        myNewEvent.append("description", this.description);
      }
      if (this.file !== null) {
        myNewEvent.append("photo", this.file);
      }

      axios.post("api/myevents", myNewEvent).then((res) => {
        this.dialogDisplayed = false;
        this.myEvents.unshift(res.data.myEvent);

        let storedMyEvents = JSON.parse(localStorage.getItem("getMyEvents"));
        storedMyEvents.unshift(res.data.myEvent);
        localStorage.setItem("getMyEvents", JSON.stringify(storedMyEvents));
      });
    },
    showFormConfirmDelete(id) {
      this.dialogMode = "delete";
      this.dialogDisplayed = true;
      this.eventToEditDelete = {
        id: id,
      };
    },
    deleteMyEventCard(id) {
      axios.delete("api/myevents/" + id).then(() => {
        this.myEvents = this.myEvents.filter((event) => event.id !== id);

        let storedMyEvents = JSON.parse(localStorage.getItem("getMyEvents"));
        storedMyEvents = storedMyEvents.filter((event) => event.id !== id);
        localStorage.setItem("getMyEvents", JSON.stringify(storedMyEvents));
      });
    },
    showFormMyEventUpdate(myEvent) {
      this.myEvent = myEvent;
      this.dialogMode = "edit";
      this.dialogDisplayed = true;
      this.myEventTitle = myEvent.title;
      this.description = myEvent.description;
      this.city = myEvent.city;
      this.category = myEvent.category;
      this.imageTitle = "";
      this.isSelectedCate = true;
      this.isSelectedCity = true;
      this.imageTitle = null;
      this.imageForUpdate = myEvent.image;
      this.endDateError = "";
      this.myEventTitleError = "";
    },

    getMyEventData() {
      axios.get("api/myevents").then((res) => {
        this.myEvents = res.data;
        this.myEvents = this.myEvents.filter(
          (event) => event.user_id == localStorage.getItem("userID")
        );
        if (this.myEvents == "") {
          this.isEmpty = false;
        }
        localStorage.setItem("getMyEvents", JSON.stringify(this.myEvents));
      });
    },
    /// =======================crud=====================
  },
  mounted() {
    // GET MYEVENT DATA FROM BACKEND
    this.getMyEventData();

    // GET CATEGORY DATA FROM BACKEND
    axios.get("api/categories").then((res) => {
      this.categories = res.data.data;
    });

    // GET COUNTRIES AND ITS CITIES FROM BACKEND WITH GOOD FORMAT
    let countriesWithItsCities = [];
    axios.get("api/countries").then((res) => {
      countriesWithItsCities = res.data;
      for (let country in countriesWithItsCities) {
        for (let city of countriesWithItsCities[country]) {
          this.countriesCities.push({
            country: country,
            city: city,
          });
        }
      }
      this.countriesCitiesInitial = this.countriesCities;
    });
  },
};
</script>

<style scoped>
.emptyMyevent {
  text-align: center;
  opacity: 0.2;
  margin-top: 10%;
}
#checkDate {
  color: red;
}
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
  width: 350px;
  height: 270px;
  padding: 20px;
  overflow-y: scroll;
  scroll-behavior: smooth;
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
  color: gray;
}
textarea {
  height: 130px;
  resize: none;
}
textarea::-webkit-scrollbar {
  display: none;
}
.city-cate-container {
  width: 100%;
  display: flex;
  flex-direction: column;
}

.city,
.category {
  width: 45%;
  display: flex;
  justify-content: space-around;
  flex-wrap: wrap;
}
.city-cate-container p {
  width: 100%;
  text-align: center;
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
  background: rgba(128, 128, 128, 0.219);
  color: rgba(128, 128, 128, 0.445);
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
  color: rgb(233, 81, 81);
  margin: 5px 0;
  font-size: 12px;
  text-align: left;
}
.des p {
  margin: 5px 0;
  font-size: 15px;
  text-align: left;
}

/* categorylist style */

.categoryContainer {
  margin-top: 5px;
}
.categoryContainer ul li {
  text-align: left;
  cursor: pointer;
}

.category-container-actions,
.city-container-actions {
  display: flex;
  justify-content: space-between;
}
.category-container-actions .searchKey,
.city-container-actions .searchKey {
  width: 90%;
  padding: 5px;
  margin: 0;
  box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.25);
  border-radius: 5px;
  border: 1px solid white;
  outline: none;
  color: gray;
}
.category-container-actions .searchKey:focus {
  border: 3px solid var(--main-color);
}
.city-container-actions .searchKey:focus {
  border: 3px solid var(--main-color);
}
.btnCloseCategoryList,
.btnOpenCategoryList,
.btnOpenCityList,
.btnCloseCityList {
  color: rgb(0, 0, 0);
  padding: 0 10px;
  width: 10%;
  border: 1px solid rgb(2, 2, 2);
  border-radius: 2px;
  background: rgb(253, 252, 249);
}
.category-list,
.city-list {
  background: rgb(255, 255, 255);
  height: 150px;
  padding: 3px;
  overflow-y: scroll;
}
.category-list ul li,
.city-list ul li {
  list-style: none;
  margin-bottom: 5px;
  padding: 7px;
  font-size: 17px;
  cursor: pointer;
  background: white;
  border: 1px solid rgb(128, 124, 124);
  color: gray;
  outline: none;
}
.category-list ul li:hover {
  border: 3px solid rgb(252, 198, 50);
  color: rgb(0, 0, 0);
}
.city-list ul li:hover {
  border: 2.4px solid rgb(252, 198, 50);
  color: rgb(0, 0, 0);
}
.category-city-selected {
  display: flex;
  justify-content: space-between;
}
.category-city-selected :nth-child(1) {
  text-align: left;
}
.category-city-selected :nth-child(2) {
  text-align: right;
}

.category-city {
  display: flex;
  justify-content: space-between;
}
.title-date,
.start-date,
.end-date {
  display: flex;
  flex-direction: column;
  text-align: left;
}
.title-date label,
input,
div {
  margin: 3px 0px;
}

.title-date input {
  padding: 5px;
  box-shadow: 0px 2px 2px rgba(0, 0, 0, 0.25);
  border-radius: 5px;
  border: 1px solid white;
  outline: none;
  color: gray;
}
.title-date input:focus {
  border: 3px solid var(--main-color);
}
#see-less,
.more {
  text-align: left;
  color: blue;
  cursor: pointer;
  font-size: 18px;
}
.category-main-container label,
.city-main-container label {
  display: flex;
  text-align: left;
}
</style>
