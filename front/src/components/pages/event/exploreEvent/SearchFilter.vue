<template>
  <section>
    <div class="search-filter">
      <div class="event-search">
        <input
          type="text"
          class="searchKey"
          placeholder="What are you looking for?"
          v-model="cardKeyWord"
        />
        <button type="button" class="searchButton" @click="clearSearch">X</button>
      </div>

      <div class="city-filter">
        <div class="city-filter-action">
          <p>{{ selectedCity }}</p>
          <div class="city-select">
            <input
              type="text"
              class="searchKey"
              v-model="filterKey"
              placeholder="Select your city"
            />
            <button type="button" class="searchButton" @click="clearSearch">X</button>
          </div>
        </div>
        <div v-if="countriesCities.length > 0" class="city-list">
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
      selectedCity: "All Cities, Default",
      filterKey: "",
      countriesCities: [],
      countriesCitiesInitial: [],
    };
  },
  watch: {
    selectedCity: function(newValue) {
      this.$emit("selectedCityChange", newValue);
    },
    cardKeyWord: function(newValue) {
      this.$emit("cardSearch", newValue);
    },
    filterKey: function(key) {
      if (key === "") {
        this.countriesCities = [];
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
      this.cardKeyWord = "";
      this.filterKey = "";
      this.countriesCities = [];
    },
    setCity(city, country) {
      this.selectedCity = city + ', ' + country;
      this.countriesCities = [];
      this.filterKey = '';
    }
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
      this.countriesCitiesInitial.push({
            country: 'Default',
            city: 'All Cities',
          });
    });
  },
};
</script>

<style scoped>
.city-list {
  width: 58%;
  max-height: 100px;
  padding: 15px;
  border: 2px solid var(--main-color);
  border-top: none;
  overflow-y: scroll;
}
ul li {
  list-style: none;
}
ul li:hover {
  background: rgb(226, 226, 123);
  cursor: pointer;
}
::-webkit-scrollbar {
  width: 10px;
  border-radius: 15px;
}
  ::-webkit-scrollbar-track {
  background: #f1f1f1; 
  border-radius: 15px;
}
  ::-webkit-scrollbar-thumb {
  background: rgb(182, 182, 182); 
    border-radius:10px;
}
::-webkit-scrollbar-thumb:hover {
  
  background: rgb(153, 153, 153); 
} 



.search-filter {
  width: 82%;
  margin: auto;
  display: flex;
  justify-content: space-between;
  align-items: flex-start;
}
.city-filter {
  width: 60%;
  display: flex;
  flex-direction: column;
  align-items: flex-end;
}
.city-filter-action {
  width: 100%;
  display: flex;
  justify-content: flex-end;
  align-items: center;
  text-align: right;
}
.btn-add:hover,
.searchButton:hover {
  color: rgb(173, 101, 233);
}

.event-search {
  width: 40%;
  display: flex;
}
.city-select {
  width: 70%;
  display: flex;
  justify-content: flex-end;
}

.searchKey {
  width: 75%;
  border: 2px solid var(--main-color);
  border-right: none;
  padding: 15px;
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
</style>
