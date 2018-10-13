
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
// require('https://fonts.googleapis.com/css?family=Material+Icons')
//require('./vuetify/dist/vuetify.min.css')

// window.Vue = require('vue');
//使えない……
//import 'material-design-icons-iconfont/dist/material-design-icons.css';
// import router from './router.js'

import Vue from 'vue'
import Vuetify from 'vuetify';
//require('./bootstrap');
import "vuetify/dist/vuetify.min.css";
// import Index from "./components/googleYoutube.vue";
import FileUploadForm from "./components/FileUploadForm.vue";
// import Test from './components/test.vue'

// import VueRouter from 'vue-router'
// // ルート用のコンポーネントを読み込む


// // Vuexと同様で最初にプラグインとして登録
// Vue.use(VueRouter)



//   const router = new VueRouter({
//     mode:'history',
//     base:'/rest/public/',
//     routes:[
//         { path: '/', component: GetAll },
//         { path: '/bar', component: FileUploadForm }
//     ]
//   })

Vue.use(Vuetify);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

//Vue.component('example-component', require('./components/ExampleComponent.vue'));

// Vue.component('upload', Test)
//"file-upload-form": FileUploadForm
new Vue({
    el: '#app',
    components: {
        'main-view' : FileUploadForm
    },

    
  })
