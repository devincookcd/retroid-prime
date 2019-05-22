<template>
  <v-card
    class="board-item"
    :color="`${color} lighten-1`"
    flat
  >
    <v-card-text>
      <div
        v-if="!editable && !newItem"
        class="board-item__text"
      >
        {{ value }}
      </div>
      <v-textarea
        v-else
        box
        auto-grow
        hide-details
        rows="3"
        color="white"
        placeholder="Enter a note."
        :value="value"
        @input="$emit('input', $event)"
      />
    </v-card-text>

    <v-card-actions class="pt-0">
      <v-spacer />
      <div
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
      </div>
      <div
        v-else
        class="board-item__buttons"
      >
        <v-btn
          icon
          flat
          class="column__edit"
          @click="$emit('cancel')"
        >
          <v-icon>cancel</v-icon>
        </v-btn>
        <v-btn
          icon
          flat
          class="column__edit"
          @click="validateAndSave"
        >
          <v-icon>check</v-icon>
        </v-btn>
      </div>
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
    editable: {
      type: Boolean,
      default: false
    },
    value: {
      type: String,
      default: ''
    }
  },

  // Data
  data () {
    return {
      msg: 'Hello World'
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
    validateAndSave () {
      if (!this.value) return
      this.$emit('save')
    }
  }
}
</script>

<style scoped lang="scss">
</style>
