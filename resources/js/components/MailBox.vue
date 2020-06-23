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
                    <div id="msg-scroll" class="card-body" >
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
                                <span class="direct-chat-timestamp float-right mr-5">{{ msg.sent_at.time}}</span>
                                <!-- /.direct-chat-text -->
                            </div>
                        </div>
                    </div>
                        <!--/.direct-chat-messages-->
                    <!-- /.card-body -->
                        <div class="card-footer">
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


                <div class="col-md-9 " v-if="NoMessages">
                    <div class="card bg-warning mx-auto p-5">
                        <h3 class="text-center">Looks Like You Dont Have Messages</h3>
                    </div>
                </div>

            <div id="conversations" class="col-md-3 card">
                <div class="card-header ">
                        <span class="d-inline float-left">+</span>
                        <div  class=" text-bold text-center "> Your Conversations <span class="badge badge-primary">{{ conversations.length }}</span></div>

                </div>
                <div class="card-body" id="recent-chats">
                    <div id="conv-scroll" >
                            <div id="conv-holder" v-for="dm in conversations" :key="dm.id" >
                                    <span class="text-bold  d-inline">
                                      {{ dm.title }}
                                    </span>
                                    <span class="text-muted float-right">{{ dm.messages[dm.messages.length-1].sent_at.time}}</span>
                                    <div class="last-message font-italic text-muted" style="">
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
                    receiver_id:'',
                    message:'',
                },
                current: null,
                NoMessages: false,
            }
        },
        props:[],
        methods:{
            sendMsg(id){
                this.msg.conv_id = id;
                if(this.msg.conv_id && this.msg.message){
                    axios.post('/api/message' , this.msg)
                        .then(response =>{
                            this.fetchData();
                        })
                        .catch(err => {

                        })
                }else{
                    alert("Error While trying to send your message!Please Try Again")
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

                    })
                    .catch(err => {

                    })
            }
        },
        setConv(index){
            this.current = this.conversations[index];
        },
            readMsgs(id){

                axios.post('/api/read'+ id)
                    .then(response => {

                    })
                    .catch(err => {

                    })
            },
        mounted() {
            this.startUp();
        }
    }


</script>

<style>

    #conv-holder{
        border-bottom: .5px solid rgba(192,192,192,.6);
    }
    #message-view{
        height: 640px;
    }
    #recent-chats{
        height: 593px;
        padding: 5px 0 0 0 !important;

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
