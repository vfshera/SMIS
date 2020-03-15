<template>
    <div>
    <div class="card">
        <div class="card-header">
              <h3 class="card-title">SUBJECTS</h3>

                    <input class="form-control col-md-6  d-inline " style="margin-left:200px" type="search" placeholder="Search" v-model="search" aria-label="Search">

              <span class="btn btn-primary float-right " data-toggle="modal" data-target="#addSudentDetails"><i class="far fa-address-card mr-3"></i>ADD SUBJECT</span>
          </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="dt" class="table table-bordered table-striped" v-if="subjects">
                    <thead>
                        <tr>
                        <th>Subject Title</th>
                        <th>Abreviation</th>
                        <th>Description</th>
                        </tr>
                    </thead>

                    <tbody>

                        <tr v-for="sub in searchedSubjects" :key="sub.id">
                        <td>{{ sub.title}}</td>
                        <td>{{ sub.abbreviation}}</td>
                        <td>{{ sub.description }}</td>
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
                        <h5 class="modal-title ml-2" id="addSudentDetailsTitle">ADD NEW SUBJECT</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="p-2" @submit.prevent="addDetails">
                            <div class="form-row">
                                <div class="form-group  col-md-6">
                                    <label for="pfirstname">Subject Title</label>
                                    <input type="text" class="form-control" v-model="subject.title" id="pfirstname" placeholder="Parent or Guardian First Name">
                                    <span v-if="validationErrors.title" class="text-danger">@The parents first name field is required</span>
                                </div>
                                <div class="form-group  col-md-6">
                                    <label for="psecname">Abbreviation</label>
                                    <input type="text" class="form-control" v-model="subject.abbreviation" id="psecname" placeholder="Parent or Guardian Second Name">
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

                            <button type="submit" class="btn btn-primary float-right">ADD</button>
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
            addDetails(){
                axios.post('/api/add-subject', {
                    title:this.subject.title.toUpperCase(),
                    description:this.subject.description,
                    abbreviation:this.subject.abbreviation.toUpperCase(),
                })
                    .then(function (response) {
                         location.reload();
                    })
                    .catch(error =>{
                           this.validationErrors = error.response.data.errors;
                    });
            }
        },
        computed:{
             searchedSubjects:function (){
                     return this.subjects.filter(sub => {
                        return sub.title.toLowerCase().match(this.search.toLowerCase());
                    });
             }
        },
        mounted() {
            axios.get('/api/subjects')
                    .then(response =>{
                       this.subjects = response.data.data;
                    })
                    .catch(err =>{
                            console.log(err);

           });

        }
    }


</script>
