/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');

window.Vue = require('vue');
import Vue from 'vue';

import VueLazyload from 'vue-lazyload';
import EventHub from "vue-event-hub";
import VueIziToast from 'vue-izitoast';
import 'izitoast/dist/css/iziToast.min.css';
import VueSweetalert2 from 'vue-sweetalert2';
Vue.use(require('vue-cookies'))
Vue.use(EventHub);
Vue.use(VueIziToast);
Vue.use(VueSweetalert2);
import VueCookies from 'vue-cookies'
Vue.use(VueCookies)
Vue.use(VueLazyload, {
    preLoad: 1,
    error: '/img/404Image.png',
    loading: '/img/404Image.png',
    attempt: 1
});
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('SvgContent', require('./Pages/Svg/SvgContent.vue').default);
Vue.component('HeaderHome', require('./Pages/Home/Header/HeaderHome.vue').default);
Vue.component('FooterHome', require('./Pages/Home/Footer/FooterHome.vue').default);
Vue.component('AllHome', require('./Pages/Home/Index/AllHome.vue').default);
Vue.component('SingleIndex', require('./Pages/Home/Single/SingleIndex.vue').default);
Vue.component('SingleNews', require('./Pages/Home/Single/SingleNews.vue').default);
Vue.component('ProductArchive', require('./Pages/Home/Archive/ProductArchive.vue').default);
Vue.component('NewsArchive', require('./Pages/Home/Archive/NewsArchive.vue').default);
Vue.component('AuthIndex', require('./Pages/Home/Auth/AuthIndex.vue').default);
Vue.component('CartIndex', require('./Pages/Home/Cart/CartIndex.vue').default);
Vue.component('CartAddress', require('./Pages/Home/Cart/CartAddress.vue').default);
Vue.component('ProfileIndex', require('./Pages/Home/Profile/ProfileIndex.vue').default);
Vue.component('ProfilePay', require('./Pages/Home/Profile/ProfilePay.vue').default);
Vue.component('ProfileBookmark', require('./Pages/Home/Profile/ProfileBookmark.vue').default);
Vue.component('ProfileComment', require('./Pages/Home/Profile/ProfileComment.vue').default);
Vue.component('ProfileTicket', require('./Pages/Home/Profile/ProfileTicket.vue').default);
Vue.component('ProfileInfo', require('./Pages/Home/Profile/ProfileInfo.vue').default);
Vue.component('ShowPay', require('./Pages/Home/Profile/ShowPay.vue').default);
Vue.component('ProfileInvoice', require('./Pages/Home/Profile/ProfileInvoice.vue').default);
Vue.component('TicketIndex', require('./Pages/Home/Ticket/TicketIndex.vue').default);
Vue.component('SellerIndex', require('./Pages/Home/Seller/SellerIndex.vue').default);
Vue.component('ProductCreate', require('./Pages/Home/Seller/ProductCreate.vue').default);
Vue.component('ProductEdit', require('./Pages/Home/Seller/ProductEdit.vue').default);
Vue.component('AllMyProduct', require('./Pages/Home/Seller/AllMyProduct.vue').default);
Vue.component('AllProduct', require('./Pages/Home/Seller/AllProduct.vue').default);
Vue.component('SellerCheckout', require('./Pages/Home/Seller/SellerCheckout.vue').default);
Vue.component('SellerPay', require('./Pages/Home/Seller/SellerPay.vue').default);
Vue.component('AddVariety', require('./Pages/Home/Seller/AddVariety.vue').default);
Vue.component('EditVariety', require('./Pages/Home/Seller/EditVariety.vue').default);
Vue.component('BecomeSeller', require('./Pages/Home/Seller/BecomeSeller.vue').default);
Vue.component('BuyIndex', require('./Pages/Home/Cart/BuyIndex.vue').default);
Vue.component('PageIndex', require('./Pages/Home/Page/PageIndex.vue').default);
Vue.component('SellerSingle', require('./Pages/Home/Single/SellerSingle.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

 Vue.filter('NumFormat', function(value) {
    if(!value) return '0';
    value = `${value}`;
    var intPart = Number(value).toFixed(0);
    var intPartFormat = intPart.toString().replace(/(\d)(?=(?:\d{3})+$)/g, '$1,');
    var floatPart = "";
    var value2Array = value.split(".");
    if(value2Array.length == 2) {
        floatPart = value2Array[1].toString();
        if(floatPart.length == 1) {
            return intPartFormat + "." + floatPart + '0';
        } else {
            return intPartFormat + "." + floatPart;
        }
    } else {
        return intPartFormat + floatPart;
    }
})

const app = new Vue({
    el: '#app',
});
