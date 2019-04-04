<template>
  <div id="app">
    <v-app id="v-app">
      <the-toolbar
        @toggle="showNav = !showNav"
      />
      <the-nav-drawer
        :is-open="showNav"
      />
    </v-app>
    <!-- <FontAwsomeIcon
      icon="check-circle"
    /> -->
    <!-- <router-view/> -->
  </div>
</template>

<script>
import TheNavDrawer from './components/layout/TheNavDrawer'
import TheToolbar from './components/layout/TheToolbar'

export default {
  components: {
    TheNavDrawer,
    TheToolbar
  },

  data: () => ({
    showNav: true
  })
}
</script>

<style lang="scss">
</style>
