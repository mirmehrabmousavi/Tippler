<template>
    <div class="allIndexHome">
        <div class="homeItems" v-for="item in widget">
            <div class="homeItem" v-if="item.name == 'خبر ها'">
                <blog-index :data="item"></blog-index>
            </div>
            <div class="homeItem" v-if="item.name == 'تبلیغات اسلایدری'">
                <slider-ad :data="item"></slider-ad>
            </div>
            <div class="homeItem" v-if="item.name == 'پیشنهاد شگفت انگیز'">
                <suggest-index :data="item"></suggest-index>
            </div>
            <div class="homeItem" v-if="item.name == 'دسته بندی دلخواه'">
                <category-index :data="item"></category-index>
            </div>
            <div class="homeItem" v-if="item.name == 'دسته بندی خاص'">
                <new-product :data="item"></new-product>
            </div>
            <div class="homeItem" v-if="item.name == 'تبلیغات ساده'">
                <ad-index :data="item"></ad-index>
            </div>
            <div class="homeItem" v-if="item.name == 'محصولات با نوار'">
                <all-category :data="item"></all-category>
            </div>
            <div class="homeItem" v-if="item.name == 'محصولات همراه تبلیغ'">
                <ad-product :data="item"></ad-product>
            </div>
            <div class="homeItem" v-if="item.name == 'پست ویژه با تصویر'">
                <image-slider :data="item"></image-slider>
            </div>
        </div>
        <all-compare></all-compare>
        <pop-up-index v-if="showPop" :time="time" :image="image" :description="description" :title="title" :button="button" :color="color" :colorbutton="colorbutton" v-on:sendClose="getClose"></pop-up-index>
        <div class="allDownloadApp" v-if="showNotification && platform == 'ios'">
            <div class="downloadApp">
                <div class="pic">
                    <img :src="logo" :alt="names">
                </div>
                <div class="details">
                    <div class="topDetail">
                        وب اپلیکیشن
                        <span>{{names}}</span>
                        را به صفحه اصلی موبایل خود اضافه کنید.
                    </div>
                    <div class="detailBody">
                        <ul>
                            <li>
                                1- در نوار پایین دکمه
                                <span>"Share"</span>
                                را انتخاب کنید.
                            </li>
                            <li>
                                2- منوی باز شده را به چپ بکشید و گذینه
                                <span>
                                        <i>
                                            <svg-icon :icon="'#export'"></svg-icon>
                                        </i>
                                    </span>
                                <span>"Add to home screen"</span>
                                را انتخاب کنید.
                            </li>
                            <li>
                                2- در مرحله بعد در قسمت بالا روی
                                <span>"Add"</span>
                                کلیک کنید.
                            </li>
                        </ul>
                    </div>
                    <button @click="btnShowNotification">متوجه شدم!</button>
                </div>
            </div>
        </div>
        <div class="allDownloadApp" v-if="showNotification && platform == 'android'">
            <div class="downloadApp">
                <div class="pic">
                    <img :src="logo" :alt="names">
                </div>
                <div class="details">
                    <div class="topDetail">
                        وب اپلیکیشن
                        <span>{{names}}</span>
                        را روی گوشی خود نصب کنید.
                    </div>
                    <div class="detailBody">
                        <ul>
                            <li>
                                1- ابتدا در بالا سمت راست روی
                                <span>"سه نقطه"</span>
                                بزنید.
                            </li>
                            <li>
                                2- روی گذینه
                                <span>"install"</span>
                                یا
                                <span>"Add to home screen"</span>
                                کلیک کنید.
                            </li>
                            <li>
                                2- اکنون
                                <span>"وب اپلیکیشن"</span>
                                در صفحه اصلی شما قرار دارد.
                            </li>
                        </ul>
                    </div>
                    <button @click="btnShowNotification">متوجه شدم!</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import SliderAd from "./SliderAd";
import SuggestIndex from "./SuggestIndex";
import NewProduct from "./NewProduct";
import AdIndex from "./AdIndex";
import AllCategory from "./AllCategory";
import AdProduct from "./AdProduct";
import ImageSlider from "./ImageSlider";
import AllCompare from "../AllCompare";
import BlogIndex from "./BlogIndex";
import PopUpIndex from "./PopUpIndex";
import CategoryIndex from "./CategoryIndex";
export default {
    name: "IndexHome",
    props:['widget','platform','time','image','logo','names','description','title','button','color','colorbutton'],
    components: {
        CategoryIndex,
        PopUpIndex,
        BlogIndex, AllCompare, ImageSlider, AdProduct, AllCategory, AdIndex, NewProduct, SuggestIndex, SliderAd},
    data(){
        return{
            showPop: false,
            showNotification: true,
        }
    },
    methods:{
        btnShowNotification(){
            this.showNotification = !this.showNotification;
            this.$cookies.set('notification', true);
        },
        getClose(){
            this.showPop = false;
        },
        getLike(){
            const url = `/get-like`;
            axios.get(url)
                .then(response=>{
                    this.$eventHub.emit('getLike' , response.data);
                })
        },
        getBookmark(){
            const url = `/get-bookmark`;
            axios.get(url)
                .then(response=>{
                    this.$eventHub.emit('getBookmark' , response.data);
                })
        },
        getData(){
            if(window.innerWidth <= 500){
                if(this.$cookies.get('notification') == 'true' || this.$cookies.get('notification') == true) {
                    this.showNotification = false;
                    if(this.title){
                        this.showPop = true;
                    }
                }
            }else{
                if(this.title){
                    this.showPop = true;
                }
            }
        },
    },
    mounted(){
        this.getLike();
        this.getBookmark();
        this.getData();
    },
    created: function() {
        this.$eventHub.on('allLike', this.getLike);
        this.$eventHub.on('allBookmark', this.getBookmark);
    },
}
</script>

<style scoped>

</style>
