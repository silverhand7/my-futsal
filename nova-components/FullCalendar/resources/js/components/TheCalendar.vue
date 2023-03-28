<template>
    <div>
        <div class="w-50">
            <table class="table w-full mb-4">
                <tr class="">
                    <td class="px-2 py-1 font-bold">Lapangan</td>
                    <td class="px-2 py-1 font-bold">Terbooking</td>
                    <td class="px-2 py-1 font-bold">Belum Dikonfirmasi</td>
                </tr>
                <tr v-for="field in fields" :key="field.id">
                    <td class="px-2 py-1 ">{{ field.name }}</td>
                    <td class="px-2 py-1 "><div style="width:100px; height: 20px" :style="{'background-color': field.event_confirmed_color }"></div></td>
                    <td class="px-2 py-1 "><div style="width:100px; height: 20px" :style="{'background-color': field.event_unconfirmed_color }"></div></td>
                </tr>
            </table>
        </div>
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
            calendarOptions: {
                locale: idLocale,
                plugins: [ timeGridPlugin ],
                businessHours: {
                    daysOfWeek: [0, 1, 2, 3, 4, 5, 6],
                    startTime: '10:00', // a start time (10am in this example)
                    endTime: '24:00',
                },

                selectConstraint: "businessHours",
                initialView: 'timeGridWeek',
                events: this.bookings,
                selectable: true,
                editable: true,
                select: this.handleDateSelect,
                eventClick: this.handleEventClick,
            },
            fields: [],
        }

    },
    methods: {
        handleEventClick(selectInfo) {
            let id = selectInfo.event._def.publicId;
            window.location = './resources/bookings/' + id;
        },
        getFields() {
            Nova.request().get('../api/get-fields').then(response => {
                this.fields = response['data'];
            })
        }
    },
    mounted(){
        this.getFields();
    }
}
</script>

<style>
.w-50 {
    width: 50%;
}

</style>