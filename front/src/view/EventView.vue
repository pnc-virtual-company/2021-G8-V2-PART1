<template>
  <section>
    <search-filter @cardSearch="cardSearch"></search-filter>
    <my-event-card
      v-for="event of this.events"
      :key="event.id"
      :myEvent="event"
      :buttonMode="onEventMode"
    ></my-event-card>
  </section>
</template>

<script>
import SearchFilter from "../components/pages/event/exploreEvent/SearchFilter.vue";
import MyEventCard from '../components/pages/event/myevent/MyEventCard.vue';
import axios from "../axios-http.js";
export default {
  components: { 
    'search-filter': SearchFilter, 
    'my-event-card': MyEventCard 
    },
  data() {
    return {
      events: [],
      onEventMode: 'event',
    };
  },
  methods: {
    getMyEventData(){
      axios.get("api/myevents")
      .then( res => {
        this.events = res.data;
        this.events = this.events.filter(event => event.user_id != localStorage.getItem("userID"));
        for(let event of this.events) {
          let joinedUserIdList = [];
          axios.get('/api/userjoinevents/getUserIdList/' + event.id)
          .then(res => {
            joinedUserIdList = res.data;
            event.joinedUserIdList = joinedUserIdList;
          })
        }
      })
    },
    cardSearch(key){
      if(key === ''){
        axios.get('api/userjoinevents').then(res=>{
          this.events = res.data.data
        });
      }else{
        axios.get('api/userjoinevents/search/' + key).then(res=>{
          this.events = res.data;
        })
      }
    }
  },
  mounted() {
    this.getMyEventData();
  },
};
</script>

<style scoped>
</style>