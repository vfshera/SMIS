<template>
    <div>
    <div class="card">
         <form class="p-2" @submit.prevent="addDetails">
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
                  <th>Stream</th>
                  <th>Date Created</th>
                </tr>
                </thead>
                <tbody>

                 <tr v-for="classes in searchedForm" :key="classes.id">
                  <td>Form {{ classes.form}}</td>
                  <td>{{ classes.stream}}</td>
                  <td>{{ classes.created_at }}</td>
                </tr>


                </tbody>

              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

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
                search: '',
                validationErrors: [],
            }
        },
        props:[],
        methods:{
            fetcthData(){

                 axios.get('/api/classes')
                    .then(response =>{
                       this.classes = response.data.data;
                       console.log(this.classes);

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
            addDetails(){

                axios.post('/api/add-class', {
                    form_id:this.aclass.form_id,
                    stream_id:this.aclass.stream_id,
                })
                    .then(function (response) {
                         Fire.$emit('ClassAdded');
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
                        return cls.form.toLowerCase().match(this.search.toLowerCase());
                    });
             }
        },
        mounted() {

            this.fetcthData();
            Fire.$on('ClassAdded',()=>{
                this.fetcthData();
            });
        }
    }


</script>
