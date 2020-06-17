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
            <div class="card mt-2 col-md-12">
                <div class="card-header">
                    <h6 class="text-bold">My Subjects :</h6>
                </div>
                <div class="card-body">
                    <span id="tip" class="card col-md-2 py-1">
                        <h4 id="tip-head" class="text-bold text-center"></h4>
                        <P id="tip-info" class="text-center"></P>
                    </span>

                    <span class="col-md-1 badge badge-dark mr-2 p-2" v-for="subject in info.studies" @mouseover="showTip(subject.unit.duty)" @mouseout="hideTip()">
                            <span class="text-bold" @mouseover="showTip(subject.unit.duty)" @mouseout="hideTip()">{{ subject.unit.duty.subject.title }}</span>
                    </span>

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
            hideTip(){
                document.querySelector('#tip').style.display = 'none';
            },
            showTip(sub){
                const tipDiv = document.querySelector('#tip');
                const tipTitle = document.querySelector('#tip-head');
                const tipInfo = document.querySelector('#tip-info');

                tipTitle.innerHTML = sub.teacher.name;
                tipInfo.innerHTML = `<p class="d-block"><span>Contact : </span> <span> ${sub.teacher.tel}</span></p>
                                        <p class="d-block"><span>Email : </span> <span> ${sub.teacher.email}</span></p>`;

                    tipDiv.style.display = 'block';
            },
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
#tip{
    display: none;
    position: relative;
    margin-bottom: 50px;
    cursor: pointer;
}

</style>
