<script>
    import Search from './Search';
    import localDB from './../localDB';

    export default {

        created(){
            if(this.localDB.get('search')){
                // this.placeholder = this.localDB.get('search');
                this.setPlaceholderText(this.localDB.get('search'));

            }
        },

        data(){

            return {
                localDB: new localDB(),
                searchString: '',
                placeholder: 'search...',
            }
        },
        methods: {
            handleFormSubmit(){
                window.eventBus.$emit('searchForYoutubeStarted', this.searchString);
                Search({
                apiKey: 'AIzaSyADwBA8UmYoaJ4Tf-YeZJcIVYCEzCf06eg',
                term: this.searchString,
                // term: 'laravel repository'
                items: 10
            }, data => {
                window.eventBus.$emit('searchResultFromYouTube', data);
                this.setPlaceholderText(this.searchString);
                this.searchString = '';
            });
            },

            setPlaceholderText(string){
                this.placeholder = "Search result for " + string;
            }
        }
    }
</script>


<template>
    <div class="Search__wrapper">
        <div class="container">
            <form action="" @submit.prevent="handleFormSubmit">
                <input :placeholder="placeholder" type="text" v-model="searchString" class="form-control" name="" id="">
            </form>
        </div>
    </div>
</template>

<style>
    .Search__wrapper{
        margin-bottom: 10px;
    }
</style>
