<template>
    <div>
    <div class="card">
         <form class="p-2" @submit.prevent="addDetails">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="name">Stream Name</label>
                                    <input type="text" v-model="stream.name" class="form-control" id="name">
                                    <span v-if="validationErrors.name" class="text-danger">Stream Name Field is Required</span>
                               </div>
                                <div class="form-group col-md-5">
                                    <label for="rep">Representation</label>
                                    <input type="text" v-model="stream.rep" class="form-control" id="rep">
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
              <label><h3 class="card-title">STREAMS</h3></label>

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

                 <tr v-for="strm in searchedForm" :key="strm.id">
                  <td>{{ strm.name}}</td>
                  <td>{{ strm.rep}}</td>
                  <td>{{ strm.created_at }}</td>
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
                streams : [],
                stream: {
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
                   axios.get('/api/streams')
                    .then(response =>{
                       this.streams = response.data.data;
                    })
                    .catch(err =>{
                            console.log(err);

                    });
            },
            addDetails(){

                axios.post('/api/add-stream', {
                    name:this.stream.name,
                    rep:this.stream.rep,
                })
                    .then(function (response) {
                         Fire.$emit('StreamAdded');
                    })
                    .catch(error =>{
                           this.validationErrors = error.response.data.errors;
                    });
            }
        },
        computed:{
             searchedForm:function (){
                     return this.streams.filter(strm => {
                        return strm.name.toLowerCase().match(this.search.toLowerCase());
                    });
             }
        },
        mounted() {

            this.fetcthData();
            Fire.$on('StreamAdded',()=>{
                this.fetcthData();
            });
        }
    }


</script>
