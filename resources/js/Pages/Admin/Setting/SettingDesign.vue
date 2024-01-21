<template>
    <admin-layout>
        <div class="allTemplateSetting">
            <div class="allTemplateSettingContainers">
                <div class="allTemplateSettingContainer">
                    <div class="allTemplateSettingContainerLists">
                        <div class="allTemplateSettingList">
                            <div class="allTemplateSettingListTitle">
                                همه ویجت ها
                            </div>
                            <VuePerfectScrollbar class="scroll-area">
                                <draggable v-model="allVidget" class="drags" group="people" @start="drag=true" @change="btnSend" @end="drag = false">
                                    <div class="allCategorySettingContainerListItem" v-for="(item,index) in allVidget" :key="index">
                                        <div class="dragsItem" v-if="item.name == 'تبلیغات اسلایدری'">
                                            <img src="/img/sliderAd.png">
                                            <h3>تبلیغات اسلایدری</h3>
                                        </div>
                                        <div class="dragsItem" v-if="item.name == 'تبلیغات ساده'">
                                            <img src="/img/adIndex.png">
                                            <h3>تبلیغات ساده</h3>
                                        </div>
                                        <div class="dragsItem" v-if="item.name == 'محصولات همراه تبلیغ'">
                                            <img src="/img/adProduct.png">
                                            <h3>محصولات همراه تبلیغ</h3>
                                        </div>
                                        <div class="dragsItem" v-if="item.name == 'اسلایدر بزرگ تبلیغ'">
                                            <img src="/img/bigSlider.png">
                                            <h3>اسلایدر بزرگ تبلیغ</h3>
                                        </div>
