<template>
  <section>
    <search-filter></search-filter>
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
  components: { SearchFilter, MyEventCard },
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
      })
    }
  },
  mounted() {
    this.getMyEventData()
  },
};
</script>

<style scoped>
</style>