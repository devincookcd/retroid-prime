<template>
  <div class="board-name">
    <h1 v-if="!isEditable">
      <span class="board-name__text mr-2">{{ name }}</span>
    </h1>

    <v-text-field
      v-else
      class="board-name__field pa-0 ma-0 mr-2 mb-4"
      hide-details
      :value="boardNameTemp"
      color="white"
      :readonly="loading"
      :loading="loading"
      @input="updateBoardName"
    />

    <span v-if="!isEditable">
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
        :disabled="loading"
        class="board-name__edit ma-0"
        @click="cancelEditBoardName"
      >
        <v-icon>cancel</v-icon>
      </v-btn>
      <v-btn
        key="save"
        icon
        flat
        :disabled="loading"
        class="board-name__edit ma-0"
        @click="saveBoardName"
      >
        <v-icon>save</v-icon>
      </v-btn>
    </span>
  </div>
</template>

<script>
export default {
  // Name
  name: 'BoardName',

  // Props
  props: {
    isEditable: {
      type: Boolean,
      default: false
    },
    boardId: {
      type: Number,
      default: null
    },
    name: {
      type: String,
      default: ''
    }
  },

  // Data
  data () {
    return {
      boardNameTemp: undefined,
      loading: false
    }
  },
  // Methods
  methods: {
    editBoardName () {
      this.boardNameTemp = this.name
      this.$emit('edit')
    },

    cancelEditBoardName () {
      this.$emit('edit-cancel')
    },

    async saveBoardName () {
      try {
        if (this.boardNameTemp === this.name) return
        this.loading = true
        const response = await this.$axios({
          url: `/api/boards/update/${this.boardId}`,
          method: 'patch',
          data: {
            name: this.boardNameTemp
          }
        })
        this.$emit('update-board', response.data.board)
      } catch (error) {
        console.warn(error)
      } finally {
        this.$emit('edit-cancel')
        this.loading = false
      }
    },

    updateBoardName (value) {
      this.boardNameTemp = value
    }
  }
}
</script>

<style scoped lang="scss">
.board-name {
  display: flex;
  align-items: flex-start;
  height: 56px;

  &:hover .board-name__edit {
    display: block;
  }

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

  &__edit {
    display: none;
  }
}
</style>
