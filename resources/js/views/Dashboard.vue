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
          to="/boards/create"
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
        <div class="text-xs-center pa-2">
          <v-progress-circular
            v-if="loading"
            indeterminate
          />
        </div>
        <div
          v-if="!boards && !loading"
        >
          You Don't have Any Retro Boards yet...
        </div>
        <!-- {{ boards }} -->

        <BoardTable
          v-if="boards"
          color="white"
          :boards="boards"
          @board-click="handleBoardClick"
        />
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
  <!-- </div> -->
  </div>
</template>

<script>
// import Axios from 'axios'
import BoardTable from './boards/BoardTable'

export default {
  // Name
  name: 'Dashboard',

  // Components
  components: {
    BoardTable
  },

  // Data
  data: () => ({
    boards: undefined,
    loading: false
  }),

  // Computed
  computed: {
    user () {
      return this.$store.state.user
    }
  },

  watch: {
    user: {
      handler (newVal, oldVal) {
        console.log(newVal, oldVal)
        this.getBoards()
      },
      immediate: true
    }
  },

  created () {
  },

  methods: {
    async getBoards () {
      try {
        // console.log(Axios.defaults.headers.common['Authorization'])
        this.loading = true

        const response = await this.$axios({
          method: 'get',
          url: '/api/user/boards'
        })

        this.boards = response.data.boards
      } catch (error) {

      } finally {
        this.loading = false
      }
    },

    handleBoardClick (hash) {
      console.log(hash)
      this.$router.push({
        path: `/boards/${hash}`
      })
    }
  }
}
</script>

<style scoped lang="scss">
</style>
