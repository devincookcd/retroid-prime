<template>
  <div v-if="user">
    <h1>
      New Retro Board
    </h1>
    <v-layout
      class="mt-4"
      wrap
    >
      <v-flex xs12>
        <v-text-field
          v-model="name"
          label="Board Name"
          color="white"
        />
      </v-flex>

      <v-flex
        xs12
        class="mb-2"
      >
        <h2>
          Columns

          <v-btn
            small
            color="primary"
            @click="addColumn"
          >
            Add Column
          </v-btn>
        </h2>
        <v-container
          pa-0
          ma-0
          fluid
          grid-list-lg
        >
          <v-layout
            class="columns"
          >
            <v-flex
              v-for="(column, index) in columns"
              :key="column.key"
              class="column"
              xs3
            >
              <v-text-field
                v-model="column.text"
                class="mb-0 column__title"
                placeholder="Title"
                :height="30"
                color="white"
              />
              <v-card
                :color="`${column.color} lighten-2`"
                class="mt-0"
              >
                <v-card-text>
                  <v-select
                    v-model="column.color"
                    :items="colors"
                    item-value="value"
                    item-text="text"
                    label="Color"
                    color="white"
                  />
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
            </v-flex>
          </v-layout>
        </v-container>
      </v-flex>
      <v-flex
        xs12
      >
        <v-btn
          class="ma-0"
          color="secondary"
          @click="createBoard()"
        >
          Create
          <v-icon right>
            check
          </v-icon>
        </v-btn>
      </v-flex>
    </v-layout>
  </div>
</template>

<script>
import Axios from 'axios'

export default {
  // Name
  name: 'Dashboard',

  // Data
  data: () => ({
    column: undefined,
    colors: [{
      text: 'Red',
      value: 'red'
    }, {
      text: 'Green',
      value: 'green'
    }, {
      text: 'Orange',
      value: 'orange'
    }, {
      text: 'Purple',
      value: 'purple'
    }, {
      text: 'Blue',
      value: 'blue'
    }],
    name: undefined,
    columns: [{
      text: 'Went Well',
      color: 'green',
      key: 'honk'
    }, {
      text: 'Needs Improvement',
      color: 'red',
      key: 'beep'
    }, {
      text: 'Action Items',
      color: 'purple',
      key: 'zoink'
    }],
    defaultColumn: {
      text: 'New Column',
      color: 'blue'
    }
  }),

  // Computed
  computed: {
    user () {
      return this.$store.state.user
    }
  },

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

    async createBoard () {
      try {
        await Axios({
          method: 'post',
          url: '/api/boards/create',
          data: {
            name: this.name
          }
        })
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
  &__title {
    max-height: 52px;
    font-weight: 500;
  }
}
</style>
