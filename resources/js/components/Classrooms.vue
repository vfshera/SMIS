<template>
    <div>
    <div class="card">
         <form  class="p-2" @submit.prevent="addClass">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name">Form</label>
                                    <select class="form-control" v-model="aclass.form_id">
                                        <option  v-for="frm in forms" :key="frm.id" :value="frm.id"> {{ frm.name }}</option>
                                    </select>
                                    <span v-if="validationErrors.form" class="text-danger">Form Name Field is Required</span>
                               </div>
                                <div class="form-group col-md-5">
                                    <label for="rep">Stream</label>
                                    <select class="form-control" v-model="aclass.stream_id">
                                        <option  v-for="strm in streams" :key="strm.id" :value="strm.id"> {{ strm.name }}</option>
                                    </select>
                                    <span v-if="validationErrors.stream" class="text-danger">@{{ validationErrors.stream[0] }}</span>
                                </div>
                                <div class="form-group col-md-1">
                                    <button type="submit" class="btn btn-primary form-control " style="margin-top:30px">ADD</button>
                                </div>
                            </div>



         </form>
    </div>
    <div class="card">
        <div class="card-header">
              <label><h3 class="card-title">CLASSES</h3></label>

                    <input class="form-control col-md-5  d-inline ml-auto  float-right" type="search" placeholder="Search" v-model="search" aria-label="Search">


          </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="dt" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Level</th>
                  <th>Date Created</th>
                </tr>
                </thead>
                <tbody>

                 <tr v-for="classes in searchedForm" :key="classes.id">
                  <td>
                      <router-link :to="{ path: '/classlist/'+ classes.id }" class="nav-link">
                         Form {{ classes.name}}
                      </router-link>
                  </td>
                  <td>{{ classes.created_at }}</td>
                   <td>
                     <i class="fas fa-pencil-alt mr-1" data-toggle="modal" data-target="#editClass" @click="setCurr(classes)"></i>
                     <i class="ml-1 far fa-trash-alt" @click="deleteClass(classes.id)"></i>
                  </td>
                </tr>


                </tbody>

              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->


           <div class="modal fade" id="editClass" tabindex="-1" role="dialog" aria-labelledby="editClass" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-md" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title ml-2" id="editClass">EDIT CLASS</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <!-- Modal -->          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                          <form class="p-2 " @submit.prevent="updateClass">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="name">Form</label>
                                    <select class="form-control" v-model="classUpdate.form_id">
                                        <!-- <option :value="aclass.form_id" selected >{{ aclass.form_name}}</option> -->
                                        <option  v-for="frm in forms" :key="frm.id" :value="frm.id"> {{ frm.name }}</option>
                                    </select>
                                    <span v-if="validationErrors.form" class="text-danger">Form Name Field is Required</span>
                               </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="rep">Stream</label>
                                    <select class="form-control" v-model="classUpdate.stream_id">
                                        <!-- <option :value="aclass.stream_id" selected >{{ aclass.stream_name}}</option> -->
                                        <option  v-for="strm in streams" :key="strm.id" :value="strm.id"> {{ strm.name }}</option>
                                    </select>
                                    <span v-if="validationErrors.stream" class="text-danger">@{{ validationErrors.stream[0] }}</span>
                                </div>

                            </div>
                            <div class="form-group ">
                                    <button type="submit" class="btn btn-primary form-control " style="margin-top:30px">Update</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
            </div>

    </div>
</template>

<script>

    export default {
        name: 'Classrooms',
        data(){
            return{
                classes : [],
                streams : [],
                forms : [],
                aclass: {
                    form_id: '',
                    stream_id: '',
                },
                classUpdate: {
                    class_id:'',
                    form_id: '',
                    stream_id: '',
                    form_name: '',
                    stream_name: '',
                },
                search: '',
                validationErrors: [],
            }
        },
        props:[],
        methods:{
            setCurr(classrm){
                this.classUpdate.class_id = classrm.id;
                this.classUpdate.form_name = classrm.form;
                this.classUpdate.stream_name = classrm.stream;
                this.classUpdate.form_id = classrm.form_id;
                this.classUpdate.stream_id = classrm.stream_id;
            },
            deleteClass(id){
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
                            axios.delete('/api/delete-class/'+id)
                            .then(response =>{
                                Fire.$emit('ClasslistChanged');
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Class Deleted Successfully'
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
            fetcthData(){

                 axios.get('/api/classes')
                    .then(response =>{
                       this.classes = response.data.data;

                    })
                    .catch(err =>{
                            console.log(err);

                    });

                axios.get('/api/forms')
                    .then(response =>{
                       this.forms  = response.data.data;
                    })
                    .catch(err =>{
                            console.log(err);

                    });

                axios.get('/api/streams')
                    .then(response =>{
                       this.streams = response.data.data;
                    })
                    .catch(err =>{
                            console.log(err);

                    });
            },
            updateClass(){
                axios.post('/api/add-class', {
                    id:this.classUpdate.class_id,
                    form_id:this.classUpdate.form_id,
                    stream_id:this.classUpdate.stream_id,
                })
                    .then(function (response) {
                         Fire.$emit('ClasslistChanged');
                         Toast.fire({
                            icon: 'success',
                            title: 'Class Updated successfully'
                            })
                    })
                    .catch(error =>{
                           this.validationErrors = error.response.data.errors;
                    });
            },
             addClass(){
                axios.post('/api/add-class', {
                    form_id:this.aclass.form_id,
                    stream_id:this.aclass.stream_id,
                })
                    .then(function (response) {
                         Fire.$emit('ClasslistChanged');
                         Toast.fire({
                            icon: 'success',
                            title: 'Class Added successfully'
                            })
                    })
                    .catch(error =>{
                           this.validationErrors = error.response.data.errors;
                    });
            }
        },
        computed:{
             searchedForm:function (){
                     return this.classes.filter(cls => {
                        return cls.form.toLowerCase().match(this.search.toLowerCase()) || cls.stream.toLowerCase().match(this.search.toLowerCase());
                    });
             }
        },
        mounted() {

            this.fetcthData();
            Fire.$on('ClasslistChanged',()=>{
                this.fetcthData();
            });
        }
    }


</script>
