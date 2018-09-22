<template>
    <div>
        <li class="list-group-item" @click="saveVideoToPlaylist">{{ item.name }}</li>

    </div>
</template>

<script>
    export default {

        props: ['item'],

        methods: {

            saveVideoToPlaylist(){

                let postData = {
                    videoId: this.$route.params.id,
                    playlistId: this.item.id
                }

                axios.post('/api/playlist-entry', postData)
                    .then(response => {
                        console.info(response);

                        window.eventBus.$emit('PlayListAdded', 'The video was added.')

                    }).catch(error => {
                        console.error(error.response);
                        window.eventBus.$emit('PlayListNotAdded', error.response.data.message);
                    })
            }
        }

    }
</script>
