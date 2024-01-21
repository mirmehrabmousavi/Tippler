<template>
    <div class="allProfileIndex width">
        <profile-list></profile-list>
        <div class="allShowPay">
            <div class="topShowPay">
                <div class="title">
                    <h1>جزئیات سفارش</h1>
                    <span>{{pay.created_at}}</span>
                    <div v-if="pay.pay_meta.length">
                        <span v-if="pay.pay_meta[0].post.type != 1 && pay.status == 100">
                            <a :href="'/pay/invoice/' + pay.property">دریافت فاکتور</a>
                        </span>
                    </div>
                    <button v-if="pay.back == 2">مبلغ برگشت داده شده به حساب بانکی</button>
                    <button v-if="pay.back == 1">مبلغ برگشت داده شده به حساب سایت</button>
                </div>
                <div class="detail">
                    <div class="topDetail">
                        <div class="items" v-if="pay.address.length">
                            <div class="item">
                                <h5>تحویل گیرنده :</h5>
                                <div>{{pay.address[0].name}}</div>
                            </div>
                            <div class="item">
                                <h5>شماره تماس :</h5>
                                <div>{{pay.address[0].number}}</div>
                            </div>
                        </div>
                        <div class="items">
                            <div class="item" v-if="pay.address.length">
                                <h5>آدرس محل زندگی :</h5>
                                <div>{{pay.address[0].address}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="botDetail">
                        <div class="items">
                            <div class="item">
                                <h5>مبلغ قابل پرداخت :</h5>
                                <div>{{pay.price|NumFormat}} تومان</div>
                            </div>
                            <div class="item" v-if="pay.method == 2">
                                <h5>مبلغ بیعانه :</h5>
                                <div>{{pay.deposit|NumFormat}} تومان</div>
                            </div>
                            <div class="item">
                                <h5>وضعیت پرداخت :</h5>
                                <div class="active" v-if="pay.status == 100">پرداخت شده</div>
                                <div class="active" v-else-if="pay.status == 50">پرداخت بیعانه</div>
                                <div class="unActive" v-else>پرداخت نشده</div>
                            </div>
                            <div class="item">
                                <h5>روش پرداخت :</h5>
                                <div v-if="pay.method == 0">خرید از درگاه پرداخت</div>
                                <div v-if="pay.method == 1">خرید از کیف پولتان</div>
                                <div v-if="pay.method == 2">پرداخت در محل</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="trackPay">
                    <label>کد رهگیری :</label>
                    <h4 v-if="pay.track">{{pay.track}}</h4>
                    <h4 v-else>نامشخص</h4>
                </div>
            </div>
            <div class="allShowPayContainer">
                <div class="topContainer">
                    <div class="level">
                        <h3>مرحله مرسوله :</h3>
                        <span v-if="pay.deliver == 0">دریافت سفارش</span>
                        <span v-if="pay.deliver == 1">در انتظار بررسی</span>
                        <span v-if="pay.deliver == 2">بسته بندی شده</span>
                        <span v-if="pay.deliver == 3">تحویل پیک</span>
                        <span v-if="pay.deliver == 4">تکمیل شده</span>
                    </div>
                    <div class="rateItemsCount">
                        <div class="rateItemsCountItem" title="دریافت سفارش">
                            <div class="rateItemsCountItemBarActive" v-if="pay.deliver >= 1">
                            </div>
                            <div class="rateItemsCountItemBar" v-if="pay.deliver == 0">
                            </div>
                            <div class="rateItemsCountItemCircleActives" v-if="pay.deliver >= 1">
                                <svg-icon :icon="'#delivery-complete'"></svg-icon>
                            </div>
                            <div class="rateItemsCountItemCircleActive" v-if="pay.deliver == 0">
                                <svg-icon :icon="'#delivery-complete'"></svg-icon>
                            </div>
                        </div>
                        <div class="rateItemsCountItem" title="در انتظار بررسی">
                            <div class="rateItemsCountItemBarActive" v-if="pay.deliver >= 2">
                            </div>
                            <div class="rateItemsCountItemBar" v-if="pay.deliver <= 1">
                            </div>
                            <div class="rateItemsCountItemCircleActives" v-if="pay.deliver >= 2">
                                <svg-icon :icon="'#waiting-room'"></svg-icon>
                            </div>
                            <div class="rateItemsCountItemCircleActive" v-if="pay.deliver == 1">
                                <svg-icon :icon="'#waiting-room'"></svg-icon>
                            </div>
                            <div class="rateItemsCountItemCircle" v-if="pay.deliver <= 0">
                                <svg-icon :icon="'#waiting-room'"></svg-icon>
                            </div>
                        </div>
                        <div class="rateItemsCountItem" title="بسته بندی شده">
                            <div class="rateItemsCountItemBarActive" v-if="pay.deliver >= 3">
                            </div>
                            <div class="rateItemsCountItemBar" v-if="pay.deliver <= 2">
                            </div>
                            <div class="rateItemsCountItemCircleActives" v-if="pay.deliver >= 3">
                                <svg-icon :icon="'#package-delivery'"></svg-icon>
                            </div>
                            <div class="rateItemsCountItemCircleActive" v-if="pay.deliver == 2">
                                <svg-icon :icon="'#package-delivery'"></svg-icon>
                            </div>
                            <div class="rateItemsCountItemCircle" v-if="pay.deliver <= 1">
                                <svg-icon :icon="'#package-delivery'"></svg-icon>
                            </div>
                        </div>
                        <div class="rateItemsCountItem" title="تحویل پیک">
                            <div class="rateItemsCountItemBarActive" v-if="pay.deliver >= 4">
                            </div>
                            <div class="rateItemsCountItemBar" v-if="pay.deliver <= 3">
                            </div>
                            <div class="rateItemsCountItemCircleActives" v-if="pay.deliver >= 4">
                                <svg-icon :icon="'#delivery-truck'"></svg-icon>
                            </div>
                            <div class="rateItemsCountItemCircleActive" v-if="pay.deliver == 3">
                                <svg-icon :icon="'#delivery-truck'"></svg-icon>
                            </div>
                            <div class="rateItemsCountItemCircle" v-if="pay.deliver <= 2">
                                <svg-icon :icon="'#delivery-truck'"></svg-icon>
                            </div>
                        </div>
                        <div class="rateItemsCountItem" title="تکمیل شده">
                            <div class="rateItemsCountItemCircleActive" v-if="pay.deliver == 4">
                                <svg-icon :icon="'#delivery-box'"></svg-icon>
                            </div>
                            <div class="rateItemsCountItemCircle" v-if="pay.deliver <= 3">
                                <svg-icon :icon="'#delivery-box'"></svg-icon>
                            </div>
                        </div>
                    </div>
                    <div class="code">
                        <h3>شماره سفارش :</h3>
                        <span>{{pay.property}}</span>
                    </div>
                </div>
                <div class="items">
                    <div class="title">محصولاتی که سفارش داده شده</div>
                    <div class="item" v-for="item in pay.pay_meta">
                        <a :href="'/product/'+item.post.slug" class="cartDetailPic">
                            <img :src="JSON.parse(item.post.image)[0]" :alt="item.post.title">
                        </a>
                        <div class="cartDetailInfo">
                            <a :href="'/product/'+item.post.slug" class="cartDetailInfoItem">
                                <h3>{{item.post.title}}</h3>
                            </a>
                            <div class="cartDetailInfoItem" v-if="JSON.parse(item.color) != ''">
                                <i>
                                    <svg-icon :icon="'#color'"></svg-icon>
                                </i>
                                <span>{{JSON.parse(item.color).name}}</span>
                            </div>
                            <div class="cartDetailInfoItem" v-if="JSON.parse(item.size) != ''">
                                <i>
                                    <svg-icon :icon="'#sizeFront'"></svg-icon>
                                </i>
                                <span>{{JSON.parse(item.size).name}}</span>
                            </div>
                            <div class="cartDetailInfoItem" v-if="item.guarantee.length">
                                <i>
                                    <svg-icon :icon="'#security'"></svg-icon>
                                </i>
                                <span>{{item.guarantee[0].name}}</span>
                            </div>
                            <div class="cartDetailInfoItem">
                                <i>
                                    <svg-icon :icon="'#post'"></svg-icon>
                                </i>
                                <span>{{item.count}}</span>
                            </div>
                            <div class="cartDetailInfoItem">
                                <i>
                                    <svg-icon :icon="'#cost'"></svg-icon>
                                </i>
                                <span>{{item.price|NumFormat}} تومان</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ProfileList from "./ProfileList";
import SvgIcon from "../../Svg/SvgIcon";
export default {
    name: "ShowPay",
    components: {ProfileList,SvgIcon},
    props: ['pay']
}
</script>

<style scoped>

</style>
