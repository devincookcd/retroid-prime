<template>
  <v-navigation-drawer
    :value="isOpen"
    fixed
    app
  >
    <v-list dense>
      <v-list-tile @click.stop="left = !left">
        <!-- <v-list-tile-action>
          <v-icon>book</v-icon>
        </v-list-tile-action> -->
        <v-list-tile-content>
          <v-list-tile-title>Blog Posts</v-list-tile-title>
        </v-list-tile-content>
      </v-list-tile>

      <v-list-tile @click.stop="left = !left">
        <v-list-tile-content>
          <v-list-tile-title>News Articles</v-list-tile-title>
        </v-list-tile-content>
      </v-list-tile>

      <v-list-tile @click.stop="left = !left">
        <v-list-tile-content>
          <v-list-tile-title>SEO Articles</v-list-tile-title>
        </v-list-tile-content>
      </v-list-tile>

      <v-list-tile @click.stop="left = !left">
        <v-list-tile-content>
          <v-list-tile-title>Awards</v-list-tile-title>
        </v-list-tile-content>
      </v-list-tile>

      <v-list-tile @click.stop="left = !left">
        <v-list-tile-content>
          <v-list-tile-title>Categories</v-list-tile-title>
        </v-list-tile-content>
      </v-list-tile>
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
    left: true
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
