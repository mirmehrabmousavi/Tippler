<template>
    <home-layout>
        <div class="allSingleSeller width">
            <div class="topSeller">
                <div class="detail">
                    <div class="sellers">
                        <div class="pic">
                            <img v-if="seller.image" :src="seller.image" :alt="seller.name">
                            <img v-else src="/img/user.png" :alt="seller.name">
                        </div>
                        <h1>{{seller.name}}</h1>
                    </div>
                    <p>{{seller.about}}</p>
                </div>
                <div class="map">
                    <mapir :apiKey="map" :center="geo">
                        <mapMarker
                            :coordinates.sync="geo"
                            color="red"
                            :draggable="false"
                        />
                    </mapir>
                </div>
            </div>
            <div class="productItems">
                <div class="titleDetail">محصولات فروشنده</div>
                <hooper :settings="hooperSettings">
                    <slide v-for="(item , index) in seller.post" :key="index" :title="item.title">
                        <a class="containerCategoriesItem" :href="'/product/' + item.slug">
                            <div class="offProduct" v-if="item.off != null">
                            <span>
                                ٪ {{item.off}}
                            </span>
                            </div>
                            <div class="pic">
                                <img :src="JSON.parse(item.image)[0]" :alt="item.title">
                            </div>
                            <div class="postTitle">
                                <a :href="'/product/' + item.slug">{{item.title}}</a>
                            </div>
                        </a>
                    </slide>
                    <hooper-navigation slot="hooper-addons"></hooper-navigation>
                </hooper>
            </div>
        </div>
    </home-layout>
</template>

<script>
import HomeLayout from "../../../components/layout/HomeLayout";
import {Hooper, Navigation as HooperNavigation, Slide} from "hooper";
import 'hooper/dist/hooper.css';
import SvgIcon from "../../Svg/SvgIcon";
import { mapir, mapMarker } from "mapir-vue";
export default {
    name: "SellerSingle",
    props:['seller','title','map'],
    components: {
        HomeLayout,
        SvgIcon,
        Hooper,
        HooperNavigation,
        Slide,
        mapir ,
        mapMarker
    },
    metaInfo() {
        return {
            title: `${this.seller.name} - ${this.title}`,
            htmlAttrs: {
                lang: 'fa',
                amp: true,
                reptilian: 'gator'
            },
            headAttrs: {
                nest: 'eggs'
            },
            meta: [
                { charset: 'utf-8' },
            ]
        }
    },
    data() {
        return{
            hooperSettings: {
                wheelControl:false,
                centerMode: false,
                transition: 700,
                breakpoints: {
                    100: {
                        itemsToShow: 1,
                        itemsToSlide: 1,
                    },
                    700: {
                        itemsToShow: 3,
                        itemsToSlide: 1,
                    },
                    1000: {
                        itemsToShow: 4,
                        itemsToSlide: 1,
                    },
                    1200: {
                        itemsToShow: 5,
                        itemsToSlide: 1,
                    },
                    1600: {
                        itemsToShow: 6,
                        itemsToSlide: 1,
                    },
                    1800: {
                        itemsToShow: 8,
                        itemsToSlide: 1,
                    },
                }
            },
            geo: [JSON.parse(this.seller.geo).lng , JSON.parse(this.seller.geo).lat],
        }
    },
}
</script>

<style scoped>

</style>
