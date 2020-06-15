<template>
    <div>
                <div class="card">
                     <form class="p-2" @submit.prevent="addDetails" v-show="tbladd">
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                    <label for="name">Duty</label>
                                    <select class="form-control" v-model="tmtable.duty_id">
                                        <option  v-for="duty in duties" :key="duty.duty_id" :value="duty.duty_id"> {{ duty.abbr }} - {{ duty.teacher}}</option>
                                    </select>
                               </div>
                                <div class="form-group col-md-2">
                                    <label for="rep">Class</label>
                                    <select class="form-control" v-model="tmtable.classroom_id">
                                        <option  v-for="cl in classes" :key="cl.id" :value="cl.id"> {{ cl.name }}</option>
                                    </select>
                                </div>
                                 <div class="form-group col-md-2">
                                    <label for="rep">Term</label>
                                    <select class="form-control" v-model="tmtable.term_id">
                                        <option  v-for="term in allowedTerms" :key="term.id" :value="term.id"> {{ term.name }}</option>
                                    </select>
                                </div>
                                 <div class="form-group col-md-2">
                                    <label for="name">Day</label>
                                     <select class="form-control" v-model="tmtable.day">
                                        <option value="Monday">Monday</option>
                                        <option value="Tuesday">Tuesday</option>
                                        <option value="Wednesday">Wednesday</option>
                                        <option value="Thursday">Thursday</option>
                                        <option value="Friday">Friday</option>
                                    </select>
                               </div>
                                <div class="form-group col-md-2">
                                    <label for="time">Time</label>
                                   <select class="form-control" v-model="tmtable.time">
                                        <option class="font-weight-bold" disabled>ASSEMBLY @ 7:00 AM</option>
                                        <option value="8:00 AM">8:00 AM - 8:40 AM</option>
                                        <option value="8:40 AM">8:40 AM - 9:20 AM</option>
                                        <option value="9:20 AM">9:20 AM - 10:00 AM</option>
                                        <option class="font-weight-bold" disabled>BREAK @ 10:00 AM</option>
                                        <option value="10:25 AM">10:25 AM - 11:05 AM</option>
                                        <option value="11:05 AM">11:05 AM - 11:45 AM</option>
                                        <option class="font-weight-bold" disabled >SHORT BREAK (5min)</option>
                                        <option value="11:50 AM">11:50 AM - 12:30 PM</option>
                                        <option value="12:30 PM">12:30 PM - 13:10 PM</option>
                                        <option class="font-weight-bold" disabled>LUNCH @ 13:10 PM</option>
                                        <option value="14:00 PM">14:00 PM - 14:40 PM</option>
                                        <option value="14:40 PM">14:40 PM - 15:20 PM</option>
                                        <option value="15:20 PM">15:20 PM - 16:00 PM</option>
                                        <option class="font-weight-bold" disabled>GAMES @ 16:00 PM</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-1">
                                    <button type="submit" class="btn btn-primary form-control " style="margin-top:30px">ADD</button>
                                </div>
                            </div>
                   </form>
            </div>

            <div class="card">
                <div class="card-header" v-show="view">
                      <label><h3 >Timetable</h3></label>

                </div>
                    <!-- /.card-header -->
                    <div class="card-body" v-show="view">
                      <div class="row" v-if="levels.one">
                        <div class="col-md-2 col-sm-6 col-12" v-for="frm in levels.one.list" :key="frm.id" @click="setTimetable(frm)">
                            <div class="info-box">
                            <span class="info-box-icon bg-danger" v-text="getAbbr(1,frm)" ></span>

                            <div class="info-box-content">
                                <span class="info-box-text" >{{ frm }}</span>
                                <span class="info-box-number" v-text="stdNo(frm)"></span>
                            </div>
                            <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                      </div>
                      <div class="row " v-if="levels.two">
                        <!-- /.row -->
                         <div class="col-md-2 col-sm-6 col-12" v-for="frm in levels.two.list" :key="frm.id"  @click="setTimetable(frm)">
                            <div class="info-box">
                            <span class="info-box-icon bg-warning" v-text="getAbbr(2,frm)" data-toggle="modal" ></span>

                            <div class="info-box-content">
                                <span class="info-box-text">{{ frm }}</span>
                                <span class="info-box-number" v-text="stdNo(frm)"></span>
                            </div>
                            <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>

                      </div>
                      <div class="row  " v-if="levels.three" >
                        <div class="col-md-2 col-sm-6 col-12 " v-for="frm in levels.three.list" :key="frm.id"  @click="setTimetable(frm)">
                            <div class="info-box">
                            <span class="info-box-icon bg-info " v-text="getAbbr(3,frm)" data-toggle="modal"></span>

                            <div class="info-box-content ">
                                <span class="info-box-text" >{{ frm }}</span>
                                <span class="info-box-number" v-text="stdNo(frm)"></span>
                            </div>
                            <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                      </div>
                      <div class="row  " v-if="levels.four">
                        <!-- /.col -->
                        <div class="col-md-2 col-sm-6 col-12" v-for="frm in levels.four.list" :key="frm.id"  @click="setTimetable(frm)">
                            <div class="info-box">
                            <span class="info-box-icon bg-success " v-text="getAbbr(4,frm)" ></span>

                            <div class="info-box-content ">
                                <span class="info-box-text" >{{ frm }}</span>
                                <span class="info-box-number" v-text="stdNo(frm)"></span>

                            </div>
                            <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        </div>


            </div>


       <!--TIMETABLE POPUP-->
        <div class="card tcard" v-show="showTimetable">
            <div class="card-header tophead">
                <label><h3 >{{ currTable.name }} </h3></label>
                <span class="ml-3 d-inline ml-4 pl-2 pr-2 badge badge-primary"> {{ getStdNo(currTable.stdNum ) }} </span>
                <span @click="toggleForm" class="float-right text-primary" v-text="toggleText"></span>
            </div>

            <div >
                <div class="row col-md-12 tbl-head">
                    <div class="col-md-2 time">TIME</div>
                    <div class="col-md-2 mon">MONDAY</div>
                    <div class="col-md-2 tue">TUESDAY</div>
                    <div class="col-md-2 wed">WEDNESDAY</div>
                    <div class="col-md-2 thur">THURSDAY</div>
                    <div class="col-md-2 fri">FRIDAY</div>
                </div>
                <div class="row col-md-12 tbl-data" v-for="(tbl ,id) in currTable.fields" :key="id">
                    <div class="col-md-2 time-data">{{tbl.time}}</div>
                    <div class="col-md-2 mon-data" v-text="isToday('Monday',tbl)"></div>
                    <div class="col-md-2 tue-data" v-text="isToday('Tuesday',tbl)"></div>
                    <div class="col-md-2 wed-data" v-text="isToday('Wednesday',tbl)"></div>
                    <div class="col-md-2 thur-data" v-text="isToday('Thursday',tbl)"></div>
                    <div class="col-md-2 fri-data" v-text="isToday('Friday',tbl)"></div>
                </div>
            </div>

        </div>


            </div>
        <div class="card bg-danger  pl-2 pr-2" v-if="NoTables">
            <h2 class="text-center mt-5 mb-5">It seems like there are no timetables for this term...</h2>
        </div>

    </div>
