// app.js
import './bootstrap';

import {createApp} from 'vue'

import CalendarApp from './pages/CalendarPage.vue'
import BookingScheduleApp from './pages/BookingSchedule.vue'

axios.defaults.headers.common['X-CSRF-TOKEN'] = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

createApp(CalendarApp).mount("#calendar-app");
createApp(BookingScheduleApp).mount("#booking-schedule-app");
