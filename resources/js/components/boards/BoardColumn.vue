<template>
  <v-flex
    class="board-column"
    xs3
  >
    <v-card
      class="mt-0"
      flat
    >
      <v-system-bar
        v-if="editable"
        window
        color="blue-grey drag-handle"
      >
        <v-icon>drag_indicator</v-icon>
      </v-system-bar>
      <v-card-text>
        <div class="board-column__name mb-2">
          <div
            class="board-column__color"
            :class="displayColor"
          />

          <h2
            v-if="!nameEditable || !editable"
            class="board-column__title"
          >
            {{ name }}
          </h2>

          <div
            v-else
            class="board-column__fields"
          >
            <v-text-field
              class="board-column__name-field pa-0 ma-0 mr-2"
              hide-details
              height="36px"
              :value="nameTemp"
              color="white"
              :readonly="loading"
              :loading="loading"
              @input="updateColumnName"
            />
            <ColorSelect
              v-model="colorTemp"
            />
          </div>

          <div
            v-if="editable"
          >
            <div
              v-if="!nameEditable"
              class="d-flex"
            >
              <v-btn
                key="edit"
                icon
                flat
                class="board-column__edit ma-0 mr-1"
                @click="enableEditing"
              >
                <v-icon>edit</v-icon>
              </v-btn>
              <v-btn
                key="drag"
                icon
                flat
                class="board-column__edit ma-0"
                @click="showDeleteDialog = true"
              >
                <v-icon>delete</v-icon>
              </v-btn>
            </div>
            <div
              v-else
              class="d-flex"
            >
              <v-btn
                key="cancel"
                icon
                flat
                class="board-column__edit ma-0 mr-1"
                @click="cancelEditing"
              >
                <v-icon>cancel</v-icon>
              </v-btn>
              <v-btn
                key="save"
                icon
                flat
                class="board-column__edit ma-0"
                @click="saveColumn"
              >
                <v-icon>save</v-icon>
              </v-btn>
            </div>
          </div>
        </div>

        <v-btn
          v-if="!showNewItem"
          outline
          block
          class="ma-0"
          @click="showNewItem = true"
        >
          <v-icon>add</v-icon>
        </v-btn>
        <BoardItem
          v-else
          v-model="newBoardItem"
          :column-id="columnId"
          :board-id="boardId"
          :color="color"
          new-item
          @item-created="handleItemCreated"

          @cancel="cancelNewItem"
        />

        <div
          v-if="items.length > 0"
          class="board-column__items mt-3"
        >
          <BoardItem
            v-for="item in items"
            :key="item.id"
            :value="item.text"
            :item-id="item.id"
            :column-id="columnId"
            :board-id="boardId"
            :color="color"
            @item-updated="handleItemUpdated"
            @cancel="cancelNewItem"
          />
          <!-- :editable="item.editable" -->
        </div>
      </v-card-text>
    </v-card>

    <BoardColumnDeleteDialog
      v-model="showDeleteDialog"
      :column-name="name"
      :column-id="columnId"
      @input="showDeleteDialog = $event"
      @hide="showDeleteDialog = false"
      @delete="$emit('delete')"
    />
  </v-flex>
</template>

<script>
// import Axios from 'axios'
import BoardColumnDeleteDialog from '@/components/dialogs/BoardColumnDeleteDialog'
import BoardItem from '@/components/boards/BoardItem'
import ColorSelect from '@/components/inputs/ColorSelect'
export default {
  // Name
  name: 'BoardColumn',

  // Components
  components: {
    BoardColumnDeleteDialog,
    BoardItem,
    ColorSelect
  },

  // Props
  props: {
    name: {
      type: String,
      default: ''
    },
    columnId: {
      type: Number,
      default: null
    },
    boardId: {
      type: Number,
      default: null
    },
    color: {
      type: String,
      default: ''
    },
    editable: {
      type: Boolean,
      default: false
    },
    items: {
      type: Array,
      default: () => []
    }
  },

  // Data
  data () {
    return {
      nameEditable: false,
      loading: false,
      colorTemp: undefined,
      nameTemp: undefined,
      newBoardItem: undefined,
      showNewItem: false,
      showDeleteDialog: false
    }
  },

  // Computed
  computed: {
    displayColor () {
      return !this.nameEditable ? this.color : this.colorTemp
    }
  },

  // Methods
  methods: {
    enableEditing () {
      this.nameEditable = true
      this.nameTemp = this.name
      this.colorTemp = this.color
    },

    cancelEditing () {
      this.nameEditable = false
    },

    cancelNewItem () {
      this.newBoardItem = undefined
      this.showNewItem = false
    },

    updateColumnName (value) {
      this.nameTemp = value
    },

    handleItemCreated (item) {
      this.showNewItem = false
      this.$emit('item-created', item)
    },

    handleItemUpdated (item) {
      // this.showNewItem = false
      this.$emit('item-updated', item)
    },

    async saveColumn () {
      if (this.nameTemp === this.name && this.colorTemp === this.color) {
        this.cancelEditing()
        return
      }
      this.loading = true
      try {
        const response = await this.$axios({
          url: `/api/columns/update/${this.columnId}`,
          method: 'patch',
          data: {
            name: this.nameTemp,
            color: this.colorTemp
          }
        })
        this.$emit('column-updated', response.data.column)
        this.nameEditable = false
      } catch (error) {
        console.warn(error)
      } finally {
        this.loading = false
      }
    }
  }
}
</script>

<style scoped lang="scss">
.board-column {
  min-width: 25%;
  width: 100%;
  max-width: 100%;
  flex-grow: 1;

  &__title {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    flex-grow: 1;
  }

  &__color {
    width: 24px;
    min-width: 24px;
    height: 24px;
    margin-right: 8px;
    border-radius: 5px;
    border: 1px solid #252525;
  }

  &__name {
    display: flex;
    flex-direction: row;
  }

  &__edit {
    max-width: 36px;
    min-width: 36px;
  }

  &__fields {
    flex-grow: 1;
  }

  &__name-field {
    position: relative;
    font-size: 21px;
    font-weight: 700;
    top: -3px;
  }

  &__icon {
    cursor: pointer;
    border-radius: 50%;
  }
}

.drag-handle {
  cursor: move;
}
</style>

<style>
.v-textarea.v-text-field--enclosed textarea {
  margin-top: 0;
}
</style>
