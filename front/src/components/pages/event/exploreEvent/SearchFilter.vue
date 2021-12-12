<template>
  <section>
    <div class="add-and-search">
      <div class="event-search">
        <input
          type="text"
          class="searchKey"
          placeholder="What are you looking for?"
          v-model="cardKeyWord"
        />
        <button type="button" class="searchButton" @click="clearSearch">X</button>
      </div>

      <div class="city-search">
        <div class="city-search-actions">
          <p>{{ selectedCity }}</p>
          <input
            type="text"
            class="city-searchKey"
            v-model="searchKey"
            placeholder="Select your city"
          />
          <button type="button" class="city-searchButton" @click="clearSearch">x</button>
        </div>
        <div v-if="countriesCities" class="city-list">
          <ul>
            <li
              v-for="(countryCity, index) of countriesCities"
              :key="index"
              @click="setCity(countryCity.city, countryCity.country)"
            >{{ countryCity.city }}, {{ countryCity.country }}</li>
          </ul>
        </div>
      </div>
    </div>
  </section>
</template>
<script>
import axios from "axios";
export default {
  data() {
    return {
      cardKeyWord: "",
      selectedCity: "All Cities",
      searchKey: "",
      countriesCities: [],
      countriesCitiesInitial: [],
    };
  },
  watch: {
    selectedCity: function(newValue) {
      this.$emit("selectedCityChange", newValue);
    },
    searchKey: function(key) {
      if (key === "") {
        this.countriesCities = this.countriesCitiesInitial;
      } else {
        this.countriesCities = [];
        for (let countryCity of this.countriesCitiesInitial) {
          if (
            countryCity.city.toLowerCase().includes(key.toLowerCase()) ||
            countryCity.country.toLowerCase().includes(key.toLowerCase())
          ) {
            this.countriesCities.push(countryCity);
            this.cityListDisplayed = true;
          }
        }
      }
    },
  },
  methods: {
    clearSearch() {
      this.searchKey = "";
      this.countriesCities = [];
    },
  },
  mounted() {
    let countriesWithItsCities = [];
    axios.get("http://localhost:8000/api/countries").then((res) => {
      countriesWithItsCities = res.data;
      for (let country in countriesWithItsCities) {
        for (let city of countriesWithItsCities[country]) {
          this.countriesCitiesInitial.push({
            country: country,
            city: city,
          });
        }
      }
      this.countriesCitiesInitial;
    });
  },
};
</script>

<style scoped>
.add-and-search {
  width: 82%;
  display: flex;
  margin: auto;
  justify-content: space-between;
}
.event-search{
  display: flex;
  height: 30px;
  padding: 10px;
}
.searchKey{
  border: 2px solid var(--main-color);
  padding-left: 7px;
  border-radius: 5px 0px 0px 5px;
}
.city-search{
  padding: 10px;
 
  display: flex;
  flex-direction: column;
}
.city-search-actions{
  display: flex;
  align-items: center;
  height: 30px;
  padding: 0px;
  margin: 0px;
}
.city-searchKey, .city-searchButton{
  height: 85%;
}
.city-searchKey{
  border:2px solid rgb(103, 219, 223) ;
  border-radius: 5px 0px 0px 5px;
  padding-left: 7px;
}
.city-search-actions p{
  margin-right: 10px;
}
.city-searchButton{
  padding:1px 10px 25px 10px;
  border:2px solid rgb(103, 219, 223) ;
  background:rgb(103, 219, 223) ;
  color: white;
  font-size: 20px;
}
.searchButton{
  background: var(--main-color);
  border:2px solid var(--main-color);
  padding:3px 10px 23px 10px;
  font-size: 16px;
   color: white;
}

.city-list{
  margin-top: 5px;
  background: rgb(255, 255, 255);
  height: 200px;
  padding:10px;
  overflow-y: scroll;
  box-shadow: 1px 1px 10px  rgb(102, 102, 102) inset;
}
.city-list ul {
  list-style: none;
}

/* .btn-add {
  margin: 0;
  width: 150px;
  background: var(--main-color);
  border: none;
  padding: 15px 20px;
  border-radius: 50px;
  color: white;
  font-weight: bold;
  cursor: pointer;
}
.btn-add:hover,
.searchButton:hover,
.city-searchButton:hover {
  color: rgb(173, 101, 233);
}


.searchKey {
  width: 90%;
  height: 81%;
  border: 2px solid var(--main-color);
  border-right: none;
  border-radius: 15px 0 0 15px;
  outline: none;
}

.searchButton {
  margin: 0;
  width: 45px;
  border: 1px solid var(--main-color);
  background: var(--main-color);
  color: #fff;
  border-radius: 0 15px 15px 0;
  cursor: pointer;
  font-size: 24px;
}
.city-filter-container, .even-search{
  height: 45px;
  display: flex;
  align-items: center;
}
.city-filter-container :nth-child(1){
  margin-right: 5px;
}
.city-filter-container input, button{
  height: 90%;
  padding: 0;
}
.city-searchKey{
  padding: 0;
  margin: 0;
  border: none;
  border: 2.3px solid rgb(98, 194, 233);
  border-radius:10px 0px 0px 10px ;
}
.city-searchButton{
  height: 100%;
  padding: 0px 10px;
  border: 3px solid rgb(98, 194, 233);
  border-radius: 0 10px 10px 0;
  background: rgb(98, 194, 233);
  color: #fff;
  outline: none;
  font-size: 20px;
}
.city-searchKey:focus{
   outline: none;

}
.city-list{
  height: 200px;
  background: red;
  padding: 5px;
  overflow-y: scroll;
}
/* .city-search {
  width: 60%;
  display: flex;
  justify-content: flex-end;
} */
/* 
.city-searchKey {
  width: 40%;
  border: 2px solid rgb(34, 152, 207);
  border-right: none;
  padding: 15px;
  border-radius: 15px 0 0 15px;
  outline: none;
} */
/* .city-searchButton {
  margin: 0;
  width: 45px;
  border: 1px solid rgb(34, 152, 207);
  background: rgb(34, 152, 207);
  color: #fff;
  border-radius: 0 15px 15px 0;
  cursor: pointer;
  font-size: 24px;
  padding:9px 0px 13px 0px;
  text-align: center;
} */
</style>
