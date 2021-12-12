<template>
  <section>
    <search-filter @cardSearch="cardSearch"></search-filter>
    <my-event-card
      v-for="event of this.events"
      :key="event.id"
      :myEvent="event"
      :buttonMode="onEventMode"
      :quitOrJoinBtn="quitOrJoin(event.joinUserIdList)"
      @join="join"
      @quit="quit"
    ></my-event-card>
  </section>
</template>

<script>
import SearchFilter from "../components/pages/event/exploreEvent/SearchFilter.vue";
import MyEventCard from "../components/pages/event/myevent/MyEventCard.vue";
import axios from "../axios-http.js";
export default {
  components: {
    "search-filter": SearchFilter,
    "my-event-card": MyEventCard,
  },
  data() {
    return {
      events: [],
      onEventMode: "event",
    };
  },
  methods: {
    join(event) {
      let userId = localStorage.getItem("userID");
      let newJoined = {
        user_id: userId,
        myevent_id: event.id,
      };
      axios.post("api/userjoinevents", newJoined).then(() => {
        this.events[this.events.indexOf(event)].joinUserIdList.push(userId);
      });
    },
    quit(event) {
      let userId = localStorage.getItem("userID");
      let newJoined = {
        user_id: userId,
        myevent_id: event.id,
      };
      axios.post("api/userjoinevents/quit", newJoined).then(() => {
        this.events[this.events.indexOf(event)].joinUserIdList = this.events[
          this.events.indexOf(event)
        ].joinUserIdList.filter((user_id) => user_id !== userId);
      });
    },
    quitOrJoin(joinUserIdList) {
      let myID = localStorage.getItem("userID");
      for (let joinUserId of joinUserIdList) {
        if (joinUserId == myID) {
          return "QUIT";
        }
      }
      return "JOIN";
    },
    getExploreEventData() {
      axios.get("api/myevents").then((res) => {
        this.events = res.data;
        this.events = this.events.filter(
          (event) => event.user_id != localStorage.getItem("userID")
        );
        localStorage.setItem('getExploreEvents', JSON.stringify(this.events));
      });
    },
    cardSearch(key) {
      if (key === "") {
        this.events = JSON.parse(localStorage.getItem('getExploreEvents'));
      } else {
        let listEvents = JSON.parse(localStorage.getItem('getExploreEvents'));
        console.log(listEvents[0].description)
        this.events = listEvents.filter(event => event.title.includes(key));
      }
    }
  },
  mounted() {
    this.getExploreEventData();
  },
};
</script>

<style scoped>
</style>