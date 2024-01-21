<template>
    <main class="allProfileIndex width">
        <profile-list :tab="0"></profile-list>
        <div class="allUserIndexInfoPay">
            <h3>آخرین سفارشات شما</h3>
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
        <div class="allUserIndexInfoTop">
            <div class="allUserIndexInfoTopItem">
                <label>آخرین علاقه مندی ها</label>
                <ul>
                    <li v-for="(item , index) in like.slice(0,3)">
                        <a :href="'/product/' + item.slug">
                            <div class="userItemPic">
                                <img :src="JSON.parse(item.image)[0]" :alt="item.title">
                            </div>
                            <div class="userItemSubject">
                                <div class="userItemSubjectTitle">{{item.title}}</div>
                                <div class="postPriceItem">
                                    <div class="offPrice" v-if="item.off != null">
                                        <s>{{item.offPrice|NumFormat}} تومان</s>
                                    </div>
                                    <h3>{{item.price|NumFormat}} تومان</h3>
                                </div>
                            </div>
                        </a>
                        <i @click.stop="btnLike(item.id , index)">
                            <svg-icon :icon="'#trash'"></svg-icon>
                        </i>
                    </li>
                </ul>
            </div>
            <div class="allUserIndexInfoTopItem">
                <label>آخرین نشانه ها</label>
                <ul>
                    <li v-for="(item , index) in bookmark.slice(0,3)">
                        <a :href="'/product/' + item.slug">
                            <div class="userItemPic">
                                <img :src="JSON.parse(item.image)[0]" :alt="item.title">
                            </div>
                            <div class="userItemSubject">
                                <div class="userItemSubjectTitle">{{item.title}}</div>
                                <div class="postPriceItem">
                                    <div class="offPrice" v-if="item.off != null">
                                        <s>{{item.offPrice|NumFormat}} تومان</s>
                                    </div>
                                    <h3>{{item.price|NumFormat}} تومان</h3>
                                </div>
                            </div>
                        </a>
                        <i @click.stop="btnBookmark(item.id , index)">
                            <svg-icon :icon="'#trash'"></svg-icon>
                        </i>
                    </li>
                </ul>
            </div>
        </div>
    </main>
</template>

<script>
import ProfileList from './ProfileList'
import SvgIcon from "../../Svg/SvgIcon";
export default {
    name: "ProfileIndex",
    components: {ProfileList,SvgIcon},
    props: ['pays','bookmark','like']
}
</script>

<style scoped>

</style>
