<template>
    <div>
        <div class="card">

            <div class="card-body row">
                <div class="col-md-6">
                    <span class="text-bold"> Name</span>
                    <span class="ml-3">{{ info.name }}</span>
                </div>
                <div class="col-md-6">
                    <span class="text-bold"> TSC Number</span>
                    <span class="ml-3">{{ info.tsc }}</span>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body row">
                <div class="col-md-6">
                    <div class="mb-2">
                        <span class="text-bold">  Phone Number</span>
                        <span class="ml-3">{{ info.tel }}</span>
                    </div>

                    <div class="mb-2">
                        <span class="text-bold">  Email </span>
                        <span class="ml-3">{{ info.email }}</span>
                    </div>

                    <div class="mb-2">
                        <span class="text-bold"> Address</span>
                        <span class="ml-3">{{ info.address  }}</span>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="mb-2">
                        <span class="text-bold"> County </span>
                        <span class="ml-3">{{ info.county  }}</span>
                    </div>

                    <div class="mb-2">
                        <span class="text-bold"> Town</span>
                        <span class="ml-3">{{ info.town  }}</span>
                    </div>
                    <div class="mb-2">
                        <span class="text-bold"> Joined on</span>
                        <span class="ml-3">{{ info.joined }}</span>
                    </div>

                </div>
            </div>
        </div>
        <div class="card mt-2 col-md-12">
            <div class="card-header">
                <h6 class="text-bold">My Subjects :</h6>
            </div>
            <div class="card-body">

                <span class="col-md-1 badge badge-dark mr-2 p-2" v-for="sub in info.teaches" >
                            <span class="text-bold" >{{ sub.abbr }}</span>
                    </span>

            </div>
        </div>
        <div class="card bg-danger pt-4 pb-4 pl-2 pr-2 mt-2">
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
                axios.get('/api/teacherinfo')
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
    #tip{
        display: none;
        position: relative;
        margin-bottom: 50px;
        cursor: pointer;
    }

</style>
