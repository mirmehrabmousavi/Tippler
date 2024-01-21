<template>
    <admin-layout>
        <div class="allSettingManage">
            <div class="title">
                <div class="right">
                    <h1>تنظیمات سایت</h1>
                </div>
                <div class="left">
                    <inertia-link href="/">خانه</inertia-link>
                    <span>/</span>
                    <inertia-link href="/admin">داشبورد</inertia-link>
                    <span>/</span>
                    <inertia-link href="/admin/setting/setting-comment">تنظیمات سایت</inertia-link>
                </div>
            </div>
            <div class="allSettingManageContainer">
                <div class="allSettingManageItems">
                    <div class="allSettingManageItem">
                        <label>نام سایت</label>
                        <input type="text" placeholder="نام سایت را وارد کنید" v-model="form.name">
                    </div>
                    <div class="allSettingManageItem">
                        <label>عنوان سایت</label>
                        <input type="text" placeholder="عنوان سایت را وارد کنید" v-model="form.title">
                    </div>
                    <div class="allSettingManageItem">
                        <label>درصد بیعانه</label>
                        <input type="text" placeholder="درصد را وارد کنید" v-model="form.deposit">
                    </div>
                    <div class="allSettingManageItem">
                        <label>آدرس سایت</label>
                        <input type="text" placeholder="https://golden-site.ir/" v-model="form.address">
                    </div>
                    <div class="allSettingManageItem">
                        <label>حروف قبل شناسه کالا</label>
                        <input type="text" placeholder="حروف را وارد کنید" v-model="form.productId">
                    </div>
                    <div class="allSettingManageItem">
                        <label>آدرس ایمیل</label>
                        <input type="text" placeholder="آدرس ایمیل را وارد کنید" v-model="form.email">
                    </div>
                    <div class="allSettingManageItem">
                        <label>شماره تماس</label>
                        <input type="text" placeholder="شماره تماس را وارد کنید" v-model="form.number">
                    </div>
                    <div class="allSettingManageItem">
                        <label>آدرس نماد اعتماد الکترونیکی</label>
                        <input type="text" placeholder="آدرس را وارد کنید" v-model="form.etemad">
                    </div>
                    <div class="allSettingManageItem">
                        <label>آدرس مرکز فناوری اطلاعات دیجیتال</label>
                        <input type="text" placeholder="آدرس را وارد کنید" v-model="form.fanavari">
                    </div>
                    <div class="allSettingManageItem">
                        <label>توکن تاپین</label>
                        <input type="text" placeholder="توکن را وارد کنید" v-model="form.tokenTapin">
                    </div>
                    <div class="allSettingManageItem">
                        <label>شناسه فروشگاه تاپین</label>
                        <input type="text" placeholder="شناسه را وارد کنید" v-model="form.shopTapin">
                    </div>
                    <div class="settingCommunication">
                        <div class="allSettingManageItem">
                            <label>تلگرام</label>
                            <input type="text" placeholder="آدرس تلگرام خود را وارد کنید" v-model="form.telegram">
                        </div>
                        <div class="allSettingManageItem">
                            <label>اینستاگرام</label>
                            <input type="text" placeholder="آدرس اینستاگرام خود را وارد کنید" v-model="form.instagram">
                        </div>
                    </div>
                    <div class="settingCommunication">
                        <div class="allSettingManageItem">
                            <label>توییتر</label>
                            <input type="text" placeholder="آدرس توییتر خود را وارد کنید" v-model="form.twitter">
                        </div>
                        <div class="allSettingManageItem">
                            <label>فیسبوک</label>
                            <input type="text" placeholder="آدرس فیسبوک خود را وارد کنید" v-model="form.facebook">
                        </div>
                    </div>
                    <div class="allSettingManageItem">
                        <label>درباره ما</label>
                        <textarea placeholder="درباره ما را وارد کنید" v-model="form.about"></textarea>
                    </div>
                </div>
                <div class="allSettingManageItems">
                    <div class="allSettingManageItem">
                        <label>آدرس لوگو</label>
                        <div class="sendGallery">
                            <show-image v-on:sendClose="getClose" v-if="showImage" v-on:sendUrl="getUrl"></show-image>
                            <div class="getImageItem" @click="showImage = !showImage">
                                <div class="getImagePic" v-if="form.image">
                                    <img :src="form.image">
                                </div>
                                <span v-else>تصویر شاخص خود را وارد کنید</span>
                            </div>
                        </div>
                    </div>
                    <div class="allSettingManageRole">
                        <label>مقام پیشفرض برای کاربران :</label>
                        <div class="allCategoryPanel" @click="showRole = !showRole">
                            <div class="categoryShow">
                                <h4>{{form.role}}</h4>
                                <i>
                                    <svg-icon :icon="'#down'"></svg-icon>
                                </i>
                            </div>
                            <ul v-if="showRole">
                                <VuePerfectScrollbar class="scroll-area" v-once :settings="settings">
                                    <li v-for="item in roles" @click="sendRole(item.name)">{{item.name}}</li>
                                </VuePerfectScrollbar>
                            </ul>
                        </div>
                    </div>
                    <div class="captchaItem">
                        <label for="s3d" class="item">
                            ورود از طریق جیمیل
                            <input id="s3d" type="checkbox" class="switch" v-model="form.gm">
                        </label>
                    </div>
                    <div class="allSettingManageShow" title="نمایش تعداد پست های هر دسته بندی در هر صفحه">
                        <label>
                            تعداد پست برای صفحه بندی
                            <input type="number" placeholder="تعداد را وارد کنید" v-model="form.showPostPage">
                        </label>
                    </div>
                    <div class="allSettingManageShow" title="نمایش تعداد پست های هر دسته بندی در هر اسلایدر">
                        <label>
                            نمایش تعداد کالا در هر اسلایدر دسته بندی
                            <input type="number" placeholder="تعداد را وارد کنید" v-model="form.showPostCategory">
                        </label>
                    </div>
                </div>
            </div>
            <div class="button" @click="sendSetting">
                <button>ارسال</button>
            </div>
        </div>
    </admin-layout>
