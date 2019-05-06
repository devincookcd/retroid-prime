<template>
  <v-data-table
    :headers="headers"
    :items="boards"
    class="elevation-1 board-table"
    hide-actions
  >
    <template v-slot:items="props">
      <tr
        class="board-table__row"
        @click="$emit('board-click', props.item.url_hash)"
      >
        <td>{{ props.item.name }}</td>
        <!-- <td class="text-xs-right">
          {{ props.item.calories }}
        </td> -->
        <td class="text-xs-right">
          {{ props.item.created_at }}
        </td>
      </tr>
      <!-- <td class="text-xs-right">
        {{ props.item.carbs }}
      </td>
      <td class="text-xs-right">
        {{ props.item.protein }}
      </td>
      <td class="text-xs-right">
        {{ props.item.iron }}
      </td> -->
    </template>
  </v-data-table>
</template>

<script>
export default {
  // Name
  name: 'BoardTable',

  // Components
  components: {},

  // Mixins
  mixins: [],

  // Props
  props: {
    boards: {
      type: Array,
      default: undefined
    }

  },

  // Data
  data () {
    return {
      msg: 'Hello World',
      headers: [
        {
          text: 'Name',
          align: 'left',
          value: 'name'
        },
        { text: 'Created', value: 'created_at' }
      ]
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
.board-table {
  &__row {
    cursor: pointer;
  }
}
</style>
