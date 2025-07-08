<template>
    <div class="container">
        <div style="text-align: initial; margin-bottom: 5px">
            <p style="font-size: 20px;font-weight: bold;color: black"><span style="font-size: 15px;" @click="goBack"> <i class="ti-angle-left"></i></span> {{title}} </p>
        </div>
        <div class="icon-wrapper">
            <img
                :src="`${mainOrigin}assets/images/dresscode.jpg`"
                alt="Dresscode Image"
                class="dresscode-large"
            >
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

            title:'Dress Code'
        };
    },
    methods: {
        goBack() {
            this.$router.go(-1); // or use this.$router.push({ name: 'YourPreviousRoute' });
        },
    }
};
</script>


<style scoped>
.dresscode-large {
    width: 100%;
    max-width: 700px;
    height: auto;
    display: block;
    margin: 0 auto; /* center it */
}
</style>
