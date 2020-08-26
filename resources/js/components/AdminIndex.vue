<template>
                <!-- Main content -->
                <section class="content">
                    <div class="container-fluid" >
                        <h3>DASHBOARD</h3>
                        <hr>
                        <!-- Small boxes (Stat box) -->
                        <div id="admin" v-if="this.user.access === 0">
                            <div class="row">
                                <div class="col-lg-3 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-info">
                                        <div class="inner">
                                            <h3 class="animated  fadeInUp  faster">{{ stat.tcher_no }}</h3>

                                            <p class="animated  fadeInUp ">Teachers</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-bag"></i>
                                        </div>
                                        <router-link :to="{ name: 'allTeachers' }" class="small-box-footer  animated  fadeInRight  ">
                                            More info <i class="fas fa-arrow-circle-right"></i>
                                        </router-link>
                                    </div>
                                </div>
                                <!-- ./col -->
                                <div class="col-lg-3 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-success">
                                        <div class="inner">
                                            <h3 class="animated  fadeInUp  faster">{{ stat.stud_no }}</h3>

                                            <p class="animated  fadeInUp ">Students</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-stats-bars"></i>
                                        </div>
                                        <router-link :to="{ name: 'allStudents' }" class="small-box-footer  animated  fadeInRight  ">
                                            More info <i class="fas fa-arrow-circle-right"></i>
                                        </router-link>
                                    </div>
                                </div>
                                <!-- ./col -->
                                <div class="col-lg-3 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-warning">
                                        <div class="inner">
                                            <h3 class="animated  fadeInUp  faster">{{ stat.class_count}}</h3>

                                            <p class="animated  fadeInUp ">Classes</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-person-add"></i>
                                        </div>
                                        <router-link :to="{ name: 'addClass' }" class="small-box-footer  animated  fadeInRight  ">
                                            More info <i class="fas fa-arrow-circle-right"></i>
                                        </router-link>
                                    </div>
                                </div>
                                <!-- ./col -->
                                <div class="col-lg-3 col-6">
                                    <!-- small box -->
                                    <div class="small-box bg-danger">
                                        <div class="inner">
                                            <h3 class="animated  fadeInUp  faster">{{ stat.newsposts }}</h3>

                                            <p class="animated  fadeInUp ">News Posts</p>
                                        </div>
                                        <div class="icon">
                                            <i class="ion ion-pie-graph"></i>
                                        </div>
                                        <a href="#" class="small-box-footer  animated  fadeInRight  ">More info <i class="fas fa-arrow-circle-right"></i></a>
                                    </div>
                                </div>
                                <!-- ./col -->
                            </div>


                            <h4>ACTIONS</h4>
                            <div class="row pt-2">
                                NEWS HERE

                            </div>
                    </div>


                        <!-- /.row -->

                        <div class="row" v-if="this.user.access === 1">
                           <div class="col-md-12">
                               <h4>Notices</h4><br>
                               <div class="card bg-danger  d-block ">
                                   <div class="card-body">
                                       <h4 class="text-center mb-1">Please Note that this information is as provided during admission to Murray Girls High School.</h4>
                                       <h4 class="text-center mt-1">In order to make any changes to this information you have to visit the Information Center.</h4>
                                   </div>
                               </div>
                           </div>
                        </div>
                        <div class="row" v-if="this.user.access === 2">
                            <div class="col-md-12">
                                <h4>Notices</h4>
                                <div class="card bg-danger   d-block ">
                                    <div class="card-body">
                                        <h4 class="text-center mb-1">Please Note that this information is as provided during admission to Murray Girls High School.</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                user:[],
                stat: []
            }
        },
        methods:{

        },
        computed: {},
        mounted() {
                this.user = this.$store.state.currentUser;
                    axios.get('/api/dashStat')
                        .then(response =>{
                            this.stat = response.data;
                        })
                        .catch(err =>{
                            Swal.fire(
                                'Error!',
                                err,
                                'warning'
                            )

                        });

                   axios.get('/api/allusers')
                    .then(response =>{
                       this.users = response.data.data;
                        this.user = this.$store.state.currentUser;
                    })
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
