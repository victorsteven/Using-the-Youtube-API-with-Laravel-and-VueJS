<template>
    
    <div class="comment_wrapper">
        <div class="card-body">
            <small class="text-muted" v-text="nameTime"></small>
            <p>
                 {{ comment.body }}
            </p>
            <hr>
        </div>
    </div>
</template>

<script>
    import moment from 'moment';
    export default {

        props: ['comment'],

        computed: {
            
            nameTime(){
                return this.comment.owner.name + " said " + moment(this.comment.created_at).fromNow() + '...';
            }
        }

    }
</script>
