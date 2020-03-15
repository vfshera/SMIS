<template>
        <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                        with font-awesome or any other icon font library -->

                    <li class="nav-item">
                        <router-link :to="{ name: 'admins' }"  class="nav-link">
                            <i class="nav-icon fas fa-hashtag"></i>
                            <p>
                                Admin Users
                            </p>
                        </router-link>
                    </li>
                    <!-- <li class="nav-item">
                        <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Charts
                        </p>
                        </a>
                    </li> -->

                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link">
                        <i class="nav-icon far fa-envelope"></i>
                        <p>
                            Mailbox
                            <i class="fas fa-angle-left right"></i>
                        </p>
                        </a>
                        <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Inbox</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Compose</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Read</p>
                            </a>
                        </li>
                        </ul>
                    </li>

                            <li class="nav-item">
                                <router-link :to="{ name: 'allTeachers' }"  class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Teachers</p>
                                </router-link>
                            </li>
                            <li class="nav-item">
                                <router-link :to="{ name: 'allStudents' }" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Students</p>
                                </router-link>
                            </li>
                             <li class="nav-item has-treeview">
                                <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-store-alt"></i>
                                <p>
                                    Class
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                                </a>
                                <ul class="nav nav-treeview ml-2">
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
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Subject</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Timetable</p>
                                </a>
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

            }
        },
        props:[],
        mounted() {

        }
    }


</script>
