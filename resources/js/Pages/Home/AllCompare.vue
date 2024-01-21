<template>
    <div class="comparePostsContainer">
        <div class="comparePostsContainerCount" v-if="allComparison.length" @click.stop="btnShowCompare">
            {{allComparison.length}}
            مقایسه
        </div>
        <div class="comparePostsContainerIndex" v-if="showCompares && postCompares.length">
            <div class="comparePostsContainerItems">
                <table>
                    <tr>
                        <th>
                            <h5>مقایسه محصول</h5>
                            <div class="comparePostsContainerItemsClose" @click.stop="btnCloseAll">
                                <i>
                                    <svg-icon :icon="'#cancel'"></svg-icon>
                                </i>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <th v-for="(item , index) in postCompares">
                            <div class="comparePostsContainerItemsDelete" @click.stop="deleteCompares(index)">
                                <i>
                                    <svg-icon :icon="'#cancel'"></svg-icon>
                                </i>
                            </div>
                            <div class="comparePostsContainerItemsPic">
                                <img :src="JSON.parse(item.image)[0]" :alt="item.title"/>
                            </div>
                            <div class="comparePostsContainerItemsTitle">
                                <h4>{{item.title}}</h4>
                            </div>
                        </th>
                    </tr>
                    <tr>
                        <td>
                            <h4>قیمت محصول</h4>
                        </td>
                    </tr>
                    <tr>
                        <td v-for="item in postCompares">
                            <span>{{item.price|NumFormat}} تومان</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h4>موجودی محصول</h4>
                        </td>
                    </tr>
                    <tr>
                        <td v-for="item in postCompares">
                                    <span v-if="item.count == 0">
                                        ناموجود
                                    </span>
                            <span v-else>{{item.count}} محصول</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h4>تخفیف محصول</h4>
                        </td>
                    </tr>
                    <tr>
                        <td v-for="item in postCompares">
                            <span v-if="item.off == null">بدون تخفیف</span>
                            <span v-else>٪{{item.off}}</span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h4>ویژگی محصول</h4>
                        </td>
                    </tr>
                    <tr>
                        <td v-for="all in postCompares">
                            <ul v-if="all.review[0].ability != null">
                                <li v-for="items in JSON.parse(all.review[0].ability)">
                                    <span>{{items.name}}</span>
                                </li>
                            </ul>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
import SvgIcon from "../Svg/SvgIcon";
export default {
    name: "AllCompare",
    components: {SvgIcon},
    data(){
        return{
            allComparison: [],
            postCompares: null,
            showCompares: false
        }
    },
    methods:{
        getFast(id){
            this.allComparison = id;
        },
        btnShowCompare(){
            const url = `/show-compares`;
            axios.post(url ,{
                postCompare : this.allComparison
            })
                .then(response=>{
                    this.postCompares = response.data;
                    this.showCompares = true;
                })
        },
        deleteCompares(index){
            this.postCompares.splice(index,1);
            this.allComparison.splice(index,1);
        },
        btnCloseAll(){
            this.showCompares = false;
            this.$eventHub.emit('allComparisons' , this.allComparison);
        }
    },
    created: function() {
        this.$eventHub.on('allComparisons', this.getFast);
    },
}
</script>

<style scoped>

</style>
