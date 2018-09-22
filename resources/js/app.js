
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router';
import Notifications from 'vue-notification'


import YoutubeDash from './Youtube/YoutubeDash';
import VideoDetail from './Youtube/VideoDetail';
import MyPlaylists from './Youtube/MyPlaylists';

Vue.use(VueRouter);
Vue.use(Notifications)

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */


// Vue.component('youtube-dashboard', require('./Youtube/YoutubeDash.vue'));

window.eventBus = new Vue();

const routes = [
    {path: '/', component: YoutubeDash, 'name': 'youtube-dash'},
    {path: '/video/:id', component: VideoDetail, 'name': 'youtube-video'},
    {path: '/playlists', component: MyPlaylists, 'name': 'my-playlists'}
];

const router = new VueRouter({
    routes
});

const app = new Vue({
    router
}).$mount("#app");

// const app = new Vue({
//     el: '#app'
// });
