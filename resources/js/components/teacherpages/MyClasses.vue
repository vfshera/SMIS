<template>
    <div>
    <div class="card">
        <div class="card-header">
              <label><h3 class="card-title">My Timetable</h3></label>

          </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="row" v-if="levels.one">
                    <div class="col-md-2 col-sm-6 col-12" v-for="frm in levels.one" :key="frm.id" >
                        <div class="info-box">
                            <span class="info-box-icon bg-danger" v-text="getAbbr(1,frm.classData.name)" ></span>

                            <div class="info-box-content">
                                <span class="info-box-text" >{{ frm.duty.subject.abbreviation }}</span>
                                <span class="info-box-number">{{ frm.time}}</span>
                                <span class="info-box-number">{{ frm.day}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                </div>
                <div class="row " v-if="levels.two">
                    <!-- /.row -->
                    <div class="col-md-2 col-sm-6 col-12" v-for="frm in levels.two" :key="frm.id" >
                        <div class="info-box">
                            <span class="info-box-icon bg-warning" v-text="getAbbr(2,frm.classData.name)" data-toggle="modal" ></span>

                            <div class="info-box-content">
                                <span class="info-box-text" >{{ frm.duty.subject.abbreviation }}</span>
                                <span class="info-box-number">{{ frm.time}}</span>
                                <span class="info-box-number">{{ frm.day}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>

                </div>
                <div class="row  " v-if="levels.three" >
                    <div class="col-md-2 col-sm-6 col-12 " v-for="frm in levels.three" :key="frm.id">
                        <div class="info-box">
                            <span class="info-box-icon bg-info " v-text="getAbbr(3,frm.classData.name)" data-toggle="modal"></span>

                            <div class="info-box-content ">
                                <span class="info-box-text" >{{ frm.duty.subject.abbreviation }}</span>
                                <span class="info-box-number">{{ frm.time}}</span>
                                <span class="info-box-number">{{ frm.day}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                </div>
                <div class="row" v-if="levels.four">
                    <!-- /.col -->
                    <div class="col-md-2 col-sm-6 col-12" v-for="frm in levels.four" :key="frm.id">
                        <div class="info-box">
                            <span class="info-box-icon bg-success " v-text="getAbbr(4,frm.classData.name)" ></span>

                            <div class="info-box-content ">
                                <span class="info-box-text" >{{ frm.duty.subject.abbreviation }}</span>
                                <span class="info-box-number">{{ frm.time}}</span>
                                <span class="info-box-number">{{ frm.day}}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                    <!-- /.col -->
                </div>


            </div>
          </div>
          <!-- /.card -->
    </div>
</template>

<script>

    export default {
       name: 'MyClasses',
        data(){
            return{
                timetables: [],
                levels:{
                    one: [],
                    two: [],
                    three: [],
                    four: [],
                },
            }
        },
        methods:{
            getAbbr(num,name){
                let index = name.indexOf(" ") + 1;
                let abbr = name.charAt(index).toUpperCase();

                return num + abbr;
            },
            fetcthData(){
                 axios.get('/api/myclasses')
                    .then(response =>{
                        this.timetables = response.data.data;

                        this.timetables.forEach(tbl => {
                               tbl.teaches.forEach(cls => {
                                   if(cls.classData.form.math_rep === "1"){
                                       this.levels.one.push(cls);
                                   } else if(cls.classData.form.math_rep === "2"){
                                       this.levels.two.push(cls);
                                   } else if(cls.classData.form.math_rep === "3"){
                                       this.levels.three.push(cls);
                                   }
                                   else if(cls.classData.form.math_rep === "4"){
                                       this.levels.four.push(cls);
                                   }
                               })
                            });


                         }).then(console.log(this.students))
                    .catch(err =>{

                    });

            },
        },
        computed:{
        },
        mounted() {
            this.fetcthData();
        }
    }


</script>
