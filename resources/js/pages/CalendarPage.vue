<template>
    <div>
        <TheCalendar :bookings="bookings" />
    </div>
</template>

<script>
import TheCalendar from '../components/TheCalendar.vue';
export default {
  data() {
    return {
      bookings: []
    }
  },
  components: {
    TheCalendar,
  },
}
</script>