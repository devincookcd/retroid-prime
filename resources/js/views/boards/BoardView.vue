<template>
  <div v-if="user && board">
    <h1>
      {{ board.name }}
      <!-- View Board -->
    </h1>

    <v-container
      pa-0
      ma-0
      fluid
      grid-list-lg
    >
      <v-layout
        class="columns"
      >
        <BoardColumn
          v-for="(column, index) in board.columns"
          :key="index"
          :name="column.name"
          :column-id="column.id"
        />
        <!-- <v-flex
          v-for="(column, index) in board.columns"
          :key="index"
          class="column"
          xs3
        >
          <v-card
            class="mt-0"
            flat
          >
            <v-card-text>
              <div class="d-flex mb-2">
                <h2>{{ column.name }}</h2>
                <v-btn
                  icon
                  flat
                  class="column__edit ma-0"
                >
                  <v-icon>edit</v-icon>
                </v-btn>
                <v-btn
                  icon
                  flat
                  class="column__edit ma-0"
                >
                  <v-icon>add</v-icon>
                </v-btn>
              </div>
              <v-card
                :color="`${column.color} lighten-1`"
                flat
              >
                <v-card-text>
                  <v-textarea
                    box
                    auto-grow
                    hide-details
                    color="white"
                    value="The Woodman set to work at once, and so sharp was his axe that the tree was soon chopped nearly through."
                  />
                </v-card-text>

                <v-card-actions>
                  <v-spacer />
                  <v-btn
                    icon
                    flat
                    class="column__edit ma-0"
                  >
                    <v-icon>edit</v-icon>
                  </v-btn>
                </v-card-actions>
              </v-card>
            </v-card-text>
            <v-card-actions>
              <v-spacer />
              <v-btn
                icon
                @click="removeColumn(index)"
              >
                <v-icon>
                  delete
                </v-icon>
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-flex> -->
      </v-layout>
    </v-container>
  </div>
</template>

<script>
import Axios from 'axios'
import BoardColumn from '@/components/boards/BoardColumn'

export default {
  // Name
  name: 'BoardView',

  components: {
    BoardColumn
  },

  // Data
  data: () => ({
    board: undefined
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
        if (!newVal) return
        console.log(newVal, oldVal)
        this.getBoard()
      },
      immediate: true
    }
  },

  // created () {
  //   this.getBoard()
  // },

  // Methods
  methods: {
    addColumn () {
      let column = { ...this.defaultColumn }
      column.key = this.getRandomHash()
      this.columns.push(column)
    },

    removeColumn (index) {
      this.columns.splice(index, 1)
    },

    getRandomHash () {
      return window.crypto.getRandomValues(new Uint32Array(1))[0]
    },

    async getBoard () {
      const hash = this.$route.params.hash

      try {
        const response = await Axios({
          method: 'get',
          url: `/api/boards/view/${hash}`
        })

        this.board = response.data.board
      } catch (error) {

      }
    }
  }
}
</script>

<style scoped lang="scss">
.columns {
  overflow-x: auto;
}
.column {
  min-width: 25%;
  width: 100%;
  max-width: 100%;
  flex-grow: 1;
  // box-shadow: 0 0 3px 3px inset rgba(255, 255, 255, .5);
  // margin: 0 4px;
  // background-color: rgba(255, 255, 255, .10);

  // border-right: 1px solid #fff;

  &__title {
    // max-height: 52px;
    font-weight: 500;
  }

  &__edit {
    max-width: 36px;
  }
}
</style>
