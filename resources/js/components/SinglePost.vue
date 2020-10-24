<template>
    <div>
        <div class="card col-md-12 mt-5">
            <div class="card-body container  mt-3">
                <h3 class="card-title text-bold d-inline">
                    <router-link  :to="{ name: 'mailBox' }" style="text-decoration: none">
                     {{ post.name}}
                    </router-link>
                </h3>
                <span class="float-right text-muted font-italic">
                        {{ post.email }}
                    </span>

                <p class="card-text">{{ post.message }} </p>
            </div>
        </div>



    </div>
</template>

<script>

    export default {
        name: 'SinglePost',
        data(){
            return{
                post: []

            }
        },
        props:["id","postTitle"],
        methods: {

            fetchData() {
                axios.get('/api/direct-msgs/'+this.id)
                    .then(response => {
                        this.post = response.data.data;

                    })
                    .catch(err => {

                    })

            },
        },
        computed:{
                   },
        mounted() {
            this.fetchData()
        }

    }


</script>

<style>

</style>
