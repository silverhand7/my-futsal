<template>
  <div>
    <Head title="Full Calendar" />

    <Heading class="mb-6">Full Calendar Hello world</Heading>
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

let todayStr = new Date().toISOString().replace(/T.*$/, '') // YYYY-MM-DD of today

export default {
  props: {
    bookings: Object
  },
  components: {
    FullCalendar
  },
  data() {
    return {
      calendarData: [],
      calendarOptions: {},
    }
  },
  methods: {
    handleEventClick(selectInfo) {
     alert('test');
    },
    handleDateSelect(selectInfo) {
      if(window.confirm(`Anda akan membooking lapangan di jam ${selectInfo.startStr} sampai ${selectInfo.endStr}`)) {
        let calendarApi = selectInfo.view.calendar
        calendarApi.unselect() // clear date selection

        calendarApi.addEvent({
          id: 1,
          title: 'booking futsal',
          start: selectInfo.startStr,
          end: selectInfo.endStr,
          allDay: selectInfo.allDay
        })
      }

    },
  },
  created() {
    for (let i = 0; i < this.bookings.length; i++){
      this.calendarData.push({
        'id': this.bookings[i].id,
        'title': 'booking ' + this.bookings[i].id,
        'start': this.bookings[i].date_iso,
        //'end': '2022-12-15T10:00:00'
      })
    }

    this.calendarOptions = {
          locale: idLocale,
          plugins: [ timeGridPlugin, interactionPlugin ],
          businessHours: {
            daysOfWeek: [0, 1, 2, 3, 4, 5, 6],
            startTime: '10:00', // a start time (10am in this example)
            endTime: '24:00',
          },
          selectConstraint: "businessHours",
          initialView: 'timeGridWeek',
          initialEvents: this.calendarData,
          selectable: true,
          editable: true,
          select: this.handleDateSelect,
        }
    }
}
</script>

<style>
/* Scoped Styles */
</style>