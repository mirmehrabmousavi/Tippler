<template>
    <admin-layout>
        <div class="allDashboard">
            <div class="allDashboardTitle">
                <h1>داشبورد</h1>
                <div class="title">
                    <inertia-link href="/">خانه</inertia-link>
                    <span>/</span>
                    <inertia-link href="/admin">داشبورد</inertia-link>
                </div>
            </div>
            <div class="panelItems">
                <div class="rightPanel">
                    <div class="topPanelVidgets">
                        <div class="topPanelVidget">
                            <div class="right">
                                <h4>امروز</h4>
                                <h2>{{viewDay|NumFormat}}</h2>
                                <span>تعداد بازدید</span>
                            </div>
                            <div class="left">
                                <svg-icon :icon="'#chartPanel'"></svg-icon>
                            </div>
                        </div>
                        <div class="topPanelVidget">
                            <div class="right">
                                <h4>دیروز</h4>
                                <h2>{{viewYesterday|NumFormat}}</h2>
                                <span>تعداد بازدید</span>
                            </div>
                            <div class="left">
                                <svg-icon :icon="'#chartPanel'"></svg-icon>
                            </div>
                        </div>
                        <div class="topPanelVidget">
                            <div class="right">
                                <h4>این هفته</h4>
                                <h2>{{viewWeek|NumFormat}}</h2>
                                <span>تعداد بازدید</span>
                            </div>
                            <div class="left">
                                <svg-icon :icon="'#chartPanel'"></svg-icon>
                            </div>
                        </div>
                        <div class="topPanelVidget">
                            <div class="right">
                                <h4>این ماه</h4>
                                <h2>{{viewMonth|NumFormat}}</h2>
                                <span>تعداد بازدید</span>
                            </div>
                            <div class="left">
                                <svg-icon :icon="'#chartPanel'"></svg-icon>
                            </div>
                        </div>
                        <div class="topPanelVidget">
                            <div class="right">
                                <h4>امسال</h4>
                                <h2>{{viewYear|NumFormat}}</h2>
                                <span>تعداد بازدید</span>
                            </div>
                            <div class="left">
                                <svg-icon :icon="'#chartPanel'"></svg-icon>
                            </div>
                        </div>
                    </div>
                    <div class="panelCharts">
                        <div class="chartItem">
                            <div class="chartTitle">
                                <h3>وضعیت دیدگاه ها</h3>
                                <inertia-link href="/admin/comment">مشاهده جزییات دیدگاه ها</inertia-link>
                            </div>
                            <apexchart width="300px" type="donut" :options="chartOptions" :series="series"></apexchart>
                        </div>
                        <div class="chartItem">
                            <div class="chartTitle">
                                <h3>وضعیت کاربر ها</h3>
                                <inertia-link href="/admin/user">مشاهده جزییات کاربران</inertia-link>
                            </div>
                            <apexchart width="300px" type="donut" :options="userOptions" :series="userSeries"></apexchart>
                        </div>
                    </div>
                    <div class="allDashboardPay">
                        <label>آمار پرداختی ها</label>
                        <apexchart height="400px" type="area" :options="chartPay" :series="seriesPay"></apexchart>
                    </div>
                    <div class="allDashboardPay">
                        <label>آمار سفارشات</label>
                        <apexchart height="400px" type="area" :options="chartPay" :series="seriesViews"></apexchart>
                    </div>
                </div>
                <div class="leftPanel">
                    <div class="allDashboardUsersItem">
                        <div class="title">
                            <h3>آخرین کاربران</h3>
                            <inertia-link href="/admin/user">مشاهده همه کاربرانی که ثبت نام کردند</inertia-link>
                        </div>
                        <div class="userItems">
                            <div class="userItem" v-for="item in lastUser">
                                <div class="pic">
                                    <img src="/img/user.png">
                                </div>
                                <div class="subject">
                                    <h4>{{item.name}}</h4>
                                    <div class="subjectItems">
                                        <span>{{item.email}}</span>
                                        <span>{{item.created_at}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="allDashboardUsersItem">
                        <div class="title">
                            <h3>آخرین دیدگاه ها</h3>
                            <inertia-link href="/admin/comment">مشاهده همه دیدگاه ها که ارسال کردند</inertia-link>
                        </div>
                        <div class="userItems">
                            <div class="userItem" v-for="item in lastComment">
                                <div class="pic">
                                    <img :src="JSON.parse(item.post.image)[0]">
                                </div>
                                <div class="subject">
                                    <h4>{{item.user.name}}</h4>
                                    <div class="subjectItems">
                                        <span>{{item.body}}</span>
                                        <span>{{item.created_at}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="allDashboardUsersItem">
                        <div class="title">
                            <h3>آخرین محصولات</h3>
                            <inertia-link href="/admin/post">مشاهده همه محصولات که ارسال کردند</inertia-link>
                        </div>
                        <div class="userItems">
                            <div class="userItem" v-for="item in lastPost">
                                <div class="pic">
                                    <img :src="JSON.parse(item.image)[0]">
                                </div>
                                <div class="subject">
                                    <h4>{{item.title}}</h4>
                                    <div class="subjectItems">
                                        <span>{{item.price|NumFormat}} تومان</span>
                                        <span>{{item.created_at}}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </admin-layout>
</template>

<script>
import AdminLayout from "../../components/layout/AdminLayout";
import { Hooper, Slide} from 'hooper';
import 'hooper/dist/hooper.css';
import SvgIcon from "../Svg/SvgIcon";
import Vue from 'vue';
import VueApexCharts from 'vue-apexcharts';
Vue.use(VueApexCharts);

Vue.component('apexchart', VueApexCharts)
export default {
    name: "panel",
    props : ['allow','userData','onlineUser','monthView','viewYear','viewWeek','viewDay','viewYesterday','viewMonth','offUser','lastComment','lastUser','monthPay','checkComment','acceptComment','lastPost'],
    components:{
        Hooper,
        SvgIcon,
        Slide,
        AdminLayout
    },
    data() {
        return {
            hooperSettings: {
                wheelControl:false,
                infiniteScroll:true,
                centerMode: false,
                transition: 2000,
                autoPlay:true,
                playSpeed : 2200,
                itemsToSlide: 1,
                breakpoints: {
                    1100: {
                        itemsToShow: 1,
                    },
                    1200: {
                        itemsToShow: 2,
                    },
                    1300: {
                        itemsToShow: 3,
                    },
                    1400: {
                        itemsToShow: 4,
                    },
                }
            },
            allows: [],
            chartOptions:{
                labels: ['انتظار','تایید'],
                chart:{
                    fontFamily:'irsans, irsans, sans-serif',
                    height:'auto',
                    width:'100%',
                    fontWeight:'300',
                },
                plotOptions:{
                    pie:{
                        donut:{
                            labels:{
                                show: true,
                            }
                        }
                    }
                }
            },
            series:[this.checkComment,this.acceptComment],
            chartPay: {
                chart: {
                    id: 'vuechart-example',
                    fontFamily:'irsans, irsans, sans-serif',
                    height:'auto',
                    width:'100%',
                    fontWeight:'300',
                },
                stroke: {
                    width: 2
                },
                fill: {
                    type: "gradient",
                    gradient: {
                        shadeIntensity: 1,
                        opacityFrom: 0.7,
                        opacityTo: 0.9,
                        stops: [0, 90, 100]
                    }
                },
                labels:['فروردین', 'اردیبهشت', 'خرداد', 'تیر','مرداد','شهریور','مهر','آبان','آذر','دی','بهمن','اسفند'],
            },
            seriesPay: [{
                name: 'تومان',
                data: this.monthPay,
            }],
            seriesViews: [{
                name: 'تعداد',
                data: this.monthView,
            }],
            userOptions:{
                labels: ['آفلاین','آنلاین'],
                chart:{
                    fontFamily:'irsans, irsans, sans-serif',
                    height:'auto',
                    width:'100%',
                    fontWeight:'300',
                },
                plotOptions:{
                    pie:{
                        donut:{
                            labels:{
                                show: true,
                            }
                        }
                    }
                }
            },
            userSeries:[this.offUser,this.onlineUser],
        }
    },
    metaInfo: {
        link: [
            { rel: 'stylesheet', href: '/css/admin.css' },
        ],
      title: 'داشبورد'
    },
    methods:{
        sidebar(){
            this.$eventHub.emit('sidebar' , '0');
        }
    },
    mounted() {
        this.sidebar();
    },
}
</script>

<style scoped>

</style>
