<template>
    
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <textarea 
                name=""
                class="form-control"
                v-model="comment"
                placeholder="Add a new comment"
                >
                </textarea>
                <div :class="loading ? 'loader' : ''"></div>

            </div>
            <div class="form-group">
                <button class="btn btn-primary" @click="saveNewComment">Save</button>
            </div>
        </div>
    </div>
</template>

<script>
    export default {

        created(){
            // console.log(this.$route.params.id);
            
        },
        data(){
            return {
                comment: '',
                loading: false,
            }
        },

        methods: {
            saveNewComment(){
                this.loading = true;
                var url = window.Laravel.basePath + 'api/comment';

                //these are the guys our store method will receive
                var postData = {
                    body: this.comment,
                    videoId: this.$route.params.id
                }

                axios.post(url, postData).then(response => {
                    window.eventBus.$emit('commentAddEvent', response.data);

                    this.loading = false;

                    this.comment = ''
                });
            }
        }
    }
</script>

<style>
.loader {
    border: 4px solid #f3f3f3;
    border-radius: 50%;
    border-top: 4px solid #3498db;
    width: 30px;
    height: 30px;
    -webkit-animation: spin 2s linear infinite; /* Safari */
    animation: spin 2s linear infinite;

    position: absolute;
    left: 566px;
    bottom: 80px;
  }

  /* Safari */
  @-webkit-keyframes spin {
    0% { -webkit-transform: rotate(0deg); }
    100% { -webkit-transform: rotate(360deg); }
  }

  @keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }
</style>
