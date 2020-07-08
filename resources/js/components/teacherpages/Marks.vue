<template>
    <div>
    <div class="card">
        <div class="card-header">
              <label><h3 class="card-title text-bold d-inline">{{ this.duty.name }} MARKS  - FORM {{ this.classs.name.toUpperCase() }} </h3>
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
                     <td class="ml-3" v-if="student.marks"> {{ student.marks.score }}</td>
                     <td >
                        <div class="row" v-if="term.submissions === 1">
                            <input class="form-control col-md-8 mr-5 ml-2" type="number" v-model="score"/>
                            <i class="fa fa-check col-md-1 text-center primary" v-if="score" style="margin-top: 7px" @click="inputMarks(student.id)"></i>
                            <span v-if="student.marks.id && score">|</span>
                            <i class=" far fa-trash-alt col-md-1 text-center" v-if="student.marks.id" style="margin-top: 7px" @click="deleteMarks(student.marks.id)"></i>
                        </div>
                         <div v-if="term.submissions === 0">
                             <h4>Submissions Are Currently Not Allowed</h4>
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
                score: '',
                validationErrors: [],
                term:'',
                duty:'',
                classs: ''
            }
        },
        props:['classid','timetableid', 'className' , 'subject'],
        methods:{
           inputMarks(studentid){
               Swal.fire({
                   title: 'Add score?',
                   text: "You are about to assign marks!",
                   icon: 'warning',
                   showCancelButton: true,
                   confirmButtonColor: '#3085d6',
                   cancelButtonColor: '#d33',
                   confirmButtonText: 'Yes!',
               }).then((result) => {
                   if (result.value) {
                       axios.post('/api/addmarks/',
                           {
                               student_id: studentid,
                               duty_id: this.timetableid,
                               score: this.score,
                           }).then(response => {
                           this.score = '';
                           Fire.$emit('UpdateStudentsMarks');
                           Toast.fire({
                               icon: 'success',
                               title: 'Marks Added Successfully'
                           })

                       }).catch(err => {
                           console.log(err);
                       });
                   }
               })
           },
            deleteMarks(id){
                Swal.fire({
                    title: 'Delete Marks?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.value) {
                        axios.delete('/api/deletemarks/'+id)
                            .then(response =>{
                                this.score = '';
                                Fire.$emit('UpdateStudentsMarks');
                                Toast.fire({
                                    icon: 'success',
                                    title: 'Marks Deleted Successfully'
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
            fetchData(){
                axios.get('/api/duty/'+ this.timetableid)
                    .then(response =>{
                        this.duty = response.data.data;
                    })
                    .catch(err =>{
                        console.log(err);

                    });
                axios.get('/api/classes/'+ this.classid)
                    .then(response =>{
                        this.classs = response.data.data;
                    })
                    .catch(err =>{
                        console.log(err);

                    });

                axios.get('/api/active-term')
                    .then(response =>{
                        this.term = response.data.data;
                    })
                    .catch(err =>{
                        console.log(err);

                    });

                 axios.get('/api/scoresheet/'+ this.classid +"/"+this.timetableid).then(response =>{

                     this.students = response.data.data;
                     this.students.forEach(stud => {
                         stud.marks.forEach(mark => {
                             if(mark.duty_id == this.timetableid){
                                 stud.marks = {
                                     id: mark.id,
                                     duty_id: mark.duty_id,
                                     score: mark.score
                                 };
                             }else {
                                 stud.marks = {
                                     id:'',
                                     duty_id: '',
                                     score: " - "
                                 };
                             }
                         })
                     })

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
                        return '0 Students'
                }
            }

        },
        mounted() {
            this.fetchData();
            Fire.$on('UpdateStudentsMarks',()=>{
                this.fetchData();
            });

        }
    }


</script>
<style>
    .fa fa-check{
        color: blue;
    }
</style>
