<template>
        <div class="row "  >
            <div id ="chat" class="col-md-9">
                <!-- DIRECT CHAT -->
                <div id="message-view" class="card direct-chat direct-chat-primary" v-for="dm in conversations" :key="dm.id">
                    <div class="card-header">
                        <h3 class="card-title">{{ dm.title }}</h3>

                        <div class="card-tools">
                            <span  class="badge badge-light">3</span>
                            Messages
                            <span  class="badge badge-primary ml-3">3</span>
                            New
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div id="msg-scroll" class="card-body" >
                        <div  v-for="msg in dm.messages" v-if="dm.messages">
                            <!-- Message. Default to the left -->
                            <div class="direct-chat-msg col-md-6" v-if="!msg.isYours">
                                <div class="direct-chat-infos clearfix">
                                    <span class="direct-chat-name float-left ml-3">{{ msg.sender.name}}</span>
                                </div>
                                <div class="direct-chat-text">
                                    {{ msg.message }}
                                </div>
                                <span class="direct-chat-timestamp ml-5 float-left">{{ msg.sent_at}}</span>
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
                                <span class="direct-chat-timestamp float-right mr-5">{{ msg.sent_at}}</span>
                                <!-- /.direct-chat-text -->
                            </div>
                        </div>
                    </div>
                        <!--/.direct-chat-messages-->
                    <!-- /.card-body -->
                        <div class="card-footer">
                            <form action="#" method="post" @submit.prevent="sendMsg(dm.id)">
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
                <div class="card bg-warning mx-auto col-md-12 p-5" v-if="conversations.length == 0">
                    <h3 class="text-center">Looks Like You Dont Have Messages</h3>
                </div>

            <div id="conversations" class="col-md-3 card">
                <div class="card-header text-bold text-center">
                        Your Conversations
                </div>
                <div class="card-body" >
                    <div id="conv-scroll" >
                        <div id="conv-holder" v-for="dm in conversations" :key="dm.id" >
                            <span class="username d-inline">
                              {{ dm.title }}
                            </span>
                                <span class="text-muted float-right">{{ dm.messages[dm.messages.length-1].sent_at }}</span>
                                <div class="last-message">
                                    {{ dm.messages[dm.messages.length-1].message }}
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
                }
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
                    .then(response =>{
                        this.conversations = response.data.data;
                    })
                    .catch(err => {

                    })
            }
        },
        mounted() {
            this.fetchData();
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
