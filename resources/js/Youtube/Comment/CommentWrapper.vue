<template>
    <div>
        <span class="mt-4">
            <comment-add></comment-add>
        </span>

        <div v-for="comment in comments" :key="comment.id">
            <comment :comment="comment"></comment>
        </div>
    </div>
    
</template>

<script>
    import comment from './Comment.vue';
    import commentAdd from './CommentAdd.vue';

    export default {

        components: {
            comment, commentAdd
        },

        created(){
            window.eventBus.$on('commentAddEvent', comment => this.handleNewComment(comment));

            this.loadComments();


            window.Echo.channel('comments').listen('.comment.created', event => {
                // console.log('event', event);
                console.log('Called');
                this.handleNewComment(event.comment);
                
            });


        },

        data(){
            return {
                comments: [],
            }
        },

        methods: {
            handleNewComment(comment){
                this.comments.unshift(comment);
            },

            loadComments(){
                var url = window.Laravel.basePath + '/api/video/comments';
                var postData = {
                    videoId: this.$route.params.id
                }

                axios.post(url, postData).then(response => {
                    this.comments = response.data;
                })
            }
        }
    }
</script>

