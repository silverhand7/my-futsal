<template>
  <div>
    <Head title="Full Calendar" />

    <Heading class="mb-6">
      <div>
        Full Calendars
      </div>
    </Heading>
    <div class="mb-4">
      <Link href="./resources/bookings/new" class="flex-shrink-0 shadow rounded focus:outline-none ring-primary-200 dark:ring-gray-600 focus:ring bg-primary-500 hover:bg-primary-400 active:bg-primary-600 text-white dark:text-gray-800 inline-flex items-center font-bold px-4 h-9 text-sm flex-shrink-0">
        Buat Booking
      </Link>
    </div>
    <Card
      class="p-6"
    >
      <FullCalendar :options="calendarOptions" />
    </Card>

  </div>
</template>

<script>
import FullCalendar from '@fullcalendar/vue3'
import timeGridPlugin from '@fullcalendar/timegrid'
import interactionPlugin from '@fullcalendar/interaction'
import idLocale from '@fullcalendar/core/locales/id'

export default {
  props: {
    bookings: Object
  },
  components: {
    FullCalendar,
  },
  data() {
    return {
      calendarData: [],
      calendarOptions: {},
    }
  },
  methods: {
    // handleEventClick(selectInfo) {
    //  alert('test');
    // },
    // handleDateSelect(selectInfo) {
    //   if(window.confirm(`Anda akan membooking lapangan di jam ${selectInfo.startStr} sampai ${selectInfo.endStr}`)) {
    //     let calendarApi = selectInfo.view.calendar
    //     calendarApi.unselect() // clear date selection

    //     calendarApi.addEvent({
    //       id: 1,
    //       title: 'booking futsal',
    //       start: selectInfo.startStr,
    //       end: selectInfo.endStr,
    //       allDay: selectInfo.allDay
    //     })
    //   }

    // },
  },
  created() {

    this.calendarOptions = {
          locale: idLocale,
          plugins: [ timeGridPlugin ],
          businessHours: {
            daysOfWeek: [0, 1, 2, 3, 4, 5, 6],
            startTime: '10:00', // a start time (10am in this example)
            endTime: '24:00',
          },
          selectConstraint: "businessHours",
          initialView: 'timeGridWeek',
          initialEvents: this.bookings,
          selectable: true,
          editable: true,
          select: this.handleDateSelect,
        }
    }
}
</script>