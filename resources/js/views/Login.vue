<template>
  <v-container
    fluid
    fill-height
  >
    <v-layout
      align-center
      justify-center
    >
      <v-flex
        xs12
        sm8
        md4
      >
        <transition name="slide-y-transition">
          <v-alert
            v-if="user"
            type="success"
            :value="user"
            class="mb-2"
          >
            Logged in as {{ user.name }}
          </v-alert>
        </transition>

        <v-card class="elevation-4">
          <v-toolbar
            dark
            color="primary"
            flat
          >
            <v-toolbar-title>Login</v-toolbar-title>
          </v-toolbar>
          <v-card-text>
            <v-form ref="form">
              <v-text-field
                v-model="email"
                :readonly="loading"
                :rules="[
                  $data.$_validation_rules.required,
                  $data.$_validation_rules.email
                ]"
                prepend-icon="person"
                name="email"
                label="Email"
                type="text"
              />
              <v-text-field
                id="password"
                v-model="password"
                :readonly="loading"
                :rules="[
                  $data.$_validation_rules.required
                ]"
                prepend-icon="lock"
                name="password"
                label="Password"
                type="password"
              />
            </v-form>
          </v-card-text>
          <v-card-actions>
            <v-spacer />
            <v-btn
              color="secondary"
              :loading="loading"
              @click="login"
            >
              Login
            </v-btn>
          </v-card-actions>
        </v-card>

        <transition name="slide-y-transition">
          <v-alert
            v-if="error"
            :value="true"
            class="mt-2"
            type="error"
          >
            {{ error }}
          </v-alert>
        </transition>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
import Axios from 'axios'
import validation from '@/mixins/validation'

export default {
  // Name
  name: 'Login',

  // Mixins
  mixins: [validation],

  // Data
  data () {
    return {
      email: undefined,
      password: undefined,
      error: undefined,
      loading: false
    }
  },

  // Computed
  computed: {
    user () {
      return this.$store.state.user
    }
  },

  // Methods
  methods: {
    /**
     * Login
     * Attempt to log the user into the API
     */
    async login () {
      if (!this.$refs.form.validate()) return
      this.loading = true
      this.error = undefined
      try {
        const response = await Axios({
          method: 'post',
          url: '/api/login',
          data: {
            email: this.email,
            password: this.password
          }
        })
        this.storeAccessToken(response.data.token)
        const user = response.data.user
        this.handleSuccessfulLogin(user)
      } catch (error) {
        console.dir(error)
        this.error = error.response.data.message
      } finally {
        this.loading = false
      }
    },

    /**
     * Store Access Token
     * Keep the access token in the Authorization Header
     * @param {String} - token
     */
    storeAccessToken (token) {
      Axios.defaults.headers.common['Authorization'] = `Bearer ${token}`
      localStorage.setItem('token', token)
    },

    /**
     * Handle Successful Login
     * Update the user in the store and emit a toast, redirect to Dashboard
     * @param {Object} - user
     */
    handleSuccessfulLogin (user) {
      this.$store.commit('updateUser', user)
      this.$bus.$emit('toast', {
        text: `Logged in as ${user.name}`
      })
      this.$router.push('/dashboard')
    }
  }
}
</script>

<style scoped lang="scss">
</style>
