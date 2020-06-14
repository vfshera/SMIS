<template>
    <div>
        <div class="card">
            <div class="card-header">
                <label><h3 class="card-title">EXAMS</h3></label>

            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <h4 >Please Select a class to administer exams : </h4>
                <div class="row mt-3" v-if="levels.one">
                    <div class="col-md-2 col-sm-6 col-12" v-for="frm in levels.one" :key="frm.id" @click="addMarks(frm.classData.name,frm.classData.id,frm.duty.subject.title,frm.duty.id)">
                        <div class="info-box" >
                            <span class="info-box-icon bg-danger" v-text="getAbbr(1,frm.classData.name)" ></span>

                            <div class="info-box-content">
                                <span class="info-box-text" >{{ frm.duty.subject.abbreviation }}</span>
                                <span class="info-box-number" v-text="stdNo(frm)"></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                </div>
                <div class="row " v-if="levels.two">
                    <!-- /.row -->
                    <div class="col-md-2 col-sm-6 col-12" v-for="frm in levels.two" :key="frm.id" @click="addMarks(frm.classData.name,frm.classData.id,frm.duty.subject.title,frm.duty.id)">
                        <div class="info-box" >
                            <span class="info-box-icon bg-warning" v-text="getAbbr(2,frm.classData.name)" data-toggle="modal" ></span>

                            <div class="info-box-content">
                                <span class="info-box-text" >{{ frm.duty.subject.abbreviation }}</span>
                                <span class="info-box-number" v-text="stdNo(frm)"></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </div>

                </div>
                <div class="row  " v-if="levels.three" >
                    <div class="col-md-2 col-sm-6 col-12 " v-for="frm in levels.three" :key="frm.id" @click="addMarks(frm.classData.name,frm.classData.id,frm.duty.subject.title,frm.duty.id)">
                        <div class="info-box" >
                            <span class="info-box-icon bg-info " v-text="getAbbr(3,frm.classData.name)" data-toggle="modal"></span>

                            <div class="info-box-content ">
                                <span class="info-box-text" >{{ frm.duty.subject.abbreviation }}</span>
                                <span class="info-box-number" v-text="stdNo(frm)"></span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                        <!-- /.info-box -->
                    </div>
                </div>
                <div class="row" v-if="levels.four">
                    <!-- /.col -->
                    <div class="col-md-2 col-sm-6 col-12" v-for="frm in levels.four" :key="frm.id" @click="addMarks(frm.classData.name,frm.classData.id,frm.duty.subject.title,frm.duty.id)">
                        <div class="info-box">
                            <span class="info-box-icon bg-success " v-text="getAbbr(4,frm.classData.name)" ></span>

                            <div class="info-box-content ">
                                <span class="info-box-text" >{{ frm.duty.subject.abbreviation }}</span>
                                <span class="info-box-number" v-text="stdNo(frm)"></span>
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
            stdNo(num){
                if(num.noOfstudents == 1){
                    return num.noOfstudents + " Student";
                }else {
                    return num.noOfstudents + " Students";
                }
            },
            singleFilter(){
                const filteredOne = [];
                      this.levels.one.forEach(lvlone =>{
                          if(filteredOne.length){
                                filteredOne.forEach(fltrd =>{
                                    if(fltrd.classData.id === lvlone.classData.id && fltrd.duty.id === lvlone.duty.id){

                                    }else{
                                        filteredOne.push(lvlone);
                                    }
                                })
                          }else{
                              filteredOne.push(lvlone);
                          }
                      })
                this.levels.one = filteredOne;

                const filteredTwo = [];
                this.levels.two.forEach(lvlone =>{
                    if(filteredTwo.length){
                        filteredTwo.forEach(fltrd =>{
                            if(fltrd.classData.id === lvlone.classData.id && fltrd.duty.id === lvlone.duty.id){

                            }else{
                                filteredTwo.push(lvlone);
                            }
                        })
                    }else{
                        filteredTwo.push(lvlone);
                    }
                })
                this.levels.two = filteredTwo;

                const filteredThree = [];
                this.levels.three.forEach(lvlone =>{
                    if(filteredThree.length){
                        filteredThree.forEach(fltrd =>{
                            if(fltrd.classData.id === lvlone.classData.id && fltrd.duty.id === lvlone.duty.id){

                            }else{
                                filteredThree.push(lvlone);
                            }
                        })
                    }else{
                        filteredThree.push(lvlone);
                    }
                })
                this.levels.three = filteredThree;

                const filteredFour = [];
                this.levels.four.forEach(lvlone =>{
                    if(filteredFour.length){
                        filteredFour.forEach(fltrd =>{
                            if(fltrd.classData.id === lvlone.classData.id && fltrd.duty.id === lvlone.duty.id){

                            }else{
                                filteredFour.push(lvlone);
                            }
                        })
                    }else{
                        filteredFour.push(lvlone);
                    }
                })
                this.levels.four = filteredFour;
            },
            addMarks(className,classid,subject,timetableid){
                this.$router.push({ name : 'marks' , params : { classid , timetableid ,className ,subject}});

            },
            getAbbr(num,name){
                let index = name.indexOf(" ") + 1;
                let abbr = name.charAt(index).toUpperCase();

                return num + abbr;
            },
            fetchData(){
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

                        this.singleFilter();
                    })
                    .catch(err =>{
                        alert(err)
                    });

            },
        },
        computed:{
        },
        mounted() {
            this.fetchData();

        }
    }


</script>
