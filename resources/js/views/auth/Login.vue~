<template>
  <div>
    <div class="wrapper-page">
      <div class="card overflow-hidden account-card mx-3">
          <div class="image-container">
              <img :src="`${mainOrigin}assets/images/loginBg.jpg`" alt="Background Image" class="background-image">
              <div class="image-text">ACI <br> <span style="color: white">Unity</span></div>
          </div>
<!--        <div class="bg-gradient p-4 text-white text-center position-relative">-->
<!--            -->
<!--          <h4 class="font-25 m-b-5">Aci Conference</h4>-->
<!--        </div>-->
        <div class="account-card-content">
          <ValidationObserver v-slot="{ handleSubmit }">
            <form class="form-horizontal m-t-30" @submit.prevent="handleSubmit(onSubmit)">
              <ValidationProvider name="User ID" mode="eager" rules="required" v-slot="{ errors }">
                <div class="form-group">
                  <label for="username">User Id</label>
                  <input type="text" class="form-control" :class="{'error-border': errors[0]}" id="usermailorphone"
                         v-model="usermailorphone" name="usermailorphone" placeholder="User Id" autocomplete="off">
                  <span class="error-message"> {{ errors[0] }}</span>
                </div>
              </ValidationProvider>
              <ValidationProvider name="Password" mode="eager" rules="required" v-slot="{ errors }">
                <div class="form-group">
                  <label for="user-password">Password</label>
                  <input type="password" v-model="password" class="form-control" :class="{'error-border': errors[0]}"
                         id="user-password" placeholder="Password" autocomplete>
                  <span class="error-message">{{ errors[0] }}</span>
                </div>
              </ValidationProvider>
              <submit-form name="Log In"/>
            </form>
          </ValidationObserver>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import {Common} from '../../mixins/common'
import moment from "moment";

export default {
  mixins: [Common],
  data() {
    return {
      usermailorphone: '',
      userID: '',
      password: '',
    }
  },
  computed: {
    now() {
      return moment()
    }
  },
  mounted() {
    // this.getData();
  },
  methods: {
    onSubmit() {
      this.$store.commit('submitButtonLoadingStatus', true);
      this.axiosPostWithoutToken('login', {
        userID: this.usermailorphone,
        password: this.password
      }, (response) => {
          console.log(response)
        localStorage.setItem("token", response.access_token);
        this.successNoti('Successfully logged in.');
        this.$store.commit('submitButtonLoadingStatus', false);
        this.redirect(this.mainOrigin + 'dashboard')
      }, (error) => {
        this.errorNoti(error);
        this.$store.commit('submitButtonLoadingStatus', false);
      })
    }
  }
}
</script>

<style scoped>
.image-container {
    position: relative;
    width: 100%;
    max-width: 600px; /* Optional: adjust for layout */
}

.background-image {
    width: 100%;
    display: block;
    border-radius: 10px;
}

.image-text {
    position: absolute;
    top: 10px;
    width: 100%;
    text-align: center;
    font-size: 28px;
    font-weight: bold;
    color: #5DFFA7;
    text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
}
</style>
