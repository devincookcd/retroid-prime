<template>
  <div v-if="user">
    <h1>
      View Board...
    </h1>
    <v-layout
      class="mt-4"
      wrap
    >
      Test
      <v-btn
        @click="getBoard"
      >
        Test
      </v-btn>
    </v-layout>
  </div>
</template>

<script>
import Axios from 'axios'

export default {
  // Name
  name: 'Dashboard',

  // Data
  data: () => ({
  }),

  // Computed
  computed: {
    user () {
      return this.$store.state.user
    }
  },

  // Methods
  methods: {
    addColumn () {
      let column = { ...this.defaultColumn }
      column.key = this.getRandomHash()
      this.columns.push(column)
    },

    removeColumn (index) {
      this.columns.splice(index, 1)
    },

    getRandomHash () {
      return window.crypto.getRandomValues(new Uint32Array(1))[0]
    },

    async getBoard () {
      const hash = this.$route.params.hash

      try {
        await Axios({
          method: 'get',
          url: `/api/boards/view/${hash}`
        })
      } catch (error) {

      }
    }
  }
}
</script>

<style scoped lang="scss">
.columns {
  overflow-x: auto;
}
.column {
  min-width: 25%;
  &__title {
    max-height: 52px;
    font-weight: 500;
  }
}
</style>
