<template>
    <div v-if="bookings.length != 0">
        <FullCalendar :bookings="bookings" :options="calendarOptions"  />
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
        FullCalendar
    },
    data() {
        return {
            calendarOptions:
                {
                    locale: idLocale,
                    plugins: [ timeGridPlugin ],
                    businessHours: {
                        daysOfWeek: [0, 1, 2, 3, 4, 5, 6],
                        startTime: '10:00', // a start time (10am in this example)
                        endTime: '24:00',
                    },

                    selectConstraint: "businessHours",
                    initialView: 'timeGridWeek',
                    //events: this.bookings,
                    selectable: true,
                    editable: true,
                    select: this.handleDateSelect,
                    eventClick: this.handleEventClick
                },
        }

    },
    methods: {
        handleEventClick(selectInfo) {
            let id = selectInfo.event._def.publicId;
            window.location = './resources/bookings/' + id;
        }
    },
    created(){
        // mencoba append value nya tetap gagal saat sudah terload
        if (this.bookings.length != 0) {
            this.calendarOptions.events = this.bookings;
        }
       //console.log(this.bookings, this.calendarOptions);
    }
}
</script>