<template>
    <div class="production-officer-home">
        <!-- Header Section -->
        <div class="header">
            <div class="profile-header d-flex align-items-center flex-wrap justify-content-between">
                <!-- Left Section: Profile Icon & Greeting -->
                <div class="d-flex align-items-center flex-grow-1 col-md-7 col-7">
                    <!-- Profile Icon -->
                    <div class="profile-icon me-3">
                        <img :src="`${mainOrigin}assets/icon/profile.png`" alt="Profile Image" class="profile">
                    </div>

                    <!-- Greeting Section -->
                    <div class="greeting">
                        <p class="time">{{ greetingMessage }}</p>
                        <h1 class="name">{{me.UserName}}</h1>
                    </div>
                </div>

                <!-- Right Section: Check-In & Notification -->
                <div class="actions d-flex align-items-center justify-content-end col-md-5 col-5">
                    <label class="btn btn-checkin m-0"
                           :style="checkingDone ? 'opacity: 0.6; pointer-events: none;' : ''"
                           style="font-size: 10px; background: linear-gradient(135deg, #35ACBC 0%, #154F9E 100%); border-radius:15px; color: #FFFFFF"
                           :class="{ checked: isCheckedIn }">

                        <input type="checkbox" @change="handleCheckin" v-model="isCheckedIn" class="d-none" />

                        <i :class="['me-1', isCheckedIn ? 'fas fa-sign-out-alt' : 'fas fa-sign-in-alt']"></i>

                        {{ isCheckedIn ? "Check Out" : "Check In" }}
                    </label>

                </div>

            </div>


            <div class="remainingHeader">
                <div class="welcome-message">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-12">
                            <h6>    Welcome to the Marketing & Sales Conference 2025–26 of ACI Pharma Business</h6>
                            <p>We are thrilled to have you join us for this milestone event — a celebration of our achievements, a time to recognize our champions, and a platform to shape the future together.
                                Let’s recharge our passion, realign our strategies, and reignite the momentum as we move forward into a new era of excellence.</p>

                            <p> <span style="font-size: 14px">Customer Core, Achieve More</span>
                                <br><br>
                                <span style="margin-top: 10px;font-size: 16px;line-height: 1.2;">
                                    M Mohibuz Zaman <br>
                                MD & CEO , ACI HealthCare Limited
                                </span>

                            </p>

                        </div>
<!--                        <div class="col-md-6 col-sm-6 col-4">-->
<!--                            <div class="profile-icon-community">-->
<!--                                <img :src="`${mainOrigin}assets/icon/community.png`" alt="profile Image" class="profile"></div>-->

