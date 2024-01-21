<template>
    <section class="allUserIndexLists">
        <div class="userTop">
            <img src="/img/profile.avif" alt="userData.name">
        </div>
        <div class="userLists">
            <h1>{{userData.name}}</h1>
            <div class="userLogo">
                <i>
                    <dropzone ref="myVueDropzone3" id="dropzone" :options="dropzoneOptions" :useCustomSlot=true v-on:vdropzone-success="uploadAllFile">
                        <svg-icon :icon="'#pencil'"></svg-icon>
                    </dropzone>
                </i>
                <img v-if="profile == null" src="/img/user.png" :alt="userData.name">
                <img v-else :src="profile" :alt="userData.name">
            </div>
            <div class="allUserIndexListsItems">
                <div class="allUserIndexListsItem">
                    <a href="/seller/profile" v-if="tab == 0" class="active">داشبورد</a>
                    <a href="/seller/profile" v-else >داشبورد</a>
                </div>
                <div class="allUserIndexListsItem">
                    <a href="/seller/product/create" v-if="tab == 1" class="active">افزودن محصول</a>
                    <a href="/seller/product/create" v-else>افزودن محصول</a>
                </div>
                <div class="allUserIndexListsItem">
                    <a href="/seller/product/user" v-if="tab == 2" class="active">محصولات شما</a>
                    <a href="/seller/product/user" v-else>محصولات شما</a>
                </div>
                <div class="allUserIndexListsItem">
                    <a href="/seller/product/all" v-if="tab == 3" class="active">افزودن تنوع</a>
                    <a href="/seller/product/all" v-else>افزودن تنوع</a>
                </div>
                <div class="allUserIndexListsItem">
                    <a href="/seller/checkout" v-if="tab == 4" class="active">تسویه حساب</a>
                    <a href="/seller/checkout" v-else>تسویه حساب</a>
                </div>
                <div class="allUserIndexListsItem">
                    <a href="/seller/pay" v-if="tab == 5" class="active">سفارشات</a>
                    <a href="/seller/pay" v-else>سفارشات</a>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
import SvgIcon from "../../Svg/SvgIcon";
import Dropzone from 'vue2-dropzone';
import 'vue2-dropzone/dist/vue2Dropzone.min.css';
export default {
    name: "SellerList",
    props:['tab'],
    components:{
        SvgIcon,
        Dropzone,
    },
    data(){
        return{
            showData: 0,
            profile: user.profile,
            userData: user,
            dropzoneOptions: {
                url: '/change-profile',
                timeout: 999999999999999999999999999999999999,
                maxFilesize: 1,
                addRemoveLinks: true,
                parallelUploads: 100,
                maxFiles: 100,
                maxThumbnailFilesize: 100,
                dictDefaultMessage: 'یک فایل PDF را در اینجا رها کنید یا برای انتخاب پرونده برای بارگذاری کلیک کنید.',
                dictFileTooBig: 'فایل ارسالی باید کمتر از 1 مگابایت باشد',
                dictFallbackMessage: 'مرورگر شما از بارگذاری پرونده drag\'n\'drop پشتیبانی نمی کند.',
                dictFallbackText: 'لطفاً برای بارگذاری پرونده های خود مانند روزهای گذشته از فرم بازگشت به پایین استفاده کنید.',
                dictInvalidFileType: 'نمی توانید پرونده هایی از این نوع را بارگذاری کنید.',
                dictResponseError: 'سرور با کد {{statusCode}} پاسخ داد.',
                dictCancelUpload: 'لغو بارگذاری',
                dictCancelUploadConfirmation: 'آیا مطمئن هستید که می خواهید این بارگذاری را لغو کنید؟',
                dictRemoveFile: 'حذف فایل',
                dictMaxFilesExceeded : 'دیگر نمی توانید پرونده بارگذاری کنید.',
                headers: {'X-CSRF-TOKEN': document.head.querySelector("[name=csrf-token]").content}
            },
        }
    },
    methods:{
        uploadAllFile(file , response){
            this.profile = response.url;
        },
        btnShow(num){
            if(this.showData == num){
                this.showData = 0;
            }else{
                this.showData = num;
            }
        }
    }
}
</script>
