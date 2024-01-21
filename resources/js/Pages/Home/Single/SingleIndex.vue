<template>
    <div class="allSingle width">
        <section class="address">
            <a href="/">خانه</a>
            <a v-for="item in posts.category.slice(0,1)" :href="'/products/category/' + item.slug">{{ item.name }}</a>
            <a>{{ posts.title }}</a>
        </section>
        <section class="productSingle">
            <div class="right">
                <div class="images">
                    <i class="rectangle">
                        <svg-icon :icon="'#singleRectangle'"></svg-icon>
                    </i>
                    <div class="cover">
                        <div class="options">
                            <div class="option" v-if="!notificationBell" @click.prevent="showNotification = true">
                                <i>
                                    <svg-icon :icon="'#bell2'"></svg-icon>
                                </i>
                                <h4>اطلاع</h4>
                            </div>
                            <div class="option" @click.prevent="showShare = true">
                                <i>
                                    <svg-icon :icon="'#share'"></svg-icon>
                                </i>
                                <h4>اشتراک</h4>
                            </div>
                            <div class="option" @click.stop="btnBookmark(posts.id)">
                                <div class="optionItem" v-if="showLoaderOption != 2">
                                    <i v-for="values in bookmark" v-if="values == posts.id">
                                        <svg-icon :icon="'#bookmark'"></svg-icon>
                                    </i>
                                    <i>
                                        <svg-icon :icon="'#unbookmark'"></svg-icon>
                                    </i>
                                </div>
                                <i v-else>
                                    <svg-icon class="loading" :icon="'#loading'"></svg-icon>
                                </i>
                                <h4>نشانه</h4>
                            </div>
                            <div class="option" @click.stop="btnLike(posts.id)">
                                <div class="optionItem" v-if="showLoaderOption != 3">
                                    <i v-for="values in like" v-if="values == posts.id">
                                        <svg-icon :icon="'#like'"></svg-icon>
                                    </i>
                                    <i>
                                        <svg-icon :icon="'#unlike'"></svg-icon>
                                    </i>
                                </div>
                                <i v-else>
                                    <svg-icon class="loading" :icon="'#loading'"></svg-icon>
                                </i>
                                <h4>محبوب</h4>
                            </div>
                        </div>
                        <vue-magnifier :src="JSON.parse(posts.image)[imageSingle]" :src-large="JSON.parse(posts.image)[imageSingle]"></vue-magnifier>
                    </div>
                    <hooper :settings="hooperSettings2">
                        <slide v-for="(item,index) in JSON.parse(posts.image)" :key="index" @click="imageSingle = index">
                            <img :src="item" :alt="posts.title">
                        </slide>
                        <hooper-navigation slot="hooper-addons"></hooper-navigation>
                    </hooper>
                </div>
            </div>
            <div class="left">
                <h1>{{ posts.title }}</h1>
                <div class="title_en">
                    <h2>{{ posts.title_en }}</h2>
                    <div class="rates">
                        <span v-if="posts.rate_count">{{ posts.rate_count }}</span>
                        <span v-else>محصول جدید</span>
                        <i>
                            <svg-icon :icon="'#star'"></svg-icon>
                        </i>
                    </div>
                </div>
                <div class="options">
                    <div class="option">
                        <h4>کشور سازنده:</h4>
                        <a v-for="item in posts.country.slice(0,1)" :href="'/products/country/' + item.slug">{{ item.name }}</a>
                    </div>
                    <div class="option" v-if="posts.category.length">
                        <h4>دسته بندی:</h4>
                        <a v-for="item in posts.category.slice(0,1)" :href="'/products/category/' + item.slug">{{ item.name }}</a>
                    </div>
                    <div class="brand" v-if="posts.brand.length">
                        <h4>برند:</h4>
                        <div class="brandPic" v-for="item in posts.brand.slice(0,1)">
                            <a :href="'/products/brand/' + item.slug">{{ item.name }}</a>
                            <img :src="item.image" :alt="item.name">
                        </div>
                    </div>
                </div>
                <div class="productDetail">
                    <div class="rightDetail">
                        <div class="abilityTitle">
                            <h4>ویژگی های محصول</h4>
                            <button v-if="!feedbackReport" @click="showReport = !showReport">بازخورد این محصول</button>
                        </div>
                        <ul>
                            <li v-for="(item , check) in JSON.parse(posts.review[0].ability)" :key="check">
                                <span>{{item.name}}</span>
                            </li>
                        </ul>
                        <div class="productData" v-if="allColor.length">
                            <h4>رنگ :</h4>
                            <ul>
                                <li v-for="(item , index) in allColor" @click="btnColor(item,index)">
                                    <div class="active" v-if="showColor == index">
                                        <span>{{item.name}}</span>
                                        <i>
                                            <svg-icon :icon="'#circle'" :style="{'fill' : item.color}"></svg-icon>
                                        </i>
                                    </div>
                                    <div class="unActive" v-if="showColor != index">
                                        <i>
                                            <svg-icon :icon="'#circle'" :style="{'fill' : item.color}"></svg-icon>
                                        </i>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="productData" v-if="allSize.length">
                            <h4>سایز :</h4>
                            <div class="customSelect">
                                <div class="categoryShow" @click="showSize = !showSize">
                                    <h4>{{sizeName.name}}</h4>
                                    <i>
                                        <svg-icon :icon="'#down'"></svg-icon>
                                    </i>
                                </div>
                                <ul v-if="showSize">
                                    <li v-for="item in sizeseller" v-if="item.count >= 0" :key="item.name" :title="item.name" @click="btnSize(item)">
                                        <span>{{item.name}}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="productData" v-if="allGuarantee.length">
                            <h4>گارانتی :</h4>
                            <div class="customSelect" @click="showGuarantee = !showGuarantee">
                                <div class="categoryShow">
                                    <h4>{{getGuarantee.name}}</h4>
                                    <i>
                                        <svg-icon :icon="'#down'"></svg-icon>
                                    </i>
                                </div>
                                <ul v-if="showGuarantee">
                                    <li v-for="item in allGuarantee" :key="item.name" :title="item.name" @click="getGuarantee = item">
                                        <span>{{item.name}}</span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="productData">
                            <h4>فروشنده :</h4>
                            <a class="seller" :href="'/seller/' + getSeller.slug">{{ getSeller.name }}</a>
                        </div>
                        <div class="priceProduct">
                            <h4>قیمت :</h4>
                            <div class="price">
                                <s v-if="posts.off">{{ offPrice|NumFormat }}</s>
                                <h3>
                                    {{ price|NumFormat }}
                                    <span>تومان</span>
                                </h3>
                            </div>
                        </div>
                        <div class="availableProducts" v-if="colorNames != '' && sizeName != ''">
                            <div class="availableProduct" v-if="colorNames.count <= sizeName.count">
                                فقط
                                <span>{{ colorNames.count }} عدد</span>
                                از این رنگ موجود در انبار است
                            </div>
                            <div class="availableProduct" v-if="sizeName.count <= colorNames.count">
                                فقط
                                <span>{{ sizeName.count }} عدد</span>
                                از این سایز موجود در انبار است
                            </div>
                        </div>
                        <div class="availableProducts" v-else>
                            <div class="availableProduct" v-if="sizeName != ''">
                                فقط
                                <span>{{ sizeName.count }} عدد</span>
                                از این سایز موجود در انبار است
                            </div>
                            <div class="availableProduct" v-if="colorNames != ''">
                                فقط
                                <span>{{ colorNames.count }} عدد</span>
                                از این رنگ موجود در انبار است
                            </div>
                        </div>
                        <div class="addCart">
                            <button @click.prevent="addCart" v-if="count == 1">
                                <i v-if="showLoaderOption == 1" class="loader">
                                    <svg-icon class="loading" :icon="'#loading'"></svg-icon>
                                </i>
                                <span v-else>افزودن به سبد خرید</span>
                            </button>
                            <button v-else class="empty">
                                <span>موجودی کافی نیست</span>
                            </button>
                        </div>
                    </div>
                    <div class="leftDetail">
                        <div class="qrDetail">
                            <h3>بارکد</h3>
                            <qr-code :text="address+'product/'+posts.slug"></qr-code>
                        </div>
                        <div class="sellerDetail">
                            <h3>انتخاب فروشنده</h3>
                            <div class="customSelect">
                                <select v-model="getSeller" @change="btnSeller">
                                    <option v-for="item in sellers" :value="item">{{ item.name }}</option>
                                </select>
                                <i>
                                    <svg-icon :icon="'#down'"></svg-icon>
                                </i>
                            </div>
                            <h4>عملکرد کلی فروشنده</h4>
                            <h5 v-if="(getSeller.supply+getSeller.commitment+getSeller.reference) / 3 >= 70">عالی</h5>
                            <h5 v-else-if="(getSeller.supply+getSeller.commitment+getSeller.reference) / 3 <= 30">ضعیف</h5>
                            <h5 v-else>متوسط</h5>
                            <ul>
                                <li>
                                    <span>{{ getSeller.supply }}%</span>
                                    <span>تامین به موقع</span>
                                </li>
                                <li>
                                    <span>{{ getSeller.commitment }}%</span>
                                    <span>تعهد ارسال</span>
                                </li>
                                <li>
                                    <span>{{ getSeller.reference }}%</span>
                                    <span>بدون ثبت مرجوعی</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="singleDetail">
            <div class="tabs">
                <div class="tab">
                    <button v-if="tab == 0" class="active">مشخصات محصول</button>
                    <button v-else @click="tab = 0">مشخصات محصول</button>
                </div>
                <div class="tab">
                    <button v-if="tab == 1" class="active">توضیحات محصول</button>
                    <button v-else @click="tab = 1">توضیحات محصول</button>
                </div>
                <div class="tab">
                    <button v-if="tab == 2" class="active">نظرات محصول</button>
                    <button v-else @click="tab = 2">نظرات محصول</button>
                </div>
                <div class="tab">
                    <button v-if="tab == 3" class="active">پرسش و پاسخ</button>
                    <button v-else @click="tab = 3">پرسش و پاسخ</button>
                </div>
            </div>
            <div v-if="tab == 0" class="propertySingle">
                <ul>
                    <li v-for="(item , check) in JSON.parse(this.posts.review[0].specifications)" :key="check">
                        <h4>{{item.title}}</h4>
                        <p>{{item.body}}</p>
                    </li>
                </ul>
            </div>
            <div v-if="tab == 1" class="descriptionSingle">
                <div class="description">
                    <div class="title">
                        <i>
                            <svg-icon :icon="'#info'"></svg-icon>
                        </i>
                        <h3>نقد و بررسی اجمالی</h3>
                    </div>
                    <p v-html="posts.body"></p>
                </div>
                <div class="description">
                    <div class="title">
                        <i>
                            <svg-icon :icon="'#info'"></svg-icon>
                        </i>
                        <h3>نقد و بررسی کامل</h3>
                    </div>
                    <p v-html="this.posts.review[0].body"></p>
                </div>
            </div>
            <div v-if="tab == 2" class="commentSingle">
                <all-comment :posts="posts" :rate="JSON.parse(posts.review[0].rate)" :replyAllow="1" :showUser="1" :coercion="1" :checkOnline="1"></all-comment>
            </div>
            <div v-if="tab == 3" class="allSingleQuestion">
                <div class="allSingleQuestionSends">
                    <div class="allSingleQuestionSend">
                        <i>
                            <svg-icon :icon="'#question'"></svg-icon>
                        </i>
                        <p>سوالات خود را با ثبت کردن در اینجا از خریداران و فروشنده بپرس</p>
                        <h3 @click="btnShowQuestion(0)">ارسال نظر</h3>
                    </div>
                </div>
                <div class="allSingleQuestionBody">
                    <div class="allSingleQuestionItems" v-if="posts.question.length">
                        <div class="allSingleQuestionItem" v-for="item in posts.question">
                            <div class="allSingleQuestionTitle">
                                <i>
                                    <svg-icon :icon="'#question'"></svg-icon>
                                </i>
                                <p>{{ item.body}}</p>
                            </div>
                            <div class="allSingleQuestionAnswers">
                                <div class="allSingleQuestionAnswer" v-for="answer in item.questions">
                                    <h4>پاسخ :</h4>
                                    <p>{{ answer.body }}</p>
                                </div>
                            </div>
                            <div class="allSingleQuestionItemSend" @click="btnShowQuestion(item.id)">
                                <span>ارسال نظر</span>
                                <i>
                                    <svg-icon :icon="'#left'"></svg-icon>
                                </i>
                            </div>
                        </div>
                    </div>
                    <div class="allSingleQuestionEmpty" v-else>
                        <i>
                            <svg-icon :icon="'#question'"></svg-icon>
                        </i>
                        <p>پرسش و پاسخی وجود ندارد</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="allCategory">
            <div class="title">
                <div class="right">
                    <i>
                        <svg-icon :icon="'#star'"></svg-icon>
                    </i>
                    <div class="name">
                        <h3>جدیدترین</h3>
                        <span>محصولات مرتبط</span>
                    </div>
                </div>
            </div>
            <div class="data">
                <hooper :settings="hooperSettings">
                    <slide v-for="(item,index) in related" :key="index">
                        <a :href="'/product/' + item.slug" class="item">
                            <div class="pic">
                                <img :src="JSON.parse(item.image)[0]" :alt="item.title">
                            </div>
                            <div class="off" v-if="item.off">{{ item.off }}%</div>
                            <div class="rate" v-if="item.rate_count">
                                <span>{{ item.rate_count }}</span>
                                <i>
                                    <svg-icon :icon="'#star'"></svg-icon>
                                </i>
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
                <div class="bar"></div>
            </div>
        </div>
        <div class="showSingleItem" v-if="showQuestion">
            <all-question v-on:sendClose="getClose" :parentId="parentId" :post="posts.id"></all-question>
        </div>
        <div class="reportsSingle" v-if="showReport">
            <report-single v-on:sendClose="getCloseFeed" :post="posts.id"></report-single>
        </div>
        <div class="showSingleItem" v-if="showShare">
            <all-share v-on:sendClose="getClose" :slug="posts.product_id" :address="address"></all-share>
        </div>
        <div class="showSingleItem" v-if="showNotification">
            <single-notification v-on:sendClose="getCloseNotification" :post="posts.id"></single-notification>
        </div>
    </div>
