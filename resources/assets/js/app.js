
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// const { default: Echo } = require('laravel-echo');

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

//  const files = require.context('./', true, /\.vue$/i)
//  files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('meme-options', require('./components/MemeOptions.vue'));
Vue.component('meme-component', require('./components/MemeComponent.vue'));
Vue.component('user-profile', require('./components/UserProfile.vue'));
Vue.component('toast', require('./components/Toast.vue'));
Vue.component('notification', require('./components/Notification.vue'));
Vue.component('notifications-status', require('./components/NotificationsStatus.vue'));
Vue.component('notification-alert', require('./components/NotificationAlert.vue'));

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});