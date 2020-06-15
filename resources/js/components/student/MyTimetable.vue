<template>
    <div>
        <!--TIMETABLE POPUP-->
        <div class="card tcard" v-if="!NoTables">
            <div class="card-header tophead">
                <label><h3 >{{ timetable.name }} Timetable</h3></label>

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
                <div class="row col-md-12 tbl-data" v-for="(tbl ,id) in timetable.fields" :key="id">
                    <div class="col-md-2 time-data">{{tbl.time}}</div>
                    <div class="col-md-2 mon-data" v-text="isToday('Monday',tbl)"></div>
                    <div class="col-md-2 tue-data" v-text="isToday('Tuesday',tbl)"></div>
                    <div class="col-md-2 wed-data" v-text="isToday('Wednesday',tbl)"></div>
                    <div class="col-md-2 thur-data" v-text="isToday('Thursday',tbl)"></div>
                    <div class="col-md-2 fri-data" v-text="isToday('Friday',tbl)"></div>
                </div>
            </div>

        </div>

        <div class="card bg-danger pt-5 pb-5 pl-2 pr-2 mt-4" v-if="NoTables">
            <h2 class="text-center mb-2">OOOPS!</h2>
            <h4 class="text-center">It seems like Your class timetable is not yet ready...</h4>
            <h4 class="text-center mt-2">Please try again later or contact your class teacher.</h4>
        </div>
    </div>
</template>

<script>
    export default {
        name: "MyTimetable",
        data(){
            return{
               timetable:{
                   name : '',
                   fields : []
               },
                tables:[],
                NoTables:false,
            }
        },
        methods:{
            isToday(day,tbl){
                if(tbl.day === day){
                    //TO DO get element and set hover to teacher
                    return tbl.duty.subject.abbreviation
                }
            },
            setTables(){
                        this.timetable.fields = [];
                        this.timetable.name = '';
                        this.tables.forEach(tbl =>{
                            this.timetable.fields.push(tbl);
                            this.timetable.name = tbl.classData.name;
                        })
            },
            fetchData(){
                axios.get('/api/mytimetable')
                    .then(response =>{
                        if(response.data.data){
                            this.NoTables = false;
                            this.tables = response.data.data;
                            this.setTables();
                        }else{
                            this.NoTables = true;
                        }
                    })
                    .catch(err =>{
                        console.log(err);

                    });
            }
        },
        mounted() {
                this.fetchData();
        }
    }
</script>

<style scoped>

</style>
