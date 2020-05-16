<template>
    <div>
    <div class="card">
         <form class="p-2" @submit.prevent="addDetails" v-show="view">
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
        <div class="card-header">
              <label><h3 >Timetable</h3></label>
                <span @click="toggleForm" class="float-right text-primary" v-text="toggleText"></span>



          </div>
            <!-- /.card-header -->
            <div class="card-body">
                      <div class="row" v-if="levels.one">
                        <div class="col-md-2 col-sm-6 col-12" v-for="frm in levels.one.list" :key="frm.id" data-toggle="modal" data-target="#classTimetable" @click="setTimetable(frm)">
                            <div class="info-box">
                            <span class="info-box-icon bg-danger" v-text="getAbbr(1,frm)" ></span>

                            <div class="info-box-content">
                                <span class="info-box-text">{{ frm }}</span>
                                <span class="info-box-number">93,139</span>
                            </div>
                            <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>

                      </div>
                      <div class="row " v-if="levels.two">
                        <!-- /.row -->
                         <div class="col-md-2 col-sm-6 col-12" v-for="frm in levels.two.list" :key="frm.id" data-toggle="modal" data-target="#classTimetable" @click="setTimetable(frm)">
                            <div class="info-box">
                            <span class="info-box-icon bg-warning" v-text="getAbbr(2,frm)" data-toggle="modal" ></span>

                            <div class="info-box-content">
                                <span class="info-box-text">{{ frm }}</span>
                                <span class="info-box-number">13,648</span>
                            </div>
                            <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>

                      </div>
                      <div class="row  " v-if="levels.three" >
                        <div class="col-md-2 col-sm-6 col-12 " v-for="frm in levels.three.list" :key="frm.id" data-toggle="modal" data-target="#classTimetable" @click="setTimetable(frm)">
                            <div class="info-box">
                            <span class="info-box-icon bg-info " v-text="getAbbr(3,frm)" data-toggle="modal"></span>

                            <div class="info-box-content ">
                                <span class="info-box-text">{{ frm }}</span>
                                <span class="info-box-number">1,410</span>
                            </div>
                            <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                      </div>
                      <div class="row  " v-if="levels.four">
                        <!-- /.col -->
                        <div class="col-md-2 col-sm-6 col-12" v-for="frm in levels.four.list" :key="frm.id" data-toggle="modal" data-target="#classTimetable" @click="setTimetable(frm)">
                            <div class="info-box">
                            <span class="info-box-icon bg-success " v-text="getAbbr(4,frm)" ></span>

                            <div class="info-box-content ">
                                <span class="info-box-text">{{ frm }}</span>
                                <span class="info-box-number">410</span>
                            </div>
                            <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                        </div>


            </div>
            <!-- /.card-body -->

            <div class="modal fade" id="classTimetable" tabindex="-1" role="dialog" aria-labelledby="classTimetable" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="classTimetableTitle">{{ currTable.name}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <!-- Modal -->          <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="">


                              <div class="day time">
                                <div class="day_title">Time</div>
                                <div class="hour">8:00</div>
                                <div class="hour">9:00</div>
                                <div class="hour">10:00</div>
                                <div class="hour">11:00</div>
                                <div class="hour">12:00</div>
                                <div class="hour">13:00</div>
                                <div class="hour">14:00</div>
                                <div class="hour">15:00</div>
                                <div class="hour">16:00</div>
                            </div>

                            <div class="day monday">
                                <div class="day_title">Monday</div>
                            </div>

                            <div class="day tuesday">
                                <div class="day_title">Tuesday</div>
                            </div>

                            <div class="day wednesday">
                                <div class="day_title">Wednesday</div>

                            </div>

                            <div class="day thursday">
                                <div class="day_title">Thursday</div>
                            </div>

                            <div class="day friday">
                            <div class="day_title">Friday</div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
          </div>
          <!-- /.card -->

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
                currTable:{
                    name: '',
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
            setTimetable(name){
                this.timetables.forEach(tbl =>{
                    if(tbl.classData.name === name){
                        this.currTable.fields.push(tbl);
                        this.currTable.name = name;
                    }
                })

                this.buildTimetable();
            },
            buildTimetable(){
                const monday = document.querySelector('.monday');
                const tuesday = document.querySelector('.tuesday');
                const wednesday = document.querySelector('.wednesday');
                const thursday = document.querySelector('.thursday');
                const friday = document.querySelector('.friday');

                const days = ["Monday","Tuesday","Wednesday","Thursday","Friday"];
                const divs = [monday,tuesday,wednesday,thursday,friday];
                const classTime =["8:00 AM","8:40 AM","9:20 AM","10:25 AM","11:05 AM","11:50 AM","12:30 PM","14:00 PM","14:40 PM","15:20 PM"];

                this.currTable.fields.forEach(fld =>{
                    let dayIndex = 0;
                    let divIndex = 0;
                    let timeIndex = 0;

                    if(fld.day === days[dayIndex])
                    {
                        if(fld.time === classTime[timeIndex])
                        {
                            let sub = fld.duty.subject.abbreviation;
                            let tip =  fld.duty.subject.title;

                            console.log(fld.time + " == " + classTime[timeIndex]);

                            const row = document.createElement("div");
                            row.innerHTML = `<div class="class" data-tooltip="${tip}">${sub}</div>`
                            divs[divIndex].appendChild(row);
                            console.log("Row Added");

                            if(classTime.length !== timeIndex + 1)
                            {
                                console.log(" Time index is  " + timeIndex);
                                timeIndex++;
                                console.log(classTime.length + " Not Equal To " + timeIndex+1);
                                console.log("New Time index is  " + timeIndex);
                            }else{
                                console.log(classTime.length + " Equal To " + timeIndex + 1);
                                console.log(" Day index is  " + dayIndex + " i.e " + days[dayIndex]+ "so we go to the next day");
                                dayIndex++
                                console.log("The next  Day  is  " + dayIndex + " i.e " + days[dayIndex]);
                                console.log(" And reset time from " + classTime[timeIndex]);
                                timeIndex = 0;
                                console.log(" To " + classTime[timeIndex]);
                            }
                        } else if(fld.day !== days[dayIndex]){
                            console.log(fld.day + " !=== " + days[dayIndex])
                            const row = document.createElement("div");
                            row.innerHTML = `<div class="class" data-tooltip=""></div>`
                            divs[divIndex].appendChild(row);

                            timeIndex++;
                            if(classTime.length !== timeIndex + 1)
                            {
                                timeIndex++;
                            }else{
                                dayIndex++
                                timeIndex = 0;
                            }
                        }

                    }
                })
            },
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
                       this.timetables = response.data.data;

                       this.levels.one.name = this.countLevels("1");
                       this.levels.two.name = this.countLevels("2");
                       this.levels.three.name = this.countLevels("3");
                       this.levels.four.name = this.countLevels("4");

                       this.buildCategories();
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
                return (this.view) ? 'Hide Form' : 'Show Form';
            },

        },
        mounted() {
            $('#classTimetable').on('hidden.bs.modal', (e)=>{
                // this.currTable.fields = [];
                // this.currTable.name = '';
                this.$router.push('/timetables');
            })

            this.fetcthData();
            Fire.$on('TimetableAdded',()=>{
                this.fetcthData();
            });
        }
    }


