<template>
    
    <div class="VideoGroup__wrapper row grid">
        <video-item
            v-images-loaded:on.progress="imageProgress"
             v-for="video in videos" :key="video.id.videoId"
             :video ="video" 
             
        >
        <!-- the "video" from the loop is passed to the VideoItem vue, which received it as a prop -->
        </video-item>        
    </div>
</template>

<script>
    import VideoItem from './VideoItem';
    import imagesLoaded from 'vue-images-loaded';
    import Isotope from 'isotope-layout';

    export default {

        props: ['videos'],

        components: {
            VideoItem
        },

        // created(){
        //     this.relayoutTheGrid()
        // },

        data(){
            return {
                isotope: '',
                counter: 0
            }
        },

        directives: {
            imagesLoaded
        },

        methods: {
            relayoutTheGrid(){
                setTimeout(() => {
                     var elem = document.querySelector('.grid');
                this.isotope = new Isotope(elem, {
                    //options
                    //the itemselector is the class for each of our videos
                    itemSelector: '.card',
                    layoutMode: 'masonry' 
                });

                }, 1);
               
            },

            imageProgress(instance, img){
                // console.log('instance', instance, 'img', img);
                this.counter++;
                if(this.counter == this.videos.length){
                    this.relayoutTheGrid();
                }

                
            }
        }
    }
</script>

<style lang="scss">
    .card {
        margin: 0px 5px 5px 0px;
        .card-img-top {
            max-height: 210px;
        }
    }
</style>
