<template>
    <div>
    <div class="card">
        <div class="card-header">
              <h3 class="card-title">STUDENTS</h3>
          </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="dt" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Date Created</th>
                </tr>
                </thead>
                <tbody>

                 <tr v-for="teacher in teachers" :key="teacher.id">
                  <td>{{ teacher.name}}</td>
                  <td>{{ teacher.email}}</td>
                  <td>{{ teacher.created_at}}</td>
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
        name: 'Students',
        data(){
            return{
                teachers : [],
            }
        },
        props:[],
        mounted() {
            axios.get('/api/teachers')
                    .then(response =>{
                       this.teachers = response.data.data;
                    })
                    .then(()=>console.log(this.users))
                    .catch(err =>{
                            console.log(err);

           });

            // $('#dt').DataTable({
            //         "paging": true,
            //         "lengthChange": false,
            //         "searching": true,
            //         "ordering": true,
            //         "info": true,
            //         "autoWidth": false,
            //     });
        }
    }


</script>
