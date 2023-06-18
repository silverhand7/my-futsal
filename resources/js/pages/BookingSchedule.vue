<template>
    <div class="booking-container">
        <div class="row mb-3">
            <div class="col-md-6">
                <input type="date" v-model="date" @change="changeDate" class="form-control">
            </div>
            <div class="col-md-12 mt-4" v-if="fieldMessage != ''">
                <div class="alert alert-warning">
                    <b>Information:</b> {{ fieldMessage }}
                </div>
            </div>
        </div>
        <div class="row">
            <div
                v-for="field in fields" :key="field.id"
                class="col-4"
            >
                <div v-if="field.id != 4">
                    <h2 class="field-name">{{ field.name }}</h2>
                    <div v-for="hour, index in hours" :key="index">
                        <div :class="['booking-hour',
                                (selectedHours.includes(hour) && selectedField.id == field.id) ? 'booking-hour-selected' : '',
                                bookedHours[field.id].includes(hour) ? 'booking-disabled' : '',
                                checkDisabledHour(hour) ? 'booking-disabled' : '',
                                checkDisabledField(field.id, hour) ? 'booking-disabled' : '',
                            ]"
                            v-on:click="handleClickHour(field, hour, index)"
                            v-on:mousedown="handleMouseDown"
                            v-on:mouseup="handleMouseUp"
                            v-on:mousemove="handleMouseMove(field, hour, index)"
                            >
                            {{ hour }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </template>

    <script>
    import axios from 'axios';

    export default {
        data() {
            return {
                bookings: [],
                fields: [],
                bookedHours: [],
                selectedField: '',
                fieldMessage: '',
                selectedHours: [],
                isDragging: false,
                date: new Date().toISOString().substr(0, 10),
                // date: '2023-04-17',
                hours: this.getHours(),
            }
        },
        async created() {
            await this.getFields();
        },
        computed: {

        },
        methods: {
            handleMouseDown() {
                this.isDragging = true;
            },

            handleMouseUp() {
                this.isDragging = false;
                setTimeout(() => {
                    if (this.selectedHours.length !== 0) {
                        const startHour = this.selectedHours[0].split(' - ', 1)[0];
                        const endHour = this.selectedHours[this.selectedHours.length - 1].split(' - ')[1];
                        if (window.confirm(`Are you sure you will book the ${this.selectedField.name} on ${this.date} at ${startHour} - ${endHour}`)) {
                            axios.post('/booking', {
                                field_id: this.selectedField.id,
                                date: this.date,
                                starting_hour: this.selectedHours[0],
                                duration: this.selectedHours.length
                            }).then(response => {
                                window.location = response.data.path;
                            }).catch(error => {
                                alert(error.response.data.message);
                                window.location.reload();
                            })
                        } else {
                            this.selectedHours = [];
                        }
                    }
                }, 100);

            },
            handleMouseMove(field, hour, index) {
                if(this.isDragging) {
                    if (!this.checkDisabledHour(hour) && !this.checkDisabledField(field.id, hour)) {
                        this.selectField(field);
                        this.selectHour(hour);
                    } else {
                        this.isDragging = false;
                        this.selectedHours = [];
                    }
                }
            },
            handleClickHour(field, hour, index) {
                if (!this.checkDisabledHour(hour) && !this.checkDisabledField(field.id, hour)) {
                    this.selectField(field);
                    this.selectHour(hour);
                }
                // this.handleMouseUp();
            },
            selectHour(hour) {
                if (this.selectedHours.find(el => hour == el) === undefined) {
                    this.selectedHours.push(hour)
                } else {

                }
                // console.log(this.selectedHours);
            },

            checkDisabledHour(hour) {
                const todayDate = new Date().toISOString().substr(0, 10);
                const currentHour = new Date().getHours();
                hour = hour.substring(0, 2);

                if (todayDate == this.date) {
                    if (hour >= currentHour) {
                        return false;
                    } else {
                        return true;
                    }
                }
            },

            checkDisabledField(fieldId, hour) {
                if (fieldId == 3) {
                    if (this.bookedHours[2].includes(hour)) {
                        return true;
                    }
                    if (this.bookedHours[1].includes(hour)) {
                        return true;
                    }
                } else {
                    // console.log(this.bookedHours[3].includes(hour));
                    if (this.bookedHours[3].includes(hour)) {
                        return true;
                    }
                }

                if (this.bookedHours[4].includes(hour)) {
                    return true;
                }
            },

            selectField(field) {
                this.selectedField = field;
            },

            checkBookingsHour(field) {
                let data = [];
                for (let i = 0; i < field.bookings.length; i++) {
                    let diff = (field.bookings[i].ending_timestamp - field.bookings[i].starting_timestamp) / 60 / 60;
                    let starting_hour = field.bookings[i].starting_hour.slice(0, -3);
                    let starting_hour_index = this.getHours().indexOf(starting_hour + ' - ' + this.hourAddition(starting_hour));
                    let hour = '';
                    console.log(diff);
                    for (let j = 0; j < diff; j++) {
                        hour = this.getHours()[starting_hour_index + j];
                        // console.log(hour);
                        data.push(hour);
                    }
                }
                // console.log(data);
                return data;
            },

            hourAddition(hour) {
                let number = parseInt(hour.slice(0, 2)) + 1;

                if (number == 24){
                    return number.toString().length == 1 ? `0${number}:00` : `00:00`;
                }

                return number.toString().length == 1 ? `0${number}:00` : `${number}:00`;
            },

            async changeDate() {
                await this.getFields();
            },

            async getFields() {
                this.fields = [];
                this.bookedHours = [];
                await axios.get('./api/get-fields/'+this.date).then(response => {
                    this.fields = response['data'];

                    this.fields.forEach(field => {
                        this.bookedHours[field.id] = this.checkBookingsHour(field);
                    })

                    this.fieldMessage = this.fields.find(field => field.id == 4)?.bookings[0]?.note ?? '';
                    // console.log(this.fields);
                    console.log(this.bookedHours);
                })
            },

            getHours() {
                return [
                    '08:00 - 09:00',
                    '09:00 - 10:00',
                    '10:00 - 11:00',
                    '11:00 - 12:00',
                    '12:00 - 13:00',
                    '13:00 - 14:00',
                    '14:00 - 15:00',
                    '15:00 - 16:00',
                    '16:00 - 17:00',
                    '17:00 - 18:00',
                    '18:00 - 19:00',
                    '19:00 - 20:00',
                    '20:00 - 21:00',
                    '21:00 - 22:00',
                    '22:00 - 23:00',
                    '23:00 - 00:00',
                ]
            },
        }
    }
  </script>

  <style>

  .booking-hour {
    -webkit-user-select: none; /* Safari */
    -ms-user-select: none; /* IE 10 and IE 11 */
    user-select: none; /* Standard syntax */
    width: 100%;
    padding: 10px;
    background: #218838;
    border: 1px solid #218838;
    color: white;
    margin-bottom:10px;
    border-radius: 5px;
    cursor: pointer;
  }
  .booking-hour:hover {
    background: #52b668;
  }

  .booking-hour-selected {
    background: #52b668;
    border: 1px solid #52b668;
    color:white
  }

  :not(.booking-hour-selected).booking-disabled {
    cursor: no-drop;
    background: #C82433;
    border-color: #C82433;
}

  @media screen and (max-width: 480px) {
    .field-name {
        font-size: 20px;
    }
  }
  </style>