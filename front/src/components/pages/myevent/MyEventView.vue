<template>
  <div>
    <my-event-form @addNewMyEvent= 'createMyNewEvent'></my-event-form>
    <my-event-card v-for=" (myEvent, index) of myEventData" :key="index" :myEvent="myEvent"></my-event-card>
  </div>
</template>

<script>
import MyEventCard from './MyEventCard.vue';
import MyEventForm from './MyEventForm.vue';
export default {
  components: { MyEventForm, MyEventCard },
  data() {
      return {
          myEventData:[
              {
                  title:'CSS',
                  description:'css course',
                  startDateTime:'10/20/2021 10:00AM',
                  endDateTime:'10/20/2021 10:00AM'
              },{
                  title:'HTML',
                  description:'HTML course',
                  startDateTime:'10/20/2021 10:00AM',
                  endDateTime:'10/20/2021 10:00AM'
              },{
                  title:'JS',
                  description:'JS course',
                  startDateTime:'10/20/2021 10:00AM',
                  endDateTime:'10/20/2021 10:00AM'
              }


          ],
      }
  },
  methods: {
      createMyNewEvent(newEvent){
          this.myEventData.unshift(newEvent);
      }
  },
}
</script>

<style scoped>
</style>
