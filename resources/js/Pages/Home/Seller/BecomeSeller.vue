<template>
    <div class="allBecomeSellers width">
        <div class="allBecomeSeller">
            <div class="allBecomeSellerTop">
                <div class="allBecomeSellerLevels">
                    <div class="allBecomeSellerLevel" title="اطلاعات فروشنده">
                        <div class="allBecomeSellerLevelBarActive" v-if="form.level >= 2">
                        </div>
                        <div class="allBecomeSellerLevelBar" v-if="form.level == 1">
                        </div>
                        <div class="allBecomeSellerLevelCircleActives" v-if="form.level >= 2">
                            <svg-icon :icon="'#contact-info'"></svg-icon>
                        </div>
                        <div class="allBecomeSellerLevelCircleActive" v-if="form.level == 1">
                            <svg-icon :icon="'#contact-info'"></svg-icon>
                        </div>
                    </div>
                    <div class="allBecomeSellerLevel" title="بارگذاری مدارک">
                        <div class="allBecomeSellerLevelBarActive" v-if="form.level >= 3">
                        </div>
                        <div class="allBecomeSellerLevelBar" v-if="form.level <= 2">
                        </div>
                        <div class="allBecomeSellerLevelCircleActives" v-if="form.level >= 3">
                            <svg-icon :icon="'#uploadDocuments'"></svg-icon>
                        </div>
                        <div class="allBecomeSellerLevelCircleActive" v-if="form.level == 2">
                            <svg-icon :icon="'#uploadDocuments'"></svg-icon>
                        </div>
                        <div class="allBecomeSellerLevelCircle" v-if="form.level <= 1">
                            <svg-icon :icon="'#uploadDocuments'"></svg-icon>
                        </div>
                    </div>
                    <div class="allBecomeSellerLevel" title="بررسی مدارک شما">
                        <div class="allBecomeSellerLevelBarActive" v-if="form.level >= 4">
                        </div>
                        <div class="allBecomeSellerLevelBar" v-if="form.level <= 3">
                        </div>
                        <div class="allBecomeSellerLevelCircleActives" v-if="form.level >= 4">
                            <svg-icon :icon="'#checkDocuments'"></svg-icon>
                        </div>
                        <div class="allBecomeSellerLevelCircleActive" v-if="form.level == 3">
                            <svg-icon :icon="'#checkDocuments'"></svg-icon>
                        </div>
                        <div class="allBecomeSellerLevelCircle" v-if="form.level <= 2">
                            <svg-icon :icon="'#checkDocuments'"></svg-icon>
                        </div>
                    </div>
                    <div class="allBecomeSellerLevel" title="اتمام ثبت نام">
                        <div class="allBecomeSellerLevelCircleActives" v-if="form.level >= 5">
                            <svg-icon :icon="'#welcomeSeller'"></svg-icon>
                        </div>
                        <div class="allBecomeSellerLevelCircleActive" v-if="form.level == 4">
                            <svg-icon :icon="'#welcomeSeller'"></svg-icon>
                        </div>
                        <div class="allBecomeSellerLevelCircle" v-if="form.level <= 3">
                            <svg-icon :icon="'#welcomeSeller'"></svg-icon>
                        </div>
                    </div>
                </div>
                <h4 v-if="form.level == 1">اطلاعات فروشنده</h4>
                <p v-if="form.level == 1">اطلاعات شخصی فروشنده ، اطلاعات تجاری ، اطلاعات تماس</p>
                <h4 v-if="form.level == 2">بارگذاری مدارک</h4>
                <p v-if="form.level == 2">اطلاعات مربوط به مالیات بر ارزش افزوده ، تصویر مدارک شخصی و تجاری</p>
                <h4 v-if="form.level == 3">بررسی مدارک شما</h4>
                <p v-if="form.level == 3">بعد تایید مدارک دکمه اتمام رو بزنید در صورت رد مدارک روی گذینه ارسال مجدد بزنید</p>
                <h4 v-if="form.level == 4">اتمام ثبت نام</h4>
                <p v-if="form.level == 4">به جمع فروشندگان خوش آمدید.</p>
            </div>
            <div class="allBecomeUserInfo" v-if="form.level == 1">
                <div class="allBecomeTip">
                    <i>
                        <svg-icon :icon="'#lamp'"></svg-icon>
                    </i>
                    <span>توجه :</span>
                    <p>پر کردن تمامی موارد الزامیست.</p>
                </div>
                <div class="sellerType">
                    <h3>چه نوع فروشنده ای هستید؟</h3>
                    <div class="allCategoryPanel" @click="btnShowStatus(1)">
                        <div class="categoryShow">
                            <h4 v-if="form.seller == 0">شخص حقیقی</h4>
                            <h4 v-if="form.seller == 1">شخص حقوقی</h4>
                            <i>
                                <svg-icon :icon="'#down'"></svg-icon>
                            </i>
                        </div>
                        <ul v-if="showStatus == 1">
                            <li @click.stop="btnSeller(0)">شخص حقیقی</li>
                            <li @click.stop="btnSeller(1)">شخص حقوقی</li>
                        </ul>
                    </div>
                    <p v-if="form.seller == 0">شخص حقیقی فردی است که دارای خصوصیاتی مختص به خود مانند نام، نام خانوادگی، تاریخ تولد، کد ملی، شماره شناسنامه و غیره می باشد.</p>
                    <p v-if="form.seller == 1">شخص حقوقی موسسات یا شرکت هایی هستند که پس از طی مراحل قانونی به ثبت می‌رسند و دارای مشخصاتی مانند نام شخص حقوقی، تاریخ ثبت، شماره ثبت، کد شناسایی، کد اقتصادی، موضوع فعالیت و غیره می باشند.</p>
                </div>
                <div class="personInfoSeller" v-if="form.seller == 0">
                    <h3>اطلاعات فروشنده</h3>
                    <div class="personInfoItems">
                        <div class="personInfoItem">
                            <h4>نام و نام خانوادگی</h4>
                            <input type="text" placeholder="نام و نام خانوادگی" v-model="form.name">
                            <div class="alert" v-if="errors['name']">
                                {{errors['name'][0]}}
                            </div>
                        </div>
                        <div class="personInfoItem">
                            <h4>کد ملی</h4>
                            <input type="text" placeholder="کد ملی" v-model="form.code">
                            <div class="alert" v-if="errors['code']">
                                {{errors['code'][0]}}
                            </div>
                        </div>
                    </div>
                    <div class="personInfoItems">
                        <div class="personInfoItem">
                            <h4>جنسیت</h4>
                            <div class="allCategoryPanel" @click="btnShowStatus(2)">
                                <div class="categoryShow">
                                    <h4 v-if="form.gender == 0">مرد</h4>
                                    <h4 v-if="form.gender == 1">زن</h4>
                                    <i>
                                        <svg-icon :icon="'#down'"></svg-icon>
                                    </i>
                                </div>
                                <ul v-if="showStatus == 2">
                                    <li @click.stop="btnGender(0)">مرد</li>
                                    <li @click.stop="btnGender(1)">زن</li>
                                </ul>
                            </div>
                            <div class="alert" v-if="errors['gender']">
                                {{errors['gender'][0]}}
                            </div>
                        </div>
                        <div class="personInfoItem">
                            <h4>تاریخ تولد</h4>
                            <date-picker
                                v-model="form.dateBirth"
                                type="date"
                                format="YYYY-MM-DD"
                                display-format="jYYYY-jMM-jDD"
                            />
                            <div class="alert" v-if="errors['dateBirth']">
                                {{errors['dateBirth'][0]}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="personInfoSeller" v-if="form.seller == 1">
                    <h3>اطلاعات شرکتی</h3>
                    <div class="personInfoItems">
                        <div class="personInfoItem">
                            <h4>نام کمپانی</h4>
                            <input type="text" placeholder="نام کمپانی" v-model="form.companyName">
                            <div class="alert" v-if="errors['companyName']">
                                {{errors['companyName'][0]}}
                            </div>
                        </div>
                    </div>
                    <div class="personInfoItems">
                        <div class="personInfoItem">
                            <h4>نوع شرکت</h4>
                            <div class="allCategoryPanel" @click="btnShowStatus(3)">
                                <div class="categoryShow">
                                    <h4 v-if="form.type == 0">سهامی عام</h4>
                                    <h4 v-if="form.type == 1">سهامی خاص</h4>
                                    <h4 v-if="form.type == 2">مسئولیت محدود</h4>
                                    <h4 v-if="form.type == 3">تعاونی</h4>
                                    <h4 v-if="form.type == 4">تضامنی</h4>
                                    <i>
                                        <svg-icon :icon="'#down'"></svg-icon>
                                    </i>
                                </div>
                                <ul v-if="showStatus == 3">
                                    <li @click.stop="btnType(0)">سهامی عام</li>
                                    <li @click.stop="btnType(1)">سهامی خاص</li>
                                    <li @click.stop="btnType(2)">مسئولیت محدود</li>
                                    <li @click.stop="btnType(3)">تعاونی</li>
                                    <li @click.stop="btnType(4)">تضامنی</li>
                                </ul>
                            </div>
                            <div class="alert" v-if="errors['type']">
                                {{errors['type'][0]}}
                            </div>
                        </div>
                        <div class="personInfoItem">
                            <h4>شماره ثبت</h4>
                            <input type="text" placeholder="شماره ثبت" v-model="form.registrationNumber">
                            <div class="alert" v-if="errors['registrationNumber']">
                                {{errors['registrationNumber'][0]}}
                            </div>
                        </div>
                    </div>
                    <div class="personInfoItems">
                        <div class="personInfoItem">
                            <h4>شناسه ملی</h4>
                            <input type="text" placeholder="شناسه ملی" v-model="form.nationalID">
                            <div class="alert" v-if="errors['nationalID']">
                                {{errors['nationalID'][0]}}
                            </div>
                        </div>
                        <div class="personInfoItem">
                            <h4>کد اقتصادی</h4>
                            <input type="text" placeholder="کد اقتصادی" v-model="form.economicCode">
                            <div class="alert" v-if="errors['economicCode']">
                                {{errors['economicCode'][0]}}
                            </div>
                        </div>
                    </div>
                    <div class="personInfoItems">
                        <div class="personInfoItem">
                            <h4>صاحبان حق امضا</h4>
                            <input type="text" placeholder="صاحبان حق امضا" v-model="form.signatureOwners">
                            <div class="alert" v-if="errors['signatureOwners']">
                                {{errors['signatureOwners'][0]}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="contactSeller">
                    <h3>اطلاعات تماس</h3>
                    <div class="personInfoItems">
                        <div class="personInfoItem">
                            <h4>آدرس</h4>
                            <input type="text" placeholder="آدرس" v-model="form.residenceAddress">
                            <div class="alert" v-if="errors['residenceAddress']">
                                {{errors['residenceAddress'][0]}}
                            </div>
                        </div>
                    </div>
                    <div class="personInfoItems">
                        <div class="personInfoItem">
                            <h4>کد پستی</h4>
                            <input type="text" placeholder="کد پستی" v-model="form.post">
                            <div class="alert" v-if="errors['post']">
                                {{errors['post'][0]}}
                            </div>
                        </div>
                        <div class="personInfoItem">
                            <h4>آدرس ایمیل</h4>
                            <div class="num" @click="changeEmail">{{form.email}}</div>
                            <div class="alert" v-if="errors['email']">
                                {{errors['email'][0]}}
                            </div>
                        </div>
                    </div>
                    <div class="personInfoItems">
                        <div class="personInfoItem">
                            <h4>تلفن ثابت</h4>
                            <input type="text" placeholder="تلفن ثابت" v-model="form.landlinePhone">
                            <div class="alert" v-if="errors['landlinePhone']">
                                {{errors['landlinePhone'][0]}}
                            </div>
                        </div>
                        <div class="personInfoItem">
                            <h4>شماره تماس</h4>
                            <div class="num" @click="changeNum">{{form.number}}</div>
                            <div class="alert" v-if="errors['number']">
                                {{errors['number'][0]}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="contactSeller">
                    <h3>اطلاعات تجاری</h3>
                    <div class="personInfoItems">
                        <div class="personInfoItem">
                            <h4>نام کاربری</h4>
                            <input type="text" placeholder="نام فروشگاه شما در این سایت" v-model="form.userName">
                            <div class="alert" v-if="errors['userName']">
                                {{errors['userName'][0]}}
                            </div>
                        </div>
                        <div class="personInfoItem">
                            <h4>شماره شبا</h4>
                            <input type="text" placeholder="شماره شبا" v-model="form.shaba">
                            <div class="alert" v-if="errors['shaba']">
                                {{errors['shaba'][0]}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="buttons" @click="sendLevel1">
                    <button>ارسال</button>
                </div>
            </div>
            <div class="uploadDocument" v-if="form.level == 2">
                <h3>تصویر کارت ملی</h3>
                <ul>
                    <li>تصاویر باید صاف و واضح باشد</li>
                    <li>تصاویر رو و پشت باید جداگانه باشد</li>
                    <li>تصویر کارت ملی همه صاحبان حق امضا در قالب یک عکس در کنار هم قرار گرفته و بارگذاری کنید</li>
                </ul>
                <div class="sendFileItem">
                    <dropzone ref="myVueDropzone3" id="dropzone" :options="dropzoneOptionsFile" :useCustomSlot=true v-on:vdropzone-success="uploadAllFront">
                        <div class="dropzone-custom-content">
                            <h3 class="dropzone-custom-title">برای بارگذاری عکس جلو کارت ملی ، بکشید و رها کنید!</h3>
                            <div class="subtitle">یا برای انتخاب از رایانه خود کلیک کنید ...</div>
                        </div>
                    </dropzone>
                </div>
                <div class="alert" v-if="errors['frontImage']">
                    {{errors['frontImage'][0]}}
                </div>
                <div class="sendFileItem">
                    <dropzone ref="myVueDropzone3" id="dropzone" :options="dropzoneOptionsFile" :useCustomSlot=true v-on:vdropzone-success="uploadAllBack">
                        <div class="dropzone-custom-content">
                            <h3 class="dropzone-custom-title">برای بارگذاری عکس پشت کارت ملی ، بکشید و رها کنید!</h3>
                            <div class="subtitle">یا برای انتخاب از رایانه خود کلیک کنید ...</div>
                        </div>
                    </dropzone>
                </div>
                <div class="alert" v-if="errors['backImage']">
                    {{errors['backImage'][0]}}
                </div>
                <div class="buttons" @click="sendLevel2">
                    <button>ارسال</button>
                </div>
            </div>
            <div class="checkUploaded" v-if="form.level == 3">
                <h3>وضعیت بررسی مدارک</h3>
                <table>
                    <tr>
                        <th>#</th>
                        <th>تصویر جلو کارت ملی</th>
                        <th>تصویر پشت کارت ملی</th>
                        <th>وضعیت بررسی مدارک</th>
                        <th>تاریخ ثبت</th>
                    </tr>
                    <tr v-for="(item, index) in documents" :key="index">
                        <td>
                            <span>{{++index}}</span>
                        </td>
                        <td>
                            <span>
                                <img :src="item.frontNaturalId" alt="تصویر جلو کارت ملی">
                            </span>
                        </td>
                        <td>
                            <span>
                                <img :src="item.backNaturalId" alt="تصویر پشت کارت ملی">
                            </span>
                        </td>
                        <td>
                            <span>
                                <span v-if="item.status == 0">در انتظار بررسی</span>
                                <span v-if="item.status == 1" class="unActive">رد شده</span>
                                <span v-if="item.status == 2" class="activeStatus">تایید شده</span>
                            </span>
                        </td>
                        <td>
                            <span>{{item.created_at}}</span>
                        </td>
                    </tr>
                </table>
                <div class="buttons">
                    <button v-if="checkDocument == 1" @click="btnSendAgain">ارسال مجدد</button>
                    <button v-if="checkDocument == 2" @click="btnFinished">اتمام</button>
                </div>
            </div>
            <div class="welcomeSeller"  v-if="form.level == 4">
                <i>
                    <svg-icon :icon="'#online-shop'"></svg-icon>
                </i>
                <h2>تبریک</h2>
                <h3>اکنون شما به جمع فروشندگان ما پیوستید</h3>
                <p>از تجارت آنلاین لذت ببرید و با ورود به هریک از بخش های زیر به کسب و کار خودت رونق بده</p>
                <div class="nextButton">
                    <a href="/seller/product/all">همه محصولات</a>
                    <a href="/seller/product/create">افزودن محصول</a>
                    <a href="/seller/pay">لیست فروش محصولات</a>
                </div>
            </div>
        </div>
        <div class="showChangeNum" v-if="showChangeNum == 1 || showChangeNum == 2">
            <div class="showChangeNumItems">
                <div class="showChangeNumContainer" v-if="showChangeNum == 1">
                    <label>{{ $t('phoneNumber') }}</label>
                    <div class="alert" v-if="errors['number']">
                        {{errors['number'][0]}}
                    </div>
                    <input @keyup="phoneFormat" type="text" v-model="phone" id="checkPhone" :placeholder="$t('phoneNumber')" maxlength="17" />
                    <div class="buttons">
                        <svg-icon v-if="loading" :icon="'#loading'"></svg-icon>
                        <button v-if="!loading" @click="btnSendCode">{{ $t('send') }}</button>
                        <button @click="showChangeNum = 0">{{ $t('cancel') }}</button>
                    </div>
                </div>
                <transition name="slide-fade">
                    <div class="allHeaderIndexRegisterItemsContainer" v-if="showChangeNum == 2">
                        <div class="allHeaderIndexRegisterItem">
                            <label>{{ $t('activeCode') }}</label>
                            <div class="alert" v-if="errors2['code']">
                                {{errors2['code'][0]}}
                            </div>
                            <input v-model="code" type="text" :placeholder="$t('activeCode')"/>
                        </div>
                        <div class="allHeaderIndexRegisterItemsContainerButton">
                            <svg-icon v-if="loading" :icon="'#loading'"></svg-icon>
                            <button v-if="!loading" @click="btnCheckCode">{{ $t('send') }}</button>
                            <button @click="showChangeNum = 0">{{ $t('cancel') }}</button>
                        </div>
                    </div>
                </transition>
            </div>
        </div>
        <div class="showChangeNum" v-if="showChangeNum == 5 || showChangeNum == 6">
            <div class="showChangeNumItems">
                <div class="showChangeNumContainer" v-if="showChangeNum == 5">
                    <label>{{ $t('emailAddress') }}</label>
                    <div class="alert" v-if="errors['email']">
                        {{errors['email'][0]}}
                    </div>
                    <input type="text" v-model="email" :placeholder="$t('emailAddress')"/>
                    <div class="buttons">
                        <svg-icon v-if="loading" :icon="'#loading'"></svg-icon>
                        <button v-if="!loading" @click="btnSendCodeEmail">{{ $t('send') }}</button>
                        <button @click="showChangeNum = 0">{{ $t('cancel') }}</button>
                    </div>
                </div>
                <transition name="slide-fade">
                    <div class="allHeaderIndexRegisterItemsContainer" v-if="showChangeNum == 6">
                        <div class="allHeaderIndexRegisterItem">
                            <label>{{ $t('activeCode') }}</label>
                            <div class="alert" v-if="errors2['code']">
                                {{errors2['code'][0]}}
                            </div>
                            <input v-model="code" type="text" :placeholder="$t('activeCode')"/>
                        </div>
                        <div class="allHeaderIndexRegisterItemsContainerButton">
                            <svg-icon v-if="loading" :icon="'#loading'"></svg-icon>
                            <button v-if="!loading" @click="btnCheckCodeEmail">{{ $t('send') }}</button>
                            <button @click="showChangeNum = 0">{{ $t('cancel') }}</button>
                        </div>
                    </div>
                </transition>
            </div>
        </div>
    </div>
</template>

<script>
import VuePersianDatetimePicker from "vue-persian-datetime-picker";
import SvgIcon from "../../Svg/SvgIcon";
import Dropzone from 'vue2-dropzone';
import 'vue2-dropzone/dist/vue2Dropzone.min.css';
export default {
    name: "BecomeSeller",
    components:{
        Dropzone,
        datePicker: VuePersianDatetimePicker,
        SvgIcon,
    },
    props:['users','documents'],
    metaInfo: {
        title: 'فروشنده شوید'
    },
    data() {
        return {
            showStatus : -1,
            showChangeNum: false,
            sendAgain:false,
            code: '',
            phone: '',
            email: '',
            loading: false,
            errors2: [],
            errors: [],
            checkDocument: 0,
            form:{
                level: 6,
                code: '',
                name: '',
                post: '',
                dateBirth: '',
                residenceAddress: '',
                landlinePhone: this.users.landlinePhone,
                number: this.users.number,
                email: this.users.email,
                companyName: '',
                registrationNumber: '',
                nationalID: '',
                signatureOwners: '',
                economicCode: '',
                shaba: this.users.shaba,
                userName: this.users.name,
                seller : 0,
                gender: 0,
                type: 0,
                frontImage: '',
                backImage: '',
            },
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
            dropzoneOptionsFile: {
                url: '/create-image',
                timeout: 999999999999999999999999999999999999,
                maxFilesize: 2,
                addRemoveLinks: true,
                parallelUploads: 1,
                maxFiles: 1,
                maxThumbnailFilesize: 100,
                dictDefaultMessage: 'یک فایل PDF را در اینجا رها کنید یا برای انتخاب پرونده برای بارگذاری کلیک کنید.',
                dictFileTooBig: 'فایل ارسالی باید کمتر از 2 مگابایت باشد',
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
        btnFinished(){
            const url = `/seller`;
            axios.post(url,this.form)
                .then(response=>{
                    this.form.level = 4;
                    window.scrollTo(0,0);
                })
                .catch((error)=>{
                    this.errors = error.response.data.errors;
                    window.scrollTo(0,0);
                    this.$toast.error('انجام نشد', 'لطفا تمام مواردی که اعلام شده را وارد کنید', this.notificationSystem.options.error);
                });
        },
        btnSendAgain(){
            this.form.level = 2;
            this.checkDocument = 0;
        },
        uploadAllFront(file , response){
            this.form.frontImage = response.url;
        },
        uploadAllBack(file , response){
            this.form.backImage = response.url;
        },
        getData(){
            const url = `/seller`;
            axios.post(url)
                .then(response=>{
                    this.form.level = response.data;
                })
            if(this.users.user_meta){
                this.form.code = this.users.user_meta[0].code;
                this.form.name = this.users.user_meta[0].name;
                this.form.post = this.users.user_meta[0].post;
                this.form.dateBirth = this.users.user_meta[0].date;
                this.form.residenceAddress = this.users.user_meta[0].residenceAddress;
            }
            if(this.users.company){
                this.form.companyName = this.users.company.name;
                this.form.residenceAddress = this.users.company.residenceAddress;
                this.form.registrationNumber = this.users.company.registration;
                this.form.nationalID = this.users.company.NationalID;
                this.form.signatureOwners = this.users.company.signer;
                this.form.economicCode = this.users.company.economicCode;
                if(this.users.company.type){
                    this.form.type = this.users.company.type;
                }
            }
            if (this.documents.length){
                this.checkDocument = this.documents[0].status;
            }
        },
        sendLevel2(){
            const url = `/seller`;
            axios.post(url,this.form)
                .then(response=>{
                    this.form.level = 3;
                    window.scrollTo(0,0);
                })
                .catch((error)=>{
                    this.errors = error.response.data.errors;
                    window.scrollTo(0,0);
                    this.$toast.error('انجام نشد', 'لطفا تمام مواردی که اعلام شده را وارد کنید', this.notificationSystem.options.error);
                });
        },
        sendLevel1(){
            const url = `/seller`;
            axios.post(url,this.form)
                .then(response=>{
                    if(this.documents.length){
                        this.form.level = 3;
                    }else{
                        this.form.level = 2;
                    }
                    window.scrollTo(0,0);
                })
                .catch((error)=>{
                    this.errors = error.response.data.errors;
                    window.scrollTo(0,0);
                    this.$toast.error('انجام نشد', 'لطفا تمام مواردی که اعلام شده را وارد کنید', this.notificationSystem.options.error);
                });
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
                        this.form.number = this.users.email;
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
                        this.form.email = this.users.email;
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
        btnSeller(num){
            this.form.seller = num;
            this.showStatus = -1;
        },
        btnGender(num){
            this.form.gender = num;
            this.showStatus = -1;
        },
        btnType(num){
            this.form.type = num;
            this.showStatus = -1;
        },
        btnShowStatus(num){
            if (this.showStatus == num){
                this.showStatus = -1;
            }else{
                this.showStatus = num;
            }
        }
    },
    mounted() {
        this.getData();
    }
}
</script>

<style scoped>

</style>
