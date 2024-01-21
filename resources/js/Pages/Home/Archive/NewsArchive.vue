<template>
    <div class="allNewsArchive width">
        <div class="archiveAddress">
            <span>صفحه اصلی /</span>
            <span> {{name}} </span>
        </div>
        <i class="productLoader" v-if="showLoader == true">
            <svg-icon class="loading" :icon="'#loading'"></svg-icon>
        </i>
        <ul v-else>
            <li v-for="item in allNews">
                <a :href="'/blog/'+item.slug">
                    <div class="pic">
                        <img v-lazy="item.image" :alt="item.title">
                    </div>
                    <div class="titleItem">
                        <span>{{item.title}}</span>
                    </div>
                    <p v-html="item.body"></p>
                </a>
            </li>
        </ul>
        <div class="archivePaginate" v-if="showLoader2 == false">
            <paginate-home :url="urlpages+'?ss='" v-on:sendPage="getPage" v-on:sendLoading="getLoading"></paginate-home>
        </div>
    </div>
</template>

<script>
import PaginateHome from "../PaginateHome";
import SvgIcon from "../../Svg/SvgIcon";
export default {
    name: "NewsArchive",
    components: {PaginateHome,SvgIcon},
    props:['name','news','urlpages','cats'],
    data() {
        return{
            allNews: [],
            showLoader2 : false,
            showLoader : false,
        }
    },
    methods:{
        getPage(page){
            this.allNews = page.data;
        },
        getLoading(num){
            this.showLoader = num;
        },
    }
}
</script>

<style scoped>

</style>
