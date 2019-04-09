<template>
  <div>
    Welcome Back {{ user.name }}
  </div>
</template>

<script>
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
      msg: 'Hello World'
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
  methods: {}
}
</script>

<style scoped lang="scss">
</style>
