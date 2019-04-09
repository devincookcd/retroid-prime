<template>
  <v-navigation-drawer
    :value="isOpen"
    fixed
    app
  >
    <v-list dense>
      <v-list-tile
        v-for="(item, index) in menu"
        :key="index"
        @click="$router.push(item.href)"
      >
        <v-list-tile-content>
          <v-list-tile-title>{{ item.text }}</v-list-tile-title>
        </v-list-tile-content>
      </v-list-tile>
      <!-- </v-list-tile> -->
    </v-list>
  </v-navigation-drawer>
</template>

<script>
export default {
  // Name
  name: 'TheNavDrawer',

  // Components
  components: {},

  // Mixins
  mixins: [],

  // Props
  props: {
    isOpen: {
      type: Boolean,
      default: true
    }
  },

  // Data
  data: () => ({
    drawer: null,
    drawerRight: null,
    right: false,
    left: true,
    menu: [{
      text: 'Login',
      href: '/'
    }, {
      text: 'Register',
      href: '/register'
    }]
  }),

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
