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
        <v-card class="elevation-4">
          <v-toolbar
            dark
            color="primary"
            flat
          >
            <v-toolbar-title>Register a New User</v-toolbar-title>
          </v-toolbar>
          <v-card-text>
            <v-form ref="form">
              <v-text-field
                v-model="name"
                :readonly="loading"
                :rules="[
                  $data.$_validation_rules.required
                ]"
                prepend-icon="person"
                name="name"
                label="Name"
                type="text"
              />
              <v-text-field
                v-model="email"
                browser-autocomplete="off"
                :readonly="loading"
                :rules="[
                  $data.$_validation_rules.required,
                  $data.$_validation_rules.email
                ]"
                prepend-icon="email"
                name="email"
                label="Email"
                type="text"
              />
              <v-text-field
                id="new-password"
                v-model="password"
                browser-autocomplete="new-password"
                :readonly="loading"
                :rules="[
                  $data.$_validation_rules.required,
                  validationRules.minLength
                ]"
                prepend-icon="lock"
                name="new-password"
                label="Password"
                type="password"
              />
              <v-text-field
                id="confirm-password"
                v-model="passwordConfirmation"
                browser-autocomplete="new-password"
                :readonly="loading"
                :rules="[
                  $data.$_validation_rules.required,
                  validationRules.minLength,
                  validationRules.passwordsMatch
                ]"
                prepend-icon="check_circle"
                name="new-password-confirmation"
                label="Confirm Password"
                type="password"
              />
            </v-form>
          </v-card-text>
          <v-card-actions>
            <v-spacer />
            <v-btn
              color="primary"
              :loading="loading"
              @click="register"
            >
              Register
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
  name: 'Register',

  // Mixins
  mixins: [validation],

  // Data
  data () {
    return {
      name: undefined,
      email: undefined,
      password: undefined,
      passwordConfirmation: undefined,
      error: undefined,
      loading: false,
      validationRules: {
        passwordsMatch: value => value === this.password || 'Passwords Must Match.',
        minLength: value => value.length >= 8 || 'Must be at least 8 characters long.'
      }
    }
  },

  // Methods
  methods: {
    async register () {
      if (!this.$refs.form.validate()) return
      this.loading = true
      this.error = undefined
      try {
        const response = await Axios({
          method: 'post',
          url: '/register',
          data: {
            name: this.name,
            email: this.email,
            password: this.password,
            password_confirmation: this.passwordConfirmation
          }
        })
        console.dir(response)
        // Axios.defaults.headers.common['X-CSRF-TOKEN'] = response.data.token
        // // Axios.defaults.headers.common['Authorization'] = response.data.token
        const user = response.data.user
        this.handleSuccessfulLogin(user)
      } catch (error) {
        console.dir(error)
        this.error = error.response.data.message
      } finally {
        this.loading = false
      }
    },

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
