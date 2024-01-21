<template>
    <admin-layout>
        <div class="allSeoSetting">
            <div class="allSeoSettingTitle">
                <div class="allSeoSettingAddress">
                    <inertia-link href="/admin">داشبورد</inertia-link>
                    <span>/</span>
                    <inertia-link href="/admin/setting/setting-popup">تنظیمات پاپ آپ</inertia-link>
                </div>
            </div>
            <div class="allSeoSettingItems">
                <div class="allSeoSettingItem">
                    <label>عنوان پاپ اپ</label>
                    <input v-model="form.titlePop" type="text" placeholder="عنوان را وارد کنید ...">
                </div>
                <div class="allSeoSettingItem">
                    <label>توضیحات پاپ اپ</label>
                    <input v-model="form.descriptionPop" type="text" placeholder="توضیح را وارد کنید ...">
                </div>
                <div class="allSeoSettingItem">
                    <label>متن دکمه پاپ اپ</label>
                    <input v-model="form.buttonPop" type="text" placeholder="متن را وارد کنید ...">
                </div>
                <div class="allSeoSettingItem">
                    <label>رنگ پاپ اپ</label>
                    <input v-model="form.colorPop" type="text" placeholder="مثال : #ffffff">
                </div>
                <div class="allSeoSettingItem">
                    <label>رنگ دکمه پاپ اپ</label>
                    <input v-model="form.colorButtonPop" type="text" placeholder="مثال : #ffffff">
                </div>
                <div class="allSeoSettingItem">
                    <label>تصویر پاپ اپ</label>
                    <div class="sendGallery">
                        <show-image v-on:sendClose="getClose" v-if="showImages" v-on:sendUrl="getUrl"></show-image>
                        <div class="getImageItem" @click="showImages = !showImages">
                            <div class="getImagePic" v-if="form.imagePop" @click.stop="form.imagePop = ''">
                                <img :src="form.imagePop">
                            </div>
                            <span v-else>تصویر شاخص خود را وارد کنید</span>
                        </div>
                    </div>
                </div>
                <div class="allSeoSettingItem">
                    <label>زمان پاپ اپ</label>
                    <div class="allCreateTaxonamiItemTimer">
                        <date-picker
                            v-model="form.timePop"
                            type="datetime"
                            format="YYYY-MM-DD HH:mm"
                            display-format="jYYYY-jMM-jDD HH:mm"
                            placeholder="زمان را وارد کنید"
                            :timezone="true"
                        />
                        <i @click.stop="form.timePop = ''" v-if="form.timePop">
                            <svg-icon :icon="'#cancel'"></svg-icon>
                        </i>
                    </div>
                </div>
                <button class="send" @click.prevent="sendSetting">ارسال</button>
            </div>
        </div>
    </admin-layout>
</template>

<script>
import AdminLayout from "../../../components/layout/AdminLayout";
import SvgIcon from "../../Svg/SvgIcon";
import ShowImage from "../ShowImage";
export default {
    name: "PopUpSetting",
    props : ['descriptionPop','imagePop','titlePop','timePop','buttonPop','colorPop','colorButtonPop'],
    components:{
        ShowImage,
        AdminLayout,
        SvgIcon,
    },
    data() {
        return {
            form:{
                timePop : this.timePop,
                descriptionPop : this.descriptionPop,
                titlePop : this.titlePop,
                buttonPop : this.buttonPop,
                colorPop : this.colorPop,
                colorButtonPop : this.colorButtonPop,
                imagePop : this.imagePop,
                update : 1,
            },
            showImages : false,
        }
    },
    metaInfo: {
      title: 'تنظیمات پاپ آپ'
    },
    methods:{
        getClose() {
            this.showImages = false;
        },
        getUrl(url) {
            this.form.imagePop = url;
        },
        sendSetting(){
            const url = "/admin/setting/setting-popup";
            this.$inertia.post(url , this.form)
            .then(res=>{
                this.$swal.fire(
                    'با موفقیت انجام شد',
                    'تنظیمات با موفقیت انجام شد',
                    'success'
                );
            })
        },
        sidebar(){
            this.$eventHub.emit('sidebar' , '2');
        },
    },
    mounted() {
        this.sidebar();
    }
}
</script>

<style scoped>

</style>
