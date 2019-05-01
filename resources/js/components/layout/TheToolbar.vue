<template>
  <v-toolbar
    color="primary"
    dark
    fixed
    app
    clipped-right
  >
    <v-toolbar-side-icon
      @click="$emit('toggle')"
    />
    <v-toolbar-title>
      Retroid Prime
    </v-toolbar-title>

    <v-spacer />

    <v-toolbar-items>
      <v-menu
        v-if="user"
        offset-y
      >
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
            @click="handleClick(item)"
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

  // Data
  data () {
    return {
      userMenu: [{
        text: 'My Profile',
        icon: 'account_circle',
        href: '/profile'
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

  // Methods
  methods: {
    /**
     * Handle Click
     * handles the navigation items, if they have a method, call it. Otherwise, change route.
     * @param {Object} - item
     */
    handleClick (item) {
      if (typeof item.method === 'function') return item.method()
      if (item.href) return this.$router.push(item.href)
    },

    /**
     * Sign Out
     * Logs the user our of the api, emit a toast on success and remove the token.
     */
    async signOut () {
      try {
        const response = await Axios({
          method: 'get',
          url: '/api/logout'
        })

        this.$bus.$emit('toast', {
          text: response.data
        })
        this.$router.push('/')
        this.$store.commit('updateUser', undefined)
        localStorage.removeItem('token')
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
