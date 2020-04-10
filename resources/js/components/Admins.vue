<template>
    <div>
    <div class="card">
        <div class="card-header">
              <h3 class="card-title">ROOT USERS</h3>
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

                 <tr v-for="admin in users" :key="admin.id">
                  <td>{{ admin.name}}</td>
                  <td>{{ admin.email}}</td>
                  <td>{{ admin.created_at}}</td>
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
        name: 'Admins',
        data(){
            return{
                users : []
            }
        },
        methods:{

        },
        props:[],
        mounted() {
             axios.get('/api/users')
                    .then(response =>{
                       this.users = response.data.data;
                    })
                    .then(()=>console.log(this.users))
                    .catch(err =>{
                            Swal.fire(
                                    'Error!',
                                    err,
                                    'warning'
                                    )

                    });



        },
    }



</script>
