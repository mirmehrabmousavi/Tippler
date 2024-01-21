<template>
    <div class="allHeaderIndexRegisterItemsContainers">
        <div class="allHeaderIndexRegisterItemsContainer" v-if="level == 6">
            <div class="allHeaderIndexRegisterItem">
                <span>رمز عبور</span>
                <label for="checkPhone" class="allHeaderIndexInput">
                    <input type="password" ref="item" id="checkPhone" v-model="password" placeholder="رمز خود را وارد کنید"/>
                </label>
            </div>
            <div class="alert" v-if="errors['password']">
                {{errors['password'][0]}}
            </div>
            <div class="allHeaderIndexRegisterItem">
                <span>تکرار رمز عبور</span>
                <label for="pass2" class="allHeaderIndexInput">
                    <input type="password" ref="item" id="pass2" v-model="confirmed" placeholder="رمز خود را وارد کنید"/>
                </label>
            </div>
            <div class="alert" v-if="errors['confirmed']">
                {{errors['confirmed'][0]}}
            </div>
            <div class="allHeaderIndexRegisterItemsContainerButton">
                <div>
                    <button @click="btnChangePassword" :style="styleLoader"><span>تایید</span></button>
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
    name: "ChangeEmailPassword",
    props:['email','shows','levels'],
    data(){
        return{
            password: '',
            confirmed: '',
            show: this.shows,
            level: this.levels,
            errors: [],
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
            styleLoader : {
                transition: 'all .3s ease-in-out',
                width: '10rem'
            },
        }
    },
    methods:{
        btnChangePassword(){
            this.level = 4;
            const url  = '/change-email-password';
            axios.post(url,{
                email : this.email,
                password : this.password,
                confirmed : this.confirmed,
            })
                .then(response=>{
                    if(response.data[0] == 'success'){
                        this.$toast.success('انجام شد', 'تغییر رمز با موفقیت انجام شد', this.notificationSystem.options.success);
                        this.$emit('sendEnd' , response.data[1]);
                    }else{
                        this.level = 6;
                        this.$toast.error('انجام نشد', 'رمز اشتباه است', this.notificationSystem.options.error);
                    }
                })
                .catch((error)=>{
                    this.level = 6;
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
