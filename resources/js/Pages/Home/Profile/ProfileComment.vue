<template>
    <div class="allProfileIndex width">
        <profile-list :tab="4"></profile-list>
        <div class="allUserIndexInfoTopItem">
            <label>دیدگاه ها</label>
            <div class="allUserIndexCommentItems">
                <div class="allUserIndexCommentItem" v-for="(item , index) in allComment">
                    <a :href="'/product/' + item.post.slug">
                        <div class="allUserIndexCommentItemPic">
                            <img :src="JSON.parse(item.post.image)[0]" :alt="item.post.title">
                        </div>
                        <div class="allUserIndexCommentItemSubject">
                            <div class="allUserIndexCommentItemSubjectTitle">
                                {{item.title}}
                            </div>
                            <div class="allUserIndexCommentItemSubjectStatus">
                                <span v-if="item.status == 0">در مورد خرید این محصول مطمئن نیستم</span>
                                <span v-if="item.status == 1">خرید این محصول را توصیه نمی‌کنم</span>
                                <span v-if="item.status == 2">خرید این محصول را توصیه می‌کنم</span>
                            </div>
                            <div class="allUserIndexCommentItemSubjectBody">
                                <p>{{item.body}}</p>
                            </div>
                            <div class="allUserIndexCommentItemSubjectAccept">
                                <span v-if="item.approved == 0">در انتظار تایید</span>
                                <span v-if="item.approved == 1" class="active">تایید شده</span>
                            </div>
                        </div>
                    </a>
                    <div class="allUserIndexCommentItemDelete">
                        <i @click.stop="btnRemove(item.id , index)">
                            <svg-icon :icon="'#trash'"></svg-icon>
                        </i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import ProfileList from "./ProfileList";
import SvgIcon from "../../Svg/SvgIcon";

export default {
    name: "ProfileComment",
    props:['comments'],
    components: {ProfileList,SvgIcon},
    data(){
        return{
            allComment: this.comments
        }
    },
    methods:{
        btnRemove(id , index){
            this.$swal.fire({
                title: 'حذف دیدگاه',
                text: "دیدگاه حذف میشود",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#67B930',
                confirmButtonText: 'حذف شود',
                cancelButtonText: 'پشیمون شدم'
            }).then((result) => {
                if (result.value) {
                    const url = `/profile/comment/${id}/delete`
                    axios.delete(url)
                        .then(response=>{
                            this.allComment.splice(index,1);
                        })
                }
            })
        }
    }
}
</script>

<style scoped>

</style>
