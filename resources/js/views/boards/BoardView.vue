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
          :board-id="boardId"
          :column-id="column.id"
          :items="column.items"
          :editable="boardColumnsEditable"
          @column-updated="updateColumn(index, $event)"
          @item-created="addItem(column.id, $event)"
          @item-updated="updateItem(column.id, $event)"
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

    addItem (columnId, item) {
      const column = this.board.columns.find(column => column.id === columnId)
      column.items.push(item)
      // console.log(columnId)
      // console.log(item)
      // console.log(column)
      // column.items.push(item)
      // console.log(item)
      // console.log(column)
    },

    updateItem (columnId, item) {
      console.log('update item!')
      const column = this.board.columns.find(column => column.id === columnId)
      const itemIndex = column.items.findIndex(itemObject => itemObject.id === item.id)
      this.$set(column.items, itemIndex, item)
      // column.items.push(item)
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

    // async createItem () {
    //   try {
    //     await this.$axios({
    //       url: '/api/items/create',
    //       method: 'post',
    //       data: {
    //         text: this.newBoardItem,
    //         board_id: this.boardId,
    //         board_column_id: this.columnId
    //       }
    //     })
    //   } catch (error) {
    //     console.warn(error)
    //   }
    // },

    updateColumn (index, value) {
      this.$set(this.board.columns, index, value)
      // this.board.columns[index] = value
    },

    editBoardItem (item) {
      // const newItems = this.board.columns.items.find(boardItem => boardItem.id === item.id)
      // console.log(item)
      // item.editable = true
      // console.log(newItems)
    }
  }
}
</script>

<style scoped lang="scss">
.columns {
  overflow-x: auto;
}
</style>