<!--                                        <div class="dragsItem" v-if="item.name == 'برند ویژه'">-->
<!--                                            <img src="/img/brandIndex.png">-->
<!--                                            <h3>برند ویژه</h3>-->
<!--                                        </div>-->
                                        <div class="dragsItem" v-if="item.name == 'دسته بندی خاص'">
                                            <img src="/img/newProduct.png">
                                            <h3>دسته بندی خاص</h3>
                                        </div>
                                        <div class="dragsItem" v-if="item.name == 'دسته بندی دلخواه'">
                                            <img src="/img/categoryIndex.png">
                                            <h3>دسته بندی دلخواه</h3>
                                        </div>
                                        <div class="dragsItem" v-if="item.name == 'محصولات با نوار'">
                                            <img src="/img/allCategory.png">
                                            <h3>محصولات با نوار</h3>
                                        </div>
                                        <div class="dragsItem" v-if="item.name == 'پست ویژه با تصویر'">
                                            <img src="/img/imageWidget.png">
                                            <h3>پست ویژه با تصویر</h3>
                                        </div>
                                        <div class="dragsItem" v-if="item.name == 'خبر ها'">
                                            <img src="/img/blogIndex.png">
                                            <h3>خبر ها</h3>
                                        </div>
                                        <div class="dragsItem" v-if="item.name == 'پیشنهاد شگفت انگیز'">
                                            <img src="/img/suggestIndex.png">
                                            <h3>پیشنهاد شگفت انگیز</h3>
                                        </div>
                                    </div>
                                </draggable>
                            </VuePerfectScrollbar>
                        </div>
                    </div>
                    <div class="allTemplateSettingList">
                        <div class="allTemplateSettingListTitle">
                            قالب وبسایت شما
                        </div>
                        <draggable class="allTemplateSettingListDrag" v-model="form.allSiteTemplate" group="people" @start="drag=true" @end="drag = false">
                            <div class="allCategorySettingContainerListItemChoice"  v-for="(item , allIndex) in form.allSiteTemplate" :key="allIndex">
                                <img v-if="item.name == 'تبلیغات اسلایدری'" src="/img/sliderAd.png">
                                <img v-if="item.name == 'تبلیغات ساده'" src="/img/adIndex.png">
                                <img v-if="item.name == 'محصولات همراه تبلیغ'" src="/img/adProduct.png">
                                <img v-if="item.name == 'اسلایدر بزرگ تبلیغ'" src="/img/bigSlider.png">
                                <img v-if="item.name == 'دسته بندی دلخواه'" src="/img/categoryIndex.png">
                                <img v-if="item.name == 'برند ویژه'" src="/img/brandIndex.png">
                                <img v-if="item.name == 'دسته بندی خاص'" src="/img/newProduct.png">
                                <img v-if="item.name == 'محصولات با نوار'" src="/img/allCategory.png">
                                <img v-if="item.name == 'پست ویژه با تصویر'" src="/img/imageWidget.png">
                                <img v-if="item.name == 'خبر ها'" src="/img/blogIndex.png">
                                <img v-if="item.name == 'پیشنهاد شگفت انگیز'" src="/img/suggestIndex.png">
                                <div class="allCategorySettingContainerListItemChoiceData">
                                    <h3>{{item.name}}</h3>
                                    <div class="allCategoryTitle" v-if="item.name != 'تبلیغات اسلایدری' && item.name != 'پست ویژه با تصویر' && item.name != 'پیشنهاد شگفت انگیز' && item.name != 'تبلیغات ساده' && item.name != 'اسلایدر بزرگ تبلیغ' && item.name != 'جستجو'">
                                        <label>نمایش عنوان :</label>
                                        <input type="text" placeholder="عنوان را وارد کنید" v-model="item.title">
                                    </div>
                                    <div class="allCategoryTitle" v-if="item.name != 'تبلیغات اسلایدری' && item.name != 'دسته بندی دلخواه' && item.name != 'پست ویژه با تصویر' && item.name != 'تبلیغات ساده' && item.name != 'اسلایدر بزرگ تبلیغ' && item.name != 'جستجو'">
                                        <label>عنوان مشاهده بیشتر :</label>
                                        <input type="text" placeholder="عنوان را وارد کنید" v-model="item.more">
                                    </div>
                                    <div class="allCategoryTitle" v-if="item.name != 'خبر ها' && item.name != 'تبلیغات اسلایدری' && item.name != 'دسته بندی دلخواه' && item.name != 'اسلایدر بزرگ تبلیغ' && item.name != 'پست ویژه با تصویر' && item.name != 'تبلیغات ساده' && item.name != 'اسلایدر بزرگ تبلیغ' && item.name != 'جستجو'">
                                        <label>پیوند یکتا (slug) :</label>
                                        <input type="text" placeholder="پیوند را وارد کنید" v-model="item.slug">
                                    </div>
                                    <div class="allCategoryTitle" v-if="item.name != 'تبلیغات ساده' && item.name != 'اسلایدر بزرگ تبلیغ' && item.name != 'تبلیغات اسلایدری' && item.name != 'دسته بندی دلخواه' && item.name != 'ویژگی ها'">
                                        <label>تعداد نمایش :</label>
                                        <input type="text" placeholder="تعداد را وارد کنید" v-model="item.count">
                                    </div>
                                    <div class="allCategoryTitle" v-if="item.name == 'پیشنهاد شگفت انگیز'">
                                        <label>زمان باقیمانده :</label>
                                        <div class="timerItem">
                                            <date-picker
                                                v-model="item.background"
                                                type="datetime"
                                                format="YYYY-MM-DD HH:mm"
                                                display-format="jYYYY-jMM-jDD HH:mm"
                                                :timezone="true"
                                            />
                                            <i @click="item.background = ''" v-if="item.background">
                                                <svg-icon :icon="'#cancel'"></svg-icon>
                                            </i>
                                        </div>
                                    </div>
                                    <div class="allCategorySettingSelect" v-if="item.name != 'اسلایدر بزرگ تبلیغ' && item.name != 'تبلیغات اسلایدری' && item.name != 'دسته بندی دلخواه' && item.name != 'تبلیغات ساده' && item.name != 'خبر ها' && item.name != 'برند ویژه'">
                                        <label>دسته بندی :</label>
                                        <div class="allTaxes">
                                            <div class="taxShow" @click="btnShowTax(2,allIndex)">
                                                <h4 v-if="item.category.length == 0">دسته بندی را وارد کنید</h4>
                                                <ul v-else>
                                                    <li v-for="(item , index) in item.category" :key="index">
                                                        <i @click.stop="btnClose(index,allIndex,'category')">
                                                            <svg-icon :icon="'#cancel'"></svg-icon>
                                                        </i>
                                                        <span>{{item}}</span>
                                                    </li>
                                                </ul>
                                                <svg-icon :icon="'#down'"></svg-icon>
                                            </div>
                                            <ul class="showAllTaxes" v-if="showTax == 2 && showAllTax == allIndex">
                                                <VuePerfectScrollbar class="scroll-area">
                                                    <li v-for="(item , index) in category" @click.stop="sendTax(item.name,allIndex,'category')" :key="index">
                                                        {{item.name}}
                                                    </li>
                                                </VuePerfectScrollbar>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="allCategorySettingSelect" v-if="item.name == 'خبر ها'">
                                        <label>دسته بندی :</label>
                                        <div class="allTaxes">
                                            <div class="taxShow" @click="btnShowTax(2,allIndex)">
                                                <h4 v-if="item.category.length == 0">دسته بندی را وارد کنید</h4>
                                                <ul v-else>
                                                    <li v-for="(item , index) in item.category" :key="index">
                                                        <i @click.stop="btnClose(index,allIndex,'category')">
                                                            <svg-icon :icon="'#cancel'"></svg-icon>
                                                        </i>
                                                        <span>{{item}}</span>
                                                    </li>
                                                </ul>
                                                <svg-icon :icon="'#down'"></svg-icon>
                                            </div>
                                            <ul class="showAllTaxes" v-if="showTax == 2 && showAllTax == allIndex">
                                                <VuePerfectScrollbar class="scroll-area">
                                                    <li v-for="(item , index) in categoryNews" @click.stop="sendTax(item.name,allIndex,'category')" :key="index">
                                                        {{item.name}}
                                                    </li>
                                                </VuePerfectScrollbar>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="allCategorySettingSelect" v-if="item.name != 'خبر ها' && item.name != 'پیشنهاد شگفت انگیز' && item.name != 'اسلایدر بزرگ تبلیغ' && item.name != 'تبلیغات اسلایدری' && item.name != 'دسته بندی دلخواه' && item.name != 'تبلیغات ساده'">
                                        <label>برند :</label>
                                        <div class="allTaxes">
                                            <div class="taxShow" @click="btnShowTax(1,allIndex)">
                                                <h4 v-if="item.brand.length == 0">برند را وارد کنید</h4>
                                                <ul v-else>
                                                    <li v-for="(item , index) in item.brand" :key="index">
                                                        <i @click.stop="btnClose(index,allIndex,'brand')">
                                                            <svg-icon :icon="'#cancel'"></svg-icon>
                                                        </i>
                                                        <span>{{item}}</span>
                                                    </li>
                                                </ul>
                                                <svg-icon :icon="'#down'"></svg-icon>
                                            </div>
                                            <ul class="showAllTaxes" v-if="showTax == 1 && showAllTax == allIndex">
                                                <VuePerfectScrollbar class="scroll-area">
                                                    <li v-for="(item , index) in brand" @click.stop="sendTax(item.name,allIndex,'brand')" :key="index">
                                                        {{item.name}}
                                                    </li>
                                                </VuePerfectScrollbar>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="allCategorySettingSelect" v-if="item.name != 'خبر ها' && item.name != 'اسلایدر بزرگ تبلیغ' && item.name != 'تبلیغات اسلایدری' && item.name != 'دسته بندی دلخواه' && item.name != 'برند ویژه' && item.name != 'تبلیغات ساده'">
                                        <label>نمایش براساس :</label>
                                        <div class="allCategoryPanel" @click="btnShowTax(3,allIndex)">
                                            <div class="categoryShow">
                                                <h4 v-if="item.show == 0">جدید ترین</h4>
                                                <h4 v-if="item.show == 1">محبوب ترین</h4>
                                                <h4 v-if="item.show == 2">پربازدید ترین</h4>
                                                <h4 v-if="item.show == 3">ارزان ترین</h4>
                                                <h4 v-if="item.show == 4">گران ترین</h4>
                                                <h4 v-if="item.show == 5">پرفروش ترین</h4>
                                                <i>
                                                    <svg-icon :icon="'#down'"></svg-icon>
                                                </i>
                                            </div>
                                            <ul v-if="showTax == 3 && showAllTax == allIndex">
                                                <li @click="item.show = 0">جدید ترین</li>
                                                <li @click="item.show = 1">محبوب ترین</li>
                                                <li @click="item.show = 2">پربازدید ترین</li>
                                                <li @click="item.show = 3">ارزان ترین</li>
                                                <li @click="item.show = 4">گران ترین</li>
                                                <li @click="item.show = 5">پرفروش ترین</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="allCategorySettingSelect" v-if="item.name != 'خبر ها' && item.name != 'اسلایدر بزرگ تبلیغ' && item.name != 'تبلیغات اسلایدری' && item.name != 'دسته بندی دلخواه' && item.name != 'برند ویژه' && item.name != 'تبلیغات ساده'">
                                        <label>نوع کالا :</label>
                                        <div class="allCategoryPanel" @click="btnShowTax(4,allIndex)">
                                            <div class="categoryShow">
                                                <h4 v-if="item.type == 3">همه</h4>
                                                <h4 v-if="item.type == 0">فقط موجود</h4>
                                                <h4 v-if="item.type == 1">تخفیف خورده</h4>
                                                <h4 v-if="item.type == 2">پیشنهادی</h4>
                                                <i>
                                                    <svg-icon :icon="'#down'"></svg-icon>
                                                </i>
                                            </div>
                                            <ul v-if="showTax == 4 && showAllTax == allIndex">
                                                <li @click="item.type = 3">همه</li>
                                                <li @click="item.type = 0">فقط موجود</li>
                                                <li @click="item.type = 1">تخفیف خورده</li>
                                                <li @click="item.type = 2">پیشنهادی</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="abilityPost" v-if="item.name == 'تبلیغات ساده' || item.name == 'اسلایدر بزرگ تبلیغ'">
                                        <table class="abilityTable">
                                            <tr>
                                                <th>تصویر تبلیغ</th>
                                                <th>آدرس تبلیغ</th>
                                                <th>
                                                    <i @click="addAbility(allIndex)">
                                                        <svg-icon :icon="'#add'"></svg-icon>
                                                    </i>
                                                </th>
                                            </tr>
                                            <tr v-for="(value, index2) in item.category" :key="index2">
                                                <td>
                                                    <input type="text" placeholder="تصویر را وارد کنید" v-model="value.image">
                                                </td>
                                                <td>
                                                    <input type="text" placeholder="آدرس را وارد کنید" v-model="value.address">
                                                </td>
                                                <td>
                                                    <i @click="deleteAbility(allIndex,index2)">
                                                        <svg-icon :icon="'#trash'"></svg-icon>
                                                    </i>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="abilityPost catIndex" v-if="item.name == 'دسته بندی دلخواه'">
                                        <table class="abilityTable">
                                            <tr>
                                                <th>تصویر</th>
                                                <th>عنوان</th>
                                                <th>آدرس</th>
                                                <th>
                                                    <i @click="addAbility(allIndex)">
                                                        <svg-icon :icon="'#add'"></svg-icon>
                                                    </i>
                                                </th>
                                            </tr>
                                            <tr v-for="(value, index2) in item.category" :key="index2">
                                                <td>
                                                    <input type="text" placeholder="تصویر را وارد کنید" v-model="value.image">
                                                </td>
                                                <td>
                                                    <input type="text" placeholder="عنوان را وارد کنید" v-model="value.title">
                                                </td>
                                                <td>
                                                    <input type="text" placeholder="آدرس را وارد کنید" v-model="value.address">
                                                </td>
                                                <td>
                                                    <i @click="deleteAbility(allIndex,index2)">
                                                        <svg-icon :icon="'#trash'"></svg-icon>
                                                    </i>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="abilityPost" v-if="item.name == 'تبلیغات اسلایدری' || item.name == 'پست ویژه با تصویر' ||  item.name == 'محصولات همراه تبلیغ'">
                                        <table class="abilityTable">
                                            <tr>
                                                <th>تصویر تبلیغ بالا</th>
                                                <th>آدرس تبلیغ بالا</th>
                                                <th>
                                                    <i @click="addAd2(allIndex)">
                                                        <svg-icon :icon="'#add'"></svg-icon>
                                                    </i>
                                                </th>
                                            </tr>
                                            <tr v-for="(value, index2) in item.title_en" :key="index2">
                                                <td>
                                                    <input type="text" placeholder="تصویر را وارد کنید" v-model="value.image">
                                                </td>
                                                <td>
                                                    <input type="text" placeholder="آدرس را وارد کنید" v-model="value.address">
                                                </td>
                                                <td>
                                                    <i @click="deleteAd2(allIndex,index2)">
                                                        <svg-icon :icon="'#trash'"></svg-icon>
                                                    </i>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="abilityPost" v-if="item.name == 'تبلیغات اسلایدری'">
                                        <table class="abilityTable">
                                            <tr>
                                                <th>تصویر تبلیغ پایین</th>
                                                <th>آدرس تبلیغ پایین</th>
                                                <th>
                                                    <i @click="addAd(allIndex)">
                                                        <svg-icon :icon="'#add'"></svg-icon>
                                                    </i>
                                                </th>
                                            </tr>
                                            <tr v-for="(value, index2) in item.view" :key="index2">
                                                <td>
                                                    <input type="text" placeholder="تصویر را وارد کنید" v-model="value.image">
                                                </td>
                                                <td>
                                                    <input type="text" placeholder="آدرس را وارد کنید" v-model="value.address">
                                                </td>
                                                <td>
                                                    <i @click="deleteAd(allIndex,index2)">
                                                        <svg-icon :icon="'#trash'"></svg-icon>
                                                    </i>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </draggable>
                    </div>
                </div>
            </div>
            <button class="sendBtn" @click="btnCreate">ارسال اطلاعات</button>
        </div>
    </admin-layout>
