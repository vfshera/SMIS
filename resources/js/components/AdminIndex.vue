<template>
                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid">
                        <!-- Small boxes (Stat box) -->
                        <div class="row">
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-info">
                            <div class="inner">
                                <h3 class="animated  fadeInUp  faster">150</h3>

                                <p class="animated  fadeInUp ">Teachers</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                            <a href="#" class="small-box-footer  animated  fadeInRight  ">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-success">
                            <div class="inner">
                                <h3 class="animated  fadeInUp  faster">1140</h3>

                                <p class="animated  fadeInUp ">Students</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                            <a href="#" class="small-box-footer  animated  fadeInRight  ">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-warning">
                            <div class="inner">
                                <h3 class="animated  fadeInUp  faster">64</h3>

                                <p class="animated  fadeInUp ">Classes</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                           <a href="#" class="small-box-footer  animated  fadeInRight  ">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                        <div class="col-lg-3 col-6">
                            <!-- small box -->
                            <div class="small-box bg-danger">
                            <div class="inner">
                                <h3 class="animated  fadeInUp  faster">65</h3>

                                <p class="animated  fadeInUp ">Unique Visitors</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-pie-graph"></i>
                            </div>
                            <a href="#" class="small-box-footer  animated  fadeInRight  ">More info <i class="fas fa-arrow-circle-right"></i></a>
                            </div>
                        </div>
                        <!-- ./col -->
                    </div>
                        <!-- /.row -->
                    </div>
                        <!-- /.card -->
                </section>
                <!-- right col -->

                <!-- /.content -->

</template>

<script>
    export default {
        name: 'AdminIndex',
        data(){
            return{
                users: [],
                studentsNo: '',
                teacherssNo: '',
                classesNo: '',
            }
        },
        props:[],
        methods:{

        },
        mounted() {
             axios.get('/api/allusers')
                    .then(response =>{
                       this.users = response.data.data;
                    })
                    // .then(()=>console.log(this.users.length))
                    .catch(err =>{
                            Swal.fire(
                                    'Error!',
                                    err,
                                    'warning'
                                    )

           });




        }
    }
</script>
