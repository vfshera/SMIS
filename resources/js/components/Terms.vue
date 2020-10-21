<template>
    <div>
    <div class="card">
         <form class="p-2" @submit.prevent="addDetails">
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="name">Name</label>
                                    <input type="text" v-model="term.name" class="form-control" id="name">
                                    <span v-if="validationErrors.name" class="text-danger">Form Name Field is Required</span>
                               </div>

                                 <div class="form-group col-md-4">
                                    <label for="begin">Beginning</label>
                                    <input type="date" v-model="term.begin" class="form-control" id="begin">
                                    <span v-if="validationErrors.name" class="text-danger">Form Name Field is Required</span>
                               </div>
                                <div class="form-group col-md-4">
                                    <label for="end">Ending</label>
                                    <input type="date" v-model="term.end" class="form-control" id="end">
                                    <span v-if="validationErrors.rep" class="text-danger">@{{ validationErrors.rep[0] }}</span>
                                </div>
                                <div class="form-group col-md-1">
                                    <button type="submit" class="btn btn-primary form-control " style="margin-top:30px">ADD</button>
                                </div>
                            </div>



                        </form>
    </div>
    <div class="card">
        <div class="card-header">
              <label><h3 class="card-title">Term</h3></label>

                    <input class="form-control col-md-5  d-inline ml-auto  float-right" type="search" placeholder="Search" v-model="search" aria-label="Search">


          </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="dt" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Beginning Date</th>
                  <th>Ending Date</th>
                    <th>Submissions</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>

                 <tr v-for="term in searchedTerms" :key="term.id">
                  <td>{{ term.name}}
                      <i v-if="term.status === 1" class="far fa-check-circle ml-1" style="color:#00FF00">&nbsp;&nbsp;ongoing</i>
                      <span v-else class="text-muted" ><del>closed</del></span>
                     </td>
                  <td>{{ term.beginning_on}}</td>
                  <td>{{ term.ending_on }}</td>
                     <td>
                         <span v-if="term.submissions === 1" class="text-primary" >Allowed</span>
                         <span v-else class="text-muted " ><del>Not Allowed</del></span>
                     </td>
                     <td><i class="fas fa-pencil-alt mr-1" data-toggle="modal" data-target="#editTerm" @click="setTerm(term)"></i>
                         <i class="ml-1 far fa-trash-alt" @click="deleteTerm(term.id)"></i>
                         <i class="float-right fas fa-play" v-if="term.status === 0 && term.submissions === 0"  @click="sendResults(term.id)"></i>
                     </td>
                 </tr>


                </tbody>

              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->


           <div class="modal fade" id="editTerm" tabindex="-1" role="dialog" aria-labelledby="editTerm" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title ml-2" >EDIT TERM INFO</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <!-- Modal -->          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form class="p-2" @submit.prevent="updateTerm">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="name">Name</label>

                                        <div class="custom-control custom-switch float-right">
                                            <input type="checkbox" v-model="term.status" class="custom-control-input" id="semSwitch">
                                            <label class="custom-control-label" for="semSwitch" v-text="switchText"></label>
                                        </div>
                                    <input type="text" class="form-control"  v-model="term.name"  placeholder="Enter Term Name">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="name">Beginning</label>
                                    <input type="date" class="form-control"  v-model="term.begin"  placeholder="Enter Term Begin Date">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="name">Ending</label>
                                    <input type="date" class="form-control"  v-model="term.end"  placeholder="Enter Term End  Date">
                                </div>
                            </div>
                            <div class="custom-control custom-switch float-left">
                                <input type="checkbox" v-model="term.submissions" class="custom-control-input" id="submissions">
                                <label class="custom-control-label" for="submissions" v-text="switchSubmissions"></label>
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
        name: 'Terms',
        data(){
            return{
                terms : [],
                term: {
                    id: '',
                    name: '',
                    begin: '',
                    end: '',
                    status: 0,
                    submissions: 0,
                },
                search: '',
                validationErrors: [],
            }
        },
        props:[],
        methods:{
            sendResults(term_id){
                axios.post('/api/send-results', {
                    term_id:term_id
                }).then((response) => {

                    })
                    .catch(error =>{
                        this.validationErrors = error.response.data.errors;
                    });
            },
            setTerm(term){
                this.term.id = term.id;
                this.term.name = term.name;
                this.term.begin = term.begin_raw;
                this.term.end = term.ending_raw;
                this.term.status = term.status;
                this.term.submissions = term.submissions;
            },
            resetTerm(){
                this.term.id = '';
                this.term.name = '';
                this.term.begin = '';
                this.term.end = '';
                this.term.status = 0;
                this.term.submissions = 0;
            },
            fetchData(){
                   axios.get('/api/terms')
                    .then(response =>{
                       this.terms = response.data.data;
                    })
                    .catch(err =>{
                            console.log(err);

                    });
            },
            updateTerm(id){
                   axios.post('/api/add-term', {
                    id:this.term.id,
                    name:this.term.name,
                    beginning_on:this.term.begin,
                    ending_on:this.term.end,
                     submissions:this.term.submissions,
                    status:this.term.status
                    })
                        .then((response) => {
                            Fire.$emit('TermUpdated');
                             $('#editTerm').modal('hide');
                             $('body').removeClass('modal-open');
                             $('.modal-backdrop').remove();
                            Toast.fire({
                                icon: 'success',
                                title: 'Term Updated successfully'
                                });
                        })
                        .catch(error =>{
                            this.validationErrors = error.response.data.errors;
                        });
                },
               deleteTerm(id){
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
                            axios.delete('/api/delete-term/'+id)
                            .then(response =>{
                                Fire.$emit('TermUpdated');
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Term Deleted Successfully'
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

                axios.post('/api/add-term', {
                    name:this.term.name,
                    beginning_on:this.term.begin,
                    ending_on:this.term.end,
                    status : this.term.status,
                    submissions : this.term.submissions,
                })
                    .then((response) => {
                         Fire.$emit('TermUpdated');
                         Toast.fire({
                            icon: 'success',
                            title: 'Term Added successfully'
                            });

                    })
                    .catch(error =>{
                           this.validationErrors = error.response.data.errors;
                    });
            }
        },
        computed:{
             searchedTerms:function (){
                     return this.terms.filter(trm => {
                        return trm.name.toLowerCase().match(this.search.toLowerCase());
                    });
             },
             switchText(){
                return (this.term.status) ? 'Ongoing' : 'Closed';
            },
            switchSubmissions(){
                return (this.term.submissions) ? 'Submissions Allowed' : 'Submissions Not Allowed';
            }
        },
        mounted() {
            this.fetchData();
            Fire.$on('TermUpdated',()=>{

                this.resetTerm();
                this.fetchData();
            });
        }
    }


</script>
<style scoped>
    .fas.fa-play {
        color:#00FF00 !important;
    }

    .fas.fa-play :hover{
        size:10px;
        color:#009000 !important;
    }
</style>
