<template>
    <admin-layout>
        <div class="allCategorySetting">
            <div class="title">
                <div class="right">
                    <h1>تنظیمات دسته بندی</h1>
                </div>
                <div class="left">
                    <inertia-link href="/">خانه</inertia-link>
                    <span>/</span>
                    <inertia-link href="/admin">داشبورد</inertia-link>
                    <span>/</span>
                    <inertia-link href="/admin/setting/setting-manage">تنظیمات دسته بندی</inertia-link>
                </div>
            </div>
            <div class="allCategorySettingContainer">
                <div class="allCategorySettingContainerCategory">
                    <div class="allCategorySettingContainerCategoryItem" @click="index = 0">
                        <button v-if="index == 0" class="active">
                            دسته بندی بالای سایت در هدر
                        </button>
                        <button v-else>
                            دسته بندی بالای سایت در هدر
                        </button>
                    </div>
                    <div class="allCategorySettingContainerCategoryItem" @click="index = 2">
                        <button v-if="index == 2" class="active">
                            دسته بندی در فوتر سایت
                        </button>
                        <button v-else>
                            دسته بندی در فوتر سایت
                        </button>
                    </div>
                </div>
                <div class="allCategorySettingContainerList" v-if="index == 0">
                    <div class="allCategorySettingListContainer">
                        <div class="allCategorySettingContainerListItems">
                            <div class="allCategorySettingContainerListItemsTitle">
                                همه دسته ها
                            </div>
                            <draggable class="allCategorySettingContainerListItem" v-model="form.allCategoryHeader" group="people" @start="drag=true" @end="drag=false">
                                <div class="allCategorySettingContainerListItemText" v-for="element in form.allCategoryHeader" :key="element.id">{{element.name}}</div>
                            </draggable>
                        </div>
                        <div class="allCategorySettingContainerListItems">
                            <div class="allCategorySettingContainerListItemsTitle">
                                دسته های انتخابی
                            </div>
                            <draggable class="allCategorySettingContainerListItem" v-model="form.categoryHeader" group="people" @start="drag=true" @end="drag=false">
                                <div class="allCategorySettingContainerListItemText" v-for="(item , index) in form.categoryHeader" v-if="item" :key="index">{{item.name}}</div>
                            </draggable>
                        </div>
                    </div>
                </div>
                <div class="allCategorySettingContainerList" v-if="index == 2">
                    <div class="allCategorySettingListContainer">
                        <div class="allCategorySettingContainerListItems">
                            <div class="allCategorySettingContainerListItemsTitle">
                                همه دسته ها
                            </div>
                            <draggable class="allCategorySettingContainerListItem" v-model="form.allCategoryFooter" group="people3" @start="drag=true" @end="drag=false">
                                <div class="allCategorySettingContainerListItemText" v-for="element in form.allCategoryFooter" :key="element.id">{{element.name}}</div>
                            </draggable>
                        </div>
                        <div class="allCategorySettingContainerListItems">
                            <div class="allCategorySettingContainerListItemsTitle">
                                دسته های انتخابی
                            </div>
                            <draggable class="allCategorySettingContainerListItem" v-model="form.categoryFooter" group="people3" @start="drag=true" @end="drag=false">
                                <div class="allCategorySettingContainerListItemText" v-for="(item , index) in form.categoryFooter" v-if="item" :key="index">{{item.name}}</div>
                            </draggable>
                        </div>
                    </div>
                </div>
            </div>
            <div class="buttons">
                <button @click="sendSetting">ذخیره</button>
            </div>
        </div>
    </admin-layout>
</template>

<script>
import AdminLayout from "../../../components/layout/AdminLayout";
import SvgIcon from "../../Svg/SvgIcon";
import draggable from 'vuedraggable';
export default {
    name: "CategorySetting",
    props:['categories','catFooter','catHeader'],
    components:{
        AdminLayout,
        SvgIcon,
        draggable
    },
    data() {
        return {
            form:{
                categoryHeader: [],
                categoryFooter: [],
                allCategoryHeader: this.categories,
                allCategoryFooter: this.categories,
            },
            index: 0,
        }
    },
    metaInfo: {
        link: [
            { rel: 'stylesheet', href: '/css/admin.css' },
        ],
      title: 'تنظیمات دسته سایت'
    },
    methods:{
        sendSetting(){
            const url = "/admin/setting/setting-category";
            this.$inertia.put(url , this.form)
            this.$swal.fire(
                'با موفقیت انجام شد',
                'تنظیمات با موفقیت انجام شد',
                'success'
            );
        },
        sidebar(){
            this.$eventHub.emit('sidebar' , '2');
        },
        checkData(){
            if (this.catFooter.length){
                this.form.categoryFooter = this.catFooter;
            }
            if (this.catHeader.length){
                this.form.categoryHeader = this.catHeader;
            }
        }
    },
    mounted() {
        this.checkData();
        this.sidebar();
    }
}
</script>

<style scoped>

</style>
