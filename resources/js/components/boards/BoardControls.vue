<template>
  <div class="board-controls mb-2">
    <v-btn
      class="ma-0 mr-1"
      small
      color="secondary"
      @click="editColumnsToggle"
    >
      <span v-if="!isEditable">Edit Columns</span>
      <span v-else>Lock Columns</span>
    </v-btn>
    <v-btn
      class="ma-0"
      small
      color="success"
      :loading="loadingColumn"
      @click="createColumn"
    >
      New Column
    </v-btn>
  </div>
</template>

<script>
export default {
  // Name
  name: 'BoardControls',

  // Props
  props: {
    boardId: {
      type: Number,
      default: null
    },
    isEditable: {
      type: Boolean,
      default: false
    }
  },

  // Data
  data () {
    return {
      msg: 'Hello World',
      boardColumnsEditable: false,
      loadingColumn: false,
      defaultColumn: {
        name: 'New Column',
        color: 'blue'
      }
    }
  },

  // Methods
  methods: {
    async createColumn () {
      let column = { ...this.defaultColumn }

      try {
        this.loadingColumn = true
        const response = await this.$axios({
          url: '/api/columns/create',
          method: 'post',
          data: {
            color: column.color,
            name: column.name,
            board_id: this.boardId
          }
        })
        this.$emit('add-column', response.data.column)
      } catch (error) {
        console.warn(error)
      } finally {
        this.loadingColumn = false
      }
    },

    editColumnsToggle () {
      this.$emit('toggle-editable')
    }
  }
}
</script>

<style scoped lang="scss">
</style>
