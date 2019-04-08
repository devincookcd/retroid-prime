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
            <v-toolbar-title>Login</v-toolbar-title>
          </v-toolbar>
          <v-card-text>
            <v-form>
              <v-text-field
                v-model="email"
                :readonly="loading"
                prepend-icon="person"
                name="email"
                label="Email"
                type="text"
              />
              <v-text-field
                id="password"
                v-model="password"
                :readonly="loading"
                prepend-icon="lock"
                name="password"
                label="Password"
                type="password"
              />
            </v-form>

            <v-alert
              v-if="error"
              :value="true"
              type="error"
            >
              {{ error }}
            </v-alert>
          </v-card-text>
          <v-card-actions>
            <v-spacer />
            <v-btn
              color="primary"
              :loading="loading"
              @click="login"
            >
              Login
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
import Axios from 'axios'

export default {
  // Name
  name: 'Login',

  // Components
  components: {},

  // Mixins
  mixins: [],

  // Props
  props: {},

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
  computed: {},

  // Watch
  watch: {},

  // Created
  created () {},

  // Mounted
  mounted () {},

  // Methods
  methods: {
    async login () {
      this.loading = true
      this.error = undefined
      try {
        await Axios({
          method: 'post',
          url: '/login',
          data: {
            email: this.email,
            password: this.password
          }
        })
      } catch (error) {
        console.dir(error)
        this.error = error.response.data.message
      } finally {
        this.loading = false
      }
    }
  }
}
</script>

<style scoped lang="scss">
</style>