<!--                        </div>-->

                    </div>



                </div>
            </div>

        </div>
        <div class="hotel-banner">
            <div style="flex: 1; min-width: 250px; text-align: left;">
        <span v-if="hotelInfo && hotelInfo.hotel" class="hotel-name">
            🏨 Hotel: {{hotelInfo.hotel.name}}
        </span>
            </div>
            <div style="text-align: right;">
        <span v-if="hotelInfo && hotelInfo.room" class="room-number">
            🚪 Room: {{hotelInfo.room.number}}
        </span>
            </div>
        </div>

        <!-- Upcoming Event Section -->
        <div class="upcoming-events">
            <div class="section-header">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-9"> <h5>Upcoming Event Schedule  <span class="count">{{eventInfo.length -1 }}</span></h5></div>
                    <div class="col-md-6 col-sm-6 col-3" style="text-align:right">
                        <router-link :to="{ name: 'eventIndex' }" class="see-all">See All</router-link>
                    </div>
                </div>
            </div>
        </div>

        <!-- Event Slider -->
        <div class="event-slider">
            <!-- Swiper Slider -->
            <swiper  :options="swiperOptions">
                <swiper-slide v-for="(event, index) in eventInfo" :key="index">
                    <div  :class="['event-card highlight'] ">
                        <h3 class="event-title">⭐ {{ event.Title }}</h3>
                        <p><strong>Des:</strong> {{ event.Description }}</p>
                        <p><strong>Venue:</strong> {{ event.Venue }}</p>
                        <div class="event-footer">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-6"> <span>📅 {{ event.EventDate }}</span></div>
                                <div class="col-md-6 col-sm-6 col-6"><span>⏰ {{ moment(event.StartTime, 'HH:mm:ss').format('hh:mm A') }}</span></div>
                            </div>


                        </div>
                    </div>
                </swiper-slide>
            </swiper>
        </div>

        <!-- Bottom Menu -->
        <div class="bottom-menu">
            <button class="menu-btn" @click="goToMap">
                📍 Hotel Map
            </button>
            <button class="menu-btn">👔   <router-link :to="{ name: 'dressCodeIndex' }" class="see-all">Dress Code</router-link></button>
            <button class="menu-btn">📅 <router-link :to="{ name: 'eventIndex' }" class="see-all">Schedule</router-link></button>
        </div>

        <!-- Quick Links Section -->
        <div class="quick-links">
            <router-link :to="{ name: 'eventIndex' }" class="quick-link-btn full-link">
                <div class="icon-wrapper">
                    <img :src="`${mainOrigin}assets/icon/appointment.png`" alt="appointment Image" class="appointment">
                </div>
                <div class="btn-text">
                    Event Schedule
                </div>
            </router-link>

            <router-link :to="{ name: 'hotelIndex' }" class="quick-link-btn full-link">
                <div class="icon-wrapper">
                    <img :src="`${mainOrigin}assets/icon/condominium.png`" alt="condominium Image" class="condominium">
                </div>
                <div class="btn-text">
                    Room & Hotel Info
                </div>
            </router-link>
            <router-link :to="{ name: 'travelIndex' }" class="quick-link-btn full-link">
                <div class="icon-wrapper">
                    <img :src="`${mainOrigin}assets/icon/travel.png`" alt="travel Image" class="travel">
                </div>
                <div class="btn-text">
                    Travel Info
                </div>
            </router-link>
            <router-link :to="{ name: 'helplineIndex' }" class="quick-link-btn full-link">
                <div class="icon-wrapper">
                    <img :src="`${mainOrigin}assets/icon/customer-support.png`" alt="customer-support Image" class="customer-support">
                </div>
                <div class="btn-text">
                    Helpline
                </div>
            </router-link>

        </div>

<!--        <div-->
<!--            v-for="(event, index) in eventInfo"-->
<!--            :key="index"-->
<!--            class="timeline-item"-->
<!--        >-->
<!--            <div class="timeline-marker">-->
<!--                <span class="marker-circle">{{ index + 1 }}</span>-->
<!--                <div class="timeline-line" v-if="index !== eventInfo.length - 1"></div>-->
<!--            </div>-->

<!--            <div class="timeline-content">-->
<!--                <h4 class="event-title">⭐ {{ event.Title }}</h4>-->
<!--                <p><strong>Des:</strong> {{ event.Description }}</p>-->
<!--                <p><strong>Venue:</strong> {{ event.Venue }}</p>-->
<!--                <div class="event-meta">-->
<!--                    <span class="event-date">📅 {{ event.EventDate }}</span>-->
<!--                    <span class="event-time">🕘 {{ moment(event.StartTime, 'HH:mm:ss').format('hh:mm A') }}</span>-->
<!--                    &lt;!&ndash;                    <button class="feedback-btn"   v-show="!event.feedback || event.feedback.length === 0" @click="openFeedback(index)">Feedback</button>&ndash;&gt;-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->

<!--         Gallery Section -->
        <div class="award-section">
            <div class="section-header">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-9"> <h5>Award Winners Gallery </h5></div>
                    <div class="col-md-6 col-sm-6 col-3" style="text-align:right">
                        <router-link :to="{ name: 'AwardGallery' }" class="see-all">See All</router-link>
                    </div>
                </div>
            </div>
            <div class="awards-swiper">
                <!-- Swiper Slider -->
                <swiper  :options="swiperOptions">
                    <swiper-slide v-for="(award, index) in awards" :key="index">
                        <div class="slide-card">
                            <img      @click="openSingleAwardPageData(award.AwardID)"  :src="`${mainOrigin}assets/award/${award.Photo}`" alt="award" class="slide-img" />
                            <h5  style="text-align: center"   @click="openSingleAwardPageData(award.AwardID)"  class="slide-title">{{ truncateText(award.Title, 40) }}</h5>
                        </div>
                    </swiper-slide>
                </swiper>
            </div>
        </div>

        <!-- Seller Section -->
