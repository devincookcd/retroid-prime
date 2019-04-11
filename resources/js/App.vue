<template>
  <div id="app">
    <v-app id="v-app">
      <the-toolbar
        @toggle="showNav = !showNav"
      />
      <the-nav-drawer
        :is-open="showNav"
      />

      <v-content>
        <v-container fluid>
          <router-view />
        </v-container>
      </v-content>
      <TheToaster />
    </v-app>

    <ValidateToken />
    <!-- <FontAwsomeIcon
      icon="check-circle"
    /> -->
    <!-- <router-view/> -->
  </div>
</template>

<script>
import TheNavDrawer from './components/layout/TheNavDrawer'
import TheToolbar from './components/layout/TheToolbar'
import TheToaster from '@/components/layout/TheToaster'
import ValidateToken from '@/components/passport/ValidateToken'

export default {
  components: {
    TheNavDrawer,
    TheToolbar,
    TheToaster,
    ValidateToken
  },

  data: () => ({
    showNav: true
  })
}
</script>

<style lang="scss">
</style>
