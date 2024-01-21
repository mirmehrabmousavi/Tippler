<template>
    <div class="allProfileIndex width">
        <seller-list :tab="5"></seller-list>
        <div class="allPayPanel">
            <div class="widgetItems">
                <div class="widgetItem">
                    <div class="widgetIcon">
                        <svg-icon :icon="'#payList'"></svg-icon>
                    </div>
                    <div class="widgetSubject">
                        <h4>درآمد امروز</h4>
                        <h5>{{today|NumFormat}} تومان</h5>
                    </div>
                </div>
                <div class="widgetItem">
                    <div class="widgetIcon">
                        <svg-icon :icon="'#payList'"></svg-icon>
                    </div>
                    <div class="widgetSubject">
                        <h4>درآمد این هفته</h4>
                        <h5>{{week|NumFormat}} تومان</h5>
                    </div>
                </div>
                <div class="widgetItem">
                    <div class="widgetIcon">
                        <svg-icon :icon="'#payList'"></svg-icon>
                    </div>
                    <div class="widgetSubject">
                        <h4>کل درآمد شما</h4>
                        <h5>{{allpays|NumFormat}} تومان</h5>
                    </div>
                </div>
            </div>
            <div class="allPays">
                <table>
                    <tr>
                        <th>#</th>
                        <th>شماره سفارش</th>
                        <th>کاربر</th>
                        <th>محصول</th>
                        <th>قیمت محصول</th>
                        <th>عملیات</th>
                    </tr>
                    <tr v-for="(item, index) in AllPay" :key="index">
                        <td>
                            <span>{{++index}}</span>
                        </td>
                        <td>
                            <span>{{item.pay.property}}</span>
                        </td>
                        <td>
                            <span>{{item.user.name}}</span>
                        </td>
                        <td>
                            <span>{{item.post.title}}</span>
                        </td>
                        <td>
                            <span>{{item.price|NumFormat}} تومان </span>
                        </td>
                        <td>
                                <span>
                                    <i @click="btnShow(item.id)"><svg-icon :icon="'#eye'"></svg-icon></i>
                                </span>
                        </td>
                    </tr>
                </table>
                <div class="allShowFastPost" v-if="showPay != ''">
                    <div class="allShowFastPostPanel">
                        <div class="userInfo">
                            <div class="userInfoItem">
                                <label>مبلغ خرید :</label>
                                <span>{{showPay.price|NumFormat}} تومان</span>
                            </div>
                            <div class="userInfoItem">
                                <label>محصول :</label>
                                <span>
                                    <a :href="'/product/'+ showPay.post.slug">
                                        {{showPay.post.title}}
                                    </a>
                                </span>
                            </div>
                            <div class="userInfoItem">
                                <label>وضعیت پرداخت :</label>
                                <span v-if="showPay.status == 100">پرداخت شده</span>
                                <span v-else-if="showPay.status == 50">پرداخت بیعانه</span>
                                <span v-else>پرداخت نشده</span>
                            </div>
                            <div class="userInfoItem">
                                <label>وضعیت ارسال :</label>
                                <span v-if="showPay.pay.deliver == 0">دریافت سفارش</span>
                                <span v-if="showPay.pay.deliver == 1">در انتظار بررسی</span>
                                <span v-if="showPay.pay.deliver == 2">بسته بندی شده</span>
                                <span v-if="showPay.pay.deliver == 3">تحویل پیک</span>
                                <span v-if="showPay.pay.deliver == 4">تکمیل شده</span>
                            </div>
                            <div class="userInfoItem">
                                <label v-if="JSON.parse(showPay.color) != ''">رنگ محصول :</label>
                                <span>{{JSON.parse(showPay.color).name}}</span>
                            </div>
                            <div class="userInfoItem">
                                <label v-if="JSON.parse(showPay.size) != ''">سایز :</label>
                                <span>{{JSON.parse(showPay.size).name}}</span>
                            </div>
                            <div class="userInfoItem">
                                <label>تعداد سفارش :</label>
                                <span>{{showPay.count}}</span>
                            </div>
                            <div class="userInfoItem">
                                <label>زمان تحویل :</label>
                                <span>{{showPay.count}}</span>
                            </div>
                            <div class="userInfoItem">
                                <label>زمان پرداخت :</label>
                                <span>{{showPay.created_at}}</span>
                            </div>
                            <div class="userInfoItem">
                                <label>شماره سفارش :</label>
                                <span>{{showPay.pay.property}}</span>
                            </div>
                            <div class="userInfoItem">
                                <label>آیدی خریدار :</label>
                                <span>{{showPay.user.id}}</span>
                            </div>
                            <div class="userInfoItem">
                                <label>نام خریدار :</label>
                                <span>{{showPay.user.user_meta[0].name}}</span>
                            </div>
                            <div class="userInfoItem">
                                <label>شماره تماس خریدار :</label>
                                <span>{{showPay.user.number}}</span>
                            </div>
                            <div class="userInfoItem">
                                <label>ایمیل خریدار :</label>
                                <span>{{showPay.user.email}}</span>
                            </div>
                            <div class="userInfoItem" v-if="payData.time">
                                <label>روز ارسال :</label>
                                <span>
                                    {{JSON.parse(payData.time).dayL}}
                                </span>
                            </div>
                            <div class="userInfoItem" v-if="payData.time">
                                <label>بازه زمانی ارسال :</label>
                                <span>
                                    {{JSON.parse(payData.time).from}}
                                    -
                                    {{JSON.parse(payData.time).to}}
                                </span>
                            </div>
                            <div class="userInfoItem" v-if="payData.address.length">
                                <label>کد پستی خریدار :</label>
                                <span>{{payData.address[0].post}}</span>
                            </div>
                            <div class="userInfoItem" v-if="payData.address.length">
                                <label>آدرس خریدار :</label>
                                <span>{{payData.address[0].address}}</span>
                            </div>
                        </div>
                        <div class="buttons">
                            <button @click="showPay = []">انصراف</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import SellerList from "./SellerList";
import VuePersianDatetimePicker from "vue-persian-datetime-picker";
import SvgIcon from "../../Svg/SvgIcon";
export default {
    name: "SellerPay",
    components:{
        SellerList,
        datePicker: VuePersianDatetimePicker,
        SvgIcon,
    },
    props:['pays','allpays','today','week'],
    data() {
        return {
            showPay : [],
            payData : [],
            AllPay : this.pays.data,
        }
    },
    methods:{
        btnShow(id){
            const url = `/seller/pay/${id}`;
            axios.get(url)
                .then(response=>{
                    this.showPay = response.data[0];
                    this.payData = response.data[1];
                })
        },
    },
}
</script>

<style scoped>

</style>
