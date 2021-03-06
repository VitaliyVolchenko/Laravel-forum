
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example-component', require('./components/ExampleComponent.vue'));
Vue.component('flash', require('./components/Flash.vue'));
Vue.component('reply', require('./components/Reply.vue'));
Vue.component('favorite', require('./components/Favorite.vue'));
Vue.component('replies', require('./components/Replies.vue'));
Vue.component('new-reply', require('./components/NewReply.vue'));
Vue.component('paginator', require('./components/Paginator.vue'));
Vue.component('subscribe-button', require('./components/SubscribeButton.vue'));
Vue.component('user-notifications', require('./components/UserNotifications.vue'));
Vue.component('avatar-form', require('./components/AvatarForm.vue'));
Vue.component('image-upload', require('./components/ImageUpload.vue'));
Vue.component('wysiwyg', require('./components/Wysiwyg.vue'));

Vue.component('thread-view', require('./pages/Thread.vue'));


const app = new Vue({
    el: '#app'
});
