<template>
    <div class="allProfileIndex width">
        <profile-list :tab="1"></profile-list>
        <div class="allUserIndexInfoPay">
            <h3>سفارشات شما</h3>
            <table>
                <tr>
                    <th>#</th>
                    <th>وضعیت ارسال</th>
                    <th>شماره سفارش</th>
                    <th>تاریخ سفارش</th>
                    <th>عملیات</th>
                </tr>
                <tr v-for="(item , index) in pays">
                    <td>
                        <span>{{++index}}</span>
                    </td>
                    <td>
                        <span class="unActive" v-if="item.deliver == 0">دریافت سفارش</span>
                        <span class="unActive" v-if="item.deliver == 1">در انتظار بررسی</span>
                        <span class="unActive" v-if="item.deliver == 2">بسته بندی شده</span>
                        <span class="unActive" v-if="item.deliver == 3">تحویل پیک</span>
                        <span class="active" v-if="item.deliver == 4">تکمیل شده</span>
                    </td>
                    <td>
                        <span>{{item.property}}</span>
                    </td>
                    <td>
                        <span>{{item.created_at}}</span>
                    </td>
                    <td>
                        <a :href="'/show-pay/'+item.property">
                            <svg-icon :icon="'#left'"></svg-icon>
                        </a>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</template>

<script>
import ProfileList from "./ProfileList";
import SvgIcon from "../../Svg/SvgIcon";
export default {
    name: "ProfilePay",
    props:['pays'],
    components: {ProfileList,SvgIcon},
}
</script>

<style scoped>

</style>