</script>

<style  scoped>


        html, body { height: 100%; margin: 0; }
        body {
        font-family: 'Open Sans', sans-serif;
        color: #efefef;
        overflow: hidden;
        }

        .day {
        width: 18%;
        height: 100vh;
        float: left;
        background-color: #fff;
        background-image: linear-gradient(rgba(0,0,0,.08) 50%, transparent 50%);
        background-size: 1px 20%;
        }

        .day.time { width: 10%; }

        .day_title {
        height: 10%;
        background-color: #34495e;
        font-size: 20px;
        font-weight: 600;
        text-transform: uppercase;
        text-align: center;
        line-height: 10vh;
        color:white;
        }

        .hour {
        height: 10%;
        background-color: rgba(52, 73, 94,0.9);
        font-size: 16px;
        color:white;
        font-weight: 400;
        text-align: center;
        line-height: 10vh;
        }

        .class {
        width: 100%;
        height: 10vh; /*90min*/
        line-height: 15vh;
        font-size: 2vw;
        font-weight: 300;
        padding-left: 10px;
        }

        .class.short { height: 7.5vh; line-height: 7.5vh; } /* 45min class */
        .class.b5 { margin-top: 2.5vh; } /* after 5 min break */
        .class.b25 { margin-top: 7.5vh; } /* after 25 min break */

        .navy { background-color: #34495e; }
        .grey { background-color: #bdc3c7; color: #202020; }
        .gray { background-color: #7f8c8d; }
        .red { background-color: #e74c3c; }

        .spacing { background-color: transparent; }



        /* Add this attribute to the element that needs a tooltip */
        [data-tooltip] {
        position: relative;
        z-index: 2;
        cursor: pointer;
        width: initial;
        }

        /* Hide the tooltip content by default */
        [data-tooltip]:before,
        [data-tooltip]:after {
        visibility: hidden;
        pointer-events: none;
        }

        /* Position tooltip above the element */
        [data-tooltip]:before {
        position: absolute;
        bottom: 110%;
        left: 50%;
        margin-bottom: 10px;
        margin-left: -75px;
        padding: 7px 5px;
        width: 140px;
        background-color: black;
        color: #fff;
        content: attr(data-tooltip);
        text-align: center;
        font-size: 14px;
        line-height: 1.2;
        }

        /* Triangle hack to make tooltip look like a speech bubble */
        [data-tooltip]:after {
        position: absolute;
        bottom: 110%;
        left: 50%;
        margin-left: -7px;
        margin-bottom: 3px;
        width: 0;
        border-top: 7px solid black;
        border-right: 7px solid transparent;
        border-left: 7px solid transparent;
        content: " ";
        font-size: 0;
        line-height: 0;
        }

        /* Show tooltip content on hover */
        [data-tooltip]:hover:before,
        [data-tooltip]:hover:after {
        visibility: visible;
        bottom: 90%;
        }
</style>
