
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// Vue = require('vue')
import Vue from 'vue'
import Vuetify from 'vuetify'
// import 'vuetify/dist/vuetify.min.css'
// import TheNavDrawer from './components/layout/TheNavDrawer'
import App from './App.vue'
import router from './router'
import store from './store'
import Axios from 'axios'

// require('./bootstrap')
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.use(Vuetify)

// Vue.component('example-component', require('./components/ExampleComponent.vue').default)
Vue.component('VueApp', App)
// Vue.component('TheToolbar', TheToolbar)

/**
 * Global Event Bus
 * @desc used to transmit events between components
 * @example this.$bus.$emit('event')
 * @example this.$bus.$on('event', () => {})
 */
const bus = new Vue({})
Object.defineProperty(Vue.prototype, '$bus', {
  get () {
    return bus
  }
})

let token = document.head.querySelector('meta[name="csrf-token"]')

if (token) {
  Axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content
  console.log(token)
} else {
  console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token')
}

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// eslint-disable-next-line no-unused-vars
// const app = new Vue({
//   el: '#app'
// })

new Vue({
//   data: () => ({ store }),
  router,
  store,
  render: h => h(App)
}).$mount('#app')