</template>

<script>
import FlipCountdown from "vue2-flip-countdown";
import SvgIcon from "../../Svg/SvgIcon";
import { Hooper, Navigation as HooperNavigation,Slide} from 'hooper';
import 'hooper/dist/hooper.css';
import VueQRCodeComponent from 'vue-qrcode-component'
import AllComment from "./AllComment";
import AllQuestion from "./AllQuestion";
import AllShare from "./AllShare";
import SingleNotification from "./SingleNotification";
import ReportSingle from "./ReportSingle";
Vue.component('vue-magnifier', {
    template:
        '<div class="vue-magnifier-container">' +
        '<slot></slot>' +
        '<span ref="magnificationElement" class="preview" v-bind:style="{backgroundImage:\'url(\' + src + \')\'}">' +
        '<span ref="glass" class="magnifying-glass" v-bind:style="{backgroundImage: \'url(\' + srcLarge + \')\', backgroundPosition: backgroundPos, left: cursorX + \'px\', top: cursorY + \'px\'}"></span>' +
        '</span>' +
        '</div>',
    props: {
        src: String,
        srcLarge: String
    },
    methods: {
        getCursorPos: function(e){
            var x = (window.Event) ? e.pageX : event.clientX + (document.documentElement.scrollLeft ? document.documentElement.scrollLeft : document.body.scrollLeft);
            var y = (window.Event) ? e.pageY : event.clientY + (document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop);

            this.cursorX = x-this.thumbPos.x;
            this.cursorY = y-this.thumbPos.y;
        },
        getBounds: function(){
            var el = this.$refs.magnificationElement;

            this.bounds = el.getBoundingClientRect();

            var xPos = 0;
            var yPos = 0;
            while (el) {
                var transform = this.getTransform(el);
                if (el.tagName == "BODY") {
                    // deal with browser quirks with body/window/document and page scroll
                    var xScroll = el.scrollLeft || document.documentElement.scrollLeft;
                    var yScroll = el.scrollTop || document.documentElement.scrollTop;


                    xPos += (el.offsetLeft - xScroll + el.clientLeft + parseInt(transform[0]));
                    yPos += (el.offsetTop - yScroll + el.clientTop + parseInt(transform[1]));
                } else {
                    // for all other non-BODY elements
                    xPos += (el.offsetLeft - el.scrollLeft + el.clientLeft + parseInt(transform[0]));
                    yPos += (el.offsetTop - el.scrollTop + el.clientTop + parseInt(transform[1]));
                }

                el = el.offsetParent;
            }
            this.thumbPos = {
                x: xPos,
                y: yPos
            }
        },
        moveMagnifier: function (e) {
            e.preventDefault();

            this.getBounds();
            this.getCursorPos(e);

            this.backgroundPos = this.cursorX * 100 / this.bounds.width + "% " + this.cursorY * 100 / this.bounds.height + "%";
        },
        getTransform: function (el) {
            var transform = window.getComputedStyle(el, null).getPropertyValue('-webkit-transform');

            function rotate_degree(matrix) {
                if(matrix !== 'none') {
                    var values = matrix.split('(')[1].split(')')[0].split(',');
                    var a = values[0];
                    var b = values[1];
                    var angle = Math.round(Math.atan2(b, a) * (180/Math.PI));
                } else {
                    var angle = 0;
                }
                return (angle < 0) ? angle +=360 : angle;
            }

            var results = transform.match(/matrix(?:(3d)\(-{0,1}\d+\.?\d*(?:, -{0,1}\d+\.?\d*)*(?:, (-{0,1}\d+\.?\d*))(?:, (-{0,1}\d+\.?\d*))(?:, (-{0,1}\d+\.?\d*)), -{0,1}\d+\.?\d*\)|\(-{0,1}\d+\.?\d*(?:, -{0,1}\d+\.?\d*)*(?:, (-{0,1}\d+\.?\d*))(?:, (-{0,1}\d+\.?\d*))\))/);

            var output = [0,0,0];
            if(results){
                if(results[1] == '3d'){
                    output = results.slice(2,5);
                } else {
                    results.push(0);
                    output = results.slice(5, 9); // returns the [X,Y,Z,1] value;
                }

                output.push(rotate_degree(transform));
            }
            return output;
        }
    },
    mounted: function(){
        this.$nextTick(function () {
            this.$refs.magnificationElement.addEventListener("mousemove", this.moveMagnifier);
        })
    },
    data: function(){
        return {
            img: null,
            width: null,
            height: null,
            bounds: null,
            cursorX:0,
            cursorY:0,
            thumbPos:{x:0,y:0},
            backgroundPos: '0 0'
        }
    }
});
Vue.component('qr-code', VueQRCodeComponent)
export default {
    name: "SingleIndex",
    props:['posts','sellers','related','guaranteeseller','reply','priceseller','colorseller','sizeseller','coercion','showUser','checkOnline','address','notification','feedback'],
    components:{
        ReportSingle,
        SingleNotification,
        AllShare,
        AllComment,
        AllQuestion,
        FlipCountdown,
        Hooper,
        HooperNavigation,
        Slide,
        SvgIcon,
    },
    data(){
        return{
            tab: 0,
            showQuestion: false,
            showReport: false,
            showShare: false,
            showSize: false,
            showGuarantee: false,
            parentId: 0,
            imageSingle: 0,
            showLoaderOption: 0,
            showNotification: 0,
            feedbackReport: this.feedback,
            notificationBell: this.notification,
            bookmark: [],
            like: [],
            count: 1,
            getSeller: this.sellers[0],
            colorNames : '',
            sizeName : '',
            sellerData : '',
            getGuarantee : '',
            price: this.priceseller,
            offPrice: this.posts.offPrice,
            showColor : 0,
            colors : [],
            allSize : this.sizeseller,
            allColor : this.colorseller,
            allGuarantee : this.guaranteeseller,
            addId : this.posts.id,
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
            hooperSettings: {
                wheelControl:false,
                centerMode: false,
                transition: 700,
                shortDrag: false,
                mouseDrag: false,
                breakpoints: {
                    100: {
                        itemsToShow: 1,
                        itemsToSlide: 1,
                    },
                    700: {
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
            hooperSettings2: {
                wheelControl:false,
                centerMode: false,
                transition: 700,
                breakpoints: {
                    100: {
                        itemsToShow: 2,
                        itemsToSlide: 2,
                    },
                    800: {
                        itemsToShow: 3,
                        itemsToSlide: 3,
                    },
                }
            },
        }
    },
    methods:{
        btnSeller(){
            let url = '/change-seller'
            axios.post(url,{
                post: this.posts.id,
                seller: this.getSeller.id,
            })
            .then(res=>{
                this.price = res.data.price;
                this.offPrice = res.data.offPrice;
                this.addId = res.data.id;
                this.allColor = JSON.parse(res.data['review'][0]['colors']);
                this.allSize = JSON.parse(res.data['review'][0]['size']);
                this.allGuarantee = res.data.guarantee;
                if (this.allSize.length){
                    this.sizeName = this.allSize[0];
                    this.price = parseInt(this.price) + parseInt(this.allSize[0].price);
                    if(this.sizeName.count <= 0){
                        this.count = 0;
                    }
                }
                if (this.allColor.length){
                    this.colorNames = this.allColor[0];
                    this.price = parseInt(this.price) + parseInt(this.allColor[0].price);
                    if(this.colorNames.count <= 0){
                        this.count = 0;
                    }
                }
                if(res.data.count <= 0){
                    this.count = 0;
                }
            })
        },
        getCloseNotification(item){
            if(item){
                this.notificationBell = item;
            }
            this.showNotification = false;
        },
        getCloseFeed(item){
            this.showReport = false;
            if(item){
                this.feedbackReport = item;
            }
        },
        addCart(){
            this.showLoaderOption = 1;
            const url = `/add-cart2`;
            axios.post(url ,{
                postID : this.addId,
                colorName : this.colorNames,
                sizeName : this.sizeName,
                price: this.price,
                guarantee: this.getGuarantee.id,
            })
                .then(response=>{
                    this.showLoaderOption = 0;
                    this.$eventHub.emit('getCart');
                    this.$toast.success('انجام شد', 'به سبد خرید با موفقیت اضافه شد', this.notificationSystem.options.success);
                })
                .catch(err =>{
                    this.$toast.error('انجام نشد', 'متاسفانه مشکلی پیش آمد', this.notificationSystem.options.error);
                })
        },
        btnColor(item,index){
            this.showColor = index;
            this.colorNames = item;
            if (this.sizeName != ''){
                this.price = parseInt(this.posts.price) + parseInt(this.sizeName.price) + parseInt(item.price);
                if(item.count <= 0 || this.sizeName.count <= 0 || this.posts.count <= 0){
                    this.count = 0;
                }else{
                    this.count = 1;
                }
            }else{
                this.price = parseInt(this.posts.price) + parseInt(item.price);
                if(item.count <= 0 || this.posts.count <= 0){
                    this.count = 0;
                }else{
                    this.count = 1;
                }
            }
        },
        btnLike(id , index){
            this.loadingLike = index;
            this.showLoaderOption = 3;
            const url = `/like`;
            axios.post(url ,{
                postID : id
            })
                .then(response=>{
                    this.showLoaderOption = 0;
                    this.loadingLike = -1;
                    if (response.data == 'noUser'){
                        this.$toast.error('عضو نیستید', 'ابتدا عضو شوید', this.notificationSystem.options.error);
                        this.like = [];
                    }else{
                        if (response.data == 'delete'){
                            this.$toast.success('انجام شد', 'علاقه مندی با موفقیت حذف شد', this.notificationSystem.options.success);
                            this.getLike();
                        }else{
                            this.$toast.success('انجام شد', 'به علاقه مندی با موفقیت اضافه شد', this.notificationSystem.options.success);
                            this.getLike();
                        }
                    }
                })
                .catch(err =>{
                    this.showLoaderOption = 0;
                    this.loadingLike = -1;
                    this.$toast.error('انجام نشد', 'متاسفانه مشکلی پیش آمد', this.notificationSystem.options.error);
                })
        },
        getLike(){
            const url = `/get-like`;
            axios.get(url)
                .then(response=>{
                    this.like = response.data;
                })
        },
        btnBookmark(id , index){
            this.loadingBookmark = index;
            this.showLoaderOption = 2;
            const url = `/bookmark`;
            axios.post(url ,{
                postID : id
            })
                .then(response=>{
                    this.loadingBookmark = -1;
                    this.showLoaderOption = 0;
                    if (response.data == 'noUser'){
                        this.$toast.error('عضو نیستید', 'ابتدا عضو شوید', this.notificationSystem.options.error);
                        this.bookmark = [];
                    }else {
                        if (response.data == 'delete') {
                            this.$toast.success('انجام شد', 'نشانه با موفقیت حذف شد', this.notificationSystem.options.success);
                            this.getBookmark();
                        }else {
                            this.$toast.success('انجام شد', 'نشانه با موفقیت اضافه شد', this.notificationSystem.options.success);
                            this.bookmark.push(response.data.post_id);
                        }
                    }
                })
        },
        getBookmark(){
            const url = `/get-bookmark`;
            axios.get(url)
                .then(response=>{
                    this.bookmark = response.data;
                })
        },
        btnSize(item){
            this.showSize = false;
            this.sizeName = item;
            if (this.colorNames != ''){
                this.price = parseInt(this.posts.price) + parseInt(this.colorNames.price) + parseInt(item.price);
                if(item.count <= 0 || this.colorNames.count <= 0 || this.posts.count <= 0){
                    this.count = 0;
                }else{
                    this.count = 1;
                }
            }else{
                this.price = parseInt(this.posts.price) + parseInt(item.price);
                if(item.count <= 0 || this.posts.count <= 0){
                    this.count = 0;
                }else{
                    this.count = 1;
                }
            }
        },
        btnShowQuestion(id){
            this.parentId = id;
            this.showQuestion = true;
        },
        getClose(item){
            this.showQuestion = false;
            this.showShare = false;
        },
        getData(){
            if(this.allGuarantee.length){
                this.getGuarantee = this.allGuarantee[0];
            }
            if (this.allSize.length){
                this.sizeName = this.allSize[0];
                this.price = parseInt(this.price) + parseInt(this.allSize[0].price);
                if(this.sizeName.count <= 0){
                    this.count = 0;
                }
            }
            if (this.allColor.length){
                this.colorNames = this.allColor[0];
                this.price = parseInt(this.price) + parseInt(this.allColor[0].price);
                if(this.colorNames.count <= 0){
                    this.count = 0;
                }
            }
            if(this.posts.count <= 0){
                this.count = 0;
            }
        },
        allViews(){
            const url = "/view";
            axios.post(url,{
                postId : this.posts.id
            })
        },
    },
    mounted() {
        this.getData();
        this.getBookmark();
        this.getLike();
        this.allViews();
    }
}
</script>

<style scoped>

</style>
