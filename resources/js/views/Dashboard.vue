<template>
  <div v-if="user">
    <h1>
      Dashboard
    </h1>

    <v-layout class="mt-4">
      <v-flex
        xs12
        sm8
        md3
      >
        <v-card
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
        </v-card>
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
