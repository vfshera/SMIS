<template>
        <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                    <li class="nav-item"  v-if="currentUser.access === 0">
                        <router-link :to="{ name: 'admins' }"  class="nav-link">
                            <i class="nav-icon fas fa-hashtag"></i>
                            <p>
                                Admin Users
                            </p>
                        </router-link>
                    </li>


                    <li class="nav-item" v-if="currentUser.access === 0 || currentUser.access === 2">
                        <a href="#" class="nav-link">
                        <i class="nav-icon far fa-envelope"></i>
                        <p>
                            Mailbox
                        </p>
                        </a>
                   </li>
                        <li class="nav-item" v-if="currentUser.access === 1">
                            <a href="#" class="nav-link">
                                <i class="nav-icon far fa-envelope"></i>
                                <p>
                                    News
                                </p>
                            </a>
                        </li>

                            <li class="nav-item">
                                <router-link :to="{ name: 'allTeachers' }"  class="nav-link"  v-if="currentUser.access === 0">
                                    <i class="fas fa-chalkboard-teacher nav-icon"></i>
                                    <p>Teachers</p>
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link :to="{ name: 'allStudents' }" class="nav-link"  v-if="currentUser.access === 0">
                                    <i class="fas fa-user-graduate nav-icon"></i>
                                    <p>Students</p>
                                </router-link>
                            </li>
                        <li class="nav-item has-treeview"  v-if="currentUser.access === 1">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-store-alt"></i>
                                <p>
                                   Education
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview ml-2">
                                <li class="nav-item">
                                    <router-link :to="{ name: 'myTimetable' }"  class="nav-link">
                                        <i class="nav-icon fas fa-minus"></i>
                                        <p>Timetable</p>
                                    </router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link :to="{ name: 'myResults' }"  class="nav-link">
                                        <i class="nav-icon fas fa-minus"></i>
                                        <p>Exams</p>
                                    </router-link>
                                </li>
                                <li class="nav-item">
                                    <router-link :to="{ name: 'notes' }"  class="nav-link">
                                        <i class="nav-icon fas fa-minus"></i>
                                        <p>Notes</p>
                                    </router-link>
                                </li>

                                <li class="nav-item">
                                    <router-link :to="{ name: 'pastPapers' }"  class="nav-link">
                                        <i class="nav-icon fas fa-minus"></i>
                                        <p>Past Papers</p>
                                    </router-link>
                                </li>

                            </ul>

                        </li>
                        <li class="nav-item"  v-if="currentUser.access === 1">
                            <router-link :to="{ name: 'myProfile'}" class="nav-link">
                                <i class="fas fa-user-graduate nav-icon"></i>
                                <p>My Account</p>
                            </router-link>
                        </li>
                             <li class="nav-item has-treeview"  v-if="currentUser.access === 0 || currentUser.access === 2">
                                <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-store-alt"></i>
                                <p>
                                    Class
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                                </a>
                                 <ul class="nav nav-treeview ml-2" v-if="currentUser.access === 0">
                                    <li class="nav-item">
                                        <router-link :to="{ name: 'addClass' }"  class="nav-link">
                                        <i class="nav-icon fas fa-minus"></i>
                                        <p>Classes</p>
                                        </router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link :to="{ name: 'addForm' }"  class="nav-link">
                                        <i class="nav-icon fas fa-minus"></i>
                                        <p>Form Levels</p>
                                        </router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link :to="{ name: 'addStream' }"  class="nav-link">
                                        <i class="nav-icon fas fa-minus"></i>
                                        <p>Stream</p>
                                        </router-link>
                                    </li>

                                </ul>
                                <ul class="nav nav-treeview ml-2" v-if="currentUser.access === 2">
                                    <li class="nav-item">
                                        <router-link :to="{ name: 'myclasses'  }"  class="nav-link">
                                        <i class="nav-icon fas fa-minus"></i>
                                        <p>My Timetable</p>
                                        </router-link>
                                    </li>
                                    <li class="nav-item">
                                        <router-link :to="{ name:'exams' }"  class="nav-link">
                                        <i class="nav-icon fas fa-minus"></i>
                                        <p>Exams</p>
                                        </router-link>
                                    </li>

                                    <li class="nav-item">
                                        <router-link :to="{ name:'revisionMaterials' }"  class="nav-link">
                                            <i class="nav-icon fas fa-minus"></i>
                                            <p>Revision Materials</p>
                                        </router-link>
                                    </li>

                                </ul>
                            </li>
                            <li class="nav-item"  v-if="currentUser.access === 0">
                                <router-link :to="{ name: 'addSubject' }"  class="nav-link">
                                <i class="fas fa-book-reader nav-icon"></i>
                                <p>Subjects</p>
                                </router-link>
                            </li>
                              <li class="nav-item" v-if="currentUser.access === 0">
                                 <router-link :to="{ name: 'term' }"  class="nav-link">
                                <i class=" nav-icon far fa-calendar-alt"></i>
                                <p>Term</p>
                                 </router-link>
                            </li>
                            <li class="nav-item"  v-if="currentUser.access === 0">
                                 <router-link :to="{ name: 'timeTables' }"  class="nav-link">
                                <i class=" nav-icon far fa-calendar-alt"></i>
                                <p>Timetable</p>
                                 </router-link>
                            </li>
                        <li class="nav-item" v-if="currentUser.access === 0">
                            <router-link :to="{ name:'revisionMaterials' }"  class="nav-link">
                                <i class="nav-icon far fa-calendar-alt"></i>
                                <p>Revision Materials</p>
                            </router-link>
                        </li>


                <!-- /.sidebar-menu -->
                    </ul>
                </nav>
            </div>
</template>

<script>

    export default {
        name: 'sidebar',
        data(){
            return{
                currentUser:[],
            }
        },
        props:[],
        methods:{

        },
        mounted() {
            axios.get('/api/user')
                    .then(response =>{
                       this.currentUser = response.data;

                    })
                    .catch(err =>{
                           alert(err);
                    });
        }
    }


</script>
