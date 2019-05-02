<template>
  <div v-if="user">
    <h2>
      My Retro Boards
    </h2>
    <v-layout
      class="mt-4"
      wrap
    >
      <v-flex xs12>
        <v-btn
          class="ma-0"
          color="secondary"
          href="/boards/create"
        >
          New Retro
          <v-icon right>
            add
          </v-icon>
        </v-btn>
      </v-flex>
      <v-flex
        xs12
      >
        You Don't have Any Retro Boards yet...
        <!-- <v-card
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
        </v-card> -->
      </v-flex>
    </v-layout>
  </div>
</template>

<script>
export default {
  // Name
  name: 'Dashboard',

  // Computed
  computed: {
    user () {
      return this.$store.state.user
    }
  }
}
</script>

<style scoped lang="scss">
</style>
