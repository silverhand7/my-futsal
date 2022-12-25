<template>
    <FullCalendar :bookings="bookings" :options="calendarOptions"  />
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
                        startTime: '07:00',
                        endTime: '24:00',
                    },
                    selectConstraint: "businessHours",
                    initialView: 'timeGridFourDay',
                    views: {
                        timeGridFourDay: {
                            type: 'timeGrid',
                            duration: { days: 4 },
                            buttonText: '4 Hari'
                        }
                    },
                    headerToolbar: {
                        right: 'prev,next',
                        center: 'title',
                        left: 'timeGridDay,timeGridFourDay'
                    },
                    scrollTime: '07:00:00',
                    events: this.bookings,
                    selectable: true,
                    editable: true,
                    select: this.handleDateSelect,
                    eventClick: this.handleEventClick,
                    height: '100vh'
                },
        }

    },
    methods: {
        handleEventClick(selectInfo) {
            let id = selectInfo.event._def.publicId;
            window.location = './resources/bookings/' + id;
        }
    },

}
</script>