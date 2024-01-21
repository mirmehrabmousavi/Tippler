<template>
    <div class="allProfileIndex width">
        <profile-list :tab="tab"></profile-list>
        <div class="allUserIndexInfoTopItem">
            <label v-if="tab == 2">آخرین نشانه ها</label>
            <label v-if="tab == 3">آخرین علاقه مندی ها</label>
            <ul>
                <li v-for="(item , index) in allBookmark">
                    <a :href="'/product/' + item.slug">
                        <div class="userItemPic">
                            <img :src="JSON.parse(item.image)[0]" :alt="item.title">
                        </div>
                        <div class="userItemSubject">
                            <div class="userItemSubjectTitle">{{item.title}}</div>
                            <div class="postPriceItem">
                                <div class="offPrice" v-if="item.off != null">
                                    <s>{{item.offPrice|NumFormat}} تومان</s>
                                </div>
                                <h3>{{item.price|NumFormat}} تومان</h3>
                            </div>
                        </div>
                    </a>
                    <i @click.stop="btnBookmark(item.id , index)">
                        <svg-icon :icon="'#trash'"></svg-icon>
                    </i>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
import ProfileList from "./ProfileList";
import SvgIcon from "../../Svg/SvgIcon";
export default {
    name: "ProfileBookmark",
    props:['bookmark','tab'],
    components: {ProfileList,SvgIcon},
    data(){
        return{
            allBookmark: this.bookmark,
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
        btnBookmark(id , index){
            if(this.tab == 2){
                var url = `/bookmark`;
            }else{
                var url = `/like`;
            }
            axios.post(url ,{
                postID : id
            })
                .then(response=>{
                    if (response.data == 'noUser'){
                        this.$toast.error('عضو نیستید', 'ابتدا عضو شوید', this.notificationSystem.options.error);
                    }else{
                        if (response.data == 'delete'){
                            this.$toast.success('انجام شد', 'نشانه با موفقیت حذف شد', this.notificationSystem.options.success);
                            this.allBookmark.splice(index , 1);
                        }
                    }
                })
                .catch(err =>{
                    this.$toast.error('انجام نشد', 'متاسفانه مشکلی پیش آمد', this.notificationSystem.options.error);
                })
        },
    }
}
</script>

<style scoped>

</style>
