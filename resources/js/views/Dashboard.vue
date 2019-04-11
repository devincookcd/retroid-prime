<template>
  <div v-if="user">
    <h1>
      Dashboard
    </h1>
    Welcome Back {{ user.name }}
    <v-btn @click="getUser">
      Get User
    </v-btn>

    <div v-if="test">
      {{ test }}!!!!
    </div>
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
