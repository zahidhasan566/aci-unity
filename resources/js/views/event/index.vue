<template>
    <div class="event-timeline">
        <div class="container">
            <!-- 🔙 Back Icon Row -->
            <div style="text-align: initial; margin-bottom: 5px">
                <p style="font-size: 20px;font-weight: bold;color: black"><span style="font-size: 15px;" @click="goBack"> <i class="ti-angle-left"></i></span> {{title}} </p>
            </div>


            <!-- 🔍 Filter Row -->
            <div class="row mb-3">
                <div class="col-6 pe-1">
                    <input
                        type="text"
                        v-model="searchText"
                        placeholder="🔍 Search by title or sub..."
                        class="form-control"
                    />
                </div>

                <div class="col-6 ps-1">
                    <input
                        type="date"
                        v-model="selectedDate"
                        class="form-control"
                    />
                </div>
            </div>

        </div>



        <div
            v-for="(event, index) in filteredEvents"
            :key="index"
            class="timeline-item"
        >
            <div class="timeline-marker">
                <span class="marker-circle">{{ index + 1 }}</span>
                <div class="timeline-line" v-if="index !== events.length - 1"></div>
            </div>

            <div class="timeline-content">
                <h4 class="event-title">⭐ {{ event.Title }}</h4>
                <p><strong>Des:</strong> {{ event.Description }}</p>
                <p><strong>Venue:</strong> {{ event.Venue }}</p>
                <div class="event-meta">
                    <span class="event-date">📅 {{ event.EventDate }}</span>
                    <span class="event-time">🕘 {{ moment(event.StartTime, 'HH:mm:ss').format('hh:mm A') }}</span>
<!--                    <button class="feedback-btn"   v-show="!event.feedback || event.feedback.length === 0" @click="openFeedback(index)">Feedback</button>-->
                </div>
            </div>
        </div>
        <!-- Feedback Modal -->
        <div v-if="showModal" class="modal-overlay">
            <div class="modal-content">
                <h5>Submit Feedback</h5>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                <label>Overall Rating</label>
                <div class="slider-wrap">
                    <input type="range" style="color: #6C85FF" min="1" max="5" v-model="rating" />
                    <span>{{ rating }}★</span>
                </div>
                <textarea v-model="feedbackText" style="margin-bottom:15px" placeholder="Type Here..."></textarea>
                <button @click="submitFeedback">Submit</button>
                <button class="close-btn" @click="showModal = false">×</button>
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
            title:'Event Schedule',
            searchText: '',
            selectedDate: '',
            events: [],
            // events: [
            //     {
            //         title: "Annual Marketing and Sales conference. 2025",
            //         sub: "Introduction to SAR",
            //         venue: "Sayeman Beach Resort, 2nd Floor, Room 345",
            //         date: "Monday, 27 July",
            //         time: "09:00 - 10:00",
            //     },
            //     {
            //         title: "Monthly Marketing and Sales conference. 2025",
            //         sub: "Introduction to SAR",
            //         venue: "Sayeman Beach Resort, 2nd Floor, Room 345",
            //         date: "Monday, 27 July",
            //         time: "09:00 - 10:00",
            //     },
            //     {
            //         title: "Annual Marketing and Sales conference. 2025",
            //         sub: "Introduction to SAR",
            //         venue: "Sayeman Beach Resort, 2nd Floor, Room 345",
            //         date: "Monday, 27 July",
            //         time: "09:00 - 10:00",
            //     },
            //     // Add more events as needed
            // ],
            showModal: false,
            selectedEventIndex: null,
            rating: 3,
            feedbackText: '',
        };
    },
    mounted() {
        this.getData();
    },
    computed: {
        filteredEvents() {
            return this.events.filter(event => {
                const searchMatch = this.searchText === '' || (
                    event.Title.toLowerCase().includes(this.searchText.toLowerCase()) ||
                    event.Description.toLowerCase().includes(this.searchText.toLowerCase())
                );

                const dateMatch = this.selectedDate === '' || event.EventDate === this.selectedDate;

                return searchMatch && dateMatch;
            });
        }
    },
    methods: {
        openFeedback(index) {
            this.selectedEventIndex = index;
            this.showModal = true;
        },
        goBack() {
            this.$router.go(-1); // or use this.$router.push({ name: 'YourPreviousRoute' });
        },
        getData() {
            this.axiosGet('event-schedule-data', (response) => {
                this.events = response.eventInfo
                this.isLoading = false;
            }, (error) => {
                this.errorNoti(error);
            });
        },
        async submitFeedback() {
            let url = 'store-event-feedback';
            this.axiosPost(url, {
                event: this.events[this.selectedEventIndex],
                rating: this.rating,
                feedback: this.feedbackText,
            }, (response) => {
                this.rating = '3';
                this.feedbackText = '';
                this.successNoti(response.message);
                this.showModal = false
                this.getData();
            }, (error) => {
                this.errorNoti(error);
            })
            // const payload = {
            //     event: this.events[this.selectedEventIndex],
            //     rating: this.rating,
            //     feedback: this.feedbackText,
            // };
            //
            // try {
            //     const response = await this.$http.post('https://your-api.com/submit-feedback', payload);
            //     alert("Feedback submitted successfully!");
            //     this.showModal = false;
            //     this.rating = 3;
            //     this.feedbackText = '';
            // } catch (error) {
            //     console.error("Error submitting feedback:", error);
            //     alert("Submission failed.");
            // }
        }
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

.event-title {
    margin: 0 0 5px;
    font-size: 16px;
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
