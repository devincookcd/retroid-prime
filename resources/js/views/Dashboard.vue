<template>
  <div v-if="user">
    <h1>
      Dashboard
    </h1>
    <!-- <h2>Welcome back, {{ user.name }}</h2> -->
    <!-- <v-container
      fluid
      fill-height
    > -->
    <v-layout class="mt-4">
      <v-flex
        xs12
        sm8
        md3
      >
        <v-card
          color="cyan darken-2"
          class="white--text"
        >
          <v-layout
            justify-center
            align-center
          >
            <v-flex
              xs5
              class="text-xs-center"
            >
              <v-icon
                size="42px"
                color="white"
              >
                book
              </v-icon>
              <!-- <v-img
                src="https://cdn.vuetifyjs.com/images/cards/foster.jpg"
                height="125px"
                contain
              /> -->
            </v-flex>
            <v-flex xs7>
              <v-card-title primary-title>
                <div>
                  <div class="headline">
                    Blog Posts
                  </div>
                  <div>742</div>
                </div>
              </v-card-title>
            </v-flex>
          </v-layout>
          <v-divider light />
          <!-- <v-card-actions class="pa-3">
            Rate this album
            <v-spacer />
            <v-icon>star_border</v-icon>
            <v-icon>star_border</v-icon>
            <v-icon>star_border</v-icon>
            <v-icon>star_border</v-icon>
            <v-icon>star_border</v-icon>
          </v-card-actions> -->
        </v-card>
      </v-flex>
    </v-layout>
    <!-- </v-container> -->
    <!-- <v-btn @click="getUser">
      Get User
    </v-btn>

    <div v-if="test">
      {{ test }}!!!!
    </div> -->
  </div>
</template>

<script>
import Axios from 'axios'
export default {
  // Name
  name: 'Dashboard',

  // Components
  components: {},

  // Mixins
  mixins: [],

  // Props
  props: {},

  // Data
  data () {
    return {
      msg: 'Hello World',
      test: undefined
    }
  },

  // Computed
  computed: {
    user () {
      return this.$store.state.user
    }
  },

  // Watch
  watch: {},

  // Created
  created () {},

  // Mounted
  mounted () {},

  // Methods
  methods: {
    async getUser () {
      try {
        const response = await Axios({
          method: 'get',
          url: '/api/user'
        })
        this.test = response.data.user
      } catch (error) {

      }
    }
  }
}
</script>

<style scoped lang="scss">
</style>
