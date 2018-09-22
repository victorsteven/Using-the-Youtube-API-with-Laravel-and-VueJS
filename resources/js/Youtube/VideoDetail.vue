<template>
    
    <div class="VideoDetails__wrapper row" v-if="video">
        <div class="col-sm-8 col-sm-push-2">
            <h2>{{ video.snippet.title }}</h2>
            <br>
            <small>Channel: {{ video.snippet.channelTitle }}</small>

            <div class="embed-responsive embed-responsive-16by9 mb-3">
                <iframe :src="url" class="embed-responsive-item"></iframe>
            </div>

            <p>{{ video.snippet.description }}</p>
            
            <playlist-wrapper></playlist-wrapper>

        </div>
        <div class="col-sm-8 col-sm-push-2">


            <comment-wrapper></comment-wrapper>
        </div>
        
    </div>
</template>

<script>
    import CommentWrapper from './Comment/CommentWrapper.vue';
    import getVideo from './getVideo';
    import PlaylistWrapper from './Playlist/PlaylistWrapper.vue';

    export default {

        components: {
            CommentWrapper, PlaylistWrapper
        },

        data(){
            return {
                videoId: null,
                video: null,
                url: null
            }
        },
        
        created(){
            // console.log(this.$route.params.id);
            // console.log(this.$route.params.video);

            //if the if condition is true, this takes us to our video dashboard, so, if i was on a single video before, when i refresh, it takes me to all videos
            // if(this.$route.params.video === undefined){
            //     this.$router.push({name: 'youtube-dash'});
            // }

            this.videoId = this.$route.params.id;
            this.url = `https://www.youtube.com/embed/${this.videoId}`; //iframe video url

            // this.video = this.$route.params.video;
            
            //this is a promise
            getVideo({
                apiKey: 'AIzaSyADwBA8UmYoaJ4Tf-YeZJcIVYCEzCf06eg',
                videoId: this.videoId
            }, response => {
                // console.log('reponse videos', response);
                
                this.video = response[0];
            })
            
        }
    }
</script>
