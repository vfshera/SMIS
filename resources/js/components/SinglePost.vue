<template>
    <div>
        <div class="card col-md-12 mt-5">
            <div class="card-body container  mt-3">
                <h3 class="card-title text-bold d-inline">
                    <router-link  :to="{ name: 'newsCenter' }" style="text-decoration: none">
                     {{ post.title}}
                    </router-link>
                </h3>
                <span class="float-right text-muted font-italic">
                        {{ post.created_at }}
                    </span>

                <p class="card-text">{{ post.info }} </p>
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
                axios.get('/api/news-post/'+this.id)
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
