<template>
    <div class="allHeaderIndexRegisterItemsContainers">
        <div class="allHeaderIndexRegisterItemsContainer" v-if="level == 0">
            <div class="allHeaderIndexRegisterItem">
                <span>ایمیل</span>
                <label for="emails" class="allHeaderIndexInput">
                    <input type="email" ref="item" id="emails" title=" ...ایمیل را وارد کنید" placeholder=" ...ایمیل را وارد کنید" v-model="email"/>
                </label>
            </div>
            <div class="alert" v-if="errors['email']">
                {{errors['email'][0]}}
            </div>
            <div class="allHeaderIndexRegisterItemsContainerButton">
                <div>
                    <button @click="btnSendCode(1)" :style="styleLoader">
                        <span>تایید</span>
                    </button>
                </div>
            </div>
        </div>
        <div class="allHeaderIndexRegisterLoader" v-if="level == 4">
            <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
        </div>
    </div>
</template>

<script>
import SvgIcon from "../../../Svg/SvgIcon";

export default {
    name: "StartEmail",
    data(){
        return{
            errors:[],
            show: 0,
            level: 0,
            email: '',
            styleLoader : {
                transition: 'all .3s ease-in-out',
                width: '10rem'
            },
        }
    },
    methods:{
        btnSendCode(show){
            this.level = 4;
            const url  = '/check-email';
            axios.post(url,{
                email : this.email,
                show : show
            })
                .then(response=>{
                    this.show=show;
                    this.level = response.data;
                    this.$emit('sendData' , [this.show,this.level,this.email]);
                })
            .catch(error=>{
                this.level = 0;
                this.errors = error.response.data.errors;
            })
        },
    },
    mounted(){
        this.$refs.item.focus();
        window.scrollTo(0,0);
    }
}
</script>

<style scoped>

</style>
