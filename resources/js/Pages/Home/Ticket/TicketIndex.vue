<template>
    <div class="allTicketIndex">
        <div class="allSendTicket">
            <h1 v-if="showAsk">پرسش و پاسخ متداول</h1>
            <div class="questions width" v-if="showAsk">
                <div class="questionIndex" v-for="(item,index) in asks">
                    <div class="title" @click="btnShow(index)">
                        <h3>{{item.name}}</h3>
                        <i>
                            <svg-icon :icon="'#down'"></svg-icon>
                        </i>
                    </div>
                    <transition name="slide-fade">
                        <div class="description" v-if="show == index">
                            <p v-html="item.body"></p>
                        </div>
                    </transition>
                </div>
            </div>
            <div class="sendTicket" v-else>
                <div class="sendTicketTitle">
                    ارسال تیکت
                </div>
                <div class="ticketItems">
                    <div class="ticketItem">
                        <h4>نام و نام خانوادگی</h4>
                        <input type="text" v-model="name" placeholder="نام و نام خانوادگی">
                    </div>
                    <div class="ticketItem">
                        <h4>ایمیل</h4>
                        <input type="text" v-model="email" placeholder="ایمیل">
                    </div>
                </div>
                <div class="ticketItem">
                    <h4>درخواست *</h4>
                    <textarea v-model="ticket" placeholder="درخواست"></textarea>
                </div>
                <div class="createImage">
                    <dropzone ref="myVueDropzone" id="dropzone" v-on:vdropzone-success="uploadAllFile" :options="dropzoneOptionsUser" :useCustomSlot=true>
                        <div class="dropzone-custom-content">
                            <h3 class="dropzone-custom-title">فایل پیوست</h3>
                            <div class="subtitle">فایل پیوست را در اینجا قرار دهید</div>
                        </div>
                    </dropzone>
                </div>
                <div class="sendTicketButtons">
                    <button v-if="loading">
                        <svg-icon class="loading" :icon="'#loading'"></svg-icon>
                    </button>
                    <button v-else @click="sendTicket">ارسال</button>
                </div>
            </div>
            <div class="buttons" v-if="showAsk" @click="showAsk = !showAsk">
                <button>ارسال تیکت</button>
            </div>
        </div>
    </div>
</template>

<script>
import SvgIcon from "../../Svg/SvgIcon";
import Dropzone from "vue2-dropzone";
import 'vue2-dropzone/dist/vue2Dropzone.min.css';
export default {
    name: "TicketIndex",
    props:['asks'],
    components: {
        SvgIcon,
        Dropzone
    },
    data(){
        return{
            showTicket: false,
            ticket: '',
            name: '',
            email: '',
            file: '',
            loading: false,
            showAsk: true,
            show: -1,
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
            dropzoneOptionsUser: {
                url: '/create-image',
                thumbnailWidth: 150,
                maxFilesize: 12000000,
                timeout: 999999999999999999999999999999999999,
                addRemoveLinks: true,
                parallelUploads: 1,
                maxFiles: 1,
                dictDefaultMessage: 'یک فایل PDF را در اینجا رها کنید یا برای انتخاب پرونده برای بارگذاری کلیک کنید.',
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
        btnShow(index){
            if(this.show == index){
                this.show = -1;
            }else{
                this.show = index;
            }
        },
        btnClose(){
            this.$emit('sendClose');
        },
        sendTicket(){
            if(this.ticket == ''){
                this.$toast.error('انجام نشد', 'فیلد درخواست اجباری است', this.notificationSystem.options.error);
            }else{
                this.loading = true;
                const url = '/send-ticket';
                axios.post(url,{
                    ticket: this.ticket,
                    file: this.file,
                    name: this.name,
                    email: this.email,
                })
                    .then(response =>{
                        if (response.data == 'noUser'){
                            this.$toast.error('عضو نیستید', 'ابتدا عضو شوید', this.notificationSystem.options.error);
                        }else{
                            this.$toast.success('انجام شد', 'عملیات با موفقیت انجام شد', this.notificationSystem.options.success);
                            this.ticket = '';
                            this.name = '';
                            this.email = '';
                            this.$emit('sendClose');
                        }
                        this.loading = false;
                    })
                    .catch(err=>{
                        this.$toast.error('انجام نشد', 'متاسفانه مشکلی پیش آمد', this.notificationSystem.options.error);
                        this.loading = false;
                    })
            }
        },
        uploadAllFile(file , response){
            this.file = response.url;
        },
    }
}
</script>

<style scoped>

</style>
