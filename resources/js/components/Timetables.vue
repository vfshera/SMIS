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
                      <div class="row">
                        <div class="col-md-2 col-sm-6 col-12">
                            <div class="info-box">
                            <span class="info-box-icon bg-danger"><i class="far fa-star"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Form 1</span>
                                <span class="info-box-number">93,139</span>
                            </div>
                            <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>

                      </div>
                      <div class="row">
                        <!-- /.row -->
                         <div class="col-md-2 col-sm-6 col-12">
                            <div class="info-box">
                            <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Form 2</span>
                                <span class="info-box-number">13,648</span>
                            </div>
                            <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>

                      </div>
                      <div class="row">
                        <div class="col-md-2 col-sm-6 col-12">
                            <div class="info-box">
                            <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Form 3</span>
                                <span class="info-box-number">1,410</span>
                            </div>
                            <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                      </div>
                      <div class="row">
                        <!-- /.col -->
                        <div class="col-md-2 col-sm-6 col-12">
                            <div class="info-box">
                            <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Form 4</span>
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
                terms : [],
                duties : [],
                timetables: [],
                view:true,
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

                })
                    .then(function (response) {
                         Fire.$emit('FormAdded');
                         resetTmtbl();
                         Toast.fire({
                            icon: 'success',
                            title: 'Form Added successfully'
                            })
                    })
                    .catch(error =>{
                           this.validationErrors = error.response.data.errors;
                    });
            }
        },
        computed:{
             allowedTerms:function (){
                     return this.terms.filter(trm => {
                        return trm.status === 1;
                    });
             },
            toggleText(){
                return (this.view) ? 'Hide Form' : 'Show Form';
            }
        },
        mounted() {

            this.fetcthData();
            Fire.$on('FormAdded',()=>{
                this.fetcthData();
            });
        }
    }


</script>
