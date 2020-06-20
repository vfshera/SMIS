<template xmlns="http://www.w3.org/1999/html">
    <div>
    <div class="card">
         <form class="p-2 d-xs-none" @submit.prevent="addDetails" enctype="multipart/form-data">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="name">Name</label>
                                    <input type="text" v-model="uploadFile.name" class="form-control" id="name" required>
                                    <span v-if="validationErrors.name" class="text-danger">File Name Field is Required</span>
                               </div>

                                 <div class="form-group col-md-2">
                                    <label for="name">Type</label>
                                    <select  v-model="uploadFile.type" class="form-control" id="file-type" required>
                                        <option value="notes">Notes</option>
                                        <option value="papers">Papers</option>
                                    </select>
                                    <span v-if="validationErrors.name" class="text-danger">File Type Field is Required</span>
                                 </div>
                                <div class="form-group col-md-5">
                                    <label for="name">File</label>
                                    <input type="file" @change="fileSelected"  class="form-control" id="file" required>
                                    <span v-if="validationErrors.name" class="text-danger">File Field is Required</span>
                                </div>

                                <div class="form-group col-md-1">
                                    <button type="submit" class="btn btn-primary form-control " style="margin-top:30px">POST</button>
                                </div>
                            </div>



                        </form>
    </div>
            <div class="card">
                <div class="card-header">

                    <input class="form-control col-md-12" type="search" placeholder="Search" v-model="search" aria-label="Search">

                </div>
                <div class="card-body row">
                    <div class="col-md-6 col-sx-12" >
                        <label>Notes</label>
                        <div class="new-file-notes col-md-12"></div>
                        <div id="note" class="d-block mb-2 mb-xs-5" v-for="(note,index) in this.notes" :key="note.id">
                            <span >{{ index + 1 }} .</span>
                            <span class="ml-1" v-text="capTitle(note.title)"></span>

                            <span class="float-md-right float-sm-right  col-xs-12">
                                 <span class="ml-md-5 ml-sm-5 mr-md-2  mr-sm-2 badge badge-light">{{ note.file_type.toUpperCase() }}</span>
                                <img class="ml-md-2 ml-sm-2" :src="getPic(note.file_type)" height="20px"/>
                                <span class="ml-md-2 ml-sm-2" v-if="note.size >= 0.99">{{ note.size }} MB</span>
                                <span class="ml-md-2 ml-sm-2" v-if="note.size < 0.99">{{ Math.round(note.size * 1024) }} KB</span>
                                <img class="ml-md-5 ml-sm-5" src="/storage/icons/download.svg" height="20px" @click="downloadFile(note.id)"/>
                                 <span v-if="note.allow_delete"><i class="ml-4 mr-5 far fa-trash-alt" @click="deleteFile(note.id)"></i></span>
                                 <span v-if="!note.allow_delete"><i class="ml-4 mr-5 far fa-trash-alt" style="color: grey"></i></span>
                            </span>
                        </div>
                    </div>
                    <div class="col-md-6 col-sx-12" >
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
                                 <span v-if="paper.allow_delete"><i class="ml-4 mr-5 far fa-trash-alt" @click="deleteFile(paper.id)"></i></span>
                                <span v-if="!paper.allow_delete"><i class="ml-4 mr-5 far fa-trash-alt" style="color: grey"></i></span>
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
        name: 'RevisionMaterialsCenter',
        data(){
            return{
                uploadFile : {
                    name: '',
                    type : '',
                    file: null
                },
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
            fileSelected(event){
              this.uploadFile.file = event.target.files[0];

            },
            fetcthData(){
                    axios.get('/api/uploads')
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
               deleteFile(id){
                    Swal.fire({
                        title: 'Are you sure?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                        }).then((result) => {
                        if (result.value) {
                            axios.delete('/api/delete-upload/'+id)
                            .then(response =>{
                                Fire.$emit('UploadsUpdated');
                                Toast.fire({
                                    icon: 'success',
                                    title: 'File Deleted Successfully'
                                    })
                            })
                            .catch(err =>{
                                   Swal.fire(
                                    'Error!',
                                    err,
                                    'warning'
                                    )
                            });


                        }
                    })

                },
            addDetails(){
                   const load = document.querySelector('.new-file-'+this.uploadFile.type.toLowerCase());
                   load.style.visibility = 'visible';
                    const upFile = new FormData();
                    const config = { headers : {'Content-Type' : 'multipart/form-data'}};
                         upFile.append('fileType',this.uploadFile.type);
                        upFile.append('title',this.uploadFile.name);
                         upFile.append('mydoc',this.uploadFile.file,this.uploadFile.name);
                    axios.post('/api/myuploads', upFile,config)
                        .then((response) => {
                            load.style.visibility = 'hidden';
                             Fire.$emit('UploadsUpdated');
                             Toast.fire({
                                icon: 'success',
                                title: 'File Added successfully'
                                });

                            this.uploadFile.type = ''
                            this.uploadFile.name = ''
                           this.uploadFile.file = null
                        })
                        .catch(error =>{
                               this.validationErrors = error.response.data.errors;
                        });
                }
        },
        computed:{
             papers:function (){
                     return this.uploads.filter(paper => {
                         if(paper.doc_type === "papers"){
                             return paper.title.toLowerCase().match(this.search.toLowerCase());
                         }
                    });
             },
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
            Fire.$on('UploadsUpdated',()=>{
                this.fetcthData();
            });
        }
    }


</script>
<style>
    .new-file-notes ,.new-file-papers{
        height: 5px;
        background:deepskyblue;
        visibility: hidden;
    }
</style>
