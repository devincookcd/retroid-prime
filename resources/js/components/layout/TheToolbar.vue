<template>
  <v-toolbar
    color="primary"
    dark
    fixed
    app
    clipped-right
  >
    <v-toolbar-side-icon @click="$emit('toggle')" />
    <v-toolbar-title>Toolbar</v-toolbar-title>
    <v-spacer />
  </v-toolbar>
</template>

<script>
export default {
  // Name
  name: 'TheToolbar',

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
  computed: {},

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
