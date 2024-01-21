<template>
    <header class="allHeaderHome" :style="styleHeader" :class="{ 'navbar--hidden': !showNavbar }">
        <div class="headerBlock width">
            <div class="headerTop">
                <a href="/" class="logo">
                    <figure>
                        <img :src="logo" :alt="logo">
                    </figure>
                </a>
                <div class="left">
                    <form class="searchHeader" action="/products/search?search=" method="get">
                        <label for="searching">
                            <input type="search" v-model="searchProduct" @keydown="searchDataHandler" @keypress.enter="btnSearchProduct" name="search" id="searching" placeholder="جستجو محصول ...">
                            <button>
                                <svg-icon :icon="'#search'"></svg-icon>
                            </button>
                        </label>
                        <ul>
                            <li v-for="item in allResult">
                                <a :href="'/product/' + item.slug">
                                    <div class="pic">
                                        <img v-lazy="JSON.parse(item.image)[0]" :alt="item.title">
                                    </div>
                                    <div class="subject">
                                        <h3>{{item.title}}</h3>
                                        <h5>{{item.product_id}}</h5>
                                    </div>
                                    <div class="price">{{item.price|NumFormat}} تومان</div>
                                </a>
                            </li>
                        </ul>
                    </form>
                    <div class="headerLeft">
                        <div class="user" v-if="user">
                            <div class="userItems">
                                <div class="pic">
                                    <img v-if="user.profile == null" src="/img/user.png" :alt="user.name">
                                    <img v-else :src="user.profile" :alt="user.name">
                                </div>
                                <div class="name">
                                    <h3>{{user.name}}</h3>
                                    <h4 v-if="user.number">{{user.number}}</h4>
                                    <h4 v-else>{{user.email}}</h4>
                                </div>
                                <div class="icon">
                                    <i @click="btnShowData(1)">
                                        <span></span>
                                    </i>
                                </div>
                            </div>
                            <ul v-if="showData == 1">
                                <li>
                                    <a href="/profile">
                                        <i>
                                            <svg-icon :icon="'#home2'"></svg-icon>
                                        </i>
                                        مدیریت حساب
                                    </a>
                                </li>
                                <li>
                                    <a href="/profile/bookmark">
                                        <i>
                                            <svg-icon :icon="'#unbookmark'"></svg-icon>
                                        </i>
                                        نشانه گذاری
                                    </a>
                                </li>
                                <li>
                                    <a href="/profile/pay">
                                        <i>
                                            <svg-icon :icon="'#bill'"></svg-icon>
                                        </i>
                                        پرداختی ها
                                    </a>
                                </li>
                                <li>
                                    <a href="/profile/like">
                                        <i>
                                            <svg-icon :icon="'#unlike'"></svg-icon>
                                        </i>
                                        علاقه مندی ها
                                    </a>
                                </li>
                                <li>
                                    <a href="/logout">
                                        <i>
                                            <svg-icon :icon="'#exit'"></svg-icon>
                                        </i>
                                        خروج از حساب
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <a href="/login" class="login" v-if="!user">
                            <span>ثبت نام / ورود</span>
                            <svg-icon :icon="'#down'"></svg-icon>
                        </a>
                        <a href="/login" class="loginRes" v-if="!user">
                            <svg-icon :icon="'#customer'"></svg-icon>
                        </a>
                        <div class="cart" @click="btnShowData(2)">
                            <svg-icon :icon="'#cart'"></svg-icon>
                            <span>{{allCount}}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="headerBot" :style="styleHeaderBot" :class="{ 'navbar--hidden': !showNavbar }">
                <i class="align" @click="showCategory = !showCategory">
                    <svg-icon :icon="'#align'"></svg-icon>
                </i>
                <nav class="list">
                    <ul>
                        <li>
                            <a href="/">خانه</a>
                        </li>
                        <li v-for="item in cats">
                            <a :href="'/products/category/' + item.slug">
                                {{ item.name }}
                                <svg-icon v-if="item.cats.length" :icon="'#down'"></svg-icon>
                            </a>
                            <ul class="allList" v-if="item.cats.length">
                                <li v-for="allList in item.cats.slice(0 , 8)">
                                    <a :href="'/products/category/' + allList.slug" class="allHeaderHomeBlockBotCategoryItemTitle">
                                        {{ allList.name }}
                                        <i>
                                            <svg-icon :icon="'#left'"></svg-icon>
                                        </i>
                                    </a>
                                    <div class="allHeaderHomeBlockBotCategoryItemLists">
                                        <ul>
                                            <li v-for="lists in allList.cats">
                                                <a :href="'/products/category/' + lists.slug">{{lists.name}}</a>
                                            </li>
                                        </ul>
                                        <div class="catPic">
                                            <img :src="allList.image" :alt="allList.name">
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="/ticket">پشتیبانی</a>
                        </li>
                        <li>
                            <a href="/seller">فروشنده شوید</a>
                        </li>
                    </ul>
                    <i class="like">
                        <a href="/profile/like">
                            <svg-icon :icon="'#unlike'"></svg-icon>
                        </a>
                    </i>
                </nav>
            </div>
            <div class="showCartData" @click="btnShowData(2)" v-if="showData == 2">
                <div class="showCartItems" @click.stop="">
                    <div class="titleCart">
                        <h3>سبد خرید شما</h3>
                        <p v-if="allCarts.length == 0">سبد خریدتان خالی است</p>
                        <p v-else>شما {{ allCarts.length }} کالا در سبد خرید خود دارید.</p>
                    </div>
                    <ul v-if="allCarts.length && checkLoader == false">
                        <li v-for="(item , index) in allCarts" :key="index">
                            <div class="cartPic" v-if="item.carts.image">
                                <a :href="'/product/' + item.carts.slug">
                                    <img v-lazy="JSON.parse(item.carts.image)[0]" :alt="item.carts.title">
                                </a>
                            </div>
                            <div class="cartText">
                                <span>{{item.carts.title}}</span>
                                <h4 v-if="item.count.sizeN">{{JSON.parse(item.count.size).name}}</h4>
                                <h4 v-if="item.count.colorN">{{JSON.parse(item.count.color).name}}</h4>
                                <div class="price">
                                    <span>{{item.count.count}} عدد -</span>
                                    {{(item.count.price * item.count.count)|NumFormat}}
                                    تومان
                                </div>
                            </div>
                            <i @click.stop="deleteCart(item.count.sizeN, item.count.guarantee_id, item.count.colorN , item.carts.id , index)">
                                <svg-icon :icon="'#cancel'"></svg-icon>
                            </i>
                        </li>
                    </ul>
                    <div class="showCartEmpty" v-if="allCarts.length == 0 && checkLoader == false">
                        <span>
                            <svg-icon :icon="'#cart'"></svg-icon>
                        </span>
                    </div>
                    <div class="loaderCheck" v-if="checkLoader">
                        <svg-icon :icon="'#loading'"></svg-icon>
                    </div>
                    <div class="allPrice">
                        <h4>تعداد محصولات :</h4>
                        <h5>{{allCount|NumFormat}} محصول</h5>
                    </div>
                    <div class="allPrice">
                        <h4>مبلغ قابل پرداخت :</h4>
                        <h5>{{allSum2|NumFormat}} تومان</h5>
                    </div>
                    <div class="addBtn">
                        <a href="/cart">خرید کنید</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="categoryHeaderResponsive" v-if="showCategory">
            <div class="title">
                <span>منو</span>
                <i @click.prevent="showCategory = !showCategory">
                    <svg-icon :icon="'#cancel'"></svg-icon>
                </i>
            </div>
            <ul class="allCats">
                <li v-for="(allList , index) in cats" :key="index">
                    <div class="allCatsTitle">
                        <a :href="'/products/category/' + allList.slug">{{allList.name}}</a>
                        <i @click.prevent="btnAllListShow(index)">
                            <svg-icon :icon="'#up'" v-if="allListShow == index"></svg-icon>
                            <svg-icon :icon="'#down'" v-else></svg-icon>
                        </i>
                    </div>
                    <ul class="allCatsList" v-if="allList.cats.length && allListShow == index">
                        <li v-for="(lists , index2) in allList.cats.slice(0 , 4)">
                            <div class="allCatsTitle">
                                <a :href="'/products/category/' + lists.slug">{{lists.name}}</a>
                                <i @click.prevent="btnListsShow(index2)">
                                    <svg-icon :icon="'#up'" v-if="listsShow == index2"></svg-icon>
                                    <svg-icon :icon="'#down'" v-else></svg-icon>
                                </i>
                            </div>
                            <ul v-if="lists.cats && listsShow == index2">
                                <li v-for="value in lists.cats">
                                    <div class="allCatsTitle">
                                        <a :href="'/products/category/' + value.slug">{{value.name}}</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li>
                    <div class="allCatsTitle">
                        <a href="/ticket">پشتیبانی</a>
                    </div>
                </li>
            </ul>
        </div>
    </header>
