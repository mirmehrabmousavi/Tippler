<template>
    <div class="allProfileIndex width">
        <seller-list :tab="2"></seller-list>
        <div class="myProduct">
            <div class="allTopTable">
                <div class="searches">
                    <input type="text" v-model="search" @keypress.enter="btnSearch" placeholder="جستجو ...">
                </div>
            </div>
            <transition name="slide-fade">
                <div class="allTableContainer">
                    <div class="postItem" v-for="item in allProduct">
                        <div class="postTop">
                            <div class="postPic">
                                <img :src="JSON.parse(item.image)[0]" :alt="item.title">
                            </div>
                            <div class="postTitle">
                                <h3>{{item.title}}</h3>
                                <h3 v-if="item.title_en">{{item.title_en}}</h3>
                                <h3 v-else>{{item.title}}</h3>
                            </div>
                            <div class="postOptions">
                                <a v-if="item.variety == 0" :href="'/seller/product/' + item.id+ '/edit'" title="ویرایش محصول">
                                    <svg-icon :icon="'#edit'"></svg-icon>
                                </a>
                                <a v-else :href="'/seller/edit-variety/' + item.id" title="ویرایش محصول">
                                    <svg-icon :icon="'#edit'"></svg-icon>
                                </a>
                            </div>
                        </div>
                        <div class="postBot" v-if="item.variety == 0">
                            <ul>
                                <li>
                                    <span>گروه :</span>
                                    <span v-if="item.category.length">{{item.category[0].name}}</span>
                                    <span v-else>بدون گروه</span>
                                </li>
                                <li>
                                    <span>قیمت محصول :</span>
                                    <span>{{ item.price|NumFormat }} تومان</span>
                                </li>
                                <li>
                                    <span>تعداد تنوع فعال :</span>
                                    <span>{{ item.post_count }}</span>
                                </li>
                                <li>
                                    <span>وضعیت محصول :</span>
                                    <span v-if="item.status == 0">پیشنویس</span>
                                    <span v-if="item.status == 1">منتشر شده</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </transition>
        </div>
    </div>
</template>

<script>
import SvgIcon from '../../Svg/SvgIcon.vue';
import SellerList from "./SellerList";
export default {
    name: "AllMyProduct",
    components: {SellerList,SvgIcon},
    props:['posts'],
    data() {
        return{
            search: '',
            allProduct: this.posts.data,
        }
    },
    methods: {
        btnSearch(){
            const url = `/seller/search-my-product`;
            axios.post(url , {
                search : this.search,
            })
            .then(response=>{
                this.allProduct = response.data.data;
            })
        }
    }
}
</script>

<style scoped>

</style>
