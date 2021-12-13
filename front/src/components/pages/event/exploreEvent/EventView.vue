-
<template>
  <section>
    <search-filter @cardSearch="cardSearch" @selectedCityChange="filterByCity"  @clearfilter="getExploreEventData">
    </search-filter>
    <div v-if="events.length !== 0">
      <my-event-card
        v-for="event of this.events"
        :key="event.id"
        :myEvent="event"
        :buttonMode="onEventMode"
        :quitOrJoinBtn="quitOrJoin(event.joinUserIdList)"
        @join="join"
        @quit="quit"
      ></my-event-card>
    </div>
    <div class="emptyCard" v-else>
      <h1 v-cloak>{{ message }}</h1>
    </div>
  </section>
</template>

<script>
import SearchFilter from "./SearchFilter.vue";
import MyEventCard from "../myevent/MyEventCard.vue";
import axios from "../../../../axios-http.js";
export default {
  components: {
    "search-filter": SearchFilter,
    "my-event-card": MyEventCard,
  },
  data() {
    return {
      events: [],
      onEventMode: "event",
      message: "NO EVENT YET",
    };
  },
  methods: {
    filterByCity(city) {
      if (city === "All Cities, Default") {
        this.getExploreEventData();
      } else {
        axios.get("api/myevents/city/" + city).then((res) => {
          this.events = res.data;
          this.events = this.events.filter(
            (event) => event.user_id != localStorage.getItem("userID")
          );
          localStorage.setItem("getExploreEvents", JSON.stringify(this.events));
        });
      }
    },
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
        localStorage.setItem("getExploreEvents", JSON.stringify(this.events));
      });
    },
    cardSearch(key) {
      if (key === "") {
        this.events = JSON.parse(localStorage.getItem("getExploreEvents"));
      } else {
        let listEvents = JSON.parse(localStorage.getItem("getExploreEvents"));
        this.events = listEvents.filter((event) =>
          event.title.toLowerCase().includes(key.toLowerCase())
        );
      }
    },
  },
  mounted() {
    this.getExploreEventData();
  },
};
</script>

<style scoped>
.emptyCard {
  text-align: center;
  opacity: 0.2;
  margin-top: 10%;
}
[v-cloak] {
  display: none;
}
</style>
