<template>
    <div>
    <div class="card">
        <div class="card-header">
              <h3 class="card-title">SUBJECTS</h3>

                    <input class="form-control col-md-6  d-inline " style="margin-left:200px" type="search" placeholder="Search" v-model="search" aria-label="Search">

              <span class="btn btn-primary float-right " data-toggle="modal" data-target="#addSubject" @click="resetSub()"><i class="far fa-address-card mr-3"></i>ADD SUBJECT</span>
          </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="dt" class="table table-bordered table-striped" v-if="subjects">
                    <thead>
                        <tr>
                        <th>Subject Title</th>
                        <th>Abreviation</th>
                        <th>Description</th>
                        <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>

                        <tr v-for="sub in searchedSubjects" :key="sub.id">
                        <td>{{ sub.title}}</td>
                        <td>{{ sub.abbreviation}}</td>
                        <td>{{ sub.description }}</td>
                       <td><i class="fas fa-pencil-alt mr-1" data-toggle="modal" data-target="#editSubject" @click="setCurr(sub)"></i> <i class="ml-1 far fa-trash-alt" @click="deleteSubject(sub.id)"></i></td>
                       </tr>

                    </tbody>

              </table>

            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->



            <div class="modal fade" id="addSubject" tabindex="-1" role="dialog" aria-labelledby="addSubject" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title ml-2" id="addSubjectDetailsTitle">ADD NEW SUBJECT</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="p-2" @submit.prevent="addDetails">
                                <div class="form-row">
                                    <div class="form-group  col-md-6">
                                        <label for="pfirstname">Subject Title</label>
                                        <input type="text" class="form-control" v-model="subject.title" id="pfirstname" placeholder="Enter Subject Title Here ....">
                                        <span v-if="validationErrors.title" class="text-danger">Subject Title is required</span>
                                    </div>
                                    <div class="form-group  col-md-6">
                                        <label for="psecname">Abbreviation</label>
                                        <input type="text" class="form-control" v-model="subject.abbreviation" id="psecname" placeholder="Enter Abbreviation Here ...">
                                        <span v-if="validationErrors.abbreviation" class="text-danger">Abbreviation field is required.</span>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="pfirstname">Subject Description</label>
                                        <textarea type="text" v-model="subject.description" rows="8" class="form-control" id="address" placeholder="Put Subject description here ......"></textarea>
                                        <span v-if="validationErrors.description" class="text-danger">@{{ validationErrors.description[0] }}</span>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary float-right">ADD</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <div class="modal fade" id="editSubject" tabindex="-1" role="dialog" aria-labelledby="editSubject" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title ml-2" id="editSubjectTitle">EDIT SUBJECT</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="p-2" @submit.prevent="editSubject">
                                <div class="form-row">
                                    <div class="form-group  col-md-6">
                                        <label for="pfirstname">Subject Title</label>
                                        <input type="text" class="form-control" v-model="subject.title" id="pfirstname" placeholder="Enter Subject Title Here ....">
                                        <span v-if="validationErrors.title" class="text-danger">@The parents first name field is required</span>
                                    </div>
                                    <div class="form-group  col-md-6">
                                        <label for="psecname">Abbreviation</label>
                                        <input type="text" class="form-control" v-model="subject.abbreviation" id="psecname" placeholder="Enter Abbreviation Here ....">
                                        <span v-if="validationErrors.abbreviation" class="text-danger">@The parents second name field is required.</span>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="pfirstname">Subject Description</label>
                                        <textarea type="text" v-model="subject.description" rows="8" class="form-control" id="address" placeholder="Put Subject description here ......"></textarea>
                                        <span v-if="validationErrors.description" class="text-danger">@{{ validationErrors.description[0] }}</span>
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
        name: 'Subjects',
        data(){
            return{
                subjects : [],
                subject: {
                    id:'',
                    title: '',
                    description: '',
                    abbreviation:'',
                },
                search: '',
                validationErrors: [],
            }
        },
        props:[],
        methods:{
            setCurr(sub){
                this.subject.id = sub.id;
                this.subject.title = sub.title;
                this.subject.description = sub.description;
                this.subject.abbreviation = sub.abbreviation;
            },
             resetSub(){
                this.subject.id = '';
                this.subject.title = '';
                this.subject.description = '';
                this.subject.abbreviation = '';
            },
            fetcthData(){
                 axios.get('/api/subjects')
                    .then(response =>{
                       this.subjects = response.data.data;
                    })
                    .catch(err =>{
                         Swal.fire(
                                    'Error!',
                                    err,
                                    'warning'
                                    )

                    });
            },
            deleteSubject(id){
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
                            axios.delete('/api/delete-sub/'+id)
                            .then(response =>{
                                Fire.$emit('GetSubjects');
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Subject Deleted Successfully'
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
            addDetails(){
                axios.post('/api/add-subject', {
                    title:this.subject.title.toUpperCase(),
                    description:this.subject.description,
                    abbreviation:this.subject.abbreviation.toUpperCase(),
                })
                    .then(function (response) {
                         Fire.$emit('GetSubjects');
                         $('#addSubject').modal('hide');
                         $('body').removeClass('modal-open');
                         $('.modal-backdrop').remove();
                         this.resetSub();
                         Toast.fire({
                            icon: 'success',
                            title: 'Subject Added successfully'
                            })
                    })
                    .catch(error =>{
                           this.validationErrors = error.response.data.errors;
                    });
            },
             editSubject(){
                axios.post('/api/add-subject', {
                    id:this.subject.id,
                    title:this.subject.title.toUpperCase(),
                    description:this.subject.description,
                    abbreviation:this.subject.abbreviation.toUpperCase(),
                })
                    .then(function (response) {
                         Fire.$emit('GetSubjects');
                         $('#editSubject').modal('hide');
                         $('body').removeClass('modal-open');
                         $('.modal-backdrop').remove();
                          this.resetSub();
                         Toast.fire({
                            icon: 'success',
                            title: 'Subject Updated successfully'
                            })
                    })
                    .catch(error =>{
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            timer:4000,
                            showConfirmButton:false,
                            text: error.response.data.message,
                            })

                    });
            },
        },
        computed:{
             searchedSubjects:function (){
                     return this.subjects.filter(sub => {
                        return sub.title.toLowerCase().match(this.search.toLowerCase());
                    });
             }
        },
        mounted() {

           this.fetcthData();

           Fire.$on('GetSubjects',()=>{
                this.fetcthData();
            });

        }
    }


</script>
