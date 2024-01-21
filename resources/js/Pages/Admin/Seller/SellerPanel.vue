<template>
    <admin-layout>
        <div class="allSellerPanel">
            <div class="allSellerTop">
                <h1>فروشنده ها</h1>
                <div class="allSellerTitle">
                    <inertia-link href="/admin">داشبورد</inertia-link>
                    <span>/</span>
                    <inertia-link href="/admin/seller">فروشنده ها</inertia-link>
                </div>
            </div>
            <div class="allTable" v-if="seller == '' && !sellerData.length">
                <div class="allTopTable">
                    <div class="allTopTableItem">
                        <button class="button" @click="btnRemoveArray('')" v-if="value.length">حذف</button>
                    </div>
                    <div class="filterItems">
                        <div class="ContentOptionsFilterButton" @click.stop="showFilter = !showFilter">
                            <svg-icon :icon="'#filter'"></svg-icon>
                            فیلتر اطلاعات
                        </div>
                        <transition name="bounce">
                            <div class="filterContent" v-if="showFilter">
                                <div class="filterContentItem">
                                    <label>فیلتر نام یا آیدی</label>
                                    <input type="text" v-model="search"  placeholder="نام یا آیدی را وارد کنید" @keypress.enter="btnSearch(0)">
                                </div>
                                <div class="filterContentItem">
                                    <label>فیلتر نوع</label>
                                    <div class="allCategoryPanel" @click="showSort = !showSort">
                                        <div class="categoryShow">
                                            <h4 v-if="sort == 0">همه</h4>
                                            <h4 v-if="sort == 1">حقیقی</h4>
                                            <h4 v-if="sort == 2">حقوقی</h4>
                                            <i>
                                                <svg-icon :icon="'#down'"></svg-icon>
                                            </i>
                                        </div>
                                        <ul v-if="showSort">
                                            <li @click="sort = 0" v-on:click="btnSearch(0)">همه</li>
                                            <li @click="sort = 1" v-on:click="btnSearch(0)">حقیقی</li>
                                            <li @click="sort = 2" v-on:click="btnSearch(0)">حقوقی</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </transition>
                    </div>
                </div>
                <div class="paginate">
                    <paginate-panel :link="sellers.links"></paginate-panel>
                </div>
                <div class="allTableContainer">
                    <div class="postItem" v-for="item in sellers.data" @click="getCheck(item.id)">
                        <div class="postTop">
                            <div class="postPic">
                                <img v-if="item.profile_photo_url" src="/img/user.png">
                                <img v-else :src="item.image">
                            </div>
                            <div class="postTitle">
                                <ul>
                                    <li>
                                        <span>نام کاربری :</span>
                                        <span>{{item.name}}</span>
                                    </li>
                                    <li>
                                        <span>شماره تماس :</span>
                                        <span>{{item.number}}</span>
                                    </li>
                                    <li>
                                        <span>ایمیل :</span>
                                        <span>{{item.email}}</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="postOptions">
                                <a title="دریافت اکسل از محصولات کاربر" :href="'/admin/get-excel/seller?seller=' + item.id">
                                    <svg-icon :icon="'#excel2'"></svg-icon>
                                </a>
                                <i title="مشاهده کاربر" @click="openShow(item.id)">
                                    <svg-icon :icon="'#eye'"></svg-icon>
                                </i>
                                <i @click="openEdit(item.id)" title="ویرایش کاربر">
                                    <svg-icon :icon="'#edit'"></svg-icon>
                                </i>
                                <i title="حذف کاربر" @click="btnRemoveArray(item.id)">
                                    <svg-icon :icon="'#trash'"></svg-icon>
                                </i>
                            </div>
                        </div>
                        <div class="postBot">
                            <ul>
                                <li>
                                    <span>نوع فروشنده :</span>
                                    <span v-if="item.seller == 1">فروشنده حقوقی</span>
                                    <span v-else>فروشنده حقیقی</span>
                                </li>
                                <li>
                                    <span>تعداد محصولات :</span>
                                    <span>{{ item.post_count }}</span>
                                </li>
                                <li>
                                    <span>زمان ثبت نام :</span>
                                    <span>{{ item.created_at }}</span>
                                </li>
                                <li>
                                    <span>آخرین بازدید :</span>
                                    <span>{{item.activity}}</span>
                                </li>
                            </ul>
                            <i>
                                <svg-icon v-for="(values , index2) in value" :key="index2" v-if="values == item.id" :icon="'#check'"></svg-icon>
                                <svg-icon :icon="'#uncheck'"></svg-icon>
                            </i>
                        </div>
                    </div>
                </div>
                <div class="paginate">
                    <div class="showInfo">
                        نمایش
                        {{sellers.from}}
                        تا
                        {{sellers.to}}
                        از
                        {{sellers.total}}
                        ورودی
                    </div>
                    <paginate-panel :link="sellers.links"></paginate-panel>
                </div>
            </div>
            <div class="createDocumentPanel" v-if="seller != ''">
                <div class="createDocumentPanelItems">
                    <div class="errorsCreate" v-if="Object.keys(errors).length > 0">
                        <i>
                            <svg-icon :icon="'#error'"></svg-icon>
                        </i>
                        <span>
                               {{errors[Object.keys(errors)[0]][0]}}
                          </span>
                    </div>
                    <div class="allBecomeUserInfo">
                        <div class="sellerType">
                            <h3>نوع فروشنده</h3>
                            <div class="allCategoryPanel" @click="btnShowStatus(4)">
                                <div class="categoryShow">
                                    <h4 v-if="form.seller == 0">فروشنده حقیقی</h4>
                                    <h4 v-if="form.seller == 1">فروشنده حقوقی</h4>
                                    <i>
                                        <svg-icon :icon="'#down'"></svg-icon>
                                    </i>
                                </div>
                                <ul v-if="showStatus == 4">
                                    <li @click.stop="btnSeller(0)">فروشنده حقیقی</li>
                                    <li @click.stop="btnSeller(1)">فروشنده حقوقی</li>
                                </ul>
                            </div>
                        </div>
                        <div class="personInfoSeller">
                            <h3>اطلاعات شخصی</h3>
                            <div class="personInfoItems">
                                <div class="personInfoItem">
                                    <h4>نام و نام خانوادگی :</h4>
                                    <input type="text" placeholder="نام و نام خانوادگی" v-model="form.name">
                                </div>
                                <div class="personInfoItem">
                                    <h4>کارت ملی :</h4>
                                    <input type="text" placeholder="کارت ملی" v-model="form.code">
                                </div>
                            </div>
                            <div class="personInfoItems">
                                <div class="personInfoItem">
                                    <h4>جنسیت فروشنده :</h4>
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
                                </div>
                                <div class="personInfoItem">
                                    <h4>تاریخ تولد</h4>
                                    <date-picker
                                        v-model="form.dateBirth"
                                        type="date"
                                        format="YYYY-MM-DD"
                                        display-format="jYYYY-jMM-jDD"
                                    />
                                </div>
                            </div>
                        </div>
                        <div class="personInfoSeller">
                            <h3>اطلاعات کمپانی</h3>
                            <div class="personInfoItems">
                                <div class="personInfoItem">
                                    <h4>نام کمپانی :</h4>
                                    <input type="text" placeholder="نام کمپانی" v-model="form.companyName">
                                </div>
                            </div>
                            <div class="personInfoItems">
                                <div class="personInfoItem">
                                    <h4>نوع کمپانی :</h4>
                                    <div class="allCategoryPanel" @click="btnShowStatus(3)">
                                        <div class="categoryShow">
                                            <h4 v-if="form.type == 0">سهام عام</h4>
                                            <h4 v-if="form.type == 1">سهام خاص</h4>
                                            <h4 v-if="form.type == 2">مسئولیت محدود</h4>
                                            <h4 v-if="form.type == 3">تعاونی</h4>
                                            <h4 v-if="form.type == 4">تضامنی</h4>
                                            <i>
                                                <svg-icon :icon="'#down'"></svg-icon>
                                            </i>
                                        </div>
                                        <ul v-if="showStatus == 3">
                                            <li @click.stop="btnType(0)">سهام عام</li>
                                            <li @click.stop="btnType(1)">سهام خاص</li>
                                            <li @click.stop="btnType(2)">مسئولیت محدود</li>
                                            <li @click.stop="btnType(3)">تعاونی</li>
                                            <li @click.stop="btnType(4)">تضامنی</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="personInfoItem">
                                    <h4>شماره ثبت :</h4>
                                    <input type="text" placeholder="شماره ثبت" v-model="form.registrationNumber">
                                </div>
                            </div>
                            <div class="personInfoItems">
                                <div class="personInfoItem">
                                    <h4>شناسه ملی :</h4>
                                    <input type="text" placeholder="شناسه ملی" v-model="form.nationalID">
                                </div>
                                <div class="personInfoItem">
                                    <h4>کد اقتصادی :</h4>
                                    <input type="text" placeholder="کد اقتصادی" v-model="form.economicCode">
                                </div>
                            </div>
                            <div class="personInfoItems">
                                <div class="personInfoItem">
                                    <h4>صاحبان حق امضا</h4>
                                    <input type="text" placeholder="صاحبان حق امضا" v-model="form.signatureOwners">
                                </div>
                            </div>
                        </div>
                        <div class="contactSeller">
                            <h3>اطلاعات تماس</h3>
                            <div class="personInfoItems">
                                <div class="personInfoItem">
                                    <h4>آدرس :</h4>
                                    <input type="text" placeholder="آدرس" v-model="form.residenceAddress">
                                </div>
                            </div>
                            <div class="personInfoItems">
                                <div class="personInfoItem">
                                    <h4>کد پستی :</h4>
                                    <input type="text" placeholder="کد پستی" v-model="form.post">
                                </div>
                                <div class="personInfoItem">
                                    <h4>آدرس ایمیل</h4>
                                    <input type="text" placeholder="آدرس ایمیل" v-model="form.email">
                                </div>
                            </div>
                            <div class="personInfoItems">
                                <div class="personInfoItem">
                                    <h4>تلفن ثابت</h4>
                                    <input type="text" placeholder="پیش شماره بدون صفر + شماره" v-model="form.landlinePhone">
                                </div>
                                <div class="personInfoItem">
                                    <h4>شماره تماس</h4>
                                    <input type="text" placeholder="شماره تماس" v-model="form.number">
                                </div>
                            </div>
                        </div>
                        <div class="contactSeller">
                            <h3>اطلاعات تجاری</h3>
                            <div class="personInfoItems">
                                <div class="personInfoItem">
                                    <h4>نام کاربری</h4>
                                    <input type="text" placeholder="نام فروشگاه شما در این سایت" v-model="form.userName">
                                </div>
                                <div class="personInfoItem">
                                    <h4>شماره شبا :</h4>
                                    <input type="text" placeholder="شماره شبا" v-model="form.shaba">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="uploadDocument">
                        <h3>تصویر کارت ملی</h3>
                        <a :href="form.frontImage" class="download" download>دانلود تصویر جلو کارت ملی</a>
                        <div class="sendGallery">
                            <show-image v-on:sendClose="getClose" v-if="showImage1" v-on:sendUrl="getUrl1"></show-image>
                            <div class="getImageItem" @click="showImage1 = !showImage1">
                                <span v-if="form.frontImage == ''">تصویر جلو کارت ملی را وارد کنید</span>
                                <div class="getImagePic" v-else>
                                    <img :src="form.frontImage">
                                </div>
                            </div>
                        </div>
                        <a :href="form.backImage" class="download" download>دانلود تصویر پشت کارت ملی</a>
                        <div class="sendGallery">
                            <show-image v-on:sendClose="getClose" v-if="showImage2" v-on:sendUrl="getUrl2"></show-image>
                            <div class="getImageItem" @click="showImage2 = !showImage2">
                                <span v-if="form.backImage == ''">تصویر پشت کارت ملی را وارد کنید</span>
                                <div class="getImagePic" v-else>
                                    <img :src="form.backImage">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="rateSeller">
                        <div class="item">
                            <h4>تامین به موقع : ({{form.supply}} %)</h4>
                            <input type="range" v-model="form.supply" class="range-slider__range" min="0" max="100">
                        </div>
                        <div class="item">
                            <h4>تعهد ارسال : ({{form.commitment}} %)</h4>
                            <input type="range" v-model="form.commitment" class="range-slider__range" min="0" max="100">
                        </div>
                        <div class="item">
                            <h4>بدون ثبت مرجوعی : ({{form.reference}} %)</h4>
                            <input type="range" v-model="form.reference" class="range-slider__range" min="0" max="100">
                        </div>
                    </div>
                    <div class="buttons">
                        <button @click="updateDocument">بروزرسانی</button>
                        <button @click="btnCancel">انصراف</button>
                    </div>
                </div>
            </div>
            <div class="sellerShow" v-if="sellerData.length">
                <div class="topShowPay">
                    <div class="title">
                        <h1>جزئیات فروشنده</h1>
                        <span v-if="sellerData[0].seller == 1">فروشنده حقوقی</span>
                        <span v-else>فروشنده حقیقی</span>
                    </div>
                    <div class="detail">
                        <div class="topDetail">
                            <div class="items">
                                <div class="item">
                                    <h5>نام و نام خانوادگی فروشنده :</h5>
                                    <div>{{sellerData[0].user_meta[0].name}}</div>
                                </div>
                                <div class="item">
                                    <h5>شماره تماس :</h5>
                                    <div>{{sellerData[0].number}}</div>
                                </div>
                                <div class="item">
                                    <h5>ایمیل :</h5>
                                    <div>{{sellerData[0].email}}</div>
                                </div>
                            </div>
                            <div class="items">
                                <div class="item">
                                    <h5>آدرس :</h5>
                                    <div>{{sellerData[0].user_meta[0].residenceAddress}}</div>
                                    <div v-if="sellerData[0].company">{{sellerData[0].company.residenceAddress}}</div>
                                </div>
                            </div>
                        </div>
                        <div class="botDetail">
                            <div class="items">
                                <div class="item">
                                    <h5>کل درآمد :</h5>
                                    <div>{{sellerData[1]|NumFormat}} تومان</div>
                                </div>
                                <div class="item">
                                    <h5>شماره شبا :</h5>
                                    <div>{{ sellerData[0].shaba }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="allShowPayContainer">
                    <div class="items">
                        <div class="title">محصولاتی که اقدام به فروشش کردند</div>
                        <div class="item" v-for="item in sellerData[0].post">
                            <inertia-link :href="'/product/'+item.slug" class="cartDetailPic">
                                <img :src="JSON.parse(item.image)[0]" :alt="item.title">
                            </inertia-link>
                            <div class="cartDetailInfo">
                                <inertia-link :href="'/product/'+item.slug" class="cartDetailInfoItem">
                                    <h3>{{item.title}}</h3>
                                </inertia-link>
                                <div class="cartDetailInfoItem">
                                    <i>
                                        <svg-icon :icon="'#bill'"></svg-icon>
                                    </i>
                                    <span>{{item.pay_meta_count}}</span>
                                </div>
                                <div class="cartDetailInfoItem" v-if="item.guarantee">
                                    <i>
                                        <svg-icon :icon="'#security'"></svg-icon>
                                    </i>
                                    <span>{{item.guarantee[0].name}}</span>
                                </div>
                                <div class="cartDetailInfoItem">
                                    <i>
                                        <svg-icon :icon="'#post'"></svg-icon>
                                    </i>
                                    <span>{{item.count}}</span>
                                </div>
                                <div class="priceData">
                                    <h4>
                                        {{item.price|NumFormat}}
                                        <span>تومان</span>
                                    </h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="buttons">
                    <button @click="btnCancel">انصراف</button>
                </div>
            </div>
        </div>
    </admin-layout>
</template>

<script>
import PaginatePanel from "../PaginatePanel";
import AllTable from "../Table/AllTable";
import AdminLayout from "../../../components/layout/AdminLayout";
import ShowImage from "../ShowImage";
import SvgIcon from "../../Svg/SvgIcon";
export default {
    name: "SellerPanel",
    components: {SvgIcon, ShowImage, AllTable,AdminLayout, PaginatePanel},
    props:['sellers','sellerEdit','showSeller','labels','errors'],
    metaInfo: {
        link: [
            { rel: 'stylesheet', href: '/css/admin.css' },
        ],
        title: 'نمایش فروشنده'
    },
    data(){
        return{
            value: [],
            seller: [],
            sellerData: [],
            sort: 0,
            i: 0,
            showFilter: false,
            form:{
                code: '',
                name: '',
                status: '',
                post: '',
                dateBirth: '',
                residenceAddress: '',
                landlinePhone: '',
                number: '',
                reference: 100,
                supply: 100,
                commitment: 100,
                email: '',
                companyName: '',
                registrationNumber: '',
                nationalID: '',
                signatureOwners: '',
                economicCode: '',
                shaba: '',
                userName: '',
                gender: 0,
                type: 0,
                frontImage: '',
                backImage: '',
                taxId: '',
                update: 0,
                show: 0,
                seller: 0,
            },
            showImage1: false,
            showImage2: false,
            showStatus : -1,
            showSort: false,
        }
    },
    methods: {
        btnCancel(){
            this.seller = '';
            this.form.taxId = '';
            this.form.update = 0;
            this.form.show = 0;
            this.sellerData = [];
            this.form={
                code: '',
                name: '',
                status: '',
                post: '',
                dateBirth: '',
                residenceAddress: '',
                landlinePhone: '',
                number: '',
                email: '',
                reference: 100,
                supply: 100,
                commitment: 100,
                companyName: '',
                registrationNumber: '',
                nationalID: '',
                signatureOwners: '',
                economicCode: '',
                shaba: '',
                userName: '',
                gender: 0,
                type: 0,
                frontImage: '',
                backImage: '',
                taxId: '',
                update: 0,
                show: 0,
                seller: 0,
            }
        },
        updateDocument(){
            this.form.update = 1;
            const url = `/admin/seller`;
            this.$inertia.post(url, this.form)
                .then(response => {
                    if(Object.keys(this.errors).length <= 0){
                        this.form.update = 0;
                        this.seller = '';
                        this.form.taxId = '';
                        this.form={
                            code: '',
                            name: '',
                            status: '',
                            post: '',
                            dateBirth: '',
                            residenceAddress: '',
                            landlinePhone: '',
                            number: '',
                            email: '',
                            companyName: '',
                            registrationNumber: '',
                            nationalID: '',
                            signatureOwners: '',
                            reference: 100,
                            supply: 100,
                            commitment: 100,
                            economicCode: '',
                            shaba: '',
                            userName: '',
                            gender: 0,
                            type: 0,
                            frontImage: '',
                            backImage: '',
                            taxId: '',
                            update: 0,
                            show: 0,
                            seller: 0,
                        }
                    }
                })
        },
        getCheck(id) {
            for (this.i; this.i < this.value.length; this.i++) {
                if (this.value[this.i] == id) {
                    this.value.splice(this.i, 1);
                    this.i = 100;
                }
            }
            if (this.i != 101) {
                this.value.push(id);
            }
            this.i = 0;
        },
        btnRemoveArray(id) {
            this.$swal.fire({
                title: 'آیا مطمینی ؟',
                text: "فایل حذف شده برگشتی ندارد!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'بله حذف شود',
                cancelButtonText: 'پشیمون شدم'
            }).then((result) => {
                if (result.value) {
                    if (id) {
                        this.value = [id]
                    }
                    const url = `/admin/seller`;
                    this.$inertia.post(url, {'value': this.value})
                        .then(response => {
                                this.value = []
                            }
                        )
                }
            })
        },
        openEdit(id){
            this.form.taxId = id;
            const url = `/admin/seller`;
            this.$inertia.post(url, {
                taxId: id
            })
                .then(response => {
                    this.seller = this.sellerEdit;
                    if(this.sellerEdit.document.length){
                        this.form.frontImage= this.sellerEdit.document[0].frontNaturalId;
                        this.form.backImage= this.sellerEdit.document[0].backNaturalId;
                    }
                    this.form.seller= this.sellerEdit.seller;
                    this.form.status= this.sellerEdit.document.status;
                    this.form.landlinePhone= this.sellerEdit.landlinePhone;
                    this.form.number= this.sellerEdit.number;
                    this.form.email= this.sellerEdit.email;
                    this.form.shaba= this.sellerEdit.shaba;
                    this.form.reference= this.sellerEdit.reference;
                    this.form.supply= this.sellerEdit.supply;
                    this.form.commitment= this.sellerEdit.commitment;
                    this.form.userName= this.sellerEdit.name;
                    if(this.sellerEdit.user_meta){
                        this.form.code = this.sellerEdit.user_meta[0].code;
                        this.form.name = this.sellerEdit.user_meta[0].name;
                        this.form.post = this.sellerEdit.user_meta[0].post;
                        this.form.dateBirth = this.sellerEdit.user_meta[0].date;
                        this.form.residenceAddress = this.sellerEdit.user_meta[0].residenceAddress;
                    }
                    if(this.sellerEdit.company){
                        this.form.companyName = this.sellerEdit.company.name;
                        this.form.residenceAddress = this.sellerEdit.company.residenceAddress;
                        this.form.registrationNumber = this.sellerEdit.company.registration;
                        this.form.nationalID = this.sellerEdit.company.NationalID;
                        this.form.signatureOwners = this.sellerEdit.company.signer;
                        this.form.economicCode = this.sellerEdit.company.economicCode;
                        if(this.sellerEdit.company.type){
                            this.form.type = this.sellerEdit.company.type;
                        }
                    }
                })
        },
        openShow(id) {
            const url = `/admin/seller`;
            this.$inertia.post(url, {
                show: id
            })
                .then(response => {
                    this.sellerData = this.showSeller;
                })
        },
        btnShowStatus(num){
            if (this.showStatus == num){
                this.showStatus = -1;
            }else{
                this.showStatus = num;
            }
        },
        btnGender(num){
            this.form.gender = num;
            this.showStatus = -1;
        },
        btnStatus(num){
            this.form.status = num;
            this.showStatus = -1;
        },
        btnSearch(){
            const url = `/admin/seller`;
            this.$inertia.post(url , {
                search : this.search,
                sort : this.sort,
            })
        },
        btnSeller(num){
            this.form.seller = num;
            this.showStatus = -1;
        },
        btnType(num){
            this.form.type = num;
            this.showStatus = -1;
        },
        getClose(){
            this.showImage1 = false;
            this.showImage2 = false;
        },
        getUrl1(url){
            this.form.frontImage= url;
        },
        getUrl2(url){
            this.form.backImage= url;
        },
        sidebars() {
            this.$eventHub.emit('sidebar', 13);
        },
    },
    mounted() {
        this.sidebars();
    }
}
</script>

<style scoped>

</style>
