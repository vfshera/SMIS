<template>
    <div>
    <div class="card">
         <form class="p-2" @submit.prevent="addDetails">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name">Form Name</label>
                                    <input type="text" v-model="form.name" class="form-control" id="name">
                                    <span v-if="validationErrors.name" class="text-danger">Form Name Field is Required</span>
                               </div>
                                <div class="form-group col-md-5">
                                    <label for="rep">Representation</label>
                                    <input type="text" v-model="form.rep" class="form-control" id="rep">
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
              <label><h3 class="card-title">FORMS</h3></label>

                    <input class="form-control col-md-5  d-inline ml-auto  float-right" type="search" placeholder="Search" v-model="search" aria-label="Search">


          </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="dt" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Representation</th>
                  <th>Date Created</th>
                </tr>
                </thead>
                <tbody>

                 <tr v-for="form in searchedForm" :key="form.id">
                  <td>{{ form.name}}</td>
                  <td>{{ form.math_rep}}</td>
                  <td>{{ form.created_at }}</td>
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
        name: 'Form',
        data(){
            return{
                forms : [],
                form: {
                    name: '',
                    rep: '',
                },
                search: '',
                validationErrors: [],
            }
        },
        props:[],
        methods:{
            fetcthData(){
                   axios.get('/api/forms')
                    .then(response =>{
                       this.forms = response.data.data;
                    })
                    .catch(err =>{
                            console.log(err);

                    });
            },
            addDetails(){

                axios.post('/api/add-form', {
                    name:this.form.name,
                    math_rep:this.form.rep,
                })
                    .then(function (response) {
                         Fire.$emit('FormAdded');
                         Toast.fire({
                            icon: 'success',
                            title: 'Form Added successfully'
                            })
                    })
                    .catch(error =>{
                           this.validationErrors = error.response.data.errors;
                    });
            }
        },
        computed:{
             searchedForm:function (){
                     return this.forms.filter(frm => {
                        return frm.name.toLowerCase().match(this.search.toLowerCase());
                    });
             }
        },
        mounted() {

            this.fetcthData();
            Fire.$on('FormAdded',()=>{
                this.fetcthData();
            });
        }
    }


</script>
