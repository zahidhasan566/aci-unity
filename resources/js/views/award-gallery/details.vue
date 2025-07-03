<template>
    <div>
        <div style="text-align: initial; margin-bottom: 5px">
            <p style="font-size: 20px;font-weight: bold;color: black"><span style="font-size: 15px;" @click="goBack"> <i class="ti-angle-left"></i></span> {{title}} </p>
        </div>
        <div class="container">
            <h4>{{award.Title}}</h4>

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
                <p style="margin:0"><strong>Title: {{ award.Title }} </strong></p>
                <p style="margin:0"><strong>Year: {{ award.Year }}</strong> </p>
                <p style="margin:0"><strong>Category: {{ award.Category }}</strong> </p>
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
            title:'Award Gallery Details',
            award:{}
        };
    },
    mounted() {
         this.galleryId = this.$route.params.id;

        this.axiosGet('get-award-gallery-details/'+ this.galleryId, (response) => {
            this.award = response.award
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


<style scoped>
.img-wrapper {
    width: 100%;
    min-height: 100px;
    max-height: 100px;
    display: flex;
    justify-content: center;
    align-items: center;
    overflow: hidden;
}
.timeline-content {
    background: #EFF2FF;
    border-radius: 10px;
    padding: 12px 16px;
    flex: 1;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
}
</style>
