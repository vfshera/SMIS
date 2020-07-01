<template>
        <div class="content-wrapper" style="padding-top:20px">

                <router-view class="ml-3 mr-3 mt-5"></router-view>

                <footer class="main-footer">
                   <strong>Copyright &copy;SMIS. 2020</strong>
                        All rights reserved.

                </footer>

                <!-- Control Sidebar -->
                <aside class="control-sidebar control-sidebar-dark">
                    <!-- Control sidebar content goes here -->
                </aside>
                <!-- /.control-sidebar -->
         </div>
</template>

<script>
    export default {
        name: 'admin',
        data(){
            return{


            }
        },
        mounted() {

        },
      created() {
            this.$store.dispatch('fetchUser');
        }
    }
</script>

<style  scoped>
    small{
        color:white;
    }
</style>
