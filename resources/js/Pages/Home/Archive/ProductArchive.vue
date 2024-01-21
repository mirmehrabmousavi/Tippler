<template>
    <div class="allProductArchive width">
        <div class="productArchive">
            <div class="filterArchive">
                <div class="filterItems">
                    <div class="filterTitle">
                        <i>
                            <svg-icon :icon="'#filter'"></svg-icon>
                        </i>
                        <span>براساس قیمت</span>
                    </div>
                    <div class="priceItems">
                        <VueSimpleRangeSlider
                            :max="maxprice"
                            :logarithmic="true"
                            v-model="rangePrice"
                        />
                        <input v-model="rangePrice" hidden>
                        <div class="priceItem">
                            <span>از</span>
                            <h4>{{showMinPrice|NumFormat}} تومان</h4>
                        </div>
                        <div class="priceItem">
                            <span>تا</span>
                            <h4>{{showMaxPrice|NumFormat}} تومان</h4>
                        </div>
                        <button class="priceFilter" @click="btnSearch">فیلتر قیمت</button>
                    </div>
                </div>
                <div class="filterItems">
                    <div class="filterTitle">
                        <i>
                            <svg-icon :icon="'#filter'"></svg-icon>
                        </i>
                        <span>دسته بندی محصول</span>
                    </div>
                    <VuePerfectScrollbar class="scroll-area">
                        <div class="filterCategories">
                            <a v-if="cats.length" v-for="item in cats" :key="item.id" :href="'/products/category/'+  item.slug">
                                <a v-if="item.cats.length" v-for="items in item.cats" :key="items.id" :href="'/products/category/' +  items.slug">
                                    <span>{{items.name}}</span>
                                    <a v-if="items.cats.length" v-for="element in items.cats" :key="element.id" :href="'/products/category/' +  element.slug">
                                        <span>{{element.name}}</span>
                                    </a>
                                </a>
                            </a>
                        </div>
                    </VuePerfectScrollbar>
                </div>
                <div class="filterItems" v-if="brands.length">
                    <div class="filterTitle">
                        <i>
                            <svg-icon :icon="'#filter'"></svg-icon>
                        </i>
                        <span>برند های محصول</span>
                    </div>
                    <VuePerfectScrollbar class="scroll-area">
                        <div class="filterCategories">
                            <a v-for="item in brands" :key="item.id" :href="'/products/brand/' + item.slug">
                                <a>
                                    <span>{{item.name}}</span>
                                </a>
                            </a>
                        </div>
                    </VuePerfectScrollbar>
                </div>
                <div class="filterItems" v-if="color.length">
                    <div class="filterTitle">
                        <i>
                            <svg-icon :icon="'#filter'"></svg-icon>
                        </i>
                        <span>رنگ های محصول</span>
                    </div>
                    <transition name="slide-fade">
                        <div class="filterSearch">
                            <label for="filterColor">
                                <i>
                                    <svg-icon :icon="'#search'"></svg-icon>
                                </i>
                                <input id="filterColor" type="text" placeholder="جستجو ... " v-model="searchColor">
                            </label>
                        </div>
                    </transition>
                    <transition name="slide-fade">
                        <div class="filterContainer">
                            <VuePerfectScrollbar class="scroll-area">
                                <div class="allProductArchiveFiltersItem" v-for="(item,index) in filteredListColor">
                                    <label :for="index">
                                        <input :id="index" type="checkbox" @change="sendColor(item)">
                                        {{item}}
                                    </label>
                                </div>
                            </VuePerfectScrollbar>
                        </div>
                    </transition>
                </div>
                <div class="filterItems" v-if="size.length">
                    <div class="filterTitle">
                        <i>
                            <svg-icon :icon="'#filter'"></svg-icon>
                        </i>
                        <span>سایز های محصول</span>
                    </div>
                    <transition name="slide-fade">
                        <div class="filterSearch">
                            <label for="filterSize">
                                <i>
                                    <svg-icon :icon="'#search'"></svg-icon>
                                </i>
                                <input id="filterSize" type="text" placeholder="جستجو ... " v-model="searchSize">
                            </label>
                        </div>
                    </transition>
                    <transition name="slide-fade">
                        <div class="filterContainer">
                            <VuePerfectScrollbar class="scroll-area">
                                <div class="allProductArchiveFiltersItem" v-for="(item,index) in filteredListSize">
                                    <label :for="item">
                                        <input :id="item" type="checkbox" @change="sendSize(item)">
                                        {{item}}
                                    </label>
                                </div>
                            </VuePerfectScrollbar>
                        </div>
                    </transition>
                </div>
            </div>
            <div class="productContainer">
                <div class="productTitle">
                    <div class="right" v-if="cats.length">
                        <i>
                            <svg-icon :icon="'#smallPattern'"></svg-icon>
                        </i>
                        <div class="name">
                            <span>محصولات</span>
                            <span>{{cats[0].name}}</span>
                        </div>
                    </div>
                    <div class="left">
                        <div class="top">
                            <i v-if="showLoader == true">
                                <svg-icon class="loading" :icon="'#loading'"></svg-icon>
                            </i>
                            <span v-else>{{allProducts.total}}</span>
                        </div>
                        <h4>محصول</h4>
                    </div>
                </div>
                <div class="searchProduct">
                    <label for="filterSearch">
                        <input id="filterSearch" @keypress.enter="btnSearch" type="text" placeholder="جستجو محصول ... " v-model="search">
                        <i>
                            <svg-icon :icon="'#search'"></svg-icon>
                        </i>
                    </label>
                </div>
                <div class="productOrder">
                    <span>ترتیب براساس : </span>
                    <ul>
                        <li @click="btnShowSort(0)">
                            <span class="active" v-if="show == 0">جدید ترین</span>
                            <span class="unActive" v-else>جدید ترین</span>
                        </li>
                        <li @click="btnShowSort(1)">
                            <span class="active" v-if="show == 1">پربازدید ترین</span>
                            <span class="unActive" v-else>پربازدید ترین</span>
                        </li>
                        <li @click="btnShowSort(2)">
                            <span class="active" v-if="show == 2">پرفروش ترین</span>
                            <span class="unActive" v-else>پرفروش ترین</span>
                        </li>
                        <li @click="btnShowSort(3)">
                            <span class="active" v-if="show == 3">محبوب ترین</span>
                            <span class="unActive" v-else>محبوب ترین</span>
                        </li>
                        <li @click="btnShowSort(4)">
                            <span class="active" v-if="show == 4">ارزان ترین</span>
                            <span class="unActive" v-else>ارزان ترین</span>
                        </li>
                        <li @click="btnShowSort(5)">
                            <span class="active" v-if="show == 5">گران ترین</span>
                            <span class="unActive" v-else>گران ترین</span>
                        </li>
                    </ul>
                </div>
                <i class="productLoader" v-if="showLoader == true">
                    <svg-icon class="loading" :icon="'#loading'"></svg-icon>
                </i>
                <div class="productLists" v-else>
                    <div class="productList" v-for="(item,index) in allProducts.data" :key="index">
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
                    </div>
                </div>
                <div class="archivePaginate" v-if="showLoader2 == false">
                    <paginate-home :url="urlpages+'?show='+show+'&search='+search+'&min='+rangePrice[0]+'&max='+rangePrice[1]+'&allSize='+allSize+'&allColor='+allColor" v-on:sendPage="getPage" v-on:sendLoading="getLoading"></paginate-home>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import SvgIcon from "../../Svg/SvgIcon";
