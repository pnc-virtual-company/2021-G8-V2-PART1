<template>
  <section>
    <add-search @showForm="showAddForm" @search='search'></add-search>
    <base-dialog
      v-if="dialogDisplayed"
      :title="dialogTitle"
      :mode="dialogMode"
      @close="closeDialog"
    >
      <div class="eventForm">
        <div class="left-side">
          <div class="title">
            <input type="text" placeholder="Title" v-model="myEventTitle" />
            <div class="error" v-if="myEventTitleError">
              <p v-text="myEventTitleError"></p>
            </div>
            <div class="date">
              <label for>Start Date</label>
              <input
                type="datetime-local"
                v-model="startDateTime"
              />
            </div>
            <div class="time">
              <label for>End Date</label>
              <input type="datetime-local" v-model="endDate"/>
            </div>
          </div>
          <div class="city-cate">
            <div class="category">
              <button type="button" @click="showCategoryList">
                Category
              </button>
              <p v-if="category" v-text="category.name"></p>

              <category-city-dialog
                v-if="categoryListDisplayed"
                @closeCategoryList="closeCategoryList"
              >
                <div class="cate-search">
                    <input
                        type="text"
                        class="searchKey"
                        placeholder="search category"
                        v-model="cateKeySearch"
                    />
                    <button type="button" class="clearButton" @click="clearCateSearch">X</button>
                </div>
                <div class="categoryContainer">
                    <ul>
                        <li v-for="cate of this.categories" 
                          :key="cate.id"
                          @click="setCate(cate.id, cate.name)"
                        >{{ cate.name }}
                        </li>
                    </ul>
                </div>
              </category-city-dialog>
            </div>
            <div class="city">
              <button type="button"  @click="showCityList">City</button>
              <p v-if="city" v-text="city"></p>

              <category-city-dialog
                v-if="cityListDisplayed"
                @closeCategoryList="closeCategoryList"
              >
                <div class="cate-search">
                    <input
                        type="text"
                        class="searchKey"
                        placeholder="search city"
                        v-model="cityKeySearch"
                    />
                    <button type="button" class="clearButton" @click="clearCitySearch">X</button>
                </div>
                <div class="categoryContainer">
                    <ul>
                        <li v-for="(countryCity, index) of countriesCities" 
                            :key="index"
                            @click="setCity(countryCity.city, countryCity.country)"
                        >{{ countryCity.city }}
                        </li>
                    </ul>
                </div>
              </category-city-dialog>
            </div>
          </div>
        <div class="more">
          <p @click="showMoreChoice" v-if="!isShowMore">See more..</p>
          <p @click="showLessChoice" v-if="isShowMore">See less..</p>
        </div>
        </div>
        <div class="showMoreInfo" v-if="isShowMore">
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
          <input type="file" @change="getImage"/>
          <img :src="imageTitle" alt="EMPTY PICTURE" />
        </div>
      </div>
  </div>
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
      v-for="myEvent of this.myEvents"
      :key="myEvent.id"
      :myEvent="myEvent"
      :buttonMode="onMyEventMode"
      @deleteMyEvent='deleteMyEventCard'
      @updateMyEvent='EditMyEventCard'
    ></my-event-card>
    <!------------------------- myevent card and from -->
  </section>
</template>

<script>
import MyEventCard from "../components/pages/event/myevent/MyEventCard.vue";
import AddSearch from "../components/pages/event/myevent/AddSearch.vue";
import BaseButton from "../components/UI/BaseButton.vue";

