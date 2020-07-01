<template>
        <div class="row "  >
            <div id ="chat" class="col-md-9">
                <!-- DIRECT CHAT -->
                <div id="message-view" class="card direct-chat direct-chat-primary" v-if="current">
                    <div class="card-header">
                        <h3 class="card-title">{{ current.title }}</h3>

                        <div class="card-tools">
                            <span  class="badge badge-light">{{ current.messages.length }}</span>
                            Messages
                            <span  class="badge badge-primary ml-3">{{ current.new }}</span>
                            New
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div id="msg-scroll" class="card-body">
                        <div  v-for="msg in current.messages" v-if="current.messages">
                            <!-- Message. Default to the left -->
                            <div class="direct-chat-msg col-md-6" v-if="!msg.isYours">
                                <div class="direct-chat-infos clearfix">
                                    <span class="direct-chat-name float-left ml-3">{{ msg.sender.name}}</span>
                                </div>
                                <div class="direct-chat-text">
                                    {{ msg.message }}
                                </div>
                                <span class="direct-chat-timestamp ml-5 float-left">{{ msg.sent_at.time}}</span>
                                <!-- /.direct-chat-text -->
                            </div>
                            <!-- /.direct-chat-msg -->

                            <!-- Message to the right -->
                            <div class="direct-chat-msg right ml-auto col-md-6" v-if="msg.isYours">
                                <div class="direct-chat-infos clearfix">
                                    <span class="direct-chat-name float-right mr-3">Me</span>
                                </div>
                                <div class="direct-chat-text">
                                    {{ msg.message }}
                                </div>

                                <span class="direct-chat-timestamp float-right mr-5 font-italic">
                                    <span id="msg-actions" class="px-2 mr-2" v-if="msg.sender.access == 0">
                                        <i class="fas fa-pencil-alt mr-1" data-toggle="modal" data-target="#editMsg" @click="setMsg(msg)"></i>
                                        <i class="ml-3 far fa-trash-alt" @click="delMsg(msg.id)"></i>
                                    </span>
                                        <span class="mr-2">
                                        {{msg.sent_at.full_date}}
                                        </span>
                                    {{ msg.sent_at.time}}
                                </span>
                                <!-- /.direct-chat-text -->
                            </div>
                        </div>
                    </div>
                        <!--/.direct-chat-messages-->
                    <!-- /.card-body -->
                        <div class="card-footer" id="msg-send-section">
                            <form action="#" method="post" @submit.prevent="sendMsg(current.id)">
                                <div class="input-group">
                                    <input type="text" name="message" v-model="msg.message" placeholder="Type Message ..." class="form-control" required>
                                    <span class="input-group-append">
                                              <button type="submit" class="btn btn-primary" >Send</button>
                                    </span>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-footer-->
                    </div>
                </div>
              <!--/.direct-chat -->
                    <!--   new chat-->
            <div class="modal fade" id="newChat" tabindex="-1" role="dialog" aria-labelledby="newChat" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title ml-2 text-bold" id="newChatTitle">Start Chat</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <!-- Modal -->          <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="p-2" @submit.prevent="sendMsg">
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label>To</label>
                                        <select class="form-control" v-model="new_chat.receiver_id" required>
                                            <option  v-for="reciever in recipients" :key="reciever.id" :value="reciever.id"> {{ reciever.name }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label >Message</label>
                                        <textarea type="text" v-model="new_chat.message" class="form-control" rows="5"/>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary float-right">SEND</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
                    <!--  /new chat-->
            <!--   edit chat-->
            <div class="modal fade" id="editMsg" tabindex="-1" role="dialog" aria-labelledby="editMsg" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                    <div class="modal-content">

                        <div class="modal-body">
                            <form class="p-2" @submit.prevent="updateMsg">

                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label >Edit Message</label>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                        </button>
                                        <textarea type="text" v-model="MsgEdit.message" class="form-control" rows="5"/>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary float-right">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!--  /edit chat-->

                <div class="col-md-9 " v-if="NoMessages">
                    <div class="card bg-warning mx-auto p-5">
                        <h3 class="text-center">Looks Like You Dont Have Messages</h3>
                    </div>
                </div>

            <div id="conversations" class="col-md-3 card">
                <div class="card-header ">
                        <span class="d-inline float-left">
                            <i class="fa fa-paper-plane" data-toggle="modal" data-target="#newChat" aria-hidden="true" style="color:#0275d8"></i>
                        </span>
                        <div  class=" text-bold text-center "> Your Conversations <span class="badge badge-primary">{{ conversations.length }}</span></div>

                </div>
                <div class="card-body" id="recent-chats">
                    <div id="conv-scroll" >
                            <div id="conv-holder" v-for="(dm,index) in conversations" :key="dm.id" @click="loadMessage(index)">
                                    <span class="text-bold  d-inline ml-2">
                                      {{ dm.title }}
                                    </span>
                                    <span class="text-muted float-right mr-2">{{ dm.messages[dm.messages.length-1].sent_at.time}}</span>
                                    <div class="last-message font-italic text-muted ml-2" style="">
                                        {{ dm.messages[dm.messages.length-1].message.slice(0,130) }}
                                        <span class="text-bold" v-if="dm.messages[dm.messages.length-1].message.length > 130">...</span>
                                    </div>

                            </div>

                    </div>
                </div>
            </div>
        </div>



</template>

<script>

    export default {
        name: 'MailBox',
        data(){
            return{
                conversations:[],
                msg:{
                    conv_id:'',
                    message:'',
                },
                new_chat:{
                    receiver_id:'',
                    message:'',
                },
                MsgEdit:[],
                recipients:[],
                current: null,
                NoMessages: false,
            }
        },
        props:[],
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
                            this.fetchData();
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
                            this.fetchData();

                            this.current = this.conversations[0];
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
                            }
                        })
                        if(this.current.new > 0){
                            this.readMsgs(this.current.id)
                        }

                        var today = new Date();
                        var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
                        console.log("FetchData @ " + time)

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

                        console.log("STARTUP FUNCTION")
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

        mounted() {
            this.startUp();
        }

    }


</script>

<style>
    #msg-send-section{
        background: white;
    }
    #msg-scroll{
        background: #F5F5F5;
    }
      #conv-holder{
        border-bottom: .5px solid rgba(192,192,192,.6);
    }
    #conv-holder:hover{
        background: #F5F5F5;
    }
    #message-view{
        height: 640px;
    }
    #conversations{
        padding: 0;
    }
    #recent-chats{
        margin-top: 0;
        height: 593px;
        padding: 5px 0 0 0 !important;
        /*padding: 5px 0 0 0 !important;*/

    }
    #conv-scroll{
        height: 560px;
    }
    #msg-scroll,#conv-scroll{
        overflow-x: hidden;
        overflow-y: auto;
        scrollbar-width: thin;
        scrollbar-color: grey white;

    }

    ::-webkit-scrollbar{
        width: 8px;
        background-color: white;
    }

    ::-webkit-scrollbar-thumb {
        background-color: grey;
    }

    ::-webkit-scrollbar-track {
        background-color:white;
    }
</style>
