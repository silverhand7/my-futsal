<template>
    <div v-if="bookings.length != 0">
        <TheCalendar :bookings="bookings" />
    </div>
    <div v-else>
        <p class="mb-0">No data available</p>
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
}
</script>