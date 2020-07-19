<template >
    <div>
        <div class="card">
            <div class="card-header">

                <input class="form-control col-md-12" type="search" placeholder="Search" v-model="search" aria-label="Search">

            </div>
            <div class="card-body row">
                <div class="col-md-12 col-sx-12" >
                    <label>Notes</label>
                    <div class="new-file-notes col-md-12"></div>
                    <div id="note" class="d-block mb-2 mb-xs-5" v-for="(note,index) in this.notes" :key="note.id">
                        <span >{{ index + 1 }} .</span>
                        <span class="ml-1" v-text="capTitle(note.title)"></span>

                        <span class="float-md-right float-sm-right   ml-5 col-xs-12">
                                 <span class="ml-md-5 ml-sm-5 mr-md-2  mr-sm-2 badge badge-light">{{ note.file_type.toUpperCase() }}</span>
                                <img class="ml-md-2 ml-sm-5" :src="getPic(note.file_type)" height="20px"/>
                                <span class="ml-md-2 ml-sm-2" v-if="note.size >= 0.99">{{ note.size }} MB</span>
                                <span class="ml-md-2 ml-sm-2" v-if="note.size < 0.99">{{ Math.round(note.size * 1024) }} KB</span>
                                <img class="ml-md-5 ml-sm-5" src="/storage/icons/download.svg" height="20px" @click="downloadFile(note.id)"/>

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
        name: 'Notes',
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
                axios.get('/api/notes')
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
            notes:function (){
                return this.uploads.filter(note => {
                    if(note.doc_type === "notes"){
                        return note.title.toLowerCase().match(this.search.toLowerCase());
                    }
                });
            }
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
