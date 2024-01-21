<template>
    <div class="allProfileIndex width">
        <seller-list :tab="4"></seller-list>
        <div class="allCheckoutIndex">
            <div class="widgetItems">
                <div class="widgetItem">
                    <div class="widgetIcon">
                        <svg-icon :icon="'#bill'"></svg-icon>
                    </div>
                    <div class="widgetSubject">
                        <h4>کل درآمد شما</h4>
                        <h5>{{allpays|NumFormat}} تومان</h5>
                    </div>
                </div>
                <div class="widgetItem">
                    <div class="widgetIcon">
                        <svg-icon :icon="'#bill'"></svg-icon>
                    </div>
                    <div class="widgetSubject">
                        <h4>تسویه حساب شده</h4>
                        <h5>{{checksum|NumFormat}} تومان</h5>
                    </div>
                </div>
                <div class="widgetItem">
                    <div class="widgetIcon">
                        <svg-icon :icon="'#bill'"></svg-icon>
                    </div>
                    <div class="widgetSubject">
                        <h4>در کیف پولتان</h4>
                        <h5>{{(allpays-checksum)|NumFormat}} تومان</h5>
                    </div>
                </div>
            </div>
            <div class="allCheckoutTop">
                <ul>
                    <li>با توجه به مکانیزه بودن عملیات تسویه حساب لطفا از صحت شماره شبای خود اطمینان حاصل فرمایید</li>
                    <li>
                        <h4>
                            شماره شبا شما در
                            <a href="/profile/personal-info">ویرایش حساب</a>
                            قابل مشاهده است
                        </h4>
                    </li>
                </ul>
            </div>
            <div class="allCheckoutData">
                <ul>
                    <li>
                        <h4>سقف درخواست شما برای تسویه :</h4>
                        <span>{{(allpays-checksum)|NumFormat}} تومان</span>
                    </li>
                </ul>
                <button v-if="send && !exist" @click="btnCheckout">درخواست تسویه حساب</button>
            </div>
            <table>
                <tr>
                    <th>#</th>
                    <th>شماره درخواست</th>
                    <th>شماره شبا</th>
                    <th>مبلغ</th>
                    <th>وضعیت پرداخت</th>
                </tr>
                <tr v-for="(item, index) in allCheck" :key="index">
                    <td>
                        <span>{{++index}}</span>
                    </td>
                    <td>
                        <span>{{item.id}}</span>
                    </td>
                    <td>
                        <span>{{item.shaba}}</span>
                    </td>
                    <td>
                        <span>{{item.price|NumFormat}} تومان </span>
                    </td>
                    <td>
                        <span>
                            <span v-if="item.status == 0">در انتطار بررسی</span>
                            <span v-if="item.status == 1" class="unActive">رد شده</span>
                            <span v-if="item.status == 2" class="activeStatus">پرداخت شده</span>
                        </span>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</template>

<script>
import SellerList from "./SellerList";
import SvgIcon from "../../Svg/SvgIcon";
export default {
    name: "SellerCheckout",
    components: {SellerList,SvgIcon},
    props: ['check','allpays','checksum','exist'],
    data(){
        return{
            send: 0,
            allCheck: this.check,
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
        }
    },
    methods:{
        checkData(){
            if(this.check.length){
                if((parseInt(this.allpays) - parseInt(this.checksum)) >= 1000){
                    this.send = this.check[0].status;
                }
            }else{
                if((parseInt(this.allpays) - parseInt(this.checksum)) >= 1000){
                    this.send = 1;
                }
            }
        },
        btnCheckout(){
            const url = `/seller/checkout`;
            axios.post(url)
                .then(response=>{
                    this.send = 0;
                    if(response.data == 'shaba'){
                        this.$toast.error('انجام نشد', 'ابتدا شماره شبا را در صفحه ویرایش حساب وارد کنید', this.notificationSystem.options.error);
                    }else{
                        this.$toast.success('انجام شد', 'درخواست تسویه حساب با موفقیت اضافه شد', this.notificationSystem.options.success);
                        this.allCheck.push(response.data);
                    }
                })
        }
    },
    mounted(){
        this.checkData();
    }
}
</script>

<style scoped>

</style>
