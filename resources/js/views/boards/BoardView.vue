<template>
  <div v-if="user && board">
    <BoardName
      :name="board.name"
      :board-id="boardId"
      :is-editable="boardNameIsEditable"
      @edit="boardNameIsEditable = true"
      @edit-cancel="boardNameIsEditable = false"
      @update-board="board = $event"
    />

    <BoardControls
      :is-editable="boardColumnsEditable"
      :board-id="boardId"
      @toggle-editable="boardColumnsEditable = !boardColumnsEditable"
      @add-column="addColumn"
    />

    <v-container
      pa-0
      ma-0
      fluid
      grid-list-lg
    >
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
          :color="column.color"
          :column-id="column.id"
          :editable="boardColumnsEditable"
          @column-updated="updateColumn(index, $event)"
          @delete="removeColumn(index)"
        />
      </Draggable>
    </v-container>
  </div>
</template>

<script>
import Axios from 'axios'
import BoardColumn from '@/components/boards/BoardColumn'
import BoardControls from '@/components/boards/BoardControls'
import BoardName from '@/components/boards/BoardName'
import Draggable from 'vuedraggable'

export default {
  // Name
  name: 'BoardView',

  // Components
  components: {
    Draggable,
    BoardColumn,
    BoardControls,
    BoardName
  },

  // Data
  data: () => ({
    board: undefined,
    boardNameIsEditable: false,
    boardColumnsEditable: false
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
    addColumn (column) {
      this.board.columns.push(column)
    },

    removeColumn (index) {
      this.board.columns.splice(index, 1)
    },

    async reorderColumns () {
      let order = []
      this.board.columns.forEach(column => {
        order.push(column.id)
      })

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

    updateColumn (index, value) {
      this.$set(this.board.columns, index, value)
      // this.board.columns[index] = value
    }
  }
}
</script>

<style scoped lang="scss">
.columns {
  overflow-x: auto;
}
</style>
