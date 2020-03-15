<template>
    <div>
    <div class="card">
        <div class="card-header">
              <h3 class="card-title">STUDENTS</h3>

                    <input class="form-control col-md-6  d-inline " style="margin-left:200px" type="search" placeholder="Search" v-model="search" aria-label="Search">

              <span class="btn btn-primary float-right " data-toggle="modal" data-target="#addSudentDetails"><i class="far fa-address-card mr-3"></i>ADD DETAILS</span>
          </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="dt" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Date Created</th>
                </tr>
                </thead>
                <tbody>

                 <tr v-for="student in searchedStudents" :key="student.id">
                  <td>{{ student.name}}</td>
                  <td>{{ student.email}}</td>
                  <td>{{ student.created_at }}</td>
                </tr>


                </tbody>

              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->


          <!-- Modal -->
            <div class="modal fade" id="addSudentDetails" tabindex="-1" role="dialog" aria-labelledby="addSudentDetails" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title ml-2" id="addSudentDetailsTitle">ADD STUDENT DETAILS</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="p-2" @submit.prevent="addDetails">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                <label for="name">For</label>
                                <select class="form-control" v-model="student.id">
                                    <option  v-for="st in students" :key="st.id" :value="st.id"> {{ st.name }}</option>
                                </select>
                                <span v-if="validationErrors.s_id" class="text-danger">The Student ID is Required</span>
                               </div>
                                <div class="form-group col-md-6">
                                <label for="classroom">Class</label>
                                <select v-model="student.class_id" class="form-control">
                                    <option v-for="st in students" :key="st.id" :value="st.id"> {{ st.name }}</option>
                                </select>
                                <span v-if="validationErrors.class_id" class="text-danger">@{{ validationErrors.class_id[0] }}</span>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group  col-md-6">
                                    <label for="pfirstname">Parent / Guardian First Name</label>
                                    <input type="text" class="form-control" v-model="student.parents_fname" id="pfirstname" placeholder="Parent or Guardian First Name">
                                    <span v-if="validationErrors.parents_fname" class="text-danger">@The parents first name field is required</span>
                                </div>
                                <div class="form-group  col-md-6">
                                    <label for="psecname">Parent / Guardian Second Name</label>
                                    <input type="text" class="form-control" v-model="student.parents_sname" id="psecname" placeholder="Parent or Guardian Second Name">
                                    <span v-if="validationErrors.parents_sname" class="text-danger">@The parents second name field is required.</span>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="address">Address</label>
                                    <input type="text" v-model="student.address" class="form-control" id="address">
                                    <span v-if="validationErrors.address" class="text-danger">@{{ validationErrors.address[0] }}</span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="tel">Telephone (Parent)</label>
                                    <input type="text" v-model="student.parents_tel" class="form-control" id="tel">
                                    <span v-if="validationErrors.parents_tel" class="text-danger">@{{ validationErrors.parents_tel[0] }}</span>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group  col-md-6">
                                    <label for="town">Town</label>

                                    <span v-if="validationErrors.town" class="text-danger">@{{ validationErrors.town[0] }}</span>
                                </div>
                                <div class="form-group  col-md-6">
                                    <label for="county">County</label>
                                    <select id="county" v-model="student.county" class="form-control">
                                        <option selected>Choose...</option>
                                        <option>...</option>
                                    </select>
                                    <span v-if="validationErrors.county" class="text-danger">@{{ validationErrors.county[0] }}</span>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary float-right">SUBMIT</button>
                        </form>
                    </div>
                </div>
            </div>
            </div>

    </div>
</template>

<script>

    export default {
        name: 'Students',
        data(){
            return{
                students : [],
                student: {
                    id: '',
                    parents_fname: '',
                    parents_sname: '',
                    parents_tel:'',
                    class_id : '',
                    address: '',
                    county: '',
                    town : '',
                },
                search: '',
                validationErrors: [],
            }
        },
        props:[],
        methods:{
            addDetails(){

                axios.post('/api/add-student-info', {
                    s_id: this.student.id,
                    parents_fname:this.student.parents_fname,
                    parents_sname:this.student.parents_sname,
                    parents_tel:this.student.parents_tel,
                    class_id :this.student.class_id,
                    address:this.student.address,
                    county:this.student.county,
                    town :this.student.town,
                })
                    .then(function (response) {
                        alert(response);
                    })
                    .catch(error =>{
                           this.validationErrors = error.response.data.errors;
                    });
            }
        },
        computed:{
             searchedStudents:function (){
                     return this.students.filter(stdnt => {
                        return stdnt.name.toLowerCase().match(this.search.toLowerCase());
                    });
             }
        },
        mounted() {
            axios.get('/api/students')
                    .then(response =>{
                       this.students = response.data.data;
                    })
                    .catch(err =>{
                            console.log(err);

           });

        }
    }


</script>
