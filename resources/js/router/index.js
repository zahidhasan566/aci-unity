import Vue from 'vue'
import VueRouter from 'vue-router';
import Main from '../components/layouts/Main';
import Dashboard from '../views/dashboard/Index.vue';
import Login from '../views/auth/Login.vue';
import {baseurl} from '../base_url'
import NotFound from '../views/404/Index';

import Users from '../views/users/Index';
import ReportAllShopInformation from "../views/reports/reportAllShopInformation.vue";
import ApprovalIndex from "../views/approval/ApprovalIndex.vue";
import shopInformationPrint from "../views/reports/shopInformationPrint.vue";
import eventIndex from "../views/event/index.vue";
import hotelIndex from "../views/hotel/index.vue";
import travelIndex from "../views/travel/index.vue";
import helplineIndex from "../views/helpline/index.vue";
import AwardGallery from "../views/award-gallery/index.vue";
import singleDetails from "../views/award-gallery/details.vue";
import galleryIndex from "../views/gallery/index.vue";
import detailsGallery from "../views/gallery/details.vue";
import dressCodeIndex from "../views/event/dresscode.vue";

Vue.use(VueRouter);

const config = () => {
    let token = localStorage.getItem('token');
    return {
        headers: {Authorization: `Bearer ${token}`}
    };
}
const checkToken = (to, from, next) => {
    let token = localStorage.getItem('token');
    if (token === undefined || token === null || token === '') {
        next(baseurl + 'login');
    } else {
        next();
    }
};

const activeToken = (to, from, next) => {
    let token = localStorage.getItem('token');
    if (token === 'undefined' || token === null || token === '') {
        next();
    } else {
        next(baseurl);
    }
};

const routes = [
    {
        path: baseurl,
        component: Main,
        redirect: {name: 'Dashboard'},
        children: [
            //COMMON ROUTE | SHOW DASHBOARD DATA
            {
                path: baseurl + 'dashboard',
                name: 'Dashboard',
                component: Dashboard
            },
            //ADMIN ROUTE | SHOW USER LIST
            {
                path: baseurl + 'users',
                name: 'Users',
                component: Users
            },
            //Approval
            {
                path: baseurl + 'approval/approve-shop-requisition',
                name: 'ApprovalIndex',
                component: ApprovalIndex
            },
            //Report
            {
                path: baseurl + 'report/shop-information-report',
                name: 'ReportAllShopInformation',
                component: ReportAllShopInformation
            },
            {
                path: baseurl + 'report/shop-information-report/print/:shopId',
                name: 'shopInformationPrint',
                component: shopInformationPrint
            },
            {
                path: baseurl + 'all-event',
                name: 'eventIndex',
                component: eventIndex
            },
            {
                path: baseurl + 'all-hotel',
                name: 'hotelIndex',
                component: hotelIndex
            },
            {
                path: baseurl + 'all-travel-info',
                name: 'travelIndex',
                component: travelIndex
            },
            {
                path: baseurl + 'helpline-info',
                name: 'helplineIndex',
                component: helplineIndex
            },
            {
                path: baseurl + 'award-gallery-info',
                name: 'AwardGallery',
                component: AwardGallery
            },
            {
                path: baseurl + 'single-details/:id',
                name: 'singleDetails',
                component: singleDetails,
            },
            {
                path: baseurl + 'gallery-info',
                name: 'galleryIndex',
                component: galleryIndex
            },
            {
                path: baseurl + 'gallery-info/single-details/:id',
                name: 'detailsGallery',
                component: detailsGallery,
            },
            {
                path: baseurl + 'dress-code',
                name: 'dressCodeIndex',
                component: dressCodeIndex,
            },









        ],
        beforeEnter(to, from, next) {
            checkToken(to, from, next);
        }
    },
    {
        path: baseurl + 'login',
        name: 'Login',
        component: Login,
        beforeEnter(to, from, next) {
            activeToken(to, from, next);
        }
    },
    {
        path: baseurl + '*',
        name: 'NotFound',
        component: NotFound,
    },
]
const router = new VueRouter({
    mode: 'history',
    base: process.env.baseurl,
    routes
});

router.afterEach(() => {
    $('#preloader').hide();
});

export default router
