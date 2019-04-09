import Vue from 'vue'
import Router from 'vue-router'

import Login from './views/Login'
import Register from './views/Register'
import Dashboard from './views/Dashboard'

Vue.use(Router)

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'Login',
      component: Login
    },
    {
      path: '/register',
      name: 'Register',
      component: Register
    },

    {
      path: '/dashboard',
      name: 'Dashboard',
      component: Dashboard
    }
  ]
})
