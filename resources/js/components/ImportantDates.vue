<template>
   <div id="dates" class="col-md-12 pr-2">
       <div class="pt-3 col-md-12 row" id="dates-header">
           <div class="mr-auto">
               <h2>Important School Dates</h2>
           </div>
           <div class="ml-auto pt-3 pr-5 row">
              <span id="addDateBtn" class="text-primary mr-2" @click="openModal('#addDates')" >Add</span>
               <h5 class="text-primary">{{ dates.length }} Events</h5>
           </div>
       </div>

       <div id="dates-body" class=" card-deck py-3 ">

           <div class="col-md-4 col-sm-12 p-0 mb-2" v-for="post in dates" :key="post.id" v-if="!post.passed">
              <div :class="{ 'bg-danger' : post.passed }" class="card h-100 p-0" >
                  <div class="card-body " data-aos="fade-up"
                       data-aos-offset="200"
                       data-aos-delay="25"
                       data-aos-duration="1000"
                       data-aos-easing="ease-in-out"
                  >
                      <h3 class="card-title ">
                              {{ post.title.slice(0, 100) }} {{  (post.title.length > 100)  ? '...' : '' }}

                      </h3>
                      <p class="card-text">
                          <span :class="{ 'text-muted' : !post.passed }" class=" font-italic">
                             {{ (post.passed )  ? 'Happenned ' : 'Happenning ' }} on {{ post.occur_date }} at {{ post.occur_time }}
                          </span>
                      </p>
                  </div>
                  <div class="card-footer">
                      <span  :class="{ 'white-icon' : post.passed }" >
                          <CountDownTimer   :year="convDate(post.occurdate , post.occurtime).getFullYear()"
                                            :month="convDate(post.occurdate , post.occurtime).getMonth()"
                                            :date="convDate(post.occurdate , post.occurtime).getDate()"
                                            :hour="convDate(post.occurdate , post.occurtime).getHours()"
                                            :minute="convDate(post.occurdate , post.occurtime).getMinutes()" />
                      </span>
                      <span class="float-right">
                                <i class="fas fa-pencil-alt mr-1" :class="{ 'white-icon' : post.passed }" @click="editDate(post)"></i>
                               <i class="ml-1 far fa-trash-alt" :class="{ 'white-icon' : post.passed }" @click="deleteDate(post.id)"></i>
                       </span>
                  </div>
              </div>
           </div>
           <div class="col-md-4 col-sm-12 p-0 mb-2" v-for="post in dates" :key="post.id" v-if="post.passed">
               <div :class="{ 'bg-danger' : post.passed }" class="card h-100 p-0" >
                   <div class="card-body " data-aos="fade-up"
                        data-aos-offset="200"
                        data-aos-delay="25"
                        data-aos-duration="1000"
                        data-aos-easing="ease-in-out"
                   >
                       <h3 class="card-title ">
                           {{ post.title.slice(0, 100) }} {{  (post.title.length > 100)  ? '...' : '' }}

                       </h3>
                       <p class="card-text">
                          <span :class="{ 'text-muted' : !post.passed }" class=" font-italic">
                             {{ (post.passed )  ? 'Happenned ' : 'Happenning ' }} on {{ post.occur_date }} at {{ post.occur_time }}
                          </span>
                       </p>
                   </div>
                   <div class="card-footer">
                       <i class="fas fa-pencil-alt mr-1" :class="{ 'white-icon' : post.passed }" @click="editDate(post)"></i>
                       <span class="ml-5"  :class="{ 'white-icon' : post.passed }" >
                            <CountDownTimer   :year="convDate(post.occurdate , post.occurtime).getFullYear()"
                                              :month="convDate(post.occurdate , post.occurtime).getMonth()"
                                              :date="convDate(post.occurdate , post.occurtime).getDate()"
                                              :hour="convDate(post.occurdate , post.occurtime).getHours()"
                                              :minute="convDate(post.occurdate , post.occurtime).getMinutes()" />
                       </span>
                       <span class="float-right">
                               <i class="ml-1 far fa-trash-alt" :class="{ 'white-icon' : post.passed }" @click="deleteDate(post.id)"></i>
                           </span>
                   </div>
               </div>
           </div>

       </div>


<!--       modal add dates-->
       <div class="modal fade" id="addDates" tabindex="-1" role="dialog" aria-labelledby="addDates" aria-hidden="true">
           <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
               <div class="modal-content">
                   <div class="modal-header">
                           <h5 class="modal-title ml-2" id="addNewsTitle">ADD NEW EVENT</h5>
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                           </button>
                       </div>
                       <div class="modal-body">
                       <form class="p-2" @submit.prevent="addPost">
                           <div class="form-row">
                               <div class="form-group  col-md-12">
                                   <label for="datestitle">EVENT TITLE</label>
                                   <input type="text" class="form-control" v-model="datepost.title" id="datestitle" placeholder="Enter Event Title Here ....">
                               </div>
                           </div>
                           <div class="form-row">
                               <div class="form-group col-md-12">
                                   <label for="info">EVENT DATE</label>
                                   <input type="date" v-model="datepost.occur_date"  class="form-control" id="info" />
                               </div>
                           </div>
                           <div class="form-row">
                               <div class="form-group col-md-12">
                                   <label for="info">EVENT TIME</label>
                                   <input type="time" v-model="datepost.occur_time" class="form-control" id="time" />
                               </div>
                           </div>
                           <button type="submit" class="btn btn-primary float-right">POST</button>
                       </form>
                   </div>
               </div>
           </div>
       </div>
<!--       end modal add dates-->

