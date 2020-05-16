<template>
    <div>
    <div class="card">
        <div class="card-header">
              <label><h3 class="card-title">My Classes</h3></label>

              <input class="form-control col-md-5  d-inline ml-auto  float-right" type="search" placeholder="Search" v-model="search" aria-label="Search">


          </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="dt" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Admission</th>
                  <th>Name</th>
                  <th>Date Joined</th>
                </tr>
                </thead>
                <tbody>

                 <tr v-for="studnt in searchedForm" :key="studnt.id">
                  <td>

                  </td>
                  <td>

                  </td>
                  <td>

                  </td>


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
       name: 'Classlist',
        data(){
            return{
                className:'',
                classId:'',
                students:[],
                search: '',
                validationErrors: [],
            }
        },
        props:['id'],
        methods:{
            fetcthData(){
                 axios.get('')
                    .then(response =>{
                        this.className = response.data.data.name;
                        this.classId = response.data.data.id;
                        this.students = response.data.data.students;

                         }).then(console.log(this.students))
                    .catch(err =>{
                            console.log(err);

                    });

            },
        },
        computed:{
        },
        mounted() {

        }
    }


</script>
