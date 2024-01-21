<template>
    <div class="allProfileIndex width">
        <profile-list :tab="5"></profile-list>
        <div class="allUserIndexInfoPay">
            <table>
                <tr>
                    <th>#</th>
                    <th>درخواست</th>
                    <th>پاسخ</th>
                    <th>زمان ارسال</th>
                    <th>عملیات</th>
                </tr>
                <tr v-for="(item , index) in allTicket">
                    <td>
                        <span>{{++index}}</span>
                    </td>
                    <td>
                        <span>{{item.body}}</span>
                    </td>
                    <td>
                        <span>{{item.answer}}</span>
                    </td>
                    <td>
                        <span>{{item.created_at}}</span>
                    </td>
                    <td>
                        <i @click="btnRemove(item.id , index)">
                            <svg-icon :icon="'#trash'"></svg-icon>
                        </i>
                    </td>
                </tr>
            </table>
        </div>
    </div>
</template>

<script>
import ProfileList from "./ProfileList";
import SvgIcon from "../../Svg/SvgIcon";

export default {
    name: "ProfileTicket",
    components: {ProfileList,SvgIcon},
    props:['tickets'],
    data(){
        return{
            allTicket: this.tickets,
        }
    },
    methods:{
        btnRemove(id,index){
            this.$swal.fire({
                title: 'حذف تیکت',
                text: "تیک حذف میشود",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#67B930',
                confirmButtonText: 'حذف شود',
                cancelButtonText: 'پشیمون شدم'
            }).then((result) => {
                if (result.value) {
                    const url = `/profile/ticket/${id}/delete`
                    axios.delete(url)
                        .then(response=>{
                            this.allTicket.splice(--index,1);
                        })
                }
            })
        }
    }
}
</script>

<style scoped>

</style>