import VueSimpleRangeSlider from "vue-simple-range-slider";
import 'vue-simple-range-slider/dist/vueSimpleRangeSlider.css'
import VuePerfectScrollbar from "vue-perfect-scrollbar";
import PaginateHome from "../PaginateHome";
export default {
    name: "ProductArchive",
    components:{
        PaginateHome,
        SvgIcon,
        VuePerfectScrollbar,
        VueSimpleRangeSlider,
    },
    props:[
        'cats',
        'urlpages',
        'minprice',
        'maxprice',
        'size',
        'getsearch',
        'getshow',
        'getshowmin',
        'getshowmax',
        'getsize',
        'getcolor',
        'ability',
        'brands',
        'url',
        'color',
    ],
    data(){
        return{
            rangePrice: [this.getshowmin,this.getshowmax],
            showMinPrice: this.getshowmin,
            showMaxPrice: this.getshowmax,
            allColor: this.getcolor,
            allBrands: [],
            allSize: this.getsize,
            allAbility: [],
            allProducts: [],
            show: this.getshow,
            showLoader: false,
            showLoader2: false,
            suggest: 0,
            i: 0,
            searchColor: '',
            search: this.getsearch,
            searchSize: '',
            searchAbility: '',
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
        }
    },
    methods:{
        btnShowSort(show){
            this.showLoader2 = true;
            this.showLoader = true;
            this.show = show;
            window.history.pushState("", "", '?show='+this.show+'&search='+this.search+'&min='+this.rangePrice[0]+'&max='+this.rangePrice[1]+'&allSize='+this.allSize+'&allColor='+this.allColor);
            setTimeout(() => this.showLoader2 = !this.showLoader2, 200);
        },
        btnSearch(){
            this.showLoader2 = true;
            this.showLoader = true;
            window.history.pushState("", "", '?show='+this.show+'&search='+this.search+'&min='+this.rangePrice[0]+'&max='+this.rangePrice[1]+'&allSize='+this.allSize+'&allColor='+this.allColor);
            setTimeout(() => this.showLoader2 = !this.showLoader2, 200);
        },
        sendSize(item){
            this.i = 0;
            for ( this.i ; this.i <  this.allSize.length; this.i++) {
                if (this.allSize[this.i] == item){
                    this.allSize.splice(this.i , 1);
                    this.i = 100;
                }
            }
            if (this.i != 101){
                this.allSize.push(item);
            }
            this.i = 0;
            this.showLoader2 = true;
            this.showLoader = true;
            window.history.pushState('', "", '?show='+this.show+'&search='+this.search+'&min='+this.rangePrice[0]+'&max='+this.rangePrice[1]+'&allSize='+this.allSize+'&allColor='+this.allColor);
            setTimeout(() => this.showLoader2 = !this.showLoader2, 200);
        },
        sendColor(item){
            this.i = 0;
            for ( this.i ; this.i <  this.allColor.length; this.i++) {
                if (this.allColor[this.i] == item){
                    this.allColor.splice(this.i , 1);
                    this.i = 100;
                }
            }
            if (this.i != 101){
                this.allColor.push(item);
            }
            this.i = 0;
            this.showLoader2 = true;
            this.showLoader = true;
            window.history.pushState('', "", '?show='+this.show+'&search='+this.search+'&min='+this.rangePrice[0]+'&max='+this.rangePrice[1]+'&allSize='+this.allSize+'&allColor='+this.allColor);
            setTimeout(() => this.showLoader2 = !this.showLoader2, 200);
        },
        getPage(page){
            this.allProducts = page;
        },
        getLoading(num){
            this.showLoader = num;
        },
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
        getLike(){
            const url = `/get-like`;
            axios.get(url)
                .then(response=>{
                    this.like = response.data;
                })
        },
        getBookmark(){
            const url = `/get-bookmark`;
            axios.get(url)
                .then(response=>{
                    this.bookmark = response.data;
                })
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
                        this.getLike();
                    }else{
                        if (response.data == 'delete'){
                            this.getLike();
                        }else{
                            this.$toast.success('انجام شد', 'به علاقه مندی با موفقیت اضافه شد', this.notificationSystem.options.success);
                            this.like.push(response.data.post_id);
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
                        this.getBookmark();
                    }else {
                        if (response.data == 'delete') {
                            this.getBookmark();
                        }else {
                            this.$toast.success('انجام شد', 'نشانه با موفقیت اضافه شد', this.notificationSystem.options.success);
                            this.bookmark.push(response.data.post_id);
                            this.getBookmark();
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
    mounted(){
        this.getLike();
        this.getBookmark();
    },
    computed: {
        filteredListColor() {
            return this.color.filter(post => {
                return post.toString().includes(this.searchColor.toString())
            })
        },
        filteredListSize() {
            return this.size.filter(post => {
                return post.toString().includes(this.searchSize.toString())
            })
        },
        filteredListAbility() {
            return this.ability.filter(post => {
                return post.name.toString().includes(this.searchAbility.toString())
            })
        }
    },
    watch: {
        'rangePrice': function(val, oldVal){
            this.showMinPrice = `${this.rangePrice[0]}`;
            this.showMaxPrice = `${this.rangePrice[1]}`;
        }
    }
}
</script>

<style scoped>

</style>