</template>

<script>
import SvgIcon from '../../Svg/SvgIcon.vue';
import 'sweetalert2/dist/sweetalert2.min.css';
export default {
    name: "HeaderHome",
    props:['logo','user','cats'],
    components: { SvgIcon },
    data(){
        return{
            showData: -1,
            showNavbar: true,
            checkLoader: false,
            searchLoader: false,
            showCategory: false,
            allCarts: [],
            count: [],
            carts: [],
            allResult: [],
            allSum: 0,
            allSum2: 0,
            allCount: 0,
            allPay: 0,
            allOff: 0,
            listsShow: -1,
            allListShow: -1,
            searchProduct: '',
            i: 0,
            styleHeader : {
                position: 'absolute',
                top: '0',
                visibility: 'visible',
                right: '0',
                left: '0',
            },
            styleHeaderBot : {
                position: 'relative',
                top: 'auto',
                opacity: '1',
                visibility: 'visible',
            },
        }
    },
    beforeDestroy () {
        window.removeEventListener('scroll', this.onScroll)
    },
    methods:{
        btnAllListShow(num){
            if(this.allListShow == num){
                this.allListShow = -1;
            }else{
                this.allListShow = num;
            }
        },
        btnListsShow(num){
            if(this.listsShow == num){
                this.listsShow = -1;
            }else{
                this.listsShow = num;
            }
        },
        deleteCart(size ,guarantee ,color ,product , index){
            this.$swal.fire({
                title: 'حذف محصول از سبد',
                text: "محصول از سبدتان حذف میشود",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#67B930',
                confirmButtonText: 'حذف شود',
                cancelButtonText: 'پشیمون شدم'
            }).then((result) => {
                if (result.value) {
                    this.showLoader = true;
                    const url = `/delete-cart`;
                    axios.post(url,{
                        size: size,
                        guarantee: guarantee,
                        color: color,
                        product: product,
                    })
                        .then(response=>{
                            this.showLoader = false;
                            this.$eventHub.emit('getCart');
                        })
                }
            })
        },
        btnShowData(num){
            if(this.showData == num){
                this.showData = -1;
            }else{
                this.showData = num;
            }
        },
        onScroll () {
            const currentScrollPosition = window.pageYOffset || document.documentElement.scrollTop
            if (currentScrollPosition < 0) {
                return
            }  // Stop executing this function if the difference between
            // current scroll position and last scroll position is less than some offset
            if (Math.abs(currentScrollPosition - this.lastScrollPosition) < 60) {
                return
            }
            this.showNavbar = currentScrollPosition >= 64
            if(window.innerWidth <= 800){
                this.styleHeader = {
                    position: 'absolute',
                    top: '0',
                    visibility: 'visible',
                    right: '0',
                    left: '0',
                };
                this.styleHeaderBot = {
                    position: 'relative',
                    top: 'auto',
                    opacity: '1',
                    visibility: 'visible',
                };
            }else{
                if(currentScrollPosition >= 64){
                    this.styleHeader = {
                        position: 'fixed',
                        top: '0',
                        visibility: 'visible',
                        right: '0',
                        'box-shadow': '0 0 10px rgba(0,0,0,.2)',
                        left: '0',
                    };
                    this.styleHeaderBot = {
                        position: 'absolute',
                        top: '-9rem',
                        opacity: '0',
                        visibility: 'hidden',
                    };
                }else{
                    this.styleHeader = {
                        position: 'absolute',
                        top: '0',
                        visibility: 'visible',
                        right: '0',
                        left: '0',
                    };
                    this.styleHeaderBot = {
                        position: 'relative',
                        top: 'auto',
                        opacity: '1',
                        visibility: 'visible',
                    };
                }
            }
            this.lastScrollPosition = currentScrollPosition;
        },
        getCarts(){
            this.checkLoader = true;
            const url = '/get-carts';
            axios.get(url)
                .then(response=>{
                    if (response.data == 'no'){

                    }else{
                        this.allCarts =[];
                        this.allSum2 =0;
                        this.allCount =0;
                        this.carts = response.data[0];
                        this.count = response.data[1];
                        for ( this.i ; this.i <  this.carts.length; this.i++) {
                            this.allCarts.push({count : '',carts : '',});
                            this.allCarts[this.i].count = this.count[this.i];
                            this.allCarts[this.i].carts = this.carts[this.i];
                            this.allSum2 = parseInt(this.allSum2) + parseInt(this.count[this.i].price) * parseInt(this.count[this.i].count);
                            this.allCount = parseInt(this.allCount) + parseInt(this.allCarts[this.i].count.count);
                        }
                        this.i = 0;
                    }
                    this.checkLoader = 0;
                })
        },
        startedTyping() {
        },
        searchDataHandler(){
            if (this.searchProduct.length > 1){
                this.searchLoader = true;
                this.stoppedTyping();
            }else{
                this.allResult = [];
            }
        },
        stoppedTyping() {
            if(this.searchProduct){
                const url = '/search-nav';
                axios.post(url , {
                    search : this.searchProduct
                })
                    .then(res => {
                        this.searchLoader = false;
                        this.allResult = res.data;
                    })
            }else{
                this.allResult = [];
            }
        },
    },
    mounted() {
        this.getCarts();
        window.addEventListener('scroll', this.onScroll);
    },
    created: function() {
        this.$eventHub.on('getCart', this.getCarts);
    },
}
</script>

<style scoped>

</style>
