<template>
    <div class="allCountDown">
      <div class="move" :style="{'width' : ( countDown * '100') / 120 +'%'}"></div>
    </div>
</template>

<script>
export default {
    name: "CounterDown",
    props: {
        setTimer: {
            type: Number,
            default : 120
        },
        width: {
            type: Number,
            default: 80
        },
        border: {
            type: Number,
            default: 8
        },
        color: {
            type: String,
            default: '#FCA001'
        },
        fontSize: {
            type: Number,
            default: 50
        }
    },
    data () {
        return {
            timeLeft: this.setTimer,
            dashLen: (100 - this.border / 2) * Math.PI * 2
        }
    },
    computed: {
        countDown () {
            let time = this.timeLeft
            if (time <= 0) {
                return '0'
            } else {
                return time
            }
        },
        dashOffset () {
            return this.dashLen - this.timeLeft / this.setTimer * this.dashLen
        }
    },
    mounted () {
        this.lastDate = Date.now()
        this.interval = setInterval(() => {
            let curDate = Date.now()
            let diff = 1
            this.timeLeft -= diff
            if (this.timeLeft <= 0) {
                clearInterval(this.interval);
                this.$emit('sendEnd');
            }
            if (diff >= 1000) {
                this.lastDate = curDate;
            }
        }, 1000)
    }
}
</script>

<style scoped>

</style>
