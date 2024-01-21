<template>
    <div class="allProfileIndex width">
        <seller-list tab="3"></seller-list>
        <div class="allAddVariety">
            <div class="allAddVarietyTop">
                <div class="allAddVarietyPic">
                    <img :src="JSON.parse(posts.image)[0]" :alt="posts.title">
                </div>
                <div class="allAddVarietySubject">
                    <h1>{{ posts.title }}</h1>
                    <ul>
                        <li v-if="posts.category.length">
                            <span>دسته بندی :</span>
                            <span>{{posts.category[0].name}}</span>
                        </li>
                        <li v-if="posts.review[0].colors">
                            <span>تنوع رنگ :</span>
                            <span>{{JSON.parse(posts.review[0].colors).length}}</span>
                        </li>
                        <li v-if="posts.review[0].size">
                            <span>تنوع سایز :</span>
                            <span>{{JSON.parse(posts.review[0].size).length}}</span>
                        </li>
                        <li>
                            <span>مبلغ :</span>
                            <span>{{posts.price|NumFormat}} تومان</span>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="allCreateVariety">
                <div class="allVarietiesTitle">
                    <span>افزودن تنوع</span>
                </div>
                <div class="allCreateVarietyItems">
                    <div class="allCreateVarietyItem">
                        <h3>گارانتی</h3>
                        <post-taxonami add="1" :taxes="guarantees" :taxRoute="'گارانتی'" :tax="['0']"  v-on:sendTax="getGuarantees"></post-taxonami>
                    </div>
                    <div class="allCreateVarietyItem">
                        <h3>تعداد</h3>
                        <input type="text" v-model="form.count" placeholder="تعداد را وارد کنید ...">
                        <div class="alert" v-if="errors['count']">
                            {{errors['count'][0]}}
                        </div>
                    </div>
                </div>
                <div class="allCreateVarietyItems">
                    <div class="allCreateVarietyItem">
                        <h3>قیمت</h3>
                        <input type="text" v-model="form.price" placeholder="قیمت را وارد کنید ...">
                        <div class="alert" v-if="errors['price']">
                            {{errors['price'][0]}}
                        </div>
                    </div>
                    <div class="allCreateVarietyItem">
                        <h3>تخفیف</h3>
                        <input type="text" v-model="form.off" placeholder="تخفیف را وارد کنید ...">
                        <div class="alert" v-if="errors['off']">
                            {{errors['off'][0]}}
                        </div>
                    </div>
                </div>
                <div class="abilityPost">
                    <div class="abilityTitle">
                        <label>رنگ</label>
                        <i @click="addColor">
                            <svg-icon :icon="'#add'"></svg-icon>
                        </i>
                    </div>
                    <table class="abilityTable">
                        <tr>
                            <th>نام رنگ</th>
                            <th>کد رنگ</th>
                            <th>تعداد</th>
                            <th>افزودن قیمت (تومان)</th>
                            <th>حذف</th>
                        </tr>
                        <tr v-for="(item, index) in form.colors" :key="index">
                            <td>
                                <input type="text" v-model="item.name" placeholder="نام را وارد کنید">
                            </td>
                            <td>
                                <input v-model="item.color" placeholder="کد را وارد کنید">
                            </td>
                            <td>
                                <input v-model="item.count" placeholder="تعداد را وارد کنید">
                            </td>
                            <td>
                                <input v-model="item.price" placeholder="قیمت را وارد کنید">
                            </td>
                            <td>
                                <i @click="deleteColor(index)">
                                    <svg-icon :icon="'#trash'"></svg-icon>
                                </i>
                            </td>
                        </tr>
                    </table>
                    <div class="abilityPostToolTip">
                        <i>
                            <svg-icon :icon="'#lamp'"></svg-icon>
                        </i>
                        <p>برای اضافه نشدن قیمت به قیمت اصلی عدد صفر را وارد کنید</p>
                    </div>
                </div>
                <div class="abilityPost">
                    <div class="abilityTitle">
                        <label>سایز</label>
                        <i @click="addSize">
                            <svg-icon :icon="'#add'"></svg-icon>
                        </i>
                    </div>
                    <table class="abilityTable">
                        <tr>
                            <th>سایز</th>
                            <th>تعداد</th>
                            <th>افزودن قیمت (تومان)</th>
                            <th>حذف</th>
                        </tr>
                        <tr v-for="(item, index) in form.sizes" :key="index">
                            <td>
                                <input type="text" v-model="item.name" placeholder="سایز را وارد کنید">
                            </td>
                            <td>
                                <input type="text" v-model="item.count" placeholder="تعداد را وارد کنید">
                            </td>
                            <td>
                                <input v-model="item.price" placeholder="قیمت را وارد کنید">
                            </td>
                            <td>
                                <i @click="deleteSize(index)">
                                    <svg-icon :icon="'#trash'"></svg-icon>
                                </i>
                            </td>
                        </tr>
                    </table>
                    <div class="abilityPostToolTip">
                        <i>
                            <svg-icon :icon="'#lamp'"></svg-icon>
                        </i>
                        <p>برای اضافه نشدن قیمت به قیمت اصلی عدد صفر را وارد کنید</p>
                    </div>
                </div>
                <div class="buttons">
                    <button v-if="loading">
                        <svg-icon class="loading" :icon="'#loading'"></svg-icon>
                    </button>
                    <button v-else @click="btnAddVar">افزودن تنوع</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import HomeLayout from "../../../components/layout/HomeLayout";
import SvgIcon from "../../Svg/SvgIcon";
import PostTaxonami from "./PostTaxonami";
import VuePerfectScrollbar from "vue-perfect-scrollbar";
import SellerList from "./SellerList";
export default {
    name: "AddVariety",
    components: {SellerList, PostTaxonami, SvgIcon, HomeLayout ,VuePerfectScrollbar},
    props:['posts','guarantees'],
    data(){
        return{
            form:{
                price : null,
                count : null,
                off : '',
                allSize: [],
                allColor: [],
                allGuarantee: [],
                abilities: [],
                sizes:[],
                colors:[],
                update: 1,
            },
            showSort: false,
            loading: false,
            errors: [],
            i: 0,
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
    methods: {
        btnAddVar(){
            this.loading = true;
            this.form.allColor = JSON.stringify(this.form.colors);
            this.form.allSize = JSON.stringify(this.form.sizes);
            const url = `/seller/add-variety/${this.posts.id}`;
            axios.post(url , this.form)
                .then(response=>{
                    this.loading = false;
                    window.location.reload();
                    this.$toast.success('انجام شد', 'تنوع با موفقیت برای تایید بررسی شد', this.notificationSystem.options.success);
                })
                .catch((error)=>{
                    this.errors = error.response.data.errors;
                    window.scrollTo(0,0);
                    this.$toast.error('انجام نشد', 'موارد اعلام شده را وارد کنید', this.notificationSystem.options.error);
                    this.loading = false;
                });
        },
        deleteSize(index){
            this.form.sizes.splice(index,1);
        },
        deleteColor(index){
            this.form.colors.splice(index,1);
        },
        addColor() {
            this.form.colors.push({
                name:'',
                color:'',
                price:'',
            });
        },
        addSize() {
            this.form.sizes.push({
                name:'',
                price:'',
            });
        },
        getGuarantees(guarantee){
            this.form.allGuarantee = guarantee;
        },
    },
}
</script>

<style scoped>

</style>
