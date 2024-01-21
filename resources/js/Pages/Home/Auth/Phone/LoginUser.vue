<template>
    <div class="allHeaderIndexRegisterItemsContainers">
        <div class="allHeaderIndexRegisterItemsContainer" v-if="level == 2">
            <div class="allHeaderIndexRegisterItem">
                <span>رمز عبور</span>
                <label for="checkPhone" class="allHeaderIndexInput">
                    <input type="password" id="checkPhone" ref="item" v-model="password" placeholder="رمز عبور را وارد کنید"/>
                </label>
            </div>
            <div class="allHeaderIndexRegisterItemsContainerDetail" @click="btnSendCode(2)">
                رمز عبور خود را فراموش کردید؟
            </div>
            <div class="allHeaderIndexRegisterItemsContainerButton">
                <div>
                    <button @click="btnLogin" :style="styleLoader"><span>تایید</span></button>
                </div>
            </div>
        </div>
        <div class="allHeaderIndexRegisterLoader" v-if="level == 4">
            <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
        </div>
    </div>
</template>

<script>
export default {
    name: "LoginUser",
    props:['shows','levels','number'],
    data(){
        return{
            styleLoader : {
                transition: 'all .3s ease-in-out',
                width: '10rem'
            },
            level: this.levels,
            show: this.shows,
            password:'',
            notificationSystem: {
                options: {
                    show: {
                        icon: "icon-person",
                        position: "topCenter",
                    },
                    success: {
                        position: "bottomLeft"
                    },
                    error: {
                        theme: "#FCA001",
                        progressBarColor: "#DC0808",
                        position: "bottomRight"
                    },
                }
            },
        }
    },
    methods:{
        btnSendCode(show){
            this.level = 4;
            const url  = '/check-auth';
            axios.post(url,{
                number : this.number,
                show : show
            })
                .then(response=>{
                    this.show=show;
                    this.level = response.data;
                    this.$emit('sendData' , [this.show,this.level]);
                })
        },
        btnLogin(){
            this.level = 4;
            const url  = '/login-auth';
            axios.post(url,{
                number : this.number,
                password : this.password,
            })
                .then(response=>{
                    if(response.data[0] == 'success'){
                        this.$toast.success('انجام شد', 'عضویت با موفقیت انجام شد', this.notificationSystem.options.success);
                        window.location.reload();
                    }else{
                        this.level = 2;
                        this.$toast.error('انجام نشد', 'رمز اشتباه است', this.notificationSystem.options.error);
                    }
                })
                .catch((error)=>{
                    this.level = 2;
                    this.errors = error.response.data.errors;
                });
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