<!--       modal edit dates-->
       <div class="modal fade" id="editDates" tabindex="-1" role="dialog" aria-labelledby="editDates" aria-hidden="true">
           <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
               <div class="modal-content">
                   <div class="modal-header">
                       <h5 class="modal-title ml-2" id="editTitle">EDIT EVENT</h5>
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                       </button>
                   </div>
                   <div class="modal-body">
                       <form class="p-2" @submit.prevent="updatePost">
                           <div class="form-row">
                               <div class="form-group  col-md-12">
                                   <label for="datestitle">EVENT TITLE</label>
                                   <input type="text" class="form-control" v-model="datepost.title" id="editDatestitle" placeholder="Enter Event Title Here ....">
                               </div>
                           </div>
                           <div class="form-row">
                               <div class="form-group col-md-12">
                                   <label for="info">EVENT DATE</label>
                                   <input type="date" v-model="datepost.occur_date"  class="form-control" id="editDatesinfo" />
                               </div>
                           </div>
                           <div class="form-row">
                               <div class="form-group col-md-12">
                                   <label for="info">EVENT TIME</label>
                                   <input type="time" v-model="datepost.occur_time" class="form-control" id="editDatestime" />
                               </div>
                           </div>
                           <button type="submit" class="btn btn-primary float-right">UPDATE</button>
                       </form>
                   </div>
               </div>
           </div>
       </div>
<!--       end modal edit dates-->


<!--       PAGINATION-->
       <nav v-if="dates.length != 0">
           <ul class="pagination">
               <li :class="{ 'disabled' : !pagination.prev_url }" class="page-item">
                   <a class="page-link" href="" @click.prevent="fetchData(pagination.prev_url)">Prev</a>
               </li>
               <li class="page-item disabled" >
                  <span class="page-link text-dark">
                   Page {{ pagination.current_page }} of {{ pagination.last_page }}
                  </span>
               </li>
               <li class="page-item" :class="{ 'disabled' : !pagination.next_url }">
                   <a class="page-link" href="" @click.prevent="fetchData(pagination.next_url)">Next</a>
               </li>
           </ul>
       </nav>
   </div>
</template>

<script>

    import CountDownTimer from "./CountDownTimer";
    export default {
        name: 'ImportantDates',
        components: {CountDownTimer},
        data(){
            return{
                dates: [],
                datepost: {
                    id : '',
                    title: '',
                    occur_date : '',
                    occur_time : '',
                },
                pagination: {}

            }
        },
        methods:{
            convDate(d,t){
              return new Date(d +" "+ t);
            },
            viewPost(title,id){
               let postTitle = title.toLowerCase().replace(/ /g , "-");
                this.$router.push({ name : 'singlepost' , params : { postTitle,id }});
            }
            ,
            openModal(name){
                this.resetNews();
                $(name).modal('show');
            },
            resetNews(){
                this.datepost.id = ''
                this.datepost.title = ''
                this.datepost.occur_date = ''
            },
            editDate(post){
              this.openModal('#editDates')
                this.datepost.id = post.id
                this.datepost.title = post.title
                this.datepost.occur_date = post.occurdate
                this.datepost.occur_time = post.occurtime
            },
            updatePost(){
               if(this.datepost.title != '' && this.datepost.occur_date != '' && this.datepost.id != ''){
                   axios.post('/api/update-date' ,  this.datepost )
                       .then(response =>{
                           $('#editDates').modal('hide');
                           $('body').removeClass('modal-open');
                           $('.modal-backdrop').remove();

                           this.fetchData();
                       })
                       .catch(err => {

                       })
               }else{
                   alert("NO EMPTY UPDATES!")
               }
            },
            addPost(){
                if(this.datepost.title != '' && this.datepost.occur_date != '' && this.datepost.occur_time != ''){
                    axios.post('/api/datepost' ,   {
                        title: this.datepost.title,
                        occur_date : this.datepost.occur_date,
                        occur_time : this.datepost.occur_time
                    } )
                        .then(response =>{
                            $('#addDates').modal('hide');
                            $('body').removeClass('modal-open');
                            $('.modal-backdrop').remove();

                            this.fetchData();

                        })
                        .catch(err => {

                        })
                }else{
                    alert("NO EMPTY POSTS!")
                }
            },
            fetchData(posts_url){
                    let dates_url = posts_url || '/api/dateposts';
                    // let vm = this;
                    axios.get(dates_url)
                    .then(response => {
                        this.dates = response.data.data;
                        this.makePagination(response.data.meta , response.data.links)
                    })
                    .catch(err => {

                    })

            },
            makePagination(meta , links){
                this.pagination  = {
                    current_page: meta.current_page,
                    last_page: meta.last_page,
                    first_url : links.first,
                    last_url : links.last,
                    next_url : links.next,
                    prev_url : links.prev,
                }
            },
            deleteDate(id){
                Swal.fire({
                    title: 'Delete Message?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                        if (result.value) {
                            axios.delete('/api/delete-dates/'+ id)
                                .then(response => {
                                    this.fetchData();
                                })
                                .catch(err => {

                                })
                        }
                })
            }
        },
        computed:{

                   },
        mounted() {
            this.fetchData()
        }

    }


</script>

<style>
    #dates{
        width: 99% !important;
        box-sizing: border-box;
    }
   #dates-header{
       height: 64px;
       background: white;
       border-bottom: rgba(1,1,1,.6) 2px solid;
   }

    .white-icon{
        color:white !important;
    }

    #addDateBtn:hover{
        cursor: pointer;
    }

</style>
