<template>
    <FullCalendar :bookings="bookings" :options="calendarOptions"  />
    <table class="table mt-5">
        <tr class="">
            <th>Lapangan</th>
            <th>Terbooking</th>
            <th>Belum pasti</th>
        </tr>
        <tr v-for="field in fields" :key="field.id">
            <td>{{ field.name }}</td>
            <td><div style="width:5rem; height: 20px" :style="{'background-color': field.event_confirmed_color }"></div></td>
            <td><div style="width:5rem; height: 20px" :style="{'background-color': field.event_unconfirmed_color }"></div></td>
        </tr>
    </table>
</template>

<script>
import FullCalendar from '@fullcalendar/vue3'
import timeGridPlugin from '@fullcalendar/timegrid'
import interactionPlugin from '@fullcalendar/interaction'
import idLocale from '@fullcalendar/core/locales/id'
import axios from 'axios'

export default {
    props: {
        bookings: Object
    },
    components: {
        FullCalendar
    },
    data() {
        return {
            fields: [],
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
                    //eventClick: this.handleEventClick,
                    height: '100vh',
                },
        }

    },
    methods: {
        getFields() {
            axios.get('./api/get-fields').then(response => {
                this.fields = response['data'];
            })
        }
    },
    mounted(){
        this.getFields();
    }

}
</script>