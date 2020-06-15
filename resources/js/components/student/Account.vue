<template>
    <div>
        <div class="card">

            <div class="card-body row">
                <div class="col-md-6">
                    <span class="text-bold"> Name</span>
                    <span class="ml-3">{{ info.user.name}}</span>
                </div>
                <div class="col-md-6">
                    <span class="text-bold"> Email</span>
                    <span class="ml-3">{{ info.user.email}}</span>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body row">
                <div class="col-md-6">
                    <div class="mb-2">
                        <span class="text-bold"> Admission Number</span>
                        <span class="ml-3">{{ info.admNo}}</span>
                    </div>

                    <div class="mb-2">
                        <span class="text-bold">Parent Name</span>
                        <span class="ml-3">{{ info.parent}}</span>
                    </div>

                    <div class="mb-2">
                        <span class="text-bold">  Phone Number</span>
                        <span class="ml-3">{{ info.parentNo}}</span>
                    </div>

                    <div class="mb-2">
                        <span class="text-bold"> County</span>
                        <span class="ml-3">{{ info.county}}</span>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="mb-2">
                        <span class="text-bold"> Class</span>
                        <span class="ml-3">{{ info.className}}</span>
                    </div>
                    <div class="mb-2">
                        <span class="text-bold"> Address</span>
                        <span class="ml-3">{{ info.address}}</span>
                    </div>
                    <div class="mb-2">
                        <span class="text-bold"> Town</span>
                        <span class="ml-3">{{ info.town}}</span>
                    </div>
                    <div class="mb-2">
                        <span class="text-bold"> Joined on</span>
                        <span class="ml-3">{{ info.joined}}</span>
                    </div>

                </div>
            </div>
        </div>

        <div class="card bg-danger pt-4 pb-4 pl-2 pr-2 mt-2">
            <h4 class="text-center mb-1">Please Note that this information is as provided during admission to Murray Girls High School.</h4>
            <h4 class="text-center mt-1">In order to make any changes to this information you have to visit the Information Center.</h4>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Student-Account",
        data(){
            return{
                info:'',
            }
        },
       methods :{
           getMyInfo(){
               axios.get('/api/myinfo')
                   .then(response =>{
                       this.info = response.data.data;
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

</style>
