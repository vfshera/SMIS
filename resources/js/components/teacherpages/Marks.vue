<template>
    <div>
    <div class="card">
        <div class="card-header">
              <label><h3 class="card-title text-bold d-inline">{{ this.subject }} MARKS  - FORM {{ this.className.toUpperCase() }} </h3>
                  <span class="d-inline ml-2 badge badge-primary" v-text="totalStudents"></span>
              </label>

              <input class="form-control col-md-5  d-inline ml-auto  float-right" type="search" placeholder="Search" v-model="search" aria-label="Search">


          </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="dt" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Admission</th>
                  <th>Name</th>
                  <th>Marks</th>
                   <th>Allocate</th>
                </tr>
                </thead>
                <tbody>

                 <tr v-for="student in searchedStudents" :key="student.id">
                     <td> {{ student.id}}  </td>
                     <td> {{ student.user.name }}  </td>
                     <td> - </td>
                     <td>
                        <div class="row">
                            <input class="form-control col-md-8 mr-5" type="number"/>
                            <i class="fas fa-pencil-alt col-md-1 text-center " style="margin-top: 7px"></i>|
                            <i class=" far fa-trash-alt col-md-1 text-center " style="margin-top: 7px"></i>
                        </div>
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
       name: 'Marks',
        data(){
            return{
                students: [],
                search: '',
                validationErrors: [],
            }
        },
        props:['classid','timetableid', 'className' , 'subject'],
        methods:{
            fetchData(){
                 axios.get('/api/scoresheet/'+ this.classid +"/"+this.timetableid).then(response =>{
                        this.students = response.data.data
                         })
                    .catch(err =>{
                            console.log(err);

                    });

            },
        },
        computed:{
            searchedStudents:function (){
                return this.students.filter(stdnt => {
                    return stdnt.user.name.toLowerCase().match(this.search.toLowerCase());
                });
            },

            totalStudents:function () {
                if(this.searchedStudents.length > 1){

                    return this.searchedStudents.length + " Students "

                } else if(this.searchedStudents.length == 1){

                    return this.searchedStudents.length + " Student "

                }else if(this.searchedStudents.length == 0){
                        return ''
                }
            }

        },
        mounted() {
            this.fetchData();
        }
    }


</script>
