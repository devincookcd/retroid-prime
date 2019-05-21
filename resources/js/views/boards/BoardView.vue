<template>
  <div v-if="user && board">
    <div class="board-name">
      <h1 v-if="!boardNameIsEditable">
        <span class="board-name__text mr-2">{{ board.name }}</span>
      </h1>

      <v-text-field
        v-else
        class="board-name__field pa-0 ma-0 mr-2 mb-4"
        hide-details
        :value="boardNameTemp"
        color="white"
        :readonly="loadingBoardName"
        :loading="loadingBoardName"
        @input="updateBoardName"
      />

      <span v-if="!boardNameIsEditable">
        <v-btn
          key="edit"
          icon
          flat
          class="board-name__edit ma-0"
          @click="editBoardName"
        >
          <v-icon>edit</v-icon>
        </v-btn>
      </span>

      <span v-else>
        <v-btn
          key="cancel"
          icon
          flat
          class="board-name__edit ma-0"
          @click="cancelEditBoardName"
        >
          <v-icon>cancel</v-icon>
        </v-btn>
        <v-btn
          key="save"
          icon
          flat
          class="board-name__edit ma-0"
          @click="saveBoardName"
        >
          <v-icon>save</v-icon>
        </v-btn>
      </span>
    </div>

    <div class="board-controls mb-2">
      <v-btn
        class="ma-0"
        small
        color="secondary"
        @click="createColumn"
      >
        Edit Columns
      </v-btn>
    </div>

    <v-container
      pa-0
      ma-0
      fluid
      grid-list-lg
    >
      <!-- <v-layout
        class="columns"
      > -->
      <Draggable
        v-model="board.columns"
        tag="v-layout"
        class="columns"
        handle=".drag-handle"
        @end="reorderColumns"
      >
        <BoardColumn
          v-for="(column, index) in board.columns"
          :key="index"
          :name="column.name"
          :column-id="column.id"
          @name-updated="updateColumnName(index, $event)"
        />
      </Draggable>
      <!-- </v-layout> -->
    </v-container>
  </div>
</template>

<script>
import Axios from 'axios'
import BoardColumn from '@/components/boards/BoardColumn'
import Draggable from 'vuedraggable'

export default {
  // Name
  name: 'BoardView',

  // Components
  components: {
    Draggable,
    BoardColumn
  },

  // Data
  data: () => ({
    board: undefined,
    boardNameIsEditable: false,
    boardNameTemp: undefined,
    loadingBoardName: false,
    loadingColumn: false,
    defaultColumn: {
      name: 'New Column',
      color: 'blue'
    }
  }),

  // Computed
  computed: {
    user () {
      return this.$store.state.user
    },

    boardId () {
      if (!this.board) return
      return this.board.id
    }
  },

  // Watch
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

  // Methods
  methods: {
    async createColumn () {
      let column = { ...this.defaultColumn }
      column.order = this.board.columns.length

      try {
        this.loadingColumn = true
        const response = await this.$axios({
          url: '/api/columns/create',
          method: 'post',
          data: {
            color: column.color,
            name: column.name,
            order: column.order,
            board_id: this.board.id
          }
        })
        this.board.columns.push(response.data.column)
      } catch (error) {
        console.warn(error)
      } finally {
        this.loadingColumn = false
      }
    },

    removeColumn (index) {
      this.columns.splice(index, 1)
    },

    async reorderColumns () {
      let order = []
      this.board.columns.forEach(column => {
        order.push(column.id)
        // return element
      })
      console.log(order)

      try {
        const response = await this.$axios({
          url: '/api/columns/reorder',
          method: 'patch',
          data: {
            order
          }
        })
        console.log(response)
      } catch (error) {

      }
    },

    editBoardName () {
      this.boardNameTemp = this.board.name
      this.boardNameIsEditable = true
    },

    cancelEditBoardName () {
      this.boardNameIsEditable = false
    },

    async saveBoardName () {
      try {
        if (this.boardNameTemp === this.board.name) return
        this.loadingBoardName = true
        const response = await this.$axios({
          url: `/api/boards/update/${this.boardId}`,
          method: 'patch',
          data: {
            name: this.boardNameTemp
          }
        })
        this.board = response.data.board
      } catch (error) {
        console.warn(error)
      } finally {
        this.boardNameIsEditable = false
        this.loading = false
      }
      // this.boardNameTemp = value
    },

    updateBoardName (value) {
      this.boardNameTemp = value
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
    },

    updateColumnName (index, value) {
      this.board.columns[index].name = value
    }
  }
}
</script>

<style scoped lang="scss">
.board-name {
  display: flex;
  align-items: flex-start;
  height: 56px;

  &__text {
    max-width: 500px;
    text-overflow: ellipsis;
    display: inline-block;
    overflow: hidden;
    white-space: nowrap;
  }

  &__field {
    max-width: 500px;
    font-size: 2em;
    font-weight: bold;
    position: relative;
    top: 5px;
    text-rendering: optimizelegibility;
  }
}

.columns {
  overflow-x: auto;
}
</style>
