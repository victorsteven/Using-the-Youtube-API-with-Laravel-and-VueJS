<template>
    <div class="youtube__wrapper">
        <finder></finder>

        <div v-if="!loading">
            <video-group :videos = "videos"></video-group>
        </div>
        <div v-if="loading">Loading...</div>
    </div>
</template>

<script>

    import Search from './Search';
    import Finder from './Finder.vue';
    import VideoGroup from './VideoGroup';
    import localDB from './../localDB';
    
    export default {

        components: {
            VideoGroup, Finder
        },

        data(){
            return {
                localDB: new localDB(),
                videos: null,
                loading: true,
            }
        },

        created(){

            // this.localDB.set('search', [{name: 'John Doe'}]);

            console.log(this.localDB.set('search', 'fruits'));

            var searchString = (this.localDB.get('search')) ? this.localDB.get('search') : 'x men';
            

            Search({
                apiKey: 'AIzaSyADwBA8UmYoaJ4Tf-YeZJcIVYCEzCf06eg',
                term: searchString,
                // term: 'laravel repository'
                items: 10
            }, response => this.handleSearchResults(response));

            // window.eventBus.$on('searchForYoutubeStarted');
            window.eventBus.$on('searchForYoutubeStarted', (string) => {
                this.loading = true;
                this.localDB.set('search', string)
            });

            window.eventBus.$on('searchResultFromYouTube', videos => {
                // console.log('search result', videos);
                this.loading = false;
                this.videos = videos;
                
            });
        },

        methods: {
            handleSearchResults(result){
                this.loading = false;
                this.videos = result
            }
        }
    }
</script>


