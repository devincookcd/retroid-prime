<template>
  <v-card
    class="board-item mb-3"
    :color="`${color} lighten-1`"
    flat
  >
    <v-card-text>
      <div
        v-if="!editable && !newItem"
        class="board-item__text"
      >
        <p>{{ value }}</p>
        <!-- <div> -->
        <v-btn
          icon
          flat
          class="board-item__edit ma-0"
          @click="enableEdit"
        >
          <v-icon>edit</v-icon>
        </v-btn>
        <!-- </div> -->
      </div>
      <v-textarea
        v-else
        v-model="valueTemp"
        box
        auto-grow
        hide-details
        rows="3"
        color="white"
        placeholder="Enter a note."
      />
    </v-card-text>

    <v-card-actions
      v-if="editable || newItem"
      class="pt-0"
    >
      <v-spacer />
      <!-- <div
        v-if="!editable && !newItem"
        class="board-item__buttons"
      >
        <v-btn
          icon
          flat
          class="column__edit"
          @click="$emit('cancel')"
        >
          <v-icon>edit</v-icon>
        </v-btn>
      </div> -->
      <!-- <div
        v-else
        class="board-item__buttons"
      > -->
      <v-btn
        icon
        flat
        class="column__edit"
        :disabled="loading"
        @click="cancelEdit"
      >
        <v-icon>cancel</v-icon>
      </v-btn>
      <v-btn
        icon
        flat
        class="column__edit"
        :loading="loading"
        @click="validateAndSave"
      >
        <v-icon>check</v-icon>
      </v-btn>
      <!-- </div> -->
    </v-card-actions>
  </v-card>
</template>

<script>
export default {
  // Name
  name: 'BoardItem',

  // Components
  components: {},

  // Mixins
  mixins: [],

  // Props
  props: {
    color: {
      type: String,
      default: 'blue-grey'
    },
    newItem: {
      type: Boolean,
      default: false
    },
    // editable: {
    //   type: Boolean,
    //   default: false
    // },
    boardId: {
      type: Number,
      default: null
    },
    columnId: {
      type: Number,
      default: null
    },
    itemId: {
      type: Number,
      default: null
    },
    value: {
      type: String,
      default: ''
    }
  },

  // Data
  data () {
    return {
      msg: 'Hello World',
      // itemId: undefined,
      valueTemp: undefined,
      editable: false,
      loading: false
    }
  },

  // Computed
  computed: {},

  // Watch
  watch: {},

  // Created
  created () {},

  // Mounted
  mounted () {
    this.valueTemp = this.value
  },

  // Methods
  methods: {
    validateAndSave () {
      if (!this.valueTemp) return
      if (this.newItem) {
        this.createItem()
      } else {
        this.updateItem()
      }
      // this.$emit('save')
    },

    enableEdit () {
      this.valueTemp = this.value
      this.editable = true
    },

    cancelEdit () {
      this.valueTemp = undefined
      this.editable = false
      this.$emit('cancel')
    },

    async createItem () {
      this.loading = true
      try {
        const response = await this.$axios({
          url: '/api/items/create',
          method: 'post',
          data: {
            text: this.valueTemp,
            board_id: this.boardId,
            board_column_id: this.columnId
          }
        })
        this.$emit('item-created', response.data.item)
      } catch (error) {
        console.warn(error)
      } finally {
        this.loading = false
      }
    },

    async updateItem () {
      this.loading = true
      try {
        const response = await this.$axios({
          url: `/api/items/update/${this.itemId}`,
          method: 'patch',
          data: {
            text: this.valueTemp
          }
        })
        this.editable = false
        this.valueTemp = undefined
        this.$emit('item-updated', response.data.item)
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
.board-item {
  &__text {
    display: flex;
    justify-content: space-between;
  }

  &__edit {
    flex-grow: 0;
  }
}
</style>
