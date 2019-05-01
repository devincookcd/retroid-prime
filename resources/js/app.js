
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
import Vue from 'vue'
import Vuetify from 'vuetify'
import 'vuetify/dist/vuetify.min.css'
import App from './App.vue'
import router from './router'
import store from './store'
import Axios from 'axios'
import colors from 'vuetify/es5/util/colors'

Vue.use(Vuetify, {
  theme: {
    primary: colors.deepPurple,
    secondary: colors.amber.darken2,
    accent: colors.amber.lighten1,
    error: colors.red.accent3
  }
})

Vue.component('VueApp', App)

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
  Axios.defaults.headers.common = {
    'X-CSRF-TOKEN': token.content,
    'X-Requested-With': 'XMLHttpRequest'
  }
} else {
  console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token')
}

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
new Vue({
  router,
  store,
  render: h => h(App)
}).$mount('#app')
