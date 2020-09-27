<template>
    <span class="timer">
        <span v-show="!passed" class="timerGroup">
            <span class="digitHolder">
                    <span class="digit">
                         {{ days }}
                    </span>
                    <span class="label">DAYS</span>
            </span>

             <span class="digitHolder">
                    <span class="digit">
                         {{ hours }}
                    </span>
                    <span class="label">HOURS</span>
            </span>

             <span class="digitHolder">
                    <span class="digit">
                         {{ min }}
                    </span>
                    <span class="label">MIN</span>
            </span>

             <span class="digitHolder">
                    <span class="digit">
                         {{ sec }}
                    </span>
                    <span class="label">SEC</span>
            </span>
        </span>
        <span v-show="passed">EVENT EXPIRED</span>
    </span>
</template>

<script>
    export default {
        props: ["year","month","date","hour","minute"],
        name: "CountDownTimer",
        data(){
            return{
                days: '00',
                hours:'00',
                min:'00',
                sec:'00',
                passed:false
            }
        },
    methods:{
        initTimer(){
            return new Date(
                this.year,
                this.month,
                this.date,
                this.hour,
                this.minute,
            );
        },
        getRemaining(){
            const timer = setInterval(() => {
                const current = new Date();

                const remaining = this.initTimer().getTime() - current.getTime();

                if(remaining < 0){
                    this.passed = true
                    clearInterval(timer)
                }else {
                    this.passed = false

                    let sec = 1000;
                    let minutes = sec * 60;
                    let hours = minutes * 60;
                    let days = hours * 24;

                    const remDays = Math.floor(remaining / days);
                    const remHours = Math.floor((remaining % days) / hours);
                    const remMin = Math.floor((remaining % hours) / minutes);
                    const remSec = Math.floor((remaining % minutes) / sec);

                    this.days = this.twoDecimal(remDays)
                    this.hours = this.twoDecimal(remHours)
                    this.min = this.twoDecimal(remMin)
                    this.sec = this.twoDecimal(remSec)

                }
            },1000)
        },
        twoDecimal(num){
            return (num < 10) ? '0' + num : num.toString();
        }
     },
    mounted() {
            this.getRemaining();
        }
    }
</script>

<style scoped>
    * , .timer {
        margin: 0;
        padding: 0;
    }
.label{
    font-size: 1.7vh;
}
.digit{
    font-size: 3vh;
 }
.digitHolder{
}

 .timerGroup{
     width: 70%;
 }
</style>
