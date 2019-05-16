<template>
  <v-flex
    class="column"
    xs3
  >
    <v-card
      class="mt-0"
      flat
    >
      <v-card-text>
        <div class="d-flex mb-2">
          <h2>{{ column.name }}</h2>
          <!-- <v-spacer /> -->
          <v-btn
            icon
            flat
            class="column__edit ma-0"
          >
            <v-icon>edit</v-icon>
          </v-btn>
          <v-btn
            icon
            flat
            class="column__edit ma-0"
          >
            <v-icon>add</v-icon>
          </v-btn>
        </div>
        <v-card
          :color="`${column.color} lighten-1`"
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
        </v-card>
      </v-card-text>
      <v-card-actions>
        <v-spacer />
        <v-btn
          icon
          @click="removeColumn(index)"
        >
          <v-icon>
            delete
          </v-icon>
        </v-btn>
      </v-card-actions>
    </v-card>
  </v-flex>
</template>

<script>
export default {
  // Name
  name: 'Component',

  // Components
  components: {},

  // Mixins
  mixins: [],

  // Props
  props: {},

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
