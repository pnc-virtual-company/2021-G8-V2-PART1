<template>
  <section>
    <div class="even-search">
        <input
          type="text"
          class="searchKey"
          placeholder="What are you looking for?"
          v-model="keyWord"
        />
        <button type="button" class="searchButton">
          X
        </button>
    </div>
    <!-- <add-search @showForm="showAddForm"></add-search> -->
    <my-event-card
      v-for="myEvent of this.myEvents"
      :key="myEvent.id"
      :myEvent="myEvent"
      
    ></my-event-card>
    <!------------------------- myevent card and from -->
  </section>
</template>

<script>
import MyEventCard from "../components/pages/event/myevent/MyEventCard.vue";
// import AddSearch from "../components/pages/event/myevent/AddSearch.vue";

import axios from "../axios-http.js";
export default {
  components: {MyEventCard},
  props: ['userDataAppToEvent'],
  data() {
    return {
        countriesCitiesInitial: [],
        countriesCities: [],
        categories: [],
        myEvents: [],
    };
  },
  // 
  computed: {
  },
  methods: {
    
    getMyEventData(){
      axios.get("/myevents")
    .then( res => {
      this.myEvents = res.data
    })
    }
     /// =======================crud=====================

  },
  mounted() {
    // GET MYEVENT DATA FROM BACKEND
    this.getMyEventData()
  },
};
</script>

<style scoped>
.even-search {
  width: 60%;
  display: flex;
}

.searchKey {
  width: 65%;
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