</template>

<script>
import AdminLayout from "../../../components/layout/AdminLayout";
import draggable from 'vuedraggable';
import SvgIcon from '../../Svg/SvgIcon.vue';
import VuePerfectScrollbar from "vue-perfect-scrollbar";
import VuePersianDatetimePicker from "vue-persian-datetime-picker";
export default {
    name:'TemplateSetting',
    props:['vidget','categoryNews','category','brand'],
    components: {
        AdminLayout,
        draggable,
        datePicker: VuePersianDatetimePicker,
        SvgIcon,
        VuePerfectScrollbar,
    },
    metaInfo: {
        title: 'تنظیمات قالب سایت'
    },
    data() {
        return {
            allVidget:[
                {
                    name:'تبلیغات اسلایدری',
                    brand:[],
                    category:[],
                    type:3,
                    show:0,
                    title:'',
                    title_en:[],
                    more: '',
                    moreEn: [],
                    count: '',
                    background: '',
                    view: [],
                    slug: [],
                },
                {
                    name:'تبلیغات ساده',
                    brand:[],
                    category:[],
                    type:3,
                    show:0,
                    title:'',
                    title_en:'',
                    more: '',
                    moreEn: '',
                    count: '',
                    background: '',
                    view: 0,
                    slug: '',
                },
                {
                    name:'دسته بندی دلخواه',
                    brand:[],
                    category:[],
                    type:3,
                    show:0,
                    title:'',
                    title_en:'',
                    more: '',
                    moreEn: '',
                    count: '',
                    background: '',
                    view: 0,
                    slug: '',
                },
                {
                    name:'محصولات همراه تبلیغ',
                    brand:[],
                    category:[],
                    type:3,
                    show:0,
                    title:'',
                    title_en:[],
                    count: '',
                    background: '',
                    view: 0,
                    slug: '',
                    more: '',
                    moreEn: [],
                },
                // {
                //     name:'برند ویژه',
                //     brand:[],
                //     category:[],
                //     type:3,
                //     show:0,
                //     title:'',
                //     title_en:'',
                //     count: '',
                //     background: '',
                //     view: 0,
                //     slug: '',
                //     more: '',
                //     moreEn: '',
                // },
                {
                    name:'دسته بندی خاص',
                    brand:[],
                    category:[],
                    type:3,
                    show:0,
                    title:'',
                    title_en:'',
                    count: '',
                    background: '',
                    view: 0,
                    slug: '',
                    more: '',
                    moreEn: '',
                },
                {
                    name:'محصولات با نوار',
                    brand:[],
                    category:[],
                    type:3,
                    show:0,
                    title:'',
                    title_en:'',
                    count: '',
                    background: '',
                    view: 0,
                    slug: '',
                    more: '',
                    moreEn: '',
                },
                {
                    name:'خبر ها',
                    brand:[],
                    category:[],
                    type:3,
                    show:0,
                    title:'',
                    title_en:'',
                    count: '',
                    background: '',
                    view: 0,
                    slug: '',
                    more: '',
                    moreEn: '',
                },
                {
                    name:'پست ویژه با تصویر',
                    brand:[],
                    category:[],
                    type:3,
                    show:0,
                    title:[],
                    title_en:[],
                    count: '',
                    background: '',
                    view: 0,
                    slug: [],
                    more: '',
                    moreEn: [],
                },
                {
                    name:'پیشنهاد شگفت انگیز',
                    brand:[],
                    category:[],
                    type:3,
                    show:0,
                    title:'',
                    title_en:'',
                    count: '',
                    background: '',
                    view: '',
                    slug: '',
                    more: '',
                    moreEn: '',
                },
            ],
            form:{
                update: false,
                allSiteTemplate: [],
            },
            showTax: 0,
            showAllTax: 0,
            tab: 0,
            i:0
        }
    },
    methods:{
        deleteAbility(allIndex,index){
            this.form.allSiteTemplate[allIndex].category.splice(index,1);
        },
        addAbility(allIndex) {
            this.form.allSiteTemplate[allIndex].category.push({
                image:'',
                address:'',
            });
        },
        deleteAd(allIndex,index){
            this.form.allSiteTemplate[allIndex].view.splice(index,1);
        },
        addAd(allIndex) {
            this.form.allSiteTemplate[allIndex].view.push({
                image:'',
                address:'',
            });
        },
        deleteAd2(allIndex,index,platform){
            this.form.allSiteTemplate[allIndex].title_en.splice(index,1);
        },
        addAd2(allIndex) {
            if(this.form.allSiteTemplate[allIndex].title_en == null){
                this.form.allSiteTemplate[allIndex].title_en = [];
            }
            this.form.allSiteTemplate[allIndex].title_en.push({
                image:'',
                address:'',
            });
        },
        deleteAd3(allIndex,index){
            this.form.allSiteTemplate[allIndex].title_en.splice(index,1);
        },
        addAd3(allIndex) {
            if(this.form.allSiteTemplate[allIndex].title_en == null){
                this.form.allSiteTemplate[allIndex].title_en = [];
            }
            this.form.allSiteTemplate[allIndex].title_en.push({
                image:'',
                address:'',
            });
        },
        btnShowTax(num,index){
            if (this.showTax == num){
                this.showTax = 0
            }else{
                this.showTax = num;
            }
            this.showAllTax = index;
        },
        btnSend(){
            this.allVidget=[
                {
                    name:'تبلیغات اسلایدری',
                    brand:[],
                    category:[],
                    type:3,
                    show:0,
                    title:'',
                    title_en:[],
                    more: '',
                    moreEn: '',
                    count: '',
                    background: '',
                    view: [],
                    slug: [],
                },
                {
                    name:'تبلیغات ساده',
                    brand:[],
                    category:[],
                    type:3,
                    show:0,
                    title:'',
                    title_en:'',
                    more: '',
                    moreEn: '',
                    count: '',
                    background: '',
                    view: 0,
                    slug: '',
                },
                {
                    name:'دسته بندی دلخواه',
                    brand:[],
                    category:[],
                    type:3,
                    show:0,
                    title:'',
                    title_en:'',
                    more: '',
                    moreEn: '',
                    count: '',
                    background: '',
                    view: 0,
                    slug: '',
                },
                {
                    name:'محصولات همراه تبلیغ',
                    brand:[],
                    category:[],
                    type:3,
                    show:0,
                    title:'',
                    title_en:[],
                    count: '',
                    background: '',
                    view: 0,
                    slug: '',
                    more: '',
                    moreEn: [],
                },
                // {
                //     name:'برند ویژه',
                //     brand:[],
                //     category:[],
                //     type:3,
                //     show:0,
                //     title:'',
                //     title_en:'',
                //     count: '',
                //     background: '',
                //     view: 0,
                //     slug: '',
                //     more: '',
                //     moreEn: '',
                // },
                {
                    name:'دسته بندی خاص',
                    brand:[],
                    category:[],
                    type:3,
                    show:0,
                    title:'',
                    title_en:'',
                    count: '',
                    background: '',
                    view: 0,
                    slug: '',
                    more: '',
                    moreEn: '',
                },
                {
                    name:'محصولات با نوار',
                    brand:[],
                    category:[],
                    type:3,
                    show:0,
                    title:'',
                    title_en:'',
                    count: '',
                    background: '',
                    view: 0,
                    slug: '',
                    more: '',
                    moreEn: '',
                },
                {
                    name:'خبر ها',
                    brand:[],
                    category:[],
                    type:3,
                    show:0,
                    title:'',
                    title_en:'',
                    count: '',
                    background: '',
                    view: 0,
                    slug: '',
                    more: '',
                    moreEn: '',
                },
                {
                    name:'پست ویژه با تصویر',
                    brand:[],
                    category:[],
                    type:3,
                    show:0,
                    title: [],
                    title_en:'',
                    count: '',
                    background: '',
                    view: 0,
                    slug: [],
                    more: '',
                    moreEn: [],
                },
                {
                    name:'پیشنهاد شگفت انگیز',
                    brand:[],
                    category:[],
                    type:3,
                    show:0,
                    title:'',
                    title_en:'',
                    count: '',
                    background: '',
                    view: '',
                    slug: '',
                    more: '',
                    moreEn: '',
                },
            ];
        },
        btnClose(index,allIndex,type,platform){
            if(type == 'brand'){
                this.form.allSiteTemplate[allIndex].brand.splice(index,1);
            }
            if(type == 'category'){
                this.form.allSiteTemplate[allIndex].category.splice(index,1);
            }
        },
        sendTax(name,allIndex,type,platform){
            if(type == 'brand'){
                this.form.allSiteTemplate[allIndex].brand.push(name);
            }
            if(type == 'category'){
                this.form.allSiteTemplate[allIndex].category.push(name);
            }
        },
        btnCreate(){
            this.i = 0;
            for ( this.i ; this.i < this.form.allSiteTemplate.length; this.i++) {
                if(this.form.allSiteTemplate[this.i].name == 'تبلیغات ساده' ||this.form.allSiteTemplate[this.i].name == 'دسته بندی دلخواه' ||this.form.allSiteTemplate[this.i].name == 'اسلایدر بزرگ تبلیغ'){
                    this.form.allSiteTemplate[this.i].brand = JSON.stringify(this.form.allSiteTemplate[this.i].category);
                }
                if(this.form.allSiteTemplate[this.i].name == 'تبلیغات اسلایدری'){
                    this.form.allSiteTemplate[this.i].category = JSON.stringify(this.form.allSiteTemplate[this.i].view);
                    this.form.allSiteTemplate[this.i].brand = JSON.stringify(this.form.allSiteTemplate[this.i].slug);
                    this.form.allSiteTemplate[this.i].moreEn = JSON.stringify(this.form.allSiteTemplate[this.i].title_en);
                }
                if(this.form.allSiteTemplate[this.i].name == 'پست ویژه با تصویر'){
                    this.form.allSiteTemplate[this.i].moreEn = JSON.stringify(this.form.allSiteTemplate[this.i].title_en);
                }
                if(this.form.allSiteTemplate[this.i].name == 'محصولات همراه تبلیغ'){
                    this.form.allSiteTemplate[this.i].moreEn = JSON.stringify(this.form.allSiteTemplate[this.i].title_en);
                }
            }
            this.i = 0;
            this.form.update = true;
            const url = "/admin/setting/setting-design";
            this.$inertia.post(url , this.form)
            this.$swal.fire(
                'با موفقیت انجام شد',
                'تنظیمات با موفقیت انجام شد',
                'success'
            );
        },
        getData(){
            this.form.allSiteTemplate = this.vidget;
            this.i = 0;
            for ( this.i ; this.i < this.form.allSiteTemplate.length; this.i++) {
                if(this.form.allSiteTemplate[this.i].name == 'تبلیغات ساده' || this.form.allSiteTemplate[this.i].name == 'دسته بندی دلخواه' || this.form.allSiteTemplate[this.i].name == 'اسلایدر بزرگ تبلیغ' || this.form.allSiteTemplate[this.i].name == 'پست ویژه با تصویر'){
                    if(this.form.allSiteTemplate[this.i].brand != ''){
                        this.form.allSiteTemplate[this.i].category = JSON.parse(this.form.allSiteTemplate[this.i].brand);
                    }
                }
                if(this.form.allSiteTemplate[this.i].name == 'پست ویژه با تصویر'){
                    if(this.form.allSiteTemplate[this.i].moreEn != ''){
                        this.form.allSiteTemplate[this.i].title_en = JSON.parse(this.form.allSiteTemplate[this.i].moreEn);
                    }
                }
                if(this.form.allSiteTemplate[this.i].name == 'تبلیغات اسلایدری'){
                    if(this.form.allSiteTemplate[this.i].brand != ''){
                        this.form.allSiteTemplate[this.i].slug = JSON.parse(this.form.allSiteTemplate[this.i].brand);
                    }
                    if(this.form.allSiteTemplate[this.i].category != ''){
                        this.form.allSiteTemplate[this.i].view = JSON.parse(this.form.allSiteTemplate[this.i].category);
                    }
                    if(this.form.allSiteTemplate[this.i].moreEn != ''){
                        this.form.allSiteTemplate[this.i].title_en = JSON.parse(this.form.allSiteTemplate[this.i].moreEn);
                    }
                }
                if(this.form.allSiteTemplate[this.i].name == 'محصولات همراه تبلیغ'){
                    if(this.form.allSiteTemplate[this.i].moreEn != ''){
                        this.form.allSiteTemplate[this.i].title_en = JSON.parse(this.form.allSiteTemplate[this.i].moreEn);
                    }
                }
            }
            this.i = 0;
        },
        sidebar(){
            this.$eventHub.emit('sidebar' , '2');
        },
    },
    mounted(){
        this.getData();
        this.sidebar();
    },
}
</script>

<style scoped>

</style>
