<template>
    <div>
        <div style="text-align: initial; margin-bottom: 5px">
            <p style="font-size: 20px;font-weight: bold;color: black"><span style="font-size: 15px;" @click="goBack"> <i class="ti-angle-left"></i></span> {{title}} </p>
        </div>
        <div class="container">
            <h4>{{photo.Title}}</h4>

            <div class="d-flex flex-column align-items-center p-2 h-100">
                <div class="img-wrapper mb-2">
                    <img
                        :src="`${mainOrigin}assets/images/award1.png`"
                        alt="award"
                        class="slide-img"

                    />
                </div>
            </div>
            <div class="timeline-content">
                <p style="margin:0"><strong>Upload Date: {{ photo.UploadDate }}</strong> </p>
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
            galleryId: '',
            title:'Gallery Details',
            photo:{}
        };
    },
    mounted() {
         this.galleryId = this.$route.params.id;

        this.axiosGet('get-photo-gallery-details/'+ this.galleryId, (response) => {
            this.photo = response.photo
        }, (error) => {
            this.errorNoti(error);
        });
    },
    methods: {
        goBack() {
            this.$router.go(-1); // or use this.$router.push({ name: 'YourPreviousRoute' });
        }
    }
}

</script>
