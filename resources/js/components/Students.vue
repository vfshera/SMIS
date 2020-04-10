<template>
    <div>
    <div class="card">
        <div class="card-header">
              <h3 class="card-title">STUDENTS</h3>

                    <input class="form-control col-md-6  d-inline " style="margin-left:200px" type="search" placeholder="Search" v-model="search" aria-label="Search">

              <span class="btn btn-primary float-right " data-toggle="modal" data-target="#addStudentDetails"><i class="far fa-address-card mr-3"></i>ADD DETAILS</span>
          </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="dt" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Adm No</th>
                  <th>Email</th>
                  <th>Parents Name</th>
                  <th>Contact</th>
                  <th>Class</th>
                  <th>Address</th>
                  <th>Town</th>
                  <th>County</th>
                  <th>Joined On</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>

                 <tr v-for="student in searchedStudents" :key="student.id">
                  <td>{{ student.name}}</td>
                  <td>{{ student.admission_no}}</td>
                  <td>{{ student.email }}</td>
                  <td>{{ student.parents_fname}} {{ student.parents_sname}}</td>
                  <td>{{ student.parents_tel }}</td>
                  <td> {{ student.class_name }}</td>
                  <td>{{ student.address}}</td>
                  <td>{{ student.town }}</td>
                  <td>{{ student.county}}</td>
                  <td>{{ student.joined}}</td>
                  <td><i class="fas fa-pencil-alt mr-1" data-toggle="modal" data-target="#editStudent" @click="setStudent(student)"></i> <i class="ml-1 far fa-trash-alt" @click="deleteStudent(student.id)"></i></td>
                </tr>


                </tbody>

              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->



            <div class="modal fade" id="addStudentDetails" tabindex="-1" role="dialog" aria-labelledby="addStudentDetails" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title ml-2" id="addStudentDetailsTitle">ADD STUDENT DETAILS</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <!-- Modal -->          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="p-2" @submit.prevent="addDetails">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                <label for="name">For</label>
                                <select class="form-control" v-model="student.id">
                                    <option  v-for="st in logged" :key="st.id" :value="st.id"> {{ st.name }}</option>
                                </select>
                                <span v-if="validationErrors.s_id" class="text-danger">The Student ID is Required</span>
                               </div>
                                <div class="form-group col-md-6">
                                <label for="classroom">Class</label>
                                <select v-model="student.class_id" class="form-control">
                                    <option selected>Choose...</option>
                                    <option v-for="cl in classes" :key="cl.id" :value="cl.id"> {{ cl.form + " " + cl.stream }}</option>
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
                                    <input type="text" v-model="student.town" class="form-control" id="town">
                                    <span v-if="validationErrors.town" class="text-danger">@{{ validationErrors.town[0] }}</span>
                                </div>
                                <div class="form-group  col-md-6">
                                    <label for="county">County</label>
                                    <select id="county" v-model="student.county" class="form-control">
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
                        </form>
                    </div>
                </div>
            </div>
            </div>

            <div class="modal fade" id="editStudent" tabindex="-1" role="dialog" aria-labelledby="editStudent" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title ml-2" id="addSudentDetailsTitle">EDIT STUDENT DETAILS</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <!-- Modal -->          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="p-2" @submit.prevent="updateStudent">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                <label for="name">For</label>
                                <label for="name" class="form-control">{{ student.name }}</label>
                               </div>
                                <div class="form-group col-md-6">
                                <label for="classroom">Class</label>
                                <select v-model="student.class_id" class="form-control">
                                    <option v-for="cl in classes" :key="cl.id" :value="student.class_id"> {{ cl.form + " " + cl.stream }}</option>
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
                                    <input type="text" v-model="student.town" class="form-control" id="town">
                                    <span v-if="validationErrors.town" class="text-danger">@{{ validationErrors.town[0] }}</span>
                                </div>
                                <div class="form-group  col-md-6">
                                    <label for="county">County</label>
                                    <select id="county" v-model="student.county" class="form-control">
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
                students : [],
                classes: [],
                student: {
                    id: '',
                    name: '',
                    parents_fname: '',
                    parents_sname: '',
                    parents_tel:'',
                    class_id : '',
                    className: '',
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
            setStudent(student){
                    this.student.id = student.id,
                    this.student.name = student.name,
                    this.student.parents_fname = student.parents_fname,
                    this.student.parents_sname = student.parents_sname,
                    this.student.parents_tel = student.parents_tel,
                    this.student.class_id  = student.class_id,
                    this.student.className  = student.class_name,
                    this.student.address = student.address,
                    this.student.county = student.county,
                    this.student.town  = student.town
             },
            deleteStudent(id){
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
                            axios.delete('/api/delete-student/'+id)
                            .then(response =>{
                                Fire.$emit('StudentAdded');
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Student Deleted Successfully'
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

               fetchStudents(){
                  axios.get('/api/students')
                            .then(response =>{
                            this.students = response.data.data;
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

                axios.get('/api/loggedstudents')
                            .then(response =>{
                            this.logged = response.data.data;
                            })
                            .catch(err =>{
                                    console.log(err);

                });
            },
            updateStudent(){
                axios.post('/api/add-student-info', {
                    id: this.student.id,
                    parents_fname:this.student.parents_fname,
                    parents_sname:this.student.parents_sname,
                    parents_tel:this.student.parents_tel,
                    class_id :this.student.class_id,
                    address:this.student.address,
                    county:this.student.county,
                    town :this.student.town,
                }).then(function (response) {
                        Fire.$emit('StudentAdded');
                         $('#editStudent').modal('hide');
                         $('body').removeClass('modal-open');
                         $('.modal-backdrop').remove();
                        Toast.fire({
                            icon: 'success',
                            title: 'Student Updated successfully'
                            })
                    })
                    .catch(error =>{
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            timer:3500,
                            showConfirmButton:false,
                            text: error.response.data.message,
                            })
                           this.validationErrors = error.response.data.errors;
                    });

            },
            addDetails(){

                axios.post('/api/add-student-info', {
                    user_id: this.student.id,
                    parents_fname:this.student.parents_fname,
                    parents_sname:this.student.parents_sname,
                    parents_tel:this.student.parents_tel,
                    class_id :this.student.class_id,
                    address:this.student.address,
                    county:this.student.county,
                    town :this.student.town,
                }).then(function (response) {
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
             searchedStudents:function (){
                     return this.students.filter(stdnt => {
                        return stdnt.name.toLowerCase().match(this.search.toLowerCase());
                    });
             }
        },
        mounted() {

               this.fetchStudents();
               Fire.$on('StudentAdded',()=>{
                   this.fetchStudents();
               });
        }
    }


</script>
