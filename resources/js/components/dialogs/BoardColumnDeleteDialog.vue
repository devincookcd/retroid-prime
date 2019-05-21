<template>
  <v-dialog
    :value="value"
    max-width="290"
    @input="$emit('input', $event)"
  >
    <v-card>
      <v-card-title class="headline">
        Delete Column
      </v-card-title>

      <v-card-text>
        Are you sure you want do delete the <strong>{{ columnName }}</strong> column?
      </v-card-text>

      <v-card-actions>
        <v-spacer />

        <v-btn
          color=""
          flat="flat"
          :disabled="loading"
          @click="$emit('hide')"
        >
          Cancel
        </v-btn>

        <v-btn
          color="error"
          flat="flat"
          :loading="loading"
          @click="deleteColumn"
        >
          Delete
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  // Name
  name: 'BoardColumnDeleteDialog',

  // Props
  props: {
    value: {
      type: Boolean,
      default: false
    },
    columnName: {
      type: String,
      default: ''
    },
    columnId: {
      type: Number,
      default: null
    }
  },

  // Data
  data () {
    return {
      loading: false
    }
  },

  // Computed
  computed: {
    deleteUrl () {
      return `/api/columns/delete/${this.columnId}`
    }
  },

  // Methods
  methods: {
    async deleteColumn () {
      if (!this.columnId) return
      try {
        this.loading = true
        await this.$axios({
          method: 'delete',
          url: this.deleteUrl
        })

        this.$bus.$emit('toast', {
          text: 'Column Removed.'
        })

        this.$emit('hide')
        this.$emit('delete')
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
</style>