<!--        <div class="gallery-section">-->
<!--            <div class="section-header">-->
<!--                <div class="row">-->
<!--                    <div class="col-md-6 col-sm-6 col-9"> <h5>Gallery </h5></div>-->
<!--                    <div class="col-md-6 col-sm-6 col-3" style="text-align:right">-->
<!--                        <router-link :to="{ name: 'galleryIndex' }" class="see-all">See All</router-link>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class="awards-swiper">-->
<!--                &lt;!&ndash; Swiper Slider &ndash;&gt;-->
<!--                <swiper  :options="swiperOptions">-->
<!--                    <swiper-slide v-for="(gallery, index) in gallery" :key="index">-->
<!--                        <div class="slide-card">-->
<!--                            <img @click="openSingleGalleryPageData(gallery.PhotoID)" :src="`${mainOrigin}assets/images/award1.png`" alt="award" class="slide-img" />-->
<!--                        </div>-->
<!--                    </swiper-slide>-->
<!--                </swiper>-->
<!--            </div>-->
<!--        </div>-->
    </div>
</template>
<script>
import {Common} from "../../mixins/common";
import {bus} from "../../app";
export default {

  mixins: [Common],

  data() {
    return {
      isLoading: true,
      isCheckedIn: false,
      loadingCheck: false,
     checkingDone: false,
      hotelInfo: {
            hotel: {
                name: '' ,

            },
            room:{
                number: ''
            }
        },
      eventInfo: [],
      awards: [],
      gallery :[],
        awardsImage: [
            {
                id: 1,
                image: 'award1.png',
                title: 'Loren Ipsum Is simply',
                highlight: true,
                details: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. ',
            },
            {
                id: 2,
                image: 'award2.png',
                title: 'Loren Ipsum Is simply',
                highlight: true,
                details: 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. ',
            }
        ],
        swiperOptions: {
            loop: false,
            slidesPerView: 'auto',
            spaceBetween: 12,
            autoplay: {
                delay: 2000,
                disableOnInteraction: false,
                pauseOnMouseEnter: false,
            },
            // speed: 10000, // controls scroll speed, lower = faster
            freeMode: true,
            freeModeMomentum: false,
            grabCursor: true,
            breakpoints: {
                // For mobile
                0: {
                    slidesPerView: 'auto',
                    spaceBetween: 10
                },
                // For tablets and up
                768: {
                    slidesPerView: 'auto',
                    spaceBetween: 20
                }
            }
        },
    }
  },
  computed: {
    me() {
      return this.$store.state.me
    },
      greetingMessage() {
          const hour = new Date().getHours();
          if (hour >= 5 && hour < 12) return 'Good Morning';
          if (hour >= 12 && hour < 17) return 'Good Afternoon';
          if (hour >= 17 && hour < 21) return 'Good Evening';
          return 'Good Night';
      }
  },
  created() {
    this.getProfileData();
    this.getData();
  },
    mounted() {},
  methods: {
      handleCheckin(event) {
          if (this.loadingCheck) return; // Prevent double click

          this.loadingCheck = true;
          console.log("Checked In:", this.isCheckedIn);

          let flag = this.isCheckedIn ? 'checkIn' : 'checkOut';

          let url = 'user/check-in'
          this.axiosPost(url, {
              isCheckedIn: this.isCheckedIn,
              flag: flag,
          }, (response) => {
              this.successNoti(response.message);
              console.log('ff',response.checkingDone)
              if(response.checkingDone) this.checkingDone = true
              this.loadingCheck = false;
          }, (error) => {
              this.errorNoti(error);
          })
      },
      getProfileData() {
          this.axiosGet('app-supporting-data', (response) => {
              this.menus = response.menus;
              this.$store.commit('me', response.user);
              setTimeout(() => {
                  $("#side-menu").metisMenu();
              })
          }, (error) => {
              this.errorNoti(error)
          })
      },
      toggleCheckIn() {
          this.isCheckedIn = !this.isCheckedIn;
      },
      truncateText(text, maxLength = 50) {
          if (!text) return '';
          return text.length > maxLength ? text.slice(0, maxLength) + '...' : text;
      },
      openSingleAwardPageData(id) {
          this.$router.push(`/aci-unity/single-details/${id}`);
      },
      openSingleGalleryPageData(id) {
          this.$router.push(`/aci-unity/gallery-info/single-details/${id}`);
      },
    getData() {
            this.axiosGet('dashboard-data', (response) => {
            this.hotelInfo = response.hotelInfo;
            this.eventInfo = response.eventInfo;
            this.awards = response.awards
            this.gallery  = response.gallery
            this.isLoading = false;
            if(response.checkIn==='checkIn'){
                this.isCheckedIn = true
            }
            else{
                this.isCheckedIn = false
            }
            if(response.checkingDone) this.checkingDone = true

            }, (error) => {
            this.errorNoti(error);
            });
    },
      goToMap() {
          window.location.href = this.hotelInfo.hotel.map;
      }
  }
}
</script>