</template>

<script>
import AdminLayout from '../../../components/layout/AdminLayout'
import SvgIcon from "../../Svg/SvgIcon";
import ShowImage from "../ShowImage";
import VuePerfectScrollbar from "vue-perfect-scrollbar";
export default {
    name: "SettingManage",
    props:['name','deposit','roles','tokenTapin','shopTapin','tokenApp','role','gm','showPostPage','showPostCategory','logo','pay','about','fanavari','number','etemad','title','captcha','address','verify','email','merchant','twitter','facebook','instagram','telegram'],
    components:{
        AdminLayout,
        VuePerfectScrollbar,
        ShowImage,
        SvgIcon
    },
    data(){
        return{
            form:{
                showPostPage: this.showPostPage,
                showPostCategory: this.showPostCategory,
                image: this.logo,
                about: this.about,
                aboutEn: this.aboutEn,
                twitter: this.twitter,
                name: this.name,
                telegram: this.telegram,
                instagram: this.instagram,
                facebook: this.facebook,
                email: this.email,
                tokenApp: this.tokenApp,
                tokenTapin: this.tokenTapin,
                shopTapin: this.shopTapin,
                title: this.title,
                deposit: this.deposit,
                address: this.address,
                merchant: this.merchant,
                fanavari: this.fanavari,
                etemad: this.etemad,
                number: this.number,
                role: this.role,
                productId: this.productId,
                pay: this.pay,
                captcha: this.captcha,
                gm: this.gm,
                verify: this.verify,
            },
            settings: {
                maxScrollbarLength: 60
            },
            showRole : false,
            showImage : false,
        }
    },
    methods:{
        sendSetting(){
            const url = "/admin/setting/setting-manage";
            this.$inertia.put(url , this.form)
            this.$swal.fire(
                'با موفقیت انجام شد',
                'تنظیمات با موفقیت انجام شد',
                'success'
            );
        },
        sendRole(name){
            this.form.role = name;
        },
        getClose(){
            this.showImage = !this.showImage;
        },
        getUrl(url){
            this.form.image = url;
        },
        checks(){
            if (this.verify == '0'){
                this.form.verify = 0;
            }
            if (this.gm == '0'){
                this.form.gm = 0;
            }
            if (this.captcha == '0'){
                this.form.captcha = 0;
            }
            if (this.search == '0'){
                this.form.search = 0;
            }
            if (this.verifyEmail == '0'){
                this.form.verifyEmail = 0;
            }
            if (this.languages == '0'){
                this.form.language = 0;
            }
        },
        sidebar(){
            this.$eventHub.emit('sidebar' , '2');
        },
    },
    mounted() {
        this.checks();
        this.sidebar();
    },
    metaInfo: {
        link: [
            { rel: 'stylesheet', href: '/css/admin.css' },
        ],
      title: 'تنظیمات مدیریت'
    },
}
</script>

<style scoped>

</style>
