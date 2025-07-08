<template>
    <div class="event-timeline">
        <div class="container">
            <!-- 🔙 Back Icon Row -->
            <div style="text-align: initial; margin-bottom: 5px">
                <p style="font-size: 20px;font-weight: bold;color: black"><span style="font-size: 15px;" @click="goBack"> <i class="ti-angle-left"></i></span> {{title}} </p>
            </div>
        </div>



        <div>
            <div class="timeline-content">
                <h4 class="data-title">
                    <div class="row hotel-banner">
                        <div class="col-md-6 col-sm-6 col-7"> <span class="hotel-name">Hotel: {{hotelInfo.hotel.name}} </span></div>
                        <div style="text-align:right" class="col-md-6 col-sm-6 col-5"> <span class="room-number">Room: {{hotelInfo.room.number}}</span></div>

                    </div>

                </h4>
                <p><strong>Address:</strong> {{ hotelInfo.hotel.address }}</p>
                <p><strong>Check In :</strong> {{ hotelInfo.hotel.check_in }}</p>
            </div>
        </div>
    </div>


</template>
<script>
import {Common} from "../../mixins/common";
export default {

    mixins: [Common],
    data() {
        return {
            searchText: '',
            selectedDate: '',
            hotelInfo: {
                hotel: {
                    name: '' ,

                },
                room:{
                    number: ''
                }
            },
            title:'Room & Hotel Info'
        };
    },
    computed: {
        filteredHotels() {
            return this.hotels.filter(data => {
                const searchMatch = this.searchText === '' || (
                    data.name.toLowerCase().includes(this.searchText.toLowerCase()) ||
                    data.room.toLowerCase().includes(this.searchText.toLowerCase())
                );

                const dateMatch = this.selectedDate === '' || data.date === this.selectedDate;

                return searchMatch && dateMatch;
            });
        }
    },
    mounted() {
        this.getData();
    },
    methods: {
        openFeedback(index) {
            this.selectedEventIndex = index;
            this.showModal = true;
        },
        getData() {
            this.axiosGet('room-hotel-data', (response) => {
                this.hotelInfo = response.hotelInfo
            }, (error) => {
                this.errorNoti(error);
            });
        },
        goBack() {
            this.$router.go(-1); // or use this.$router.push({ name: 'YourPreviousRoute' });
        },
    }
};
</script>

<style scoped>
.filter-bar {
    display: flex;
    flex-wrap: wrap;
    gap: 12px;
    margin-bottom: 20px;
    align-items: center;
}

.search-input,
.date-input {
    padding: 8px 12px;
    border: 1px solid #cbd5e0;
    border-radius: 6px;
    font-size: 14px;
    flex: 1;
    min-width: 220px;
}
.event-timeline {
    display: flex;
    flex-direction: column;
    position: relative;
}

.timeline-item {
    display: flex;
    position: relative;
    margin-bottom: 25px;
}

.timeline-marker {
    position: relative;
    width: 30px;
    display: flex;
    flex-direction: column;
    align-items: center;
}

.marker-circle {
    width: 24px;
    height: 24px;
    border-radius: 50%;
    background: #0C2189;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 13px;
    font-weight: bold;
    z-index: 2;
}

.timeline-line {
    width: 2px;
    flex: 1;
    background: #d1d5db;
    margin-top: 2px;
}

.timeline-content {
    background: #EFF2FF;
    border-radius: 10px;
    padding: 12px 16px;
    flex: 1;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
}
.timeline-content:hover {
    background-color: #0C2189;
    color: white;
    cursor: pointer;
}

.timeline-content:hover .event-date,
.timeline-content:hover .event-time {
    background-color: #3b82f6;
    color: white;
}

.timeline-content:hover .feedback-btn {
    background-color: #2563eb;
    color: white;
}

.data-title {
    margin: 0 0 5px;
    font-size: 16px;
}
.hotel-banner{
    background: #0C2189;
    color: #ffffff;
    border-radius: 10px;
    padding: 5px 0;
}

.event-meta {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 10px;
    margin-top: 8px;
}

.event-date,
.event-time {
    background: #e0e7ff;
    padding: 4px 10px;
    border-radius: 5px;
    font-size: 13px;
}

.feedback-btn {
    margin-left: auto;
    background-color: #1e40af;
    color: white;
    border: none;
    padding: 6px 12px;
    border-radius: 5px;
    font-size: 13px;
    cursor: pointer;
}

.feedback-btn:hover {
    background-color: #2563eb;
}

/* Mobile Responsive */
@media (max-width: 768px) {
    .filter-bar {
        flex-direction: column;
        align-items: stretch;
    }
    .event-meta {
        align-items: flex-start;
    }

    .feedback-btn {
        margin-left: 0;
        margin-top: 10px;
    }
}
.event-card {
    background: #f1f5f9;
    border-radius: 8px;
    padding: 15px;
    margin: 10px 0;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
}

button {
    background-color: #1e3a8a;
    color: white;
    border: none;
    padding: 8px 12px;
    border-radius: 6px;
    cursor: pointer;
}

.modal-overlay {
    position: fixed;
    top: 0; left: 0; right: 0; bottom: 0;
    background-color: rgba(0,0,0,0.4);
    display: flex;
    align-items: center;
    justify-content: center;
}

.modal-content {
    background: #EFF2FF;
    color: #000000;
    padding: 25px;
    border-radius: 12px;
    width: 300px;
    position: relative;
}

.slider-wrap {
    display: flex;
    align-items: center;
    justify-content: space-between;
}

textarea {
    width: 100%;
    height: 70px;
    margin-top: 10px;
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 6px;
    resize: none;
}

.close-btn {
    position: absolute;
    right: 12px;
    top: 12px;
    background: #6C85FF;
    color: #FFFFFF;
    font-size: 13px;
    border-radius: 20px;
    padding: 4px 10px;
}
</style>
