<template>
    <section class="allSliderAd width">
        <div class="item">
            <hooper :settings="hooperSettingsAd">
                <slide v-for="(item,index) in JSON.parse(data.moreEn)" :key="index">
                    <div class="over"></div>
                    <a :href="item.address">
                        <figure>
                            <img :src="item.image" :alt="item.address">
                        </figure>
                    </a>
                </slide>
                <hooper-pagination slot="hooper-addons"></hooper-pagination>
                <hooper-navigation slot="hooper-addons"></hooper-navigation>
            </hooper>
        </div>
        <div class="item">
            <ul class="adList">
                <li v-for="item in JSON.parse(data.title)">
                    <a :href="item.address">
                        <figure>
                            <img :src="item.image" :alt="item.address">
                        </figure>
                    </a>
                </li>
            </ul>
            <div class="pattern">
                <svg-icon :icon="'#pattern'"></svg-icon>
            </div>
        </div>
    </section>
</template>

<script>
import {
    Hooper,
    Slide,
    Navigation as HooperNavigation,
    Pagination as HooperPagination,
} from 'hooper';
import SvgIcon from "../../Svg/SvgIcon";
import 'hooper/dist/hooper.css';
export default {
    name: "SliderAd",
    props:['data'],
    components:{
        SvgIcon,
        Hooper,
        HooperNavigation,
        Slide,
        HooperPagination,
    },
    data() {
        return {
            hooperSettingsAd: {
                wheelControl:false,
                centerMode: false,
                rtl: true,
                transition: 300,
                itemsToShow: 1,
                autoPlay:true,
                playSpeed : 5000
            },
        };
    },
}
</script>

<style scoped>

</style>
