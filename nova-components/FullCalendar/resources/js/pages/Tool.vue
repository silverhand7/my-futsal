<template>
  <div>
    <Head title="Full Calendar"/>
    <Heading class="mb-6">
      <div>
        Booking Calendar
      </div>
    </Heading>

    <div class="mb-4">
      <Link href="./resources/bookings/new" class="flex-shrink-0 shadow rounded focus:outline-none ring-primary-200 dark:ring-gray-600 focus:ring bg-primary-500 hover:bg-primary-400 active:bg-primary-600 text-white dark:text-gray-800 inline-flex items-center font-bold px-4 h-9 text-sm flex-shrink-0">
        Buat Booking
      </Link>
    </div>

    <Card class="p-6">
      <TheCalendar :bookings="bookings" />
    </Card>

  </div>
</template>

<script>

import TheCalendar from '../components/TheCalendar.vue'

export default {
  props: {
    bookings: Object
  },
  components: {
    TheCalendar,
  },
}
</script>