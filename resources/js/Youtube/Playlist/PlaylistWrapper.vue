<template>
    
    <div class="playlist-wrapper">
        <notifications group="foo"  :classes="notificationClasses"/>
        <button class="btn btn-sm btn-primary cursor" @click="playlistOpen">+ Add </button>

        <div class="list-wrapper" v-if="showPlaylist">


            <div v-if="!loading">
                <div class="list">
                    <div class="mb-2 clearfix">
                        <div class="float-left">My playlists</div>
                        <div class="float-right cursor" @click="playlistOpen">Close</div>
                    </div>
                    <div class="clearfix mb-2">
                        <ul class="list-group">

                            <playlist-item v-for="item in playlist" :key="item.id"  :item="item"></playlist-item>
                        </ul>
                    </div>
                </div>
                <form action="" @submit.prevent="handleSavePlaylist">
                    <div class="form-group-row">
                        <div class="col-sm-8">
                            <input type="text" placeholder="Create new playlist" class="form-control" v-model="playlistName">
                        </div>

                        <div class="col-sm-4"><input type="checkbox" v-model="isPrivate">Private</div>

                        <!-- <div class="form-group btn btn-primary" @click="submitPlay">Post</div> -->
                    </div>
                </form>

            </div>

            <div v-if="loading">
                <i class="fas fa-sync fa-spin"></i>
                
            </div>
            

           
        </div>
    </div>
</template>


<script>

    import PlaylistItem from './PlaylistItem.vue';
    
    export default {

        components: {

            PlaylistItem,
        },

        data(){
            return {
                notificationClasses: null,
                playlist: null,
                showPlaylist: false,
                playlistName: '',
                isPrivate: false,
                loading: true
            }
        },

        created(){

            window.eventBus.$on('PlayListAdded', data => {
                this.notificationClasses = 'vue-notification success'
                console.log(data);
                this.$notify({
                group: 'foo',
                title: 'Success!',
                text: data
            });
            });

            window.eventBus.$on('PlayListNotAdded', data => {
                this.notificationClasses = 'vue-notification error'
                console.log(data);
                this.$notify({
                group: 'foo',
                title: 'Error!',
                text: data
            });

            });

            
        },

        methods: {
            playlistOpen(){
                this.loadUserPlaylists();
            },
            loadUserPlaylists(){

                this.showPlaylist = !this.showPlaylist;

                axios.get('/api/user/playlists').then(response => {
                    setTimeout(() => {
                        console.log(response.data);
                        
                        this.playlist = response.data

                        this.loading = false;

                    }, 1000)
                })
            },

            handleSavePlaylist(){
                let postData = {
                    name: this.playlistName,
                    isPrivate: this.isPrivate
                };

                axios.post('/api/playlist', postData).then((response) => {

                    this.playlist.unshift(response.data);
                    this.playlistName = '';
                    this.isPrivate = false;

                    console.log(response.data)
                }).catch(error => {

                    if(error.response.status === 403){
                        alert(error.response.data.message);
                    }
                    console.error(error.response);
                });
            },
            // submitPlay(){

            // }
        }

    }
</script>

<style lang="scss" scoped>
    .playlist-wrapper {
        position: relative;
        .list-wrapper {
            position: absolute;
            top: -310px;
            z-index: 999;
            background-color: white;
            padding: 1rem;
            border: 1px solid #efefef;
            min-width: 29rem;
            .list {
                .list-group-item {
                    padding: 0.45rem 1.25rem;
                }
            }
        }
    }

</style>
