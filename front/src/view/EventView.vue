<template>
  <section>
    <search-filter></search-filter>
    <my-event-card
      v-for="myEvent of this.myEvents"
      :key="myEvent.id"
      :myEvent="myEvent"
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
      myEvents: [],
      onEventMode: 'event',
    };
  },
  methods: {
      getMyEventData(){
      axios.get("api/myevents")
    .then( res => {
      this.myEvents = res.data

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