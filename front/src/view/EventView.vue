<template>
  <section>
    <search-filter @cardSearch="cardSearch" @citySearch="citySearch"></search-filter>
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
    getMyEventData() {
      axios.get("api/myevents").then((res) => {
        this.events = res.data;
        this.events = this.events.filter(
          (event) => event.user_id != localStorage.getItem("userID")
        );
      });
    },
    cardSearch(key) {
      if (key === "") {
        axios.get("api/myevents").then((res) => {
          this.events = res.data;
        });
      } else {
        axios.get("api/myevents/search/" + key).then((res) => {
          this.events = res.data;
          this.events = this.events.filter(
            (event) => event.user_id != localStorage.getItem("userID")
          );
          for (let event of this.events) {
            let joinUserIdList = event.joinUserIdList;
            let userIdList = [];
            for (let userId of joinUserIdList) {
              userIdList.push(userId.user_id);
            }
            event.joinUserIdList = userIdList;
        }
        });
      }
    },
    citySearch(key){
      if (key === "") {
        axios.get("api/myevents").then((res) => {
          this.events = res.data;
        });
      } else {
        axios.get("api/myevents/search/city/" + key).then((res) => {
          this.events = res.data;
          this.events = this.events.filter(
            (event) => event.user_id != localStorage.getItem("userID")
          );
          for (let event of this.events) {
            let joinUserIdList = event.joinUserIdList;
            let userIdList = [];
            for (let userId of joinUserIdList) {
              userIdList.push(userId.user_id);
            }
            event.joinUserIdList = userIdList;
        }
        });
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