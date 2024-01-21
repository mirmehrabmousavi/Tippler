<template>
    <div class="allCartIndex">
        <div class="cartData width">
            <div class="backIcon">
                <svg-icon :icon="'#pattern2'"></svg-icon>
            </div>
            <div class="shape">
                <svg-icon :icon="'#shape'"></svg-icon>
            </div>
            <div class="cartManage">
                <div class="cartTitle">
                    <h1>سبد خرید</h1>
                    <p>کالاهای موجود در سبد شما ثبت و رزرو نشده‌اند، برای ثبت سفارش مراحل بعدی را تکمیل کنید</p>
                </div>
                <div class="cartBot">
                    <div class="right">
                        <div class="cartCount">
                            <i>
                                <svg-icon :icon="'#cart2'"></svg-icon>
                            </i>
                            <h4>
                                تعداد محصولات سبد خرید :
                                {{allCount}}
                                محصول
                            </h4>
                        </div>
                        <div class="loaders" v-if="checkLoader">
                            <div class="loaderItem">
                                <div class="loader">
                                    <div class="avatar"></div>
                                    <div class="line"></div>
                                    <div class="line"></div>
                                    <div class="line"></div>
                                </div>
                            </div>
                        </div>
                        <div class="cartItems" v-else>
                            <div class="cartItem" v-for="item in allCarts">
                                <div class="cartPic">
                                    <a :href="'/product/' + item.carts.slug">
                                        <img v-lazy="JSON.parse(item.carts.image)[0]" :alt="item.carts.title">
                                    </a>
                                </div>
                                <div class="cartSubject">
                                    <div class="titleCart">
                                        <a :href="'/product/' + item.carts.slug">{{item.carts.title}}</a>
                                        <button @click.stop="deleteCart(item.count.sizeN, item.count.guarantee_id, item.count.colorN , item.carts.id , index)">حذف</button>
                                    </div>
                                    <div class="cartPrice">
                                        <div class="price">
                                            <s v-if="item.off">{{(item.carts.offPrice*item.count.count)|NumFormat}}</s>
                                            <h4>
                                                {{(item.count.price*item.count.count)|NumFormat}}
                                            </h4>
                                            <span>تومان</span>
                                        </div>
                                        <div class="seller">
                                            <h4>فروشنده :</h4>
                                            <span>{{item.carts.user.name}}</span>
                                        </div>
                                    </div>
                                    <div class="cartDetail">
                                        <div class="productCount">
                                            <button @click.stop="changeCart(item.count.sizeN, item.count.guarantee_id, item.count.colorN , item.carts.id , 0)">-</button>
                                            <span>{{item.count.count}}</span>
                                            <button @click.stop="changeCart(item.count.sizeN, item.count.guarantee_id, item.count.colorN , item.carts.id , 1)">+</button>
                                        </div>
                                        <div class="productSize" v-if="item.count.sizeN">
                                            <h4>سایز :</h4>
                                            <span>{{JSON.parse(item.count.size).name}}</span>
                                        </div>
                                        <div class="productColors" v-if="item.count.colorN">
                                            <div class="productColor">
                                                <h4>رنگ :</h4>
                                                <div class="color">
                                                    <i>
                                                        <svg-icon :icon="'#circle'" :style="{'fill' : JSON.parse(item.count.color).color}"></svg-icon>
                                                    </i>
                                                    <span>{{JSON.parse(item.count.color).name}}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="left">
                        <div class="cartNumber">
                            <div class="cartNumberItem">
                                <h4>مبلغ سبد خرید :</h4>
                                <span>{{allSum2|NumFormat}} تومان</span>
                            </div>
                            <div class="cartNumberItem">
                                <h4>تعداد محصولات :</h4>
                                <span>{{allCount|NumFormat}} محصول</span>
                            </div>
                            <div class="cartNumberItem">
                                <h4>بدون هزینه پست :</h4>
                                <span>{{allSum2|NumFormat}} تومان</span>
                            </div>
                        </div>
                        <div class="cartPay">
                            <h4>مبلغ قابل پرداخت</h4>
                            <h5>{{allSum2|NumFormat}} تومان</h5>
                        </div>
                        <div class="nextItem">
                            <a href="/cart-address" v-if="user">ادامه فرآیند خرید</a>
                            <a href="/login" v-else>وارد حسابتان شوید</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import SvgIcon from "../../Svg/SvgIcon";

export default {
    name: "CartIndex",
    components:{
        SvgIcon,
    },
    data(){
        return {
            user: user,
            allCarts : [],
            checkLoader: false,
            i: 0,
            allSum: 0,
            allSum2: 0,
            carts: '',
            count: '',
            allCount: 0,
            allPay: 0,
            allOff: 0,
        }
    },
    methods:{
        changeCart(size ,guarantee ,color ,product , index){
            this.showLoader = true;
            const url = `/change-cart`;
            axios.post(url,{
                size: size,
                guarantee: guarantee,
                color: color,
                product: product,
                change: index,
            })
                .then(response=>{
                    this.showLoader = false;
                    this.$eventHub.emit('getCart');
                })
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
        getCarts(){
            this.checkLoader = true;
            const url = '/get-carts';
            axios.get(url)
                .then(response=>{
                    this.allCarts =[];
                    this.allSum2 =0;
                    this.allPay =0;
                    this.allOff =0;
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
                    this.checkLoader = false;
                })
        },
    },
    mounted() {
        this.getCarts();
    },
    created: function() {
        this.$eventHub.on('getCart', this.getCarts);
    },
}
</script>

<style scoped>

</style>
