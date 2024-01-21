<template>
    <div class="allProfileIndex width">
        <profile-list :tab="6"></profile-list>
        <div class="allUserIndexInfo">
            <div class="allUserIndexInfoPersonal">
                <div class="allUserIndexInfoPersonalItems">
                    <div class="allUserIndexInfoPersonalItem">
                        <label>نام و نام خانوادگی</label>
                        <input type="text" placeholder="نام و نام خانوادگی" v-model="form.name">
                        <div class="alert" v-if="errors['name']">
                            {{errors['name'][0]}}
                        </div>
                    </div>
                    <div class="allUserIndexInfoPersonalItem">
                        <label>نام کاریری</label>
                        <input type="text" placeholder="نام کاریری" v-model="form.user">
                        <div class="alert" v-if="errors['user']">
                            {{errors['user'][0]}}
                        </div>
                    </div>
                </div>
                <div class="allUserIndexInfoPersonalItems">
                    <div class="allUserIndexInfoPersonalItem">
                        <label>شماره تماس</label>
                        <h4 @click="changeNum">{{form.number}}</h4>
                    </div>
                    <div class="allUserIndexInfoPersonalItem">
                        <label>ایمیل</label>
                        <h4 @click="changeEmail">{{form.email}}</h4>
                    </div>
                </div>
                <div class="allUserIndexInfoPersonalItems">
                    <div class="allUserIndexInfoPersonalItem">
                        <label>تاریخ تولد</label>
                        <div class="allUserIndexInfoPersonalItemDate">
                            <date-picker
                                v-model="form.date"
                                type="date"
                                format="YYYY-MM-DD"
                                display-format="jYYYY-jMM-jDD"
                            />
                        </div>
                        <div class="alert" v-if="errors['date']">
                            {{errors['date'][0]}}
                        </div>
                    </div>
                    <div class="allUserIndexInfoPersonalItem">
                        <label>شغل</label>
                        <input type="text" placeholder="شغل" v-model="form.job">
                        <div class="alert" v-if="errors['job']">
                            {{errors['job'][0]}}
                        </div>
                    </div>
                </div>
                <div class="allUserIndexInfoPersonalItems">
                    <div class="allUserIndexInfoPersonalItem">
                        <label>کد ملی</label>
                        <input type="text" placeholder="کد ملی" v-model="form.code">
                        <div class="alert" v-if="errors['code']">
                            {{errors['code'][0]}}
                        </div>
                    </div>
                    <div class="allUserIndexInfoPersonalItem">
                        <label>کد پستی</label>
                        <input type="text" placeholder="کد پستی" v-model="form.post">
                        <div class="alert" v-if="errors['post']">
                            {{errors['post'][0]}}
                        </div>
                    </div>
                </div>
                <div class="allUserIndexInfoPersonalItems">
                    <div class="allUserIndexInfoPersonalItem">
                        <label>رمز عبور(در صورت تغییر وارد کنید)</label>
                        <input type="password" placeholder="رمز عبور" v-model="form.password">
                        <div class="alert" v-if="errors['password']">
                            {{errors['password'][0]}}
                        </div>
                    </div>
                    <div class="allUserIndexInfoPersonalItem">
                        <label>آدرس محل زندگی</label>
                        <input type="text" placeholder="آدرس محل زندگی" v-model="form.address">
                        <div class="alert" v-if="errors['address']">
                            {{errors['address'][0]}}
                        </div>
                    </div>
                </div>
                <div class="allUserIndexInfoPersonalItems">
                    <div class="allUserIndexInfoPersonalItem">
                        <label>شماره شبا</label>
                        <input type="text" placeholder="شماره شبا" v-model="form.shaba">
                        <div class="alert" v-if="errors['shaba']">
                            {{errors['shaba'][0]}}
                        </div>
                    </div>
                    <div class="allUserIndexInfoPersonalItem">
                        <label>تلفن ثابت</label>
                        <input type="text" placeholder="تلفن ثابت" v-model="form.landlinePhone">
                        <div class="alert" v-if="errors['landlinePhone']">
                            {{errors['landlinePhone'][0]}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="topSeller">
                <div class="detail">
                    <h4>درباره من</h4>
                    <textarea placeholder="درباره خود ..." v-model="form.about"></textarea>
                </div>
                <div class="map">
                    <mapir :apiKey="map" @click="mapOnClick" :center="form.geo">
                        <mapMarker
                            :coordinates.sync="form.geo"
                            color="red"
                            :draggable="true"
                        />
                    </mapir>
                </div>
            </div>
            <button class="infoButton" @click.prevent="updateUser">تغییر اطلاعات</button>
        </div>
        <div class="showChangeNum" v-if="showChangeNum == 1 || showChangeNum == 2">
            <div class="showChangeNumItems">
                <div class="showChangeNumContainer" v-if="showChangeNum == 1">
                    <label>شماره تماس</label>
                    <div class="alert" v-if="errors['number']">
                        {{errors['number'][0]}}
                    </div>
                    <input @keyup="phoneFormat" type="text" v-model="phone" id="checkPhone" :placeholder="$t('phoneNumber')" maxlength="17" />
                    <div class="buttons">
                        <svg-icon v-if="loading" :icon="'#loading'"></svg-icon>
                        <button v-if="!loading" @click="btnSendCode">ارسال</button>
                        <button @click="showChangeNum = 0">انصراف</button>
                    </div>
                </div>
                <transition name="slide-fade">
                    <div class="allHeaderIndexRegisterItemsContainer" v-if="showChangeNum == 2">
                        <div class="allHeaderIndexRegisterItem">
                            <label>کد تایید</label>
                            <div class="alert" v-if="errors2['code']">
                                {{errors2['code'][0]}}
                            </div>
                            <input v-model="code" type="text" placeholder="کد تایید"/>
                        </div>
                        <div class="allHeaderIndexRegisterItemsContainerButton">
                            <svg-icon v-if="loading" :icon="'#loading'"></svg-icon>
                            <button v-if="!loading" @click="btnCheckCode">ارسال</button>
                            <button @click="showChangeNum = 0">انصراف</button>
                        </div>
                    </div>
                </transition>
            </div>
        </div>
        <div class="showChangeNum" v-if="showChangeNum == 5 || showChangeNum == 6">
            <div class="showChangeNumItems">
                <div class="showChangeNumContainer" v-if="showChangeNum == 5">
                    <label>آدرس ایمیل</label>
                    <div class="alert" v-if="errors['email']">
                        {{errors['email'][0]}}
                    </div>
                    <input type="text" v-model="email" placeholder="آدرس ایمیل"/>
                    <div class="buttons">
                        <svg-icon v-if="loading" :icon="'#loading'"></svg-icon>
                        <button v-if="!loading" @click="btnSendCodeEmail">ارسال</button>
                        <button @click="showChangeNum = 0">انصراف</button>
                    </div>
                </div>
                <transition name="slide-fade">
                    <div class="allHeaderIndexRegisterItemsContainer" v-if="showChangeNum == 6">
                        <div class="allHeaderIndexRegisterItem">
                            <label>کد تایید</label>
                            <div class="alert" v-if="errors2['code']">
                                {{errors2['code'][0]}}
                            </div>
                            <input v-model="code" type="text" placeholder="کد تایید"/>
                        </div>
                        <div class="allHeaderIndexRegisterItemsContainerButton">
                            <svg-icon v-if="loading" :icon="'#loading'"></svg-icon>
                            <button v-if="!loading" @click="btnCheckCodeEmail">ارسال</button>
                            <button @click="showChangeNum = 0">انصراف</button>
                        </div>
                    </div>
                </transition>
            </div>
        </div>
    </div>
</template>

<script>
import ProfileList from "./ProfileList";
import SvgIcon from "../../Svg/SvgIcon";
import VuePersianDatetimePicker from 'vue-persian-datetime-picker'
import { mapir, mapMarker } from "mapir-vue";
export default {
    name: "ProfileInfo",
    props:['map'],
    components: {ProfileList,SvgIcon,datePicker: VuePersianDatetimePicker,mapir,mapMarker,},
    data() {
        return {
            showLoader : false,
            user: user,
            form:{
                geo: [51.420296, 35.732379],
                date: '',
                about: '',
                address: '',
                password: '',
                name: '',
                shaba: '',
                user: '',
                number: '',
                email: '',
                post: '',
                job: '',
                code: '',
                landlinePhone: '',
            },
            sendAgain:false,
            showChangeNum: false,
            code: '',
            phone: '',
            email: '',
            loading: false,
            errors2: [],
            errors: [],
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
        mapOnClick(e) {
            this.form.geo= [e.actualEvent.lngLat.lng , e.actualEvent.lngLat.lat];
        },
        btnCheckCode(){
            this.loading = !this.loading;
            const url  = '/profile/check-code';
            axios.post(url,{
                phone : this.phone,
                code : this.code,
            })
                .then(response=>{
                    if(response.data == 'success'){
                        this.$toast.success('انجام شد', 'تغییر شماره با موفقیت انجام شد', this.notificationSystem.options.success);
                        this.showChangeNum= 0;
                        window.location.reload();
                    }else{
                        this.$toast.error('انجام نشد', 'کد ارسالی اشتباه است', this.notificationSystem.options.error);
                    }
                    this.loading = !this.loading;
                })
                .catch((error)=>{
                    this.errors2 = error.response.data.errors;
                    this.loading = !this.loading;
                });
        },
        btnCheckCodeEmail(){
            this.loading = !this.loading;
            const url  = '/profile/check-email';
            axios.post(url,{
                phone : this.email,
                code : this.code,
            })
                .then(response=>{
                    if(response.data == 'success'){
                        this.$toast.success('انجام شد', 'تغییر ایمیل با موفقیت انجام شد', this.notificationSystem.options.success);
                        this.showChangeNum= 0;
                        window.location.reload();
                    }else{
                        this.$toast.error('انجام نشد', 'کد ارسالی اشتباه است', this.notificationSystem.options.error);
                    }
                    this.loading = !this.loading;
                })
                .catch((error)=>{
                    this.errors2 = error.response.data.errors;
                    this.loading = !this.loading;
                });
        },
        updateUser() {
            const url = `/change-all-user-info/${this.user.id}`;
            axios.put(url , this.form)
                .then(response=>{
                    this.$toast.success('انجام شد', 'تغییر با موفقیت انجام شد', this.notificationSystem.options.success);
                })
                .catch(err =>{
                    this.$toast.error('انجام نشد', 'متاسفانه مشکلی پیش آمد', this.notificationSystem.options.error);
                })
        },
        changeNum(){
            this.phone = '';
            this.code = '';
            this.showChangeNum = 1;
        },
        changeEmail(){
            this.email = '';
            this.code = '';
            this.showChangeNum = 5;
        },
        phoneFormat(){
            const isNumericInput = (event) => {
                const key = event.keyCode;
                return ((key >= 48 && key <= 57) ||
                    (key >= 96 && key <= 105)
                );
            };

            const isModifierKey = (event) => {
                const key = event.keyCode;
                return (event.shiftKey === true || key === 35 || key === 36) ||
                    (key === 8 || key === 9 || key === 13 || key === 46) ||
                    (key > 36 && key < 41) ||
                    (
                        (event.ctrlKey === true || event.metaKey === true) &&
                        (key === 65 || key === 67 || key === 86 || key === 88 || key === 90)
                    )
            };

            const enforceFormat = (event) => {
                if(!isNumericInput(event) && !isModifierKey(event)){
                    event.preventDefault();
                }
            };

            const formatToPhone = (event) => {
                if(isModifierKey(event)) {return;}

                const input = event.target.value.replace(/\D/g,'').substring(0,17);
                const areaCode = input.substring(0,4);
                const middle = input.substring(4,7);
                const last = input.substring(7,17);

                if(input.length > 7){event.target.value = `${areaCode} - ${middle} - ${last}`;}
                else if(input.length > 4){event.target.value = `${areaCode} - ${middle}`;}
                else if(input.length > 0){event.target.value = `${areaCode}`;}
            };

            const inputElement = document.getElementById('checkPhone');
            inputElement.addEventListener('keydown',enforceFormat);
            inputElement.addEventListener('keyup',formatToPhone);
        },
        btnSendCode(){
            this.loading = !this.loading;
            const url  = '/check-auth';
            axios.post(url,{
                number : this.phone,
                show : 1
            })
                .then(response=>{
                    if(response.data == 3){
                        this.showChangeNum= 2;
                    }else{
                        this.$toast.error('انجام نشد', 'شماره تماس وجود دارد', this.notificationSystem.options.error);
                    }
                    this.loading = !this.loading;
                })
                .catch((error)=>{
                    this.loading = !this.loading;
                    this.$toast.error('انجام نشد', 'شماره تماس وجود دارد', this.notificationSystem.options.error);
                });
        },
        btnSendCodeEmail(){
            this.loading = !this.loading;
            const url  = '/check-email';
            axios.post(url,{
                email : this.email,
                show : 1
            })
                .then(response=>{
                    if(response.data == 3){
                        this.showChangeNum= 6;
                    }else{
                        this.$toast.error('انجام نشد', 'ایمیل وجود دارد', this.notificationSystem.options.error);
                    }
                    this.loading = !this.loading;
                })
                .catch((error)=>{
                    this.loading = !this.loading;
                    this.$toast.error('انجام نشد', 'ایمیل وجود دارد', this.notificationSystem.options.error);
                });
        },
        check(){
            if(this.user.user_meta.length){
                this.form.date = this.user.user_meta[0].date;
                this.form.name = this.user.user_meta[0].name;
                this.form.post = this.user.user_meta[0].post;
                this.form.job = this.user.user_meta[0].job;
                this.form.code = this.user.user_meta[0].code;
                this.form.address = this.user.user_meta[0].address;
            }
            if(this.user.geo != '' || this.user.geo != null){
                this.form.geo= [JSON.parse(this.user.geo).lng , JSON.parse(this.user.geo).lat];
            }
            this.form.user = this.user.name;
            this.form.about = this.user.about;
            this.form.number = this.user.number;
            this.form.email = this.user.email;
            this.form.shaba = this.user.shaba;
            this.form.landlinePhone = this.user.landlinePhone;
            this.form.password = this.user.password;
        },
    },
    mounted(){
        this.check();
    }
}
</script>

<style scoped>

</style>
