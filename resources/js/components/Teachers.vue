<template>
    <div>
    <div class="card">
        <div class="card-header">
              <h3 class="card-title">TEACHERS</h3>

                    <input class="form-control col-md-6  d-inline " style="margin-left:200px" type="search" placeholder="Search" v-model="search" aria-label="Search">

              <span class="btn btn-primary float-right " data-toggle="modal" data-target="#addTeachersDetails" @click="resetTeacher"><i class="far fa-address-card mr-3"></i>ADD DETAILS</span>
          </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="dt" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>TSC</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Teaches</th>
                  <th>Actions</th>
                </tr>
                </thead>
                <tbody>

                 <tr v-for="teacher in searchedTeachers" :key="teacher.id">
                  <td data-toggle="modal" data-target="#TeachersDetails" @click="setTeacher(teacher)">{{ teacher.name}}</td>
                  <td>{{ teacher.tsc}}</td>
                  <td>{{ teacher.tel}}</td>
                  <td>{{ teacher.email}}</td>
                  <td>
                      <span v-for="(sb ,index) in teacher.teaches" :key="sb.id" >
                                        <span v-if="teacher.teaches.length == index + 1 && index != 0"> & </span>
                                        {{ sb.abbr }}
                                        <span v-if="teacher.teaches.length > 2 && teacher.teaches.length != index + 2 && teacher.teaches.length != index + 1"> , </span>

                     </span>
                  </td>
                  <td><i class="fas fa-pencil-alt mr-1" data-toggle="modal" data-target="#editTeacher" @click="setTeacher(teacher)"></i> <i class="ml-1 far fa-trash-alt" @click="deleteTeacher(teacher.id)"></i></td>
                </tr>


                </tbody>

              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
           <div class="modal fade" id="addDuties" tabindex="-1" role="dialog" aria-labelledby="addDuties" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title ml-2" id="TeacherDetailsTitle">Assign Subject To {{teacher.name}}</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <!-- Modal -->          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="p-2" @submit.prevent="addDuty">
                             <label for="classroom">Subject</label>
                            <div class="row">
                                <div class="form-group col-md-10">
                                <select v-model="teacher.newduty" class="form-control">
                                        <option disabled> Choose A Subject</option>
                                        <option v-for="sub in subjects" :key="sub.id" :value="sub.id" placeholder="Choose A Subject"> {{ sub.title }}</option>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class=" btn btn-primary float-right">ASSIGN</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            </div>

             <div class="modal fade" id="TeachersDetails" tabindex="-1" role="dialog" aria-labelledby="TeachersDetails" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h3 class="modal-title ml-2" id="TeacherDetailsTitle">{{ teacher.name }} Details</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <!-- Modal -->          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row ml-2">
                            <div class="col-md-6">
                                <div>
                                    <label for="">TSC Number</label>
                                    <p>{{ teacher.tsc}}</p>
                                </div>
                                <div>
                                    <label for="">Contacts</label>
                                    <p>{{ teacher.tel}}</p>
                                    <p>{{ teacher.email}}</p>
                                </div>
                                <div>
                                    <label for="">Address</label>
                                    <p>P.O Box {{ teacher.address}} ,{{ teacher.town}}</p>
                                    <p>{{ teacher.county}} County.</p>
                                </div>

                            </div>
                            <div class="col-md-6">
                                 <label for="" class="mb-0 pb-0">Teaches</label>
                                 <i class="float-right text-primary fa fa-plus" @click="openClasses('#TeachersDetails','#addDuties')"></i>
                                 <hr>
                                    <p v-for="sb in teacher.subjects" :key="sb.id">
                                            {{ sb.name }}
                                            <span class="d-block text-muted pl-1" style="border:1px solid grey;border-radius:5px">
                                                {{ sb.abbr.toLowerCase() }}
                                                <span class="text-danger ml-1" @click="deleteDuty(sb.duty_id)">&times;</span>
                                            </span>
                                    </p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="text-muted blue">Joined on {{ teacher.joined }}</div>
                    </div>
                </div>
            </div>
            </div>


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
                        <form class="p-2" @submit.prevent="addTeacher">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                <label for="name">For</label>
                                <select class="form-control" v-model="teacher.uid">
                                    <option  v-for="tcher in logged" :key="tcher.id" :value="tcher.id"> {{ tcher.name }}</option>
                                </select>
                                <span v-if="validationErrors.id" class="text-danger">{{ validationErrors.id[0] }}</span>
                               </div>
                                <div class="form-group col-md-6">
                                <label for="classroom">TSC Number</label>
                                <input type="text" v-model="teacher.tsc" class="form-control" id="address">
                                <span v-if="validationErrors.tsc" class="text-danger">@{{ validationErrors.tsc[0] }}</span>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="address">Address</label>
                                    <input type="text" v-model="teacher.address" class="form-control" id="address">
                                    <span v-if="validationErrors.address" class="text-danger">@{{ validationErrors.address[0] }}</span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="tel">Telephone</label>
                                    <input type="text" v-model="teacher.tel" class="form-control" id="tel">
                                    <span v-if="validationErrors.tel" class="text-danger">@{{ validationErrors.tel[0] }}</span>
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
                        </form>
                    </div>
                </div>
            </div>
            </div>

            <div class="modal fade" id="editTeacher" tabindex="-1" role="dialog" aria-labelledby="editTeacher" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title ml-2" id="TeacherDetailsTitle">EDIT TEACHER DETAILS</h5>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <!-- Modal -->          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="p-2" @submit.prevent="editTeacher">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                <label for="name">For</label>
                                 <label for="name" class="form-control">{{ teacher.name }}</label>
                               </div>
                                <div class="form-group col-md-6">
                                <label for="classroom">TSC Number</label>
                                <input type="text" v-model="teacher.tsc" class="form-control" id="address">
                                <span v-if="validationErrors.tsc" class="text-danger">@{{ validationErrors.tsc[0] }}</span>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="address">Address</label>
                                    <input type="text" v-model="teacher.address" class="form-control" id="address">
                                    <span v-if="validationErrors.address" class="text-danger">@{{ validationErrors.address[0] }}</span>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="tel">Telephone</label>
                                    <input type="text" v-model="teacher.tel" class="form-control" id="tel">
                                    <span v-if="validationErrors.tel" class="text-danger">@{{ validationErrors.tel[0] }}</span>
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
                                <span class="text-primary" @click="openClasses('#editTeacher','#TeachersDetails')">Edit {{ teacher.name }}'s Classes</span>
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
        name: 'Teachers',
        data(){
            return{
                logged : [],
                teachers : [],
                subjects: [],
                teacher: {
                    newduty:'',
                    id: '',
                    name: '',
                    uid: '',
                    tsc: '',
                    tel: '',
                    email: '',
                    address: '',
                    county: '',
                    town: '',
                    joined: '',
                    subjects: []
                },
                search: '',
                validationErrors: [],
            }
        },
        props:[],
        methods:{
              setTeacher(tcher){
                  this.teacher.id =  tcher.id
                  this.teacher.name =  tcher.name
                  this.teacher.tsc  =  tcher.tsc
                  this.teacher.tel  =  tcher.tel
                  this.teacher.email  =  tcher.email
                  this.teacher.address  =  tcher.address
                  this.teacher.county  =  tcher.county
                  this.teacher.town  =  tcher.town
                  this.teacher.joined  =  tcher.joined
                  this.teacher.subjects  =  tcher.teaches

             },
              resetTeacher(){
                  this.teacher.id =  '';
                  this.teacher.name =  '';
                  this.teacher.tsc  =  '';
                  this.teacher.tel  =  '';
                  this.teacher.email  =  '';
                  this.teacher.address  =  '';
                  this.teacher.county  =  '';
                  this.teacher.town  =  '';
                  this.teacher.joined  =  '';
                  this.teacher.subjects  =  '';

             },
             openClasses(close,open){
                 $(close).modal('hide');
                 $('body').removeClass('modal-open');
                $('.modal-backdrop').remove();

                $(open).modal('show');
             },
             addDuty(){
                axios.post('/api/add-duty/',
                        {
                            teacher_id:this.teacher.id,
                            subject_id:this.teacher.newduty
                        }
                    ).then(response =>{
                                    this.openClasses('#addDuties','#TeachersDetails');
                                    axios.get('/api/reload-duty/'+this.teacher.id)
                                        .then(response =>{
                                            this.teacher.subjects = response.data.data;
                                        })
                                        .catch(err =>{
                                            console.log("Error from Reload --- " + err)
                                        });
                                    Fire.$emit('UpdateTeachers');
                                })
                                .catch(err =>{
                                     console.log("Error from Add Duty --- " + err)
                                });
             },
             deleteDuty(id){
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
                                axios.delete('/api/delete-duty/'+id)
                                .then(response =>{
                                    // $('#TeachersDetails').modal('hide');
                                    // $('body').removeClass('modal-open');
                                    // $('.modal-backdrop').remove();
                                     axios.get('/api/reload-duty/'+this.teacher.id)
                                        .then(response =>{
                                            this.teacher.subjects = response.data.data;
                                        })
                                        .catch(err =>{
                                            console.log("Error from Reload --- " + err)
                                        });
                                    Fire.$emit('UpdateTeachers');
                                    Toast.fire({
                                        icon: 'success',
                                        title: 'Duty Deleted Successfully'
                                        })
                                })
                                .catch(err =>{
                                    console.log("Error from Delete Duty --- " + err)
                                    // Swal.fire(
                                    //     'Error!',
                                    //     err,
                                    //     'warning'
                                    //     )
                                });


                            }
                    })
             },
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
                                Fire.$emit('UpdateTeachers');
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Teacher Deleted Successfully'
                                    })
                            })
                            .catch(err =>{

                                console.log("Error from Delete Teacher --- " + err)
                                //    Swal.fire(
                                //     'Error!',
                                //     err,
                                //     'warning'
                                //     )
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
                axios.get('/api/loggedteachers')
                            .then(response =>{
                            this.logged = response.data.data;
                            })
                            .catch(err =>{
                                    console.log(err);

                });
                axios.get('/api/subjects')
                    .then(response =>{
                       this.subjects = response.data.data;

                    })
                    .catch(err =>{
                            console.log(err);

                    });
            },
            editTeacher(){
                    axios.post('/api/add-teacher-info', {
                        id: this.teacher.id,
                        user_id: this.teacher.uid,
                        tsc_number:this.teacher.tsc,
                        tel:this.teacher.tel,
                        address:this.teacher.address,
                        county:this.teacher.county,
                        town :this.teacher.town,
                    })
                    .then(function (response) {
                        Fire.$emit('UpdateTeachers');
                         $('#editTeacher').modal('hide');
                         $('body').removeClass('modal-open');
                         $('.modal-backdrop').remove();
                        Toast.fire({
                            icon: 'success',
                            title: 'Teacher Updated successfully'
                            })
                    })
                    .catch(error =>{
                           this.validationErrors = error.response.data.errors;
                    });

            },
            addTeacher(){

                axios.post('/api/add-teacher-info', {
                    user_id: this.teacher.uid,
                    tsc_number:this.teacher.tsc,
                    tel:this.teacher.tel,
                    address:this.teacher.address,
                    county:this.teacher.county,
                    town :this.teacher.town,
                })
                    .then(function (response) {
                        Fire.$emit('UpdateTeachers');
                         $('#addTeachersDetails').modal('hide');
                         $('body').removeClass('modal-open');
                         $('.modal-backdrop').remove();
                        Toast.fire({
                            icon: 'success',
                            title: 'Teacher Added Successfully'
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
               Fire.$on('UpdateTeachers',()=>{
                   this.fetchTeachers();
               });
        }
    }


</script>
