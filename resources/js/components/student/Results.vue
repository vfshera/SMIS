<template>
    <div>
         <div class="card" v-for="result in results">
             <div class="card-header text-bold">
                 <h4>TERM {{ result.term.name }} {{ result.term.year }} EXAM RESULTS</h4>
             </div>

            <div class="card-body text-bold row">
                <div class="ongoing-term col-md-12 text-center pt-2" v-if="result.term.status == 1">RESULTS WILL APPEAR AFTER SUBMISSIONS HAVE BEEN MADE</div>
                    <div class="mb-2 d-inline mr-2 badge badge-dark  py-3  col-md-3" v-for="mark in result.results">
                        <span> {{ mark.subject.name }}</span>
                        <span class="ml-3">{{ mark.score }}%</span>
                    </div>
            </div>
        </div>

        <div class="card bg-danger pt-4 pb-4 pl-2 pr-2 mt-2" v-show="results.length == 0">
            <h4 class="text-center mb-1">We Are Unable To Fetch Your Results.Please Contact or Visit The Examination Office ...</h4>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Results",
        data(){
            return{
                results:[],
            }
        },
        methods:{
            getMyInfo(){
                axios.get('/api/myresults')
                    .then(response =>{
                        this.results = response.data;
                    })
                    .catch(err =>{
                        alert(err)
                    });
            }
        },
        mounted() {
            this.getMyInfo();
        }
    }
</script>

<style scoped>

    .ongoing-term{
        height: 40px;
        background:deepskyblue;
        color :white
    }
</style>
