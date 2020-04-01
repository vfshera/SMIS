<template>
    <div>
    <div class="card">
        <div class="card-header">
              <h3 class="card-title">TEACHERS</h3>

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
                </tr>
                </thead>
                <tbody>

                 <tr v-for="teacher in searchedTeachers" :key="teacher.id">
                  <td>{{ teacher.name}}</td>
                  <td>{{ teacher.email}}</td>
                  <td><i class="fas fa-pencil-alt mr-1" data-toggle="modal" data-target="#editTeacher"></i> <i class="ml-1 far fa-trash-alt" @click="deleteTeacger(teacher.id)"></i></td>
                </tr>


                </tbody>

              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->



            <div class="modal fade" id="addTeachersDetails" tabindex="-1" role="dialog" aria-labelledby="addTeachersDetails" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title ml-2" id="addTeacherDetailsTitle">ADD TEACHERS DETAILS</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <!-- Modal -->          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- <form class="p-2" @submit.prevent="addDetails">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                <label for="name">For</label>
                                <select class="form-control" v-model="teacher.id">
                                    <option  v-for="st in logged" :key="st.id" :value="st.id"> {{ st.name }}</option>
                                </select>
                                <span v-if="validationErrors.s_id" class="text-danger">The Student ID is Required</span>
                               </div>
                                <div class="form-group col-md-6">
                                <label for="classroom">Class</label>
                                <select v-model="teacher.class_id" class="form-control">
                                    <option v-for="cl in classes" :key="cl.id" :value="cl.id"> {{ cl.form + " " + cl.stream }}</option>
                                </select>
                                <span v-if="validationErrors.class_id" class="text-danger">@{{ validationErrors.class_id[0] }}</span>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group  col-md-6">
                                    <label for="pfirstname">Parent / Guardian First Name</label>
                                    <input type="text" class="form-control" v-model="teacher.parents_fname" id="pfirstname" placeholder="Parent or Guardian First Name">
                                    <span v-if="validationErrors.parents_fname" class="text-danger">@The parents first name field is required</span>
                                </div>
                                <div class="form-group  col-md-6">
                                    <label for="psecname">Parent / Guardian Second Name</label>
                                    <input type="text" class="form-control" v-model="teacher.parents_sname" id="psecname" placeholder="Parent or Guardian Second Name">
                                    <span v-if="validationErrors.parents_sname" class="text-danger">@The parents second name field is required.</span>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="address">Address</label>
                                    <input type="text" v-model="teacher.address" class="form-control" id="address">
                                    <span v-if="validationErrors.address" class="text-danger">@{{ validationErrors.address[0] }}</span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="tel">Telephone (Parent)</label>
                                    <input type="text" v-model="teacher.parents_tel" class="form-control" id="tel">
                                    <span v-if="validationErrors.parents_tel" class="text-danger">@{{ validationErrors.parents_tel[0] }}</span>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group  col-md-6">
                                    <label for="town">Town</label>
                                    <input type="text" v-model="teacher.town" class="form-control" id="town">
                                    <span v-if="validationErrors.town" class="text-danger">@{{ validationErrors.town[0] }}</span>
                                </div>
                                <div class="form-group  col-md-6">
                                    <label for="county">County</label>
                                    <select id="county" v-model="teacher.county" class="form-control">
                                        <option selected>Choose...</option>
                                        <option>Nairobi</option>
                                        <option>Mombasa</option>
                                        <option>Kisumu</option>
                                        <option>Nakuru</option>
                                        <option>Lamu</option>
                                        <option>Vihiga</option>
                                    </select>
                                    <span v-if="validationErrors.county" class="text-danger">@{{ validationErrors.county[0] }}</span>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary float-right">SUBMIT</button>
                        </form> -->
                    </div>
                </div>
            </div>
            </div>

            <div class="modal fade" id="editTeacher" tabindex="-1" role="dialog" aria-labelledby="editTeacher" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title ml-2" id="addSudentDetailsTitle">EDIT TEACHER DETAILS</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <!-- Modal -->          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="p-2" @submit.prevent="editStudent">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                <label for="name">For</label>
                                <select class="form-control" v-model="teacher.id">
                                    <option  v-for="st in logged" :key="st.id" :value="st.id"> {{ st.name }}</option>
                                </select>
                                <span v-if="validationErrors.s_id" class="text-danger">The Student ID is Required</span>
                               </div>
                                <div class="form-group col-md-6">
                                <label for="classroom">Class</label>
                                <select v-model="teacher.class_id" class="form-control">
                                    <option v-for="cl in classes" :key="cl.id" :value="cl.id"> {{ cl.form + " " + cl.stream }}</option>
                                </select>
                                <span v-if="validationErrors.class_id" class="text-danger">@{{ validationErrors.class_id[0] }}</span>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group  col-md-6">
                                    <label for="pfirstname">Parent / Guardian First Name</label>
                                    <input type="text" class="form-control" v-model="teacher.parents_fname" id="pfirstname" placeholder="Parent or Guardian First Name">
                                    <span v-if="validationErrors.parents_fname" class="text-danger">@The parents first name field is required</span>
                                </div>
                                <div class="form-group  col-md-6">
                                    <label for="psecname">Parent / Guardian Second Name</label>
                                    <input type="text" class="form-control" v-model="teacher.parents_sname" id="psecname" placeholder="Parent or Guardian Second Name">
                                    <span v-if="validationErrors.parents_sname" class="text-danger">@The parents second name field is required.</span>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="address">Address</label>
                                    <input type="text" v-model="teacher.address" class="form-control" id="address">
                                    <span v-if="validationErrors.address" class="text-danger">@{{ validationErrors.address[0] }}</span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="tel">Telephone (Parent)</label>
                                    <input type="text" v-model="teacher.parents_tel" class="form-control" id="tel">
                                    <span v-if="validationErrors.parents_tel" class="text-danger">@{{ validationErrors.parents_tel[0] }}</span>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group  col-md-6">
                                    <label for="town">Town</label>
                                    <input type="text" v-model="teacher.town" class="form-control" id="town">
                                    <span v-if="validationErrors.town" class="text-danger">@{{ validationErrors.town[0] }}</span>
                                </div>
                                <div class="form-group  col-md-6">
                                    <label for="county">County</label>
                                    <select id="county" v-model="teacher.county" class="form-control">
                                        <option selected>Choose...</option>
                                        <option>Nairobi</option>
                                        <option>Mombasa</option>
                                        <option>Kisumu</option>
                                        <option>Nakuru</option>
                                        <option>Lamu</option>
                                        <option>Vihiga</option>
                                    </select>
                                    <span v-if="validationErrors.county" class="text-danger">@{{ validationErrors.county[0] }}</span>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary float-right">UPDATE</button>
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
                logged : [],
                teachers : [],
                classes: [],
                teacher: {
                    id: '',
                    name: '',
                    contact: '',
                },
                search: '',
                validationErrors: [],
            }
        },
        props:[],
        methods:{
            deleteTeacher(id){
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                        }).then((result) => {
                        if (result.value) {
                            axios.delete('/api/delete-teacher/'+id)
                            .then(response =>{
                                Fire.$emit('StudentAdded');
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Teacher Deleted Successfully'
                                    })
                            })
                            .catch(err =>{
                                   Swal.fire(
                                    'Error!',
                                    err,
                                    'warning'
                                    )
                            });


                        }
                    })

                },

               fetchTeachers(){
                  axios.get('/api/teachers')
                            .then(response =>{
                            this.teachers = response.data.data;
                            })
                            .catch(err =>{
                                    console.log(err);

                });

                axios.get('/api/classes')
                            .then(response =>{
                            this.classes = response.data.data;
                            console.log(this.classes);

                            })
                            .catch(err =>{
                                    console.log(err);

                            });

                axios.get('/api/loggedteachers')
                            .then(response =>{
                            this.logged = response.data.data;
                            })
                            .catch(err =>{
                                    console.log(err);

                });
            },
            editStudent(){
                   Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                        }).then((result) => {
                        if (result.value) {


                        }
                    })

            },
            addDetails(){

                axios.post('/api/add-teacher-info', {
                    user_id: this.teacher.id,
                    parents_fname:this.teacher.parents_fname,
                    parents_sname:this.teacher.parents_sname,
                    parents_tel:this.teacher.parents_tel,
                    class_id :this.teacher.class_id,
                    address:this.teacher.address,
                    county:this.teacher.county,
                    town :this.teacher.town,
                })
                    .then(function (response) {
                        Fire.$emit('StudentAdded');
                         $('#addStudentDetails').modal('hide');
                         $('body').removeClass('modal-open');
                         $('.modal-backdrop').remove();
                        Toast.fire({
                            icon: 'success',
                            title: 'Student Added successfully'
                            })
                    })
                    .catch(error =>{
                           this.validationErrors = error.response.data.errors;
                    });
            }
        },
        computed:{
             searchedTeachers:function (){
                     return this.teachers.filter(tchr => {
                        return tchr.name.toLowerCase().match(this.search.toLowerCase());
                    });
             }
        },
        mounted() {

               this.fetchTeachers();
               Fire.$on('StudentAdded',()=>{
                   this.fetchTeachers();
               });
        }
    }


</script>
