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
          <h2
            v-if="!nameEditable"
            class="board-column__title"
          >
            {{ name }}
          </h2>

          <v-text-field
            v-else
            class="board-column__name-field pa-0 ma-0 mr-2"
            hide-details
            height="36px"
            :value="nameTemp"
            color="white"
            :readonly="loading"
            :loading="loading"
            @input="updateColumnName"
          />

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
                @click="saveBoardName"
              >
                <v-icon>save</v-icon>
              </v-btn>
            </div>
          </div>
        </div>

        <v-btn
          outline
          block
          class="ma-0"
        >
          <v-icon>add</v-icon>
        </v-btn>

        <!-- <div class="text-xs-center mt-4">
          No Items Yet
        </div> -->
        <!-- <v-card
          :color="`${color} lighten-1`"
          flat
        >
          <v-card-text>
            <v-textarea
              :label="false"
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
        </v-card> -->
      </v-card-text>
      <!-- <v-card-actions>
        <v-spacer />
        <v-btn
          icon
          @click="removeColumn(index)"
        >
          <v-icon>
            delete
          </v-icon>
        </v-btn>
      </v-card-actions> -->
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

export default {
  // Name
  name: 'BoardColumn',

  // Components
  components: {
    BoardColumnDeleteDialog
  },

  // Mixins
  mixins: [],

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
    color: {
      type: String,
      default: ''
    },
    editable: {
      type: Boolean,
      default: false
    }
  },

  // Data
  data () {
    return {
      nameEditable: false,
      loading: false,
      nameTemp: undefined,
      showDeleteDialog: false
    }
  },

  // Computed
  computed: {},

  // Watch
  watch: {},

  // Created
  created () {},

  // Mounted
  mounted () {},

  // Methods
  methods: {
    enableEditing () {
      this.nameEditable = true
      this.nameTemp = this.name
    },

    cancelEditing () {
      this.nameEditable = false
    },

    updateColumnName (value) {
      this.nameTemp = value
    },

    async saveBoardName () {
      if (this.nameTemp === this.name) {
        this.cancelEditing()
        return
      }
      this.loading = true
      try {
        const response = await this.$axios({
          url: `/api/columns/update/${this.columnId}`,
          method: 'patch',
          data: {
            name: this.nameTemp
          }
        })
        this.$emit('name-updated', response.data.column.name)
        this.nameEditable = false
      } catch (error) {
        console.warn(error)
      } finally {
        this.loading = false
      }
    }

    // handleDelete (board) {
    //   this.$emit('delete')
    // }
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

  &__name {
    display: flex;
    flex-direction: row;
  }

  &__edit {
    max-width: 36px;
    min-width: 36px;
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
