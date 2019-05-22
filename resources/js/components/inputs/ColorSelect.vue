<template>
  <v-select
    :value="value"
    :items="colors"
    item-value="value"
    item-text="text"
    label="Color"
    color="white"
    @input="$emit('input', $event)"
  />
</template>

<script>
export default {
  // Name
  name: 'ColorSelect',

  // Components
  components: {},

  // Mixins
  mixins: [],

  // Props
  props: {
    value: {
      type: String,
      default: 'Red'
    }
  },

  // Data
  data () {
    return {
      // msg: 'Hello World',
      colors: [{
        text: 'Red',
        value: 'red'
      }, {
        text: 'Green',
        value: 'green'
      }, {
        text: 'Orange',
        value: 'orange'
      }, {
        text: 'Purple',
        value: 'purple'
      }, {
        text: 'Blue',
        value: 'blue'
      }]
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
