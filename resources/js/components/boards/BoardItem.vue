<template>
  <v-card
    :color="`${color} lighten-1`"
    flat
  >
    <v-card-text>
      <v-textarea
        :label="false"
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
        @click="$emit('save')"
      >
        <v-icon>check</v-icon>
      </v-btn>
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
    new: {
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
  methods: {}
}
</script>

<style scoped lang="scss">
</style>
