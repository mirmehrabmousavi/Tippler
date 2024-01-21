<template>
    <div class="allPaginateHome" v-if="LastPage >= 2">
        <div class="pages">
            <div class="pagesItem" @click="nextPage(1)" v-if="CurrentPage != LastPage">
                <svg-icon :icon="'#right'"></svg-icon>
            </div>
            <div class="pagesItem" v-if="LastPage >= CurrentPage+4" @click="nextPage(4)">{{CurrentPage+4}}</div>
            <div class="pagesItem" v-if="LastPage >= CurrentPage+3" @click="nextPage(3)">{{CurrentPage+3}}</div>
            <div class="pagesItem" v-if="LastPage >= CurrentPage+2" @click="nextPage(2)">{{CurrentPage+2}}</div>
            <div class="pagesItem" v-if="LastPage >= CurrentPage+1" @click="nextPage(1)">{{CurrentPage+1}}</div>
            <div class="inputPage"><label><input type="text" @keyup="searchPage" v-model="CurrentPage"></label></div>
            <div class="pagesItem" v-if="CurrentPage > 1" @click="prevPage(1)">{{CurrentPage-1}}</div>
            <div class="pagesItem" v-if="CurrentPage > 2" @click="prevPage(2)">{{CurrentPage-2}}</div>
            <div class="pagesItem" v-if="CurrentPage > 3" @click="prevPage(3)">{{CurrentPage-3}}</div>
            <div class="pagesItem" v-if="CurrentPage > 4" @click="prevPage(4)">{{CurrentPage-4}}</div>
            <div class="pagesItem" @click="prevPage(1)" v-if="CurrentPage != 1">
                <svg-icon :icon="'#forward'"></svg-icon>
            </div>
        </div>
    </div>
</template>

<script>
import SvgIcon from "../Svg/SvgIcon";
export default {
    name: "PaginateHome",
    components: {SvgIcon},
    props:['url'],
    data(){
        return{
            CurrentPage : 0,
            LastPage : 0,
            total : 0,
            urls: this.url
        }
    },
    methods:{
        sendPage(page){
            this.$emit('sendLoading' , true);
            let paginate = this.urls + `&page=${page}`;
            axios.get(paginate)
                .then(response =>{
                    this.CurrentPage = response.data.current_page;
                    this.LastPage = response.data.last_page;
                    this.total = response.data.total;
                    this.$emit('sendPage' , response.data);
                    this.$emit('sendLoading' , false);
                })
        },
        nextPage(number){
            this.$eventHub.emit('changePageNext' , number , this.urls);
        },
        prevPage(number){
            this.$eventHub.emit('changePagePrev' , number , this.urls);
        },
        searchPage(){
            this.$eventHub.emit('changeSearchPage' , this.CurrentPage , this.urls);
        },
        changePageNexts(number , url){
            if (this.CurrentPage < this.LastPage && url == this.urls) {
                this.sendPage(this.CurrentPage + number);
            }
        },
        changePagePrevs(number , url){
            if (this.CurrentPage > 1 && url == this.urls) {
                this.sendPage(this.CurrentPage - number);
            }
        },
        changeSearchPages(num , url){
            if (url == this.urls) {
                this.CurrentPage = num;
                this.sendPage(num);
            }
        }
    },
    created: function() {
        this.$eventHub.on('changePagePrev', this.changePagePrevs);
        this.$eventHub.on('changeSearchPage', this.changeSearchPages);
        this.$eventHub.on('changePageNext', this.changePageNexts);
    },
    mounted() {
        this.sendPage(1);
    }
}
</script>

<style scoped>

</style>