<style scoped>
/* Main Background */
.production-officer-home {
    background-color: #ffffff;
    font-family: 'Roboto', sans-serif;
}
.notification-dropdown {
    position: absolute;
    top: 100%;
    left: auto;
    right: 0;/* Align dropdown to the left of the bell icon */
    margin-top: 0.5rem;
    z-index: 1000;
    width: 250px;  /* fixed width or adjust as needed */
    max-height: 300px;
    overflow-y: auto;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

/* Header with Correct Gradient */
.header {
    /*padding: 25px 20px;*/
    color: white;
    border-radius: 0 0 15px 15px;
    margin-bottom: 25px;
    font-size: 11px;
    /*box-shadow: 0 4px 12px rgba(0,0,0,0.1);*/
}
.remainingHeader{
    background: linear-gradient(135deg, #0C2189 0%, #4BB5AC 100%);
}
.profile-icon-community{
    position: relative; /* or absolute depending on your layout */
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%; /* Optional: ensures the div fills parent vertically */
}
.profile-icon-community .profile {
    max-width: 100px; /* Adjust size as needed */
}
/* Header Styles */
.profile-header {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
    color: #000000;
}

.profile-icon {
    width: 50px;
    height: 50px;
    background-color: rgba(255,255,255,0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 15px;
    font-size: 24px;
}
.awards-swiper {
    padding-left: 12px;
    padding-right: 0;
    overflow-x: hidden;
}

/* Make each slide wrap its content */
.award-slide {
    width: auto !important;
}

/* Card layout */
.awards-swiper  .swiper-slide {
    width: auto !important;
    flex-shrink: 0;
}
.slide-card {
    display: flex;
    flex-direction: column;
    background: #fff;
    padding: 10px;
    border-radius: 10px;
    min-width: 180px;
    max-width: 220px;
    justify-content: space-between;
    width: fit-content;
    box-shadow: 0 1px 6px rgba(0,0,0,0.1);
}

/* Image style */
.slide-img {
    width: 100%;
    height: 120px;
    object-fit: cover;
    border-radius: 8px;
}

/* Text styles */
.slide-title,
.slide-desc {
    font-size: 14px;
    margin-top: 6px;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

/* Optional: Prevent Swiper adding trailing space */
.swiper-wrapper {
    display: flex;
}

.greeting .time {
    font-size: 16px;
    color: #080707b8;
    margin-bottom: 5px;
}

.greeting .name {
    font-size: 12px;
    margin: 0;
    color: #000000;
    font-weight: 600;
}

.welcome-message {
    /*background-color: rgba(255,255,255,0.15);*/
    padding: 15px;
    border-radius: 10px;
    margin: 15px 0;
}

.welcome-message h2 {
    margin-top: 0;
    color: white;
    font-size: 20px;
}

.hotel-info {
    background-color: rgba(255,255,255,0.2);
    padding: 12px 15px;
    border-radius: 8px;
    font-size: 14px;
}
.hotel-banner {
    display: flex;
    flex-wrap: wrap;             /* allow wrapping */
    justify-content: space-between;
    align-items: center;
    gap: 8px 0;
    padding: 12px;
    background-color: #EFF2FF;
    font-weight: 600;
    text-align: center;
    margin-bottom: 25px;
}

.hotel-name, .room-number {
    word-break: break-word;
    white-space: normal;
}
/*.hotel-banner {*/
/*    !*display: flex;*!*/
/*    flex-wrap: wrap;              !* allow wrap on small screens *!*/
/*    justify-content: center;      !* center horizontally *!*/
/*    align-items: center;          !* center vertically *!*/
/*    gap: 8px 20px;                !* vertical and horizontal spacing *!*/
/*    padding: 12px;*/
/*    background-color: #EFF2FF;*/
/*    font-weight: 600;*/
/*    !*font-size: 1rem;*!*/
/*    text-align: center;*/
/*    margin-bottom: 25px;*/
/*}*/

/*.hotel-name, .room-number {*/
/*    white-space: nowrap;*/
/*    overflow: hidden;*/
/*    text-overflow: ellipsis;*/
/*    display: inline-block;*/
/*    max-width: 100%;*/
/*}*/

/* Event Card Styling */


.event-slider {
    width: 100%;
    margin-bottom: 25px;
}
.event-card {
    background-color: #0C2189;
    padding: 15px;
    border-radius: 12px;
    width: 100%; /* Full width of swiper-slide */
    box-sizing: border-box;
}
.event-card.highlight {
    background-color: #0C2189;
    color: white;
}

.bottom-menu {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    gap: 8px;
    padding-bottom: 25px;
}

.menu-btn {
    /*flex: 1 1 45%;*/
    background-color: #EFF2FF;
    color: #959595;
    border: none;
    padding: 6px;
    border-radius: 10px;
    text-align: center;
    font-size: 14px;
    font-weight: 500;
    cursor: pointer;
    transition: 0.3s;
}

.menu-btn:hover {
    background-color: #0C2189;
    color: white;
}
@media (max-width: 385px) {
    /*.actions {*/
    /*    flex-wrap: wrap !important;*/
    /*    justify-content: center !important;*/
    /*    gap: 0.5rem !important;*/
    /*}*/
    .greeting .name{
        font-size: 12px;
    }
    .greeting .time {
        font-size: 11px;
    }

    .btn-checkin {
        flex: 1 1 100%;
        max-width: 150px; /* or adjust */
        text-align: center;
    }

    .notification-icon {
        flex: 1 1 auto;
    }

    /* Optional: reduce font size or padding */
    .btn-checkin, .notification-icon i {
        font-size: 0.9rem;
        padding: 0.4rem 0.7rem;
    }
}
@media (max-width: 576px) {
    .notification-dropdown {
        left: auto;     /* Same on mobile for consistency */
        right: 0;
    }
}
@media (max-width: 375px) {
    .hotel-banner {
        font-size: 0.9rem;
        gap: 6px 10px;
    }
}
/* Responsive adjustments */
@media (max-width: 480px) {
    .slide-card {
        min-width: 140px;
        max-width: 180px;
        padding: 8px;
    }

    .slide-title,
    .slide-desc {
        font-size: 12px;
    }
    .quick-link-btn {
        padding: 12px;
        width: 22%;
    }

    .icon-wrapper {
        width: 50px;
        height: 50px;
    }

    .icon-img {
        width: 24px;
        height: 24px;
    }

    .btn-text {
        font-size: 13px;
    }
    .quick-links {
        gap: 14px;
    }
    .hotel-banner {
        flex-direction: column;
    }
}

@media (max-width: 400px) {
    .hotel-banner {
        font-size: 0.9rem;
        gap: 6px 10px;
    }
    .quick-link-btn {
        padding: 12px;
        width: 22%;
    }
    .event-title {
        font-size: 14px;
    }
    .menu-btn {
        font-size: 13px;
    }
}

.action-btn {
    background-color: rgba(255,255,255,0.15);
    color: white;
    border: none;
    padding: 10px;
    border-radius: 6px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
    transition: background-color 0.3s;
}

.action-btn:hover {
    background-color: rgba(255,255,255,0.25);
}

.action-btn .icon {
    margin-right: 8px;
    font-size: 16px;
}

.count {
    background-color: #E4F2FF; /* Green */
    color: #4169E1;
    margin-left: 10px;
    border-radius: 10px;
    font-size: 12px;
}

.see-all {
    color: #1e88e5; /* Blue */
}

.action-btn {
    background-color: #e3f2fd; /* Light blue */
    color: #1976d2; /* Dark blue */
}

/* Quick Links Colors */
.quick-links {
    display: flex;
    gap: 16px;
    /*flex-wrap: wrap;*/
    /*justify-content: center;*/
    margin-bottom: 25px;
}

.quick-link-btn {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding: 12px 16px;
    background-color: #ffffff;
    color: #1e88e5;
    border:none !important;
    /*border: 1px solid #e1f0ff;*/
    /*border-radius: 10px;*/
    cursor: pointer;
    text-align: center;
    transition: box-shadow 0.3s;
}

.quick-link-btn:hover {
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.icon-wrapper {
    width: 60px;
    height: 60px;
    background: #F2F5FF;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 8px;
}

.icon-img {
    width: 30px;
    height: 30px;
    object-fit: contain;
}

.btn-text {
    font-size: 14px;
    font-weight: 500;
}
/* Gallery & Seller Items */
.gallery-item, .seller-item {
    background: white;
    border: 1px solid #e0e0e0;
}

.placeholder {
    background-color: #eceff1; /* Light gray */
    color: #90a4ae; /* Gray text */
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
/* Seller Section */
.seller-section {
    margin-top: 25px;
}
@media (min-width: 768px) {
    .event-actions {
        grid-template-columns: repeat(4, 1fr);
    }
    .quick-link-btn {
        padding: 12px;
        width: 24%;
    }

    .event-datetime {
        gap: 30px;
    }
    .quick-links {
        gap: 14px;
    }
}
/* Responsive Design */
@media (min-width: 600px) {
    .production-officer-home {
        padding: 20px;
    }

    .quick-link-btn {
        padding: 12px;
        width: 24%;
    }

    .greeting .time {
        font-size: 18px;
    }

    .greeting .name {
        font-size: 32px;
    }

    .welcome-message {
        padding: 20px;
    }

    .welcome-message h2 {
        font-size: 24px;
    }

    .welcome-message p {
        font-size: 16px;
    }

    .hotel-info {
        padding: 15px;
        font-size: 16px;
    }

    .section-header h3 {
        font-size: 20px;
    }

    .event-card {
        padding: 20px;
    }

    .event-card h4 {
        font-size: 18px;
    }

    .event-description, .event-date, .event-time {
        font-size: 16px;
    }

    .event-actions {
        grid-template-columns: repeat(4, 1fr);
    }


    .quick-link-btn .icon {
        font-size: 24px;
    }

    .quick-link-btn .btn-text {
        font-size: 14px;
    }

    .gallery-items {
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
    }

    .gallery-item, .seller-item {
        padding: 15px;
    }

    .gallery-item p, .seller-item p {
        font-size: 14px;
    }

    .placeholder {
        height: 150px;
    }
}

@media (min-width: 900px) {
    .quick-links {
        grid-template-columns: repeat(4, 1fr);
    }
    .quick-links {
        gap: 11px;
    }

    .event-actions {
        display: flex;
        flex-wrap: wrap;
    }

    .action-btn {
        padding: 8px 12px;
    }
}
</style>
