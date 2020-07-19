<template >
    <div>
        <div class="card">
            <div class="card-header">

                <input class="form-control col-md-12" type="search" placeholder="Search" v-model="search" aria-label="Search">

            </div>
            <div class="card-body row">
                <div class="col-md-12 col-sx-12" >
                    <label>Past Papers</label>
                    <div class="new-file-papers col-md-12"></div>
                    <div id="paper" class="d-block  mb-2 mb-xs-5" v-for="(paper,index) in this.papers" :key="paper.id">
                        <span class="col-xs-12">{{ index + 1 }} .</span>
                        <span class="col-xs-12" v-text="capTitle(paper.title)"></span>
                        <span class="float-md-right float-sm-right  col-xs-12">
                                 <span class="ml-5 mr-2 badge badge-light">{{ paper.file_type.toUpperCase() }}</span>
                                <img class="ml-2" :src="getPic(paper.file_type)" height="20px"/>
                                <span class="ml-2" v-if="paper.size >= 0.99">{{ paper.size }} MB</span>
                                <span class="ml-2" v-if="paper.size < 0.99">{{ Math.round(paper.size * 1024) }} KB</span>
                                <img class="ml-5" src="/storage/icons/download.svg" height="20px" @click="downloadFile(paper.id)"/>
                            </span>
                    </div>
                </div>

            </div>
        </div>
        <!-- /.card -->

    </div>
</template>

<script>

    export default {
        name: 'PastPapers',
        data(){
            return{
                user: {},
                uploads:[],
                search: '',
                validationErrors: [],
            }
        },
        props:[],
        methods:{
            capTitle(title){
                if(title.length > 24){
                    return title.slice(0,29 ) + '...'
                }else {
                    return title;
                }
            },
            getPic(name) {
                return '/storage/icons/' + name + '.svg';
            },

            fetcthData(){
                axios.get('/api/papers')
                    .then(response =>{
                        this.uploads = response.data.data;
                    })
                    .catch(err =>{
                        Swal.fire(
                            'Error!',
                            err,
                            'warning'
                        )
                    });
            },
            downloadFile(id){
                let timerInterval
                Swal.fire({
                    title: 'Preparing File For Download...',
                    html: 'Download begins in <strong></strong> Seconds.',
                    timer: 5000,
                    timerProgressBar:true,
                    onOpen: () => {
                        Swal.showLoading()
                        timerInterval = setInterval(() => {
                            Swal.getContent().querySelector('strong')
                                .textContent = Math.ceil(Swal.getTimerLeft() / 1000)
                        }, 100)

                        setTimeout(()=>{
                            axios.get('/api/download-file/'+id)
                                .then(response =>{
                                    console.log(response.data)
                                    Swal.stopTimer();
                                    Fire.$emit('UploadsUpdated');
                                })
                                .catch(err =>{
                                    console.log(err)
                                });
                        },4500)

                    },
                    onClose: () => {
                        clearInterval(timerInterval)

                    }
                }).then((result) => {
                    if (result.dismiss === Swal.DismissReason.timer){
                    }
                })
            },


        },
        computed:{
            papers:function (){
                return this.uploads.filter(paper => {
                    if(paper.doc_type === "papers"){
                        return paper.title.toLowerCase().match(this.search.toLowerCase());
                    }
                });
            },
        },
        mounted() {

            this.fetcthData();
            Fire.$on('Update',()=>{
                this.fetcthData();
            });
        }
    }


</script>
<style>

</style>
