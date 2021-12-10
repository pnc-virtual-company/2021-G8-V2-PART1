<template>
  <section>
    <search-filter @cardSearch="cardSearch"></search-filter>
    <my-event-card
      v-for="event of this.events"
      :key="event.id"
      :myEvent="event"
      :buttonMode="quitOrJoin(event.joinedUserIdList)"
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
    quitOrJoin(joinedUserIdList) {
      let myID = localStorage.getItem('userID');
      for(let joinedUserId of joinedUserIdList) {
        if(joinedUserId.user_id === myID) {
          return 'QUIT'
        }
      }
      return 'JOIN'
    },
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
            event.joinedUserIdList = Object.keys(joinedUserIdList).map((key) => joinedUserIdList[key]);
          })
        }
        console.log(this.events)
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