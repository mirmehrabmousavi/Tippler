<template>
    <section class="allNewProduct width">
        <div class="title">
            <i>
                <svg-icon :icon="'#smallPattern'"></svg-icon>
            </i>
            <div class="name">
                <h3 v-if="data.show == 0">جدید ترین</h3>
                <h3 v-if="data.show == 1">محبوب ترین</h3>
                <h3 v-if="data.show == 2">پربازدید ترین</h3>
                <h3 v-if="data.show == 3">ارزان ترین</h3>
                <h3 v-if="data.show == 4">گران ترین</h3>
                <h3 v-if="data.show == 5">پرفروش ترین</h3>
                <span>{{ data.title }}</span>
            </div>
        </div>
        <div class="data">
            <hooper :settings="hooperSettings">
                <slide v-for="(item,index) in data.post" :key="index">
                    <a :href="'/product/' + item.slug" class="item">
                        <div class="pic">
                            <img v-lazy="JSON.parse(item.image)[0]" :alt="item.title">
                        </div>
                        <div class="off" v-if="item.off">{{ item.off }}%</div>
                        <div class="rate">
                            <span v-if="item.rate_count">{{ item.rate_count }}</span>
                            <span v-else>محصول جدید</span>
                            <i>
                                <svg-icon :icon="'#star'"></svg-icon>
                            </i>
                        </div>
                        <div class="datas">
                            <div class="productOptions">
                                <div class="productOption" title="علاقه مندی" @click.prevent="btnLike(item.id , index)">
                                    <i v-if="loadingLike == index">
                                        <svg-icon class="loading" :icon="'#loading'"></svg-icon>
                                    </i>
                                    <i v-for="values in like" v-if="values == item.id && loadingLike != index">
                                        <svg-icon :icon="'#like'"></svg-icon>
                                    </i>
                                    <i>
                                        <svg-icon :icon="'#unlike'"></svg-icon>
                                    </i>
                                </div>
                                <div class="productOption" title="نشانه گذاری" @click.prevent="btnBookmark(item.id ,index)">
                                    <i v-if="loadingBookmark == index">
                                        <svg-icon class="loading" :icon="'#loading'"></svg-icon>
                                    </i>
                                    <i v-for="values in bookmark" v-if="values == item.id && loadingBookmark != index">
                                        <svg-icon :icon="'#bookmark'"></svg-icon>
                                    </i>
                                    <i>
                                        <svg-icon :icon="'#unbookmark'"></svg-icon>
                                    </i>
                                </div>
                                <div class="productOption" title="مقایسه کردن" @click.prevent="btnComparison(item.id)">
                                    <i class="active" v-for="values in allComparison" v-if="values == item.id">
                                        <svg-icon :icon="'#chart'"></svg-icon>
                                    </i>
                                    <i>
                                        <svg-icon :icon="'#chart'"></svg-icon>
                                    </i>
                                </div>
                            </div>
                        </div>
                        <div class="title">
                            {{ item.title }}
                        </div>
                        <div class="price">
                            <s v-if="item.off">{{ item.offPrice|NumFormat }}</s>
                            <h4>{{ item.price|NumFormat }}</h4>
                            <span>تومان</span>
                        </div>
                    </a>
                </slide>
                <hooper-navigation slot="hooper-addons"></hooper-navigation>
            </hooper>
        </div>
        <div class="shape">
            <i>
                <svg-icon :icon="'#shape'"></svg-icon>
            </i>
        </div>
    </section>
</template>

<script>
import { Hooper, Slide, Navigation as HooperNavigation, Pagination as HooperPagination,} from 'hooper';
import 'hooper/dist/hooper.css';
import SvgIcon from "../../Svg/SvgIcon";
export default {
    name: "NewProduct",
    props:['data'],
    components:{
        SvgIcon,
        Hooper,
        HooperNavigation,
        Slide,
    },
    data() {
        return {
            hooperSettings: {
                wheelControl:false,
                centerMode: false,
                transition: 700,
                shortDrag: false,
                mouseDrag: false,
                breakpoints: {
                    100: {
                        itemsToShow: 2,
                        itemsToSlide: 1,
                    },
                    1000: {
                        itemsToShow: 3,
                        itemsToSlide: 1,
                    },
                    1200: {
                        itemsToShow: 4,
                        itemsToSlide: 1,
                    },
                }
            },
            bookmark: [],
            like: [],
            loadingBookmark : -1,
            loadingLike : -1,
            loadingAdd: -1,
            notificationSystem: {
                options: {
                    show: {
                        icon: "icon-person",
                        position: "topCenter",
                    },
                    success: {
                        position: "bottomRight"
                    },
                    error: {
                        position: "bottomRight"
                    },
                }
            },
            allComparison: [],
            i: 0,
        };
    },
    methods: {
        btnComparison(id){
            this.i = 0;
            if (this.allComparison.length <= 7){
                for ( this.i ; this.i <  this.allComparison.length; this.i++) {
                    if (this.allComparison[this.i] == id){
                        this.allComparison.splice(this.i , 1);
                        this.i = 100;
                    }
                }
                if (this.i != 101){
                    this.allComparison.push(id);
                }
                this.i = 0;
            }
            this.$eventHub.emit('allComparisons' , this.allComparison);
        },
        checkLike(item){
            this.like = item;
        },
        checkBookmark(item){
            this.bookmark = item;
        },
        btnLike(id,index){
            this.loadingLike = index;
            const url = `/like`;
            axios.post(url ,{
                postID : id
            })
                .then(response=>{
                    if (response.data == 'noUser'){
                        this.$toast.error('عضو نیستید', 'ابتدا عضو شوید', this.notificationSystem.options.error);
                        this.$eventHub.emit('getLike' , []);
                    }else{
                        if (response.data == 'delete'){
                            this.$eventHub.emit('allLike');
                        }else{
                            this.$toast.success('انجام شد', 'به علاقه مندی با موفقیت اضافه شد', this.notificationSystem.options.success);
                            this.like.push(response.data.post_id);
                            this.$eventHub.emit('getLike' , this.like);
                        }
                    }
                    this.loadingLike = -1;
                })
                .catch(err =>{
                    this.loadingLike = -1;
                })
        },
        btnBookmark(id,index){
            this.loadingBookmark = index;
            const url = `/bookmark`;
            axios.post(url ,{
                postID : id
            })
                .then(response=>{
                    if (response.data == 'noUser'){
                        this.$toast.error('عضو نیستید', 'ابتدا عضو شوید', this.notificationSystem.options.error);
                        this.$eventHub.emit('getBookmark' , []);
                    }else {
                        if (response.data == 'delete') {
                            this.$eventHub.emit('allBookmark');
                        }else {
                            this.$toast.success('انجام شد', 'نشانه با موفقیت اضافه شد', this.notificationSystem.options.success);
                            this.bookmark.push(response.data.post_id);
                            this.$eventHub.emit('getBookmark' , this.bookmark);
                        }
                    }
                    this.loadingBookmark = -1;
                })
                .catch(err => {
                    this.loadingBookmark = -1;
                })
        },
        getCompares(item){
            this.allComparison = item;
        }
    },
    created: function() {
        this.$eventHub.on('getLike', this.checkLike);
        this.$eventHub.on('getBookmark', this.checkBookmark);
        this.$eventHub.on('allComparisons', this.getCompares);
    },
}
</script>

<style scoped>

</style>
