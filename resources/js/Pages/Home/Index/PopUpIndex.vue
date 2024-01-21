<template>
    <div class="AllPopUpIndex" @click="btnClose">
        <div class="AllPopUpData" :style="'background:' + color">
            <div class="pic">
                <img :src="image" :alt="title">
            </div>
            <h3>{{ title }}</h3>
            <p>{{ description }}</p>
            <div class="timer">
                <flip-countdown :deadline="time"></flip-countdown>
            </div>
            <div class="buttons">
                <button :style="'background:' + colorbutton">{{button}}</button>
            </div>
        </div>
    </div>
</template>

<script>
import FlipCountdown from "vue2-flip-countdown";
export default {
    name: "PopUpIndex",
    props:['time','image','description','title','button','color','colorbutton'],
    components:{
        FlipCountdown,
    },
    methods:{
        btnClose(){
            this.$emit('sendClose');
        }
    }
}
</script>

<style scoped>

</style>