import axios from "../axios-http.js";
export default {
  components: {MyEventCard, AddSearch, BaseButton},
  props: ['userDataAppToEvent'],
  data() {
    return {
        myEvent:'',
        myEventTitle:'',
        startDateTime:'',
        endDate:'',
        description:'',
        category: '',
        city: '',
        imageTitle:'',
        file: null,
  
        
        myEventTitleError:'',
        startDateTimeError:'',
        endDateError:'',
        categoryError: '',
        cityError: '',


        onMyEventMode: 'myEvent',
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
    };
  },
  watch: {
      cateKeySearch: function(key) {
        if(key === '') {
            axios.get('api/categories').then(res => {
                this.categories = res.data.data;
            });
        } else {
            axios.get('api/categories' + '/search/' + key).then(res => {
                this.categories = res.data;
            })
        }
      },
      cityKeySearch: function(key) {
        if(key === '') {
          this.countriesCities = this.countriesCitiesInitial;
        } else {
          this.countriesCities = [];
          for(let countryCity of this.countriesCitiesInitial) {
            if(countryCity.city.toLowerCase().includes(key.toLowerCase()) ||
              countryCity.country.toLowerCase().includes(key.toLowerCase()))
            {
              this.countriesCities.push(countryCity);
            }
          }
        }
      },
  },
  computed: {
    dialogTitle() {
      return this.dialogMode === "edit" ? "EDIT MY EVENT" : "CREATE MY EVENT";
    },
    dialogButtton() {
      return this.dialogMode === "edit" ? "EDIT" : "CREATE";
    },
    isValidated(){
      return (
        this.myEventTitleError === '' &&
        this.startDateTimeError === '' &&
        this.endDateError === '' &&
        this.categoryError === '' &&
        this.cityError === '' &&
        this.myEventTitle !== '' &&
        this.startDateTime !== '' &&
        this.endDate !== '' &&
        this.category !== '' &&
        this.city !== ''
      )
    }
  },
  methods: {
    
    getCategoryData(data) {
      this.categoryData = data;
    },
    showAddForm() {
      this.dialogMode = "create";
      this.dialogDisplayed = true;
    },
    closeDialog() {
      this.dialogDisplayed = false;
      this.categoryName = "";
      this.myEventTitle = ''
      this.startDateTime = ''
      this.endDate = ''
      this.description = ''
      this.isShowMore = false
    },
    showCategoryList() {
      this.categoryListDisplayed = true;
      axios.get('api/categories').then(res => {
          this.categories = res.data.data;
      });
    },
    showCityList() {
      this.cityListDisplayed = true;
    },
    closeCategoryList() {
        this.categoryListDisplayed = false;
        this.cityListDisplayed = false;
    },
    showMoreChoice() {
      this.isShowMore = true;
    },
    showLessChoice() {
      this.isShowMore = false;
    },
    clearCateSearch() {
      this.cateKeySearch = '';
      this.showCategoryList()
    },
    clearCitySearch() {
      this.cityKeySearch = '';
      this.countriesCities = this.countriesCitiesInitial;
    },
    setCity(city, country) {
      this.city = city + ', ' + country;
      this.closeCategoryList();
    },
    setCate(id, name) {
      this.category = {
        id: id,
        name: name
      };
      this.closeCategoryList();
    },
     //===========================get image
     getImage(e){
       this.file = e.target.files[0];
       let img = e.target.files[0];
       this.imageTitle = URL.createObjectURL(img);
     },
  //===========================search myevent
  search(key) {
            if(key === '') {
                axios.get('api/myevents').then(res => {
                    this.myEvents = res.data;
                });
            } else {
                axios.get('api/myevents/search/' + key).then(res => {
                    this.myEvents = res.data;
                })
            }
        },
  /// =======================crud=====================
    onConfirm() {
            if(this.isValidated) {
                if (this.dialogMode === 'create') {
                    this.addNewEvent();
                } else if (this.dialogMode === 'edit') {
                    this.updateMyEventCard(this.myEvent);
                }
                this.closeDialog();
            }
        },
    addNewEvent(){
      this.dialogDisplayed = false;
      
      let myNewEvent = new FormData();
      myNewEvent.append('category_id', this.category.id);
      myNewEvent.append('user_id', this.userDataAppToEvent.id);
      myNewEvent.append('title', this.myEventTitle);
      myNewEvent.append('start_date', this.startDateTime);
      myNewEvent.append('end_date', this.endDate);
      myNewEvent.append('city', this.city);
      myNewEvent.append('description', this.description);
      if(this.file !== null) {
        myNewEvent.append('image', this.file);
      }

      axios.post('api/myevents', myNewEvent)
      .then(res => {
        this.myEvents.unshift(res.data.myEvent);
        this.getMyEventData();
        
      })
    },
    deleteMyEventCard(id){
      axios.delete('api/myevents/'+id)
      .then(()=>{
        this.getMyEventData()
      })
    },
    EditMyEventCard(myEvent){
      this.myEvent = myEvent;
      this.dialogMode = 'edit'
       this.dialogDisplayed = true;
       this.myEventTitle = myEvent.title
       this.startDateTime = myEvent.start_date
       this.endDate = myEvent.end_date
       this.description = myEvent.description
       
    },
    updateMyEventCard(myEvent){
        let myEventUpdate = {
         category_id: myEvent.category_id,
         user_id: myEvent.user_id,
         title: this.myEventTitle,
         start_date: this.startDateTime,
         end_date: this.endDate,
         city: this.city,
         description: this.description,
         image: this.file,
       }
       axios.put('api/myevents/'+myEvent.id, myEventUpdate)
       .then(()=>{
         this.getMyEventData()
       })

    },
    getMyEventData(){
      axios.get("api/myevents")
    .then( res => {
      this.myEvents = res.data

    })
    }
     /// =======================crud=====================



  },
  mounted() {
    // GET MYEVENT DATA FROM BACKEND
    this.getMyEventData()

    // GET CATEGORY DATA FROM BACKEND
    axios.get("api/categories")
    .then((res) => {
      this.categories = res.data.data;
    })
    
    // GET COUNTRIES AND ITS CITIES FROM BACKEND WITH GOOD FORMAT
    let countriesWithItsCities = [];
    axios.get('api/countries')
    .then(res => {
      countriesWithItsCities = res.data;
      for(let country in countriesWithItsCities) {
        for(let city of countriesWithItsCities[country]) {
          this.countriesCities.push({
            'country': country,
            'city': city
          })
        }
      }
      this.countriesCitiesInitial = this.countriesCities;
    });
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
  width: 350px;
  height: 220px;
  padding: 20px;
  overflow-y: scroll;
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
.city-cate button {
  background: rgb(34, 152, 207);
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
.des p{
 
  margin: 5px 0;
  font-size: 12px;
  text-align: left;
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
.more {
  text-align: left;
  color: blue;
  cursor: pointer;
  margin-bottom: 5px;
}

</style>