</template>

<script>

    export default {
        name: 'Timetables',
        data(){
            return{
                classes : [],
                levels:{
                    one: {
                        name: '',
                        list: {}
                    },
                    two: {
                        name: '',
                        list: {}
                    },
                    three: {
                        name: '',
                        list: {}
                    },
                    four: {
                        name: '',
                        list: {}
                    },
                },
                classCategories:{
                    formOne: [],
                    formTwo: [],
                    formThree: [],
                    formFour: [],
                },
                terms : [],
                duties : [],
                timetables: [],
                view:true,
                tbladd:true,
                showTimetable:false,
                NoTables:false,
                currTable:{
                    name: '',
                    stdNum: '',
                    fields: [],
                },

                tmtable: {
                    classroom_id: '',
                    term_id: '',
                    duty_id: '',
                    day: '',
                    time: '',
                },
                search: '',
                validationErrors: [],
            }
        },
        props:[],
        methods:{
            isToday(day,tbl){
                if(tbl.day === day){
                    //TO DO get element and set hover to teacher
                     return tbl.duty.subject.abbreviation
                 }
                },
            stdNo(name){
                let num;
                this.timetables.forEach(tt =>{
                    if(tt.classData.name === name){
                        num = tt.noOfstudents;
                    }
                })

                if(num == 1){
                    return num + " Student";
                }else {
                    return num + " Students";
                }
            },
            getStdNo(stnum){
                if(stnum == 1){
                    return stnum + " Student";
                }else {
                    return stnum + " Students";
                }
            },
            setTimetable(name){
                this.currTable.fields = [];
                this.timetables.forEach(tbl =>{
                    if(tbl.classData.name === name){
                        this.currTable.fields.push(tbl);
                        this.currTable.name = name;
                        this.currTable.stdNum = tbl.noOfstudents;
                    }
                })

                this.toggleForm();
            },

            //     const classTime = ["8:00 AM","8:40 AM","9:20 AM","10:25 AM","11:05 AM","11:50 AM","12:30 PM","14:00 PM","14:40 PM","15:20 PM"];

             getAbbr(num,name){
                let index = name.indexOf(" ") + 1;
                let abbr = name.charAt(index).toUpperCase();

                return num + abbr;
            },
            countLevels(toFind){
                let found = 0 // default to 0

                for (let i = 0; i < this.timetables.length; i++ ) {
                    let timetbl = this.timetables[i]
                    if (timetbl.classData.form.math_rep === toFind) {
                        found += 1
                    }
                }


                return found;
            },
            buildCategories(){
                this.timetables.forEach(t =>{
                    if(t.classData.form.math_rep === "1")
                    {
                        this.classCategories.formOne.push(t);
                    } else if(t.classData.form.math_rep === "2")
                    {
                        this.classCategories.formTwo.push(t);
                    }else if(t.classData.form.math_rep === "3")
                    {
                        this.classCategories.formThree.push(t);

                    }else if(t.classData.form.math_rep === "4")
                    {
                        this.classCategories.formFour.push(t);
                    }
                })

                this.buildClassNames();
            },
            buildClassNames(){

                        let names4 = [];
                        this.classCategories.formFour.forEach(tbl => {
                            names4.push(tbl.classData.name);
                        });
                            let unique4 = [...new Set(names4)];
                        this.levels.four.list =  unique4;


                        let names3 = [];
                        this.classCategories.formThree.forEach(tbl => {
                            names3.push(tbl.classData.name);
                        });
                            let unique3 = [...new Set(names3)];
                        this.levels.three.list = unique3;


                        let names2 = [];
                        this.classCategories.formTwo.forEach(tbl => {
                            names2.push(tbl.classData.name);
                        });
                            let unique2 = [...new Set(names2)];
                        this.levels.two.list = unique2;


                        let names = [];
                        this.classCategories.formOne.forEach(tbl => {
                            names.push(tbl.classData.name);
                        });
                            let unique = [...new Set(names)];
                        this.levels.one.list =  unique;

            },
            toggleForm(){
                this.view = !this.view;
                this.tbladd = !this.tbladd;
                this.showTimetable = !this.showTimetable;
            },
            resetTmtbl(){
                   this.tmtable.classroom_id = '';
                   this.tmtable.term_id  = '';
                   this.tmtable.duty_id  = '';
                   this.tmtable.day  = '';
                   this.tmtable.time  = '';
            },
            fetcthData(){
                  axios.get('/api/classes')
                    .then(response =>{
                       this.classes = response.data.data;

                    })
                    .catch(err =>{
                           alert(err);
                    });

                    axios.get('/api/duties')
                    .then(response =>{
                       this.duties = response.data.data;

                    })
                    .catch(err =>{
                           alert(err);
                    });

                    axios.get('/api/terms')
                    .then(response =>{
                       this.terms = response.data.data;
                    })
                    .catch(err =>{
                            console.log(err);

                    });

                    axios.get('/api/timetables')
                    .then(response =>{
                        if(response.data.data){
                            this.view = true;
                            this.tbladd = true;
                            this.timetables = response.data.data;

                            this.levels.one.name = this.countLevels("1");
                            this.levels.two.name = this.countLevels("2");
                            this.levels.three.name = this.countLevels("3");
                            this.levels.four.name = this.countLevels("4");

                            this.buildCategories();
                        }else {
                            this.NoTables = true;
                            this.view = false;
                            this.showTimetable = false;
                        }

                    })
                    .catch(err =>{
                            console.log(err);

                    });
            },
            addDetails(){

                axios.post('/api/add-timetable', {
                    class_id: this.tmtable.classroom_id,
                    term_id: this.tmtable.term_id,
                    duty_id: this.tmtable.duty_id,
                    day: this.tmtable.day,
                    time: this.tmtable.time,

                }).then((response) => {
                         Fire.$emit('TimetableAdded');
                         this.resetTmtbl();
                         Toast.fire({
                            icon: 'success',
                            title: 'Timetable Added successfully'
                            })
                    })
                    .catch(error =>{
                        //    this.validationErrors = error.response.data.errors;
                           console.log(error);


                    });
            }
        },
        computed:{

             allowedTerms:function(){
                     return this.terms.filter(trm => {
                        return trm.status === 1;
                    });
             },
            toggleText(){
                return (this.view) ? 'Hide Form' : 'BACK TO GRID VIEW';
            },

        },
        mounted() {
            $('#classTimetable').on('hidden.bs.modal', (e)=>{
                // this.currTable.fields = [];
                // this.currTable.name = '';
            })

            this.fetcthData();
            Fire.$on('TimetableAdded',()=>{
                this.fetcthData();
            });
        }
    }


</script>

<style>
    .tbl-head{
        background: #34495e;
        color: white;
        font-size: 26px;
    }

    .tbl-data{
        font-size: 24px;
        min-height: 40px;
    }
</style>
