
import Echo from "laravel-echo"

import Vue from 'vue';
import vueResource from 'vue-resource';


Vue.use(vueResource);

Vue.component('chat', require('./components/Chat.vue'));



window.Echo = new Echo({
    broadcaster: 'socket.io',
    host: window.location.hostname + ':6001',
    namespace: 'App.Events'
});

Vue.http.interceptors.push((request, next) => {

    // modify headers
    request.headers.set('X-CSRF-TOKEN', $('meta[name="csrf-token"]').attr('content'));
    request.headers.set('X-Socket-ID', window.Echo.socketId());

    next();
});


const app = new Vue({
    el: '#app'
});