<template>
    
    <div class="myplaylist_wrapper">
        <div class="card card-default">
            <div class="card-header">
                My Playlists
            </div>

            <div class="card-body">
                <table class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Video Count</th>
                            <th>Last Updated</th>
                            <th>Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr v-for="playlist in playlists" :key="playlist.id">
                            <td>{{ playlist.name }}</td>
                            <td>{{ playlist.entries.length }}</td>
                            <td>{{ playlist.updated_at }}</td>
                            <td>Edit / Delete</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</template>

<script>
    
    export default {

        data(){
            return {
                playlists: []
            }
        },

        created(){
            axios.get('/api/user/playlists').then(response => {
                // console.log(response);
                this.playlists = response.data;
                
            })
        }
    }
</script>
