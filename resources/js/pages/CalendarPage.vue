<template>
    <div v-if="bookings.length != 0">
        <TheCalendar :bookings="bookings" />
    </div>
</template>

<script>
import TheCalendar from '../components/TheCalendar.vue';
export default {
  data() {
    return {
      bookings: [],
    }
  },
  components: {
    TheCalendar,
  },
  mounted() {
    axios
      .get('/api/get-bookings')
      .then((response) => {
        this.bookings = response['data'];
      })
  }
  // methods: {
  //   async getBookings() {
  //     return await axios
  //       .get('/api/get-bookings')
  //       .then((response) => {
  //         return response['data'];
  //       })
  //   }
  // },
  // created(){
  //   console.log(this.getBookings());
  // }
}
</script>