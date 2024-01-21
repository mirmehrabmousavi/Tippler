<template>
    <div class="allRegisters width">
        <div class="rightRegister">
            <img src="/img/loginPic.png" alt="ثبت نام / ورود">
        </div>
        <div class="allHeaderIndexRegister" v-if="level == 0">
            <div class="allHeaderIndexRegisterData">
                <div class="allHeaderIndexRegisterItems">
                    <div class="allHeaderIndexRegisterItemsTitle">
                        <div class="allHeaderIndexRegisterTitleItem">ورود / ثبت نام</div>
                        <p>با ورود و یا ثبت نام در سایت شما شرایط و قوانین استفاده از سرویس های سایت و قوانین حریم خصوصی آن را می‌پذیرید</p>
                    </div>
                    <div class="loginRule">
                        <i>
                            <svg-icon :icon="'#user2'"/>
                        </i>
                        <p>
                            ورود از طریق
                            <span>شماره موبایل</span>
                            یا
                            <span>پست الکترونیک</span>
                            انتخاب کنید
                        </p>
                    </div>
                    <div class="registerWaysBlock">
                        <div class="registerWays">
                            <button @click="level = 2">
                                <div></div>
                                <span>
                                        ورود و ثبت نام
                                        <span>ایمیل</span>
                                    </span>
                            </button>
                        </div>
                        <div class="registerWays">
                            <button @click="level = 1">
                                <div></div>
                                <span>
                                        ورود و ثبت نام
                                        <span>پیامک</span>
                                    </span>
                            </button>
                        </div>
                        <div class="registerWays">
                            <a target="blank" href="/google-login">
                                <svg-icon :icon="'#google'"/>
                                <span>
                                        ورود و ثبت نام
                                        <span>جیمیل</span>
                                    </span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <transition name="slide-fade">
            <div class="allHeaderIndexRegisterItemsContainer" v-if="level == 1">
                <auth-phone v-on:sendUser="getUser"></auth-phone>
            </div>
        </transition>
        <transition name="slide-fade">
            <div class="allHeaderIndexRegisterItemsContainer" v-if="level == 2">
                <auth-email v-on:sendUser="getUser"></auth-email>
            </div>
        </transition>
    </div>
</template>

<script>
import SvgIcon from "../../Svg/SvgIcon";
import AuthPhone from "./Phone/AuthPhone";
import AuthEmail from "./Email/AuthEmail";
export default {
    name: "AuthIndex",
    components: { AuthEmail, AuthPhone, SvgIcon},
    data(){
        return{
            level: 0
        }
    },
    methods:{
        getUser(){
            window.location.reload();
        },
    }
}
</script>

<style scoped>

</style>
