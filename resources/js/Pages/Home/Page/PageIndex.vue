<template>
    <div class="allPages">
        <mapir :apiKey="mapirToken" :center="geo" v-if="page.form == 1">
            <mapMarker
                :coordinates.sync="geo"
                color="red"
                :draggable="false"
            />
        </mapir>
        <div class="content width" v-if="page.form == 1">
            <div class="address">
                <span>خانه</span>
                <span>{{page.title}}</span>
            </div>
            <h1>{{page.title}}</h1>
            <div class="contact">
                <div class="contactItems">
                    <h3>آدرس</h3>
                    <div class="contactItem">
                        <span>ایمیل :</span>
                        <span>{{email}}</span>
                    </div>
                    <div class="contactItem">
                        <span>شماره تماس :</span>
                        <span>{{number}}</span>
                    </div>
                    <div class="contactBody">
                        <h4>درباره ما</h4>
                        <p>{{about}}</p>
                    </div>
                </div>
                <div class="contactItems">
                    <h3>ارسال پیغام</h3>
                    <div class="contactItemInputs">
                        <div class="contactItemInput">
                            <h3>نام</h3>
                            <input type="text" v-model="form.name" placeholder="نام">
                        </div>
                        <div class="contactItemInput">
                            <h3>آدرس ایمیل</h3>
                            <input type="text" v-model="form.email" placeholder="آدرس ایمیل">
                        </div>
                    </div>
                    <div class="contactItemInput">
                        <h3>درخواست</h3>
                        <textarea v-model="form.body" placeholder="درخواست"></textarea>
                    </div>
                    <div class="buttons">
                        <button v-if="loader">
                            <svg-icon class="loading" :icon="'#loading'"></svg-icon>
                        </button>
                        <button v-else @click="sendReport">ارسال</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="page" v-if="page.form == 0">
            <div class="backImage">
                <img src="/img/aboutus.jpg" :alt="page.title">
            </div>
            <div class="pageBlog width" :style="style">
                <div class="allPagesTitle">
                    <h1>{{page.title}}</h1>
                </div>
                <div class="allPagesBody">
                    <p v-html="page.body"></p>
                    <div class="form" v-if="page.form">
                        <div class="items">
                            <div class="item">
                                <h3>نام :</h3>
                                <input type="text" v-model="form.name" placeholder="نام :">
                            </div>
                            <div class="item">
                                <h3>ایمیل</h3>
                                <input type="text" v-model="form.email" placeholder="ایمیل">
                            </div>
                        </div>
                        <div class="item">
                            <h3>درخواست</h3>
                            <textarea v-model="form.body" placeholder="درخواست"></textarea>
                        </div>
                        <div class="buttons">
                            <button v-if="loader">
                                <svg-icon class="loading" :icon="'#loading'"></svg-icon>
                            </button>
                            <button v-else @click="sendReport">ارسال</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import SvgIcon from "../../Svg/SvgIcon";
import {mapir, mapMarker} from "mapir-vue";
export default {
    name: "PageIndex",
    components: { SvgIcon,mapMarker,mapir },
    props:['page','map','email','number','about'],
    data(){
        return{
            form:{
                name: '',
                email: '',
                body: '',
            },
            geo: [51.420296, 35.732379],
            mapirToken: this.map,
            forms: '',
            loader: false,
            style: 'margin-top:-15rem',
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
        sendReport(){
            this.loader = true;
            this.forms = JSON.stringify(this.form);
            const url = '/send-call'
            axios.post(url,{
                forms:this.forms
            })
                .then(response=>{
                    this.loader = false;
                    this.$toast.success('انجام شد', 'بازخورد شما با موفقیت ثبت شد', this.notificationSystem.options.success);
                    window.location.reload();
                })
                .catch(err =>{
                    this.loader = false;
                    this.$toast.error('انجام نشد', 'متاسفانه مشکلی پیش آمد', this.notificationSystem.options.error);
                })
        },
    },
    mounted() {
        if(this.page.form == 1){
            this.style= 'margin-top:0';
        }else{
            this.style= 'margin-top:-15rem';
        }
    }
}
</script>

<style scoped>

</style>
