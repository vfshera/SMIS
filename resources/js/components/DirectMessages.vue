<template>
   <div id="dmss" class="col-md-12 pr-2">
       <div class="pt-3 col-md-12 row" id="dmss-header">
           <div class="mr-auto">
               <h2>Contact Form Messages</h2>
           </div>
           <div class="ml-auto pt-3 pr-5 row">
              <h5 class="text-primary">{{ dms.length }} Posts</h5>
           </div>
       </div>

       <div id="dmss-body" class=" card-deck py-3 ">

           <div class="col-md-4 col-sm-12 p-0 mb-2" v-for="post in dms" :key="post.id">
              <div class="card h-100 p-0" >
                  <div class="card-body " data-aos="fade-up"
                       data-aos-offset="200"
                       data-aos-delay="25"
                       data-aos-duration="1000"
                       data-aos-easing="ease-in-out"
                  >
                      <h3 class="card-name ">
                              {{ post.name.slice(0, 36) }} {{  (post.name.length > 36)  ? '...' : '' }}

                      </h3>
                      <p class="card-text">
                          {{ post.message.slice(0,170) }}
                          <span v-if="post.message.length > 170">...</span>

                      </p>
                  </div>
                  <div class="card-footer">
                      <a href="" @click="viewPost(post.name , post.id)" >Read More ....</a>

                      <span class="float-right">
                               <i class="fas fa-pencil-alt mr-1" @click="editNewsPost(post)"></i>
                               <i class="ml-1 far fa-trash-alt" @click="deleteNewsPost(post.id)"></i>
                           </span>
                  </div>
              </div>
           </div>

       </div>


<!--       end modal edit dmss-->


<!--       PAGINATION-->
       <nav aria-label="...">
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

    export default {
        name: 'NewsCenter',
        data(){
            return{
                dms:[] ,

                pagination: {}

            }
        },
        methods:{
            viewPost(name,id){
               let postTitle = name.toLowerCase().replace(/ /g , "-");
                this.$router.push({ name : 'singlepost' , params : { postTitle,id }});
            }
            ,
            openModal(name){
                this.resetNews();
                $(name).modal('show');
            },

            fetchData(posts_url){
                    let dmss_url = posts_url || '/api/contact-messages';
                    // let vm = this;
                    axios.get(dmss_url)
                    .then(response => {
                        this.dms = response.data.data;
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
            deleteNewsPost(id){
                Swal.fire({
                    name: 'Delete Message?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                        if (result.value) {
                            axios.delete('/api/delete-dmss/'+ id)
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
    #dmss{
        width: 99% !important;
        box-sizing: border-box;
    }
   #dmss-header{
       height: 64px;
       background: white;
       border-bottom: rgba(1,1,1,.6) 2px solid;
   }

    #dmss-body{
        background: white;
        width: 100%;
    }


</style>
