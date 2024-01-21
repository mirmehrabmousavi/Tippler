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
                    <div class="right">
                        <h1>انتخاب آدرس و زمان ارسال</h1>
                        <p>کالاهای موجود در سبد شما ثبت و رزرو نشده‌اند، برای ثبت سفارش مراحل بعدی را تکمیل کنید</p>
                    </div>
                    <div class="left">
                        <label for="dis">
                            <input type="search" v-model="discount" id="dis" placeholder="کد تخفیف را وارد کنید">
                            <button v-if="check == 3">
                                <svg-icon class="loading" :icon="'#loading'"></svg-icon>
                            </button>
                            <button v-else-if="check == 0" @click="btnCheckDiscount">
                                بررسی
                            </button>
                            <button v-else-if="check == 2" class="fail" @click="btnCheckDiscount">
                                بررسی
                            </button>
                            <button v-else class="accept">
                                بررسی
                            </button>
                        </label>
                    </div>
                </div>
                <div class="cartBot">
                    <div class="right">
                        <div class="allAddress" id="address">
                            <div class="loaders" v-if="checkLoader">
                                <i>
                                    <svg-icon class="loading" :icon="'#loading'"></svg-icon>
                                </i>
                            </div>
                            <div class="addressItems" v-else>
                                <div class="address" v-for="(item,index) in allAddress" @click="btnSelect(item.id)">
                                    <div class="titleAddress active" v-if="item.status == 1">
                                        <i>
                                            <svg-icon :icon="'#location2'"></svg-icon>
                                        </i>
                                        <span>آدرس تحویل سفارش</span>
                                    </div>
                                    <div class="titleAddress" v-else>
                                        <i>
                                            <svg-icon :icon="'#location2'"></svg-icon>
                                        </i>
                                        <span>انتخاب آدرس</span>
                                    </div>
                                    <p>{{item.address}}</p>
                                    <div class="nameAddress">
                                        <h5>{{ item.name }}</h5>
                                        <div class="buttons">
                                            <button v-if="item.status != 1">انتخاب</button>
                                            <button @click.stop="editAddress(item.id)">ویرایش</button>
                                            <button @click.stop="btnDelete(item.id)">حذف</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="address" @click="btnAddAddress">
                                <div class="titleAddress add">
                                    <i>
                                        <svg-icon :icon="'#plus2'"></svg-icon>
                                    </i>
                                    <span>افزودن آدرس</span>
                                </div>
                                <p>با افزودن آدرس محصولات خریداری شده به آدرستان ارسال میشود</p>
                            </div>
                        </div>
                        <div class="cartTime" id="time">
                            <div class="cartDaysTitle">
                                <i class="icon">
                                    <svg-icon :icon="'#time'"></svg-icon>
                                </i>
                                <span>انتخاب زمان ارسال</span>
                            </div>
                            <ul>
                                <li v-for="item in days">
                                    <h3>{{item.dayL}}</h3>
                                    <p>
                                        <span>{{item.day}}</span>
                                        <span>{{item.month}}</span>
                                    </p>
                                    <div class="dayItem">
                                        <div class="active" v-if="item.day == getTime.day">
                                            <h4>
                                                بازه
                                                {{item.from}}
                                                -
                                                {{item.to}}
                                            </h4>
                                            <h5 v-if="getCarriers.price >= 1 && getCarriers.limit>=allPay">
                                                <span>
                                                    {{ getCarriers.price|NumFormat }}
                                                    تومان
                                                </span>
                                            </h5>
                                            <h5 v-else>
                                                <span>رایگان</span>
                                            </h5>
                                            <i>
                                                <h4>
                                                    <svg-icon :icon="'#check3'"></svg-icon>
                                                </h4>
                                            </i>
                                        </div>
                                        <div v-else @click="btnTimeGet(item)">
                                            <h4>
                                                بازه
                                                {{item.from}}
                                                -
                                                {{item.to}}
                                            </h4>
                                            <h5 v-if="getCarriers.price >= 1 && getCarriers.limit>=allPay">
                                                <span>
                                                    {{ getCarriers.price|NumFormat }}
                                                    تومان
                                                </span>
                                            </h5>
                                            <h5 v-else>
                                                <span>رایگان</span>
                                            </h5>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="cartTime" id="carrier">
                            <div class="cartDaysTitle">
                                <i class="icon">
                                    <svg-icon :icon="'#carrier'"></svg-icon>
                                </i>
                                <span>انتخاب نوع حامل</span>
                            </div>
                            <ul>
                                <li v-for="item in carriers">
                                    <div class="dayItem">
                                        <div class="active" v-if="item.name == getCarriers.name">
                                            <h4>{{item.name}}</h4>
                                            <i>
                                                <h4>
                                                    <svg-icon :icon="'#carrier-check'"></svg-icon>
                                                </h4>
                                            </i>
                                        </div>
                                        <div v-else @click="sendGetCarriers(item)">
                                            <h4>{{item.name}}</h4>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="payMethod" id="method">
                            <div class="cartDaysTitle">
                                <i class="icon">
                                    <svg-icon :icon="'#payMethod'"></svg-icon>
                                </i>
                                <span>انتخاب روش پرداخت</span>
                            </div>
                            <ul>
                                <li>
                                    <button v-if="method == 0" class="active">
                                        <i class="icon">
                                            <svg-icon :icon="'#payment2'"></svg-icon>
                                        </i>
                                        <span>پرداخت از درگاه</span>
                                    </button>
                                    <button v-else @click="method = 0">
                                        <i class="icon">
                                            <svg-icon :icon="'#payment2'"></svg-icon>
                                        </i>
                                        <span>پرداخت از درگاه</span>
                                    </button>
                                </li>
                                <li>
                                    <button v-if="method == 1" class="active">
                                        <i class="icon">
                                            <svg-icon :icon="'#payment1'"></svg-icon>
                                        </i>
                                        <span>پرداخت درب منزل ( پرداخت بیعانه )</span>
                                    </button>
                                    <button v-else @click="method = 1">
                                        <i class="icon">
                                            <svg-icon :icon="'#payment1'"></svg-icon>
                                        </i>
                                        <span>پرداخت درب منزل ( پرداخت بیعانه )</span>
                                    </button>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="left">
                        <div class="cartNumber">
                            <div class="cartNumberItem">
                                <h4>مبلغ سبد خرید :</h4>
                                <span>{{allPay|NumFormat}} تومان</span>
                            </div>
                            <div class="cartNumberItem">
                                <h4>تعداد محصول :</h4>
                                <span>{{allCount|NumFormat}} محصول</span>
                            </div>
                            <div class="cartNumberItem">
                                <h4>بدون هزینه پست :</h4>
                                <span>{{allPay|NumFormat}} تومان</span>
                            </div>
                        </div>
                        <div class="cartPay">
                            <h4>مبلغ قابل پرداخت</h4>
                            <h5>{{allSum2|NumFormat}} تومان</h5>
                        </div>
                        <div class="nextItem">
                            <a href="#address" v-if="getAddress1 == ''">آدرس را انتخاب کنید</a>
                            <a href="#time" v-else-if="getTime == ''">زمان تحویل را انتخاب کنید</a>
                            <a href="#carrier" v-else-if="getCarriers == ''">نوع حامل را انتخاب کنید</a>
                            <a href="/shop" v-else-if="method == 0">پرداخت از درگاه</a>
                            <a href="/payment-spot" v-else-if="method == 1">پرداخت درب منزل</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <add-address v-if="showAddress" :editAddress="editMyAddress" :map="map" :edited="edit" v-on:sendAddress="getAddress" v-on:sendClose="getClose"></add-address>
    </div>
