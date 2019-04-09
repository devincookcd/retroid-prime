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
    <v-toolbar-items>
      <v-menu offset-y>
        <template v-slot:activator="{ on }">
          <v-btn
            class="toolbar__button"
            flat
            small
            v-on="on"
          >
            <v-avatar
              size="36px"
              color="grey lighten-1"
            >
              <v-icon dark>
                person
              </v-icon>
            </v-avatar>
          </v-btn>
        </template>

        <v-list>
          <v-list-tile
            v-for="(item, index) in userMenu"
            :key="index"
            @click="item.method"
          >
            <v-list-tile-content>
              <v-list-tile-title>{{ item.text }}</v-list-tile-title>
            </v-list-tile-content>
            <v-list-tile-action>
              <v-icon>
                {{ item.icon }}
              </v-icon>
            </v-list-tile-action>
          </v-list-tile>
        </v-list>
      </v-menu>
    </v-toolbar-items>
  </v-toolbar>
</template>

<script>
import Axios from 'axios'

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
      userMenu: [{
        text: 'My Profile',
        icon: 'account_circle',
        method: this.signOut
      }, {
        text: 'Sign Out',
        icon: 'exit_to_app',
        method: this.signOut
      }]
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
  mounted () {
  },

  // Methods
  methods: {
    async signOut () {
      try {
        await Axios({
          method: 'post',
          url: '/logout'
        })
        this.$router.push('/')
      } catch (error) {
        console.warn(error)
      }
    }
  }
}
</script>

<style scoped lang="scss">
.toolbar {
  &__button {
    min-width: 64px;
  }
}
</style>
