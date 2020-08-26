<template>
   <div>
       <div class="pt-3 col-md-12 row" id="news-header">
           <div class="mr-auto">
               <h2>News Center</h2>
           </div>
           <div class="ml-auto pt-3 pr-5 row">
              <span class="text-primary mr-2">Compose</span> <i class="fa fa-envelope-open fa-2x mr-5" ></i>
               <h5 class="text-primary">9 Posts</h5>
           </div>
       </div>

       <div id="news-body" class=" col-md-12">

       </div>


   </div>
</template>

<script>

    export default {
        name: 'MailBox',
        data(){
            return{
                news:[] ,

            }
        },
        methods:{
            setMsg(msg){
                this.MsgEdit = msg;
            },
            updateMsg(){
                axios.post('/api/message' , this.MsgEdit)
                    .then(response =>{
                        $(editMsg).modal('hide');
                        $('body').removeClass('modal-open');
                        $('.modal-backdrop').remove();

                        this.fetchData();

                    })
                    .catch(err => {

                    })
            },
            scrollChat(){
                const scrl = document.querySelector('#msg-scroll');

                                  scrl.scrollTop =  scrl.scrollHeight;

            },
            loadMessage(index){
                this.current = this.conversations[index];
                setTimeout(() => {
                            this.fetchData()
                        }, 50)

            },
            sendMsg(id){
                this.msg.conv_id = id;
                if(this.msg.conv_id && this.msg.message){
                    axios.post('/api/message' , this.msg)
                        .then(response =>{
                            this.startUp();
                            this.current = this.conversations[0];

                            this.msg.conv_id = ''
                            this.msg.message = ''
                        })
                        .catch(err => {

                        })
                }else if(this.new_chat.receiver_id && this.new_chat.message){
                    axios.post('/api/message' , this.new_chat)
                        .then(response =>{
                            $(newChat).modal('hide');
                            $('body').removeClass('modal-open');
                            $('.modal-backdrop').remove();

                            this.conversations = [];
                            this.startUp();

                            this.current = this.conversations[0];

                            this.new_chat.receiver_id = ''
                            this.new_chat.message = ''
                        })
                        .catch(err => {

                        })
                }else{
                    alert("Ensure All Fields Are Filled!")
                }
            },
            fetchData(){
                    axios.get('/api/messages')
                    .then(response => {
                        this.conversations = response.data.data;
                        this.conversations.forEach(c =>{
                            if(c.id == this.current.id){
                                this.current = c;
                                this.msg.message = '';
                            }else {
                                this.NoMessages = false;
                                this.current = this.conversations[0];
                            }
                        })

                        if(this.current.new > 0){
                            this.readMsgs(this.current.id)
                        }



                    })
                    .catch(err => {

                    })
                axios.get('/api/recievers')
                    .then(response => {
                        this.recipients = response.data.data;

                    })
                    .catch(err => {

                    })
            },

            startUp(){
                axios.get('/api/messages')
                    .then(response => {
                        this.conversations = response.data.data;
                        if (this.conversations[0]) {
                            this.current = this.conversations[0];

                        } else {
                            this.NoMessages = true;
                        }

                        setTimeout(()=>{
                            this.scrollChat()
                        },150)

                        setInterval(() =>{
                            this.fetchData()
                        },15000)

                    })
                    .catch(err => {

                    })

                axios.get('/api/recievers')
                    .then(response => {
                        this.recipients = response.data.data;

                    })
                    .catch(err => {

                    })
            },
            delMsg(id){
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
                            axios.delete('/api/delete-msg/'+ id)
                                .then(response => {
                                    this.fetchData();
                                    // this.current.messages = []
                                })
                                .catch(err => {

                                })
                        }
                })
            },
            setConv(index){
                this.current = this.conversations[index];
            },
            readMsgs(id){
                axios.post('/api/read/'+ id)
                    .then(response => {

                    })
                    .catch(err => {

                    })
            }
        },
        computed:{
             function () {
                   this.NoMessages = (this.conversations.length > 0) ?  (this.conversations[0].messages.length < 1) : true;

                   //  const chatBox = document.querySelector('#message-view');
                   //  const noMsgBox = document.querySelector('#noMsg');
                   // if(this.NoMessages){
                   //      chatBox.style.display = 'none'
                   //     noMsgBox.style.display = 'inherit'
                   // }else{
                   //     chatBox.style.display = 'inherit'
                   //     noMsgBox.style.display = 'none'
                   // }
            }
        },
        mounted() {
            this.startUp();
        }

    }


</script>

<style>
   #news-header{
       height: 64px;
       background: white;
       border-bottom: rgba(1,1,1,.6) 2px solid;
   }

    #news-body{
        background: white;
        width: 100%;
    }
</style>