</template>

<script>
import SvgIcon from "../../Svg/SvgIcon";
import AddAddress from "./AddAddress";
export default {
    name: "CartAddress",
    props:['days','map','carriers'],
    components:{
        AddAddress,
        SvgIcon,
    },
    data() {
        return{
            allCarts : [],
            checkLoader: false,
            i: 0,
            allSum: 0,
            allSum2: 0,
            check: 0,
            method: 0,
            discount: '',
            carts: '',
            showAddress: false,
            count: '',
            allCount: 0,
            allPay: 0,
            allOff: 0,
            allSends: 0,
            edit: 0,
            getCarriers: '',
            getAddress1: '',
            allAddress: [],
            getTime: '',
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
                        theme: "#FCA001",
                        progressBarColor: "#DC0808",
                        position: "bottomRight"
                    },
                }
            },
        }
    },
    methods: {
        btnCheckDiscount(){
            this.check = 3;
            const url = '/check-discount';
            axios.post(url,{
                discount: this.discount
            })
                .then(response =>{
                    if(response.data == 2){
                        this.check = 2;
                    }else{
                        this.check = response.data;
                        if(response.data['post_id'] == null){
                            this.allSum2 = this.allSum2 - ((this.allSum2 * response.data['percent']) / 100);
                        }
                        this.$toast.success('انجام شد', 'کد تخفیف با موفقیت اعمال شد', this.notificationSystem.options.success);
                    }
                })
        },
        btnSelect(id){
            const url = '/select-address';
            axios.post(url,{
                address: id
            })
                .then(response =>{
                    this.getAllAddress();
                    this.getAddress1 = true;
                })
        },
        btnDelete(id){
            const url = '/delete-address';
            axios.post(url,{
                address: id
            })
                .then(response =>{
                    this.getAllAddress();
                })
        },
        getClose(){
            this.showAddress = false;
        },
        getAddress(address){
            this.showAddress = false;
            this.allAddress.push(address);
        },
        editMyAddress(){
            this.getAllAddress();
        },
        editAddress(address){
            const url = '/edit-address';
            axios.post(url,{
                address: address
            })
                .then(response =>{
                    this.edit = response.data;
                    setTimeout(() => this.showAddress = true, 200);
                })
        },
        deleteAddress(address,index){
            const url = '/delete-address';
            axios.post(url,{
                address: address
            })
                .then(response =>{
                    this.allAddress.splice(index,1);
                })
        },
        btnAddAddress(){
            this.edit = 0;
            setTimeout(() => this.showAddress = true, 200);
        },
        getAllAddress(){
            this.checkLoader = true;
            const url = '/get-all-address';
            axios.get(url)
                .then(response =>{
                    this.checkLoader = false;
                    this.allAddress = response.data;
                    for(this.i = 0; this.i < response.data.length; this.i++) {
                        if(response.data[this.i].status == 1) {
                            this.getAddress1 = true;
                        }
                    }
                })
        },
        btnTimeGet(item){
            this.getTime = item;
            if (this.getCarriers){
                if (this.getCarriers.limit <= this.allPay){
                    this.allSends = 0;
                    this.getTime.price = 0;
                }else{
                    this.getTime.price = this.getCarriers.price;
                    this.allSends = this.getCarriers.price;
                }
            }
            this.allSum2 = parseInt(this.allPay) + parseInt(this.allSends);
            const url = '/change-time-delivery';
            axios.post(url,{
                time: JSON.stringify(item)
            })
        },
        sendGetCarriers(item){
            this.getCarriers = item;
            if (this.getTime){
                if (this.getCarriers.limit <= this.allPay){
                    this.allSends = 0;
                    this.getTime.price = 0;
                }else{
                    this.getTime.price = item.price;
                    this.allSends = this.getCarriers.price;
                }
            }
            this.allSum2 = parseInt(this.allPay) + parseInt(this.allSends);
            const url = '/change-carrier';
            axios.post(url,{
                carrier: item.id
            })
        },
        getCarts(){
            if(this.carriers.length){
                this.getCarriers = this.carriers[0];
            }
            this.checkLoader = true;
            const url = '/get-carts';
            axios.get(url)
                .then(response=>{
                    this.allCarts =[];
                    this.allSum2 =0;
                    this.allPay =0;
                    this.allOff =0;
                    this.allCount =0;
                    this.i =0;
                    this.carts = response.data[0];
                    this.count = response.data[1];
                    for ( this.i ; this.i <  this.carts.length; this.i++) {
                        this.allCarts.push({count : '',carts : '',});
                        this.allCarts[this.i].count = this.count[this.i];
                        this.allCarts[this.i].carts = this.carts[this.i];
                        this.allSum2 = parseInt(this.allSum2) + parseInt(this.count[this.i].price) * parseInt(this.count[this.i].count);
                        this.allPay = parseInt(this.allPay) + parseInt(this.count[this.i].price) * parseInt(this.count[this.i].count);
                        this.allCount = parseInt(this.allCount) + parseInt(this.allCarts[this.i].count.count);
                    }
                    this.i = 0;
                    this.checkLoader = false;
                    if(response.data[1][0]['carrier'].length){
                        this.getCarriers = response.data[1][0]['carrier'][0];
                    }else{
                        const url = '/change-carrier';
                        axios.post(url,{
                            carrier: this.getCarriers.id
                        })
                    }
                    if(response.data[1][0]['delivery']){
                        this.getTime = JSON.parse(response.data[1][0]['delivery']);
                        if (this.getCarriers.limit <= this.allPay){
                            this.allSends = 0;
                            this.getTime.price = 0;
                        }else{
                            this.allSends = this.getCarriers.price;
                            this.getTime.price = this.getCarriers.price;
                        }
                    }else{
                        this.allSends = this.getCarriers.price;
                        this.getTime.price = this.getCarriers.price;
                    }
                    this.allSum2 = parseInt(this.allPay) + parseInt(this.allSends);
                })
        },
    },
    mounted() {
        this.getCarts();
        this.getAllAddress();
    },
    created: function() {
        this.$eventHub.on('getCart', this.getCarts);
    },
}
</script>

<style scoped>

</style>
