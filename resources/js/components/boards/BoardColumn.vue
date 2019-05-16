<template>
  <v-flex
    class="board-column"
    xs3
  >
    <v-card
      class="mt-0"
      flat
    >
      <v-card-text>
        <div class="d-flex mb-2">
          <h2
            v-if="!editable"
          >
            {{ name }}
          </h2>

          <!-- solo-inverted
            flat -->
          <v-text-field
            v-else
            class="board-column__name-field pa-0 ma-0 mr-2"
            hide-details
            height="36px"
            :value="nameTemp"
            color="white"
            @input="updateColumnName"
          />
          <!-- <v-input
            loading
            value="test"
          >
            Default Slot
          </v-input> -->
          <!-- <v-spacer /> -->
          <v-btn
            v-if="!editable"
            key="edit"
            icon
            flat
            class="board-column__edit ma-0 mr-1"
            @click="enableEditing"
          >
            <v-icon>edit</v-icon>
          </v-btn>
          <v-btn
            v-if="editable"
            key="cancel"
            icon
            flat
            class="board-column__edit ma-0 mr-1"
            @click="cancelEditing"
          >
            <v-icon>cancel</v-icon>
          </v-btn>
          <v-btn
            v-if="editable"
            key="save"
            icon
            flat
            class="board-column__edit ma-0 mr-1"
            @click="saveBoardName"
          >
            <v-icon>save</v-icon>
          </v-btn>
          <!-- <v-btn
            icon
            flat
            class="board-column__edit ma-0"
          >
            <v-icon>add</v-icon>
          </v-btn> -->
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
  </v-flex>
</template>

<script>
// import Axios from 'axios'

export default {
  // Name
  name: 'BoardColumn',

  // Components
  components: {},

  // Mixins
  mixins: [],

  // Props
  props: {
    name: {
      type: String,
      default: ''
    },
    columnId: {
      type: String,
      default: ''
    },
    color: {
      type: String,
      default: ''
    }
  },

  // Data
  data () {
    return {
      editable: false,
      loading: false,
      nameTemp: undefined
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
      this.editable = true
      this.nameTemp = this.name
    },

    cancelEditing () {
      this.editable = false
    },

    updateColumnName (value) {
      this.nameTemp = value
    },

    async saveBoardName () {
      try {
        await this.$axios({
          url: `/api/columns/update/${this.columnId}`,
          method: 'post',
          data: {
            name: this.nameTemp
          }
        })
      } catch (error) {
        console.warn(error)
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
  // box-shadow: 0 0 3px 3px inset rgba(255, 255, 255, .5);
  // margin: 0 4px;
  // background-color: rgba(255, 255, 255, .10);

  // border-right: 1px solid #fff;

  &__title {
    // max-height: 52px;
    font-weight: 500;
  }

  &__edit {
    max-width: 36px;
  }

  &__name-field {
    position: relative;
    font-size: 21px;
    font-weight: 700;
    top: -3px;
  }
}
</style>
