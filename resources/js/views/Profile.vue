<template>
  <div v-if="user">
    <h1>
      Profile
    </h1>
    <v-form ref="form">
      <v-layout
        row
        wrap
        class="mt-4"
      >
        <v-flex
          xs6
        >
          <v-text-field
            label="Name"
            :disabled="!isEditable"
            :value="user.name"
            :rules="$data.$validation_rules.required"
            @input="handleUpdate('name', $event)"
          />
        </v-flex>

        <v-flex xs6>
          <v-text-field
            label="Email"
            :disabled="!isEditable"
            :value="user.email"
            @input="handleUpdate('email', $event)"
          />
        </v-flex>

        <!-- Edit Button -->
        <v-flex
          v-if="!isEditable"
          xs12
        >
          <v-btn
            class="ml-0"
            color="secondary"
            @click="editProfile()"
          >
            Edit
          </v-btn>
        </v-flex>

        <!-- Save / Cancel Buttons -->
        <v-flex
          v-else
          xs12
        >
          <v-btn
            class="ml-0"
            :disabled="loading"
            @click="cancelEdit()"
          >
            Cancel
          </v-btn>
          <v-btn
            color="primary"
            :loading="loading"
            @click="saveProfile()"
          >
            Save
          </v-btn>
        </v-flex>
      </v-layout>
    </v-form>
  </div>
</template>

<script>
import Axios from 'axios'
import validation from '@/mixins/validation'

export default {
  // Name
  name: 'Profile',

  // Components
  components: {},

  // Mixins
  mixins: [validation],

  // Props
  props: {},

  // Data
  data () {
    return {
      loading: false,
      isEditable: false,
      userCopy: undefined
    }
  },

  // Computed
  computed: {
    user () {
      return !this.isEditable
        ? this.$store.state.user
        : this.userCopy
    }
  },

  // Watch
  watch: {},

  // Created
  created () {},

  // Mounted
  mounted () {},

  // Methods
  methods: {
    handleUpdate (field, value) {
      this.userCopy[field] = value
    },

    handleErrors (errors) {
      for (let field in errors) {
        errors[field].forEach((error) => {
          this.$bus.$emit('toast', {
            text: error,
            color: 'error'
          })
        })
      }
    },

    cancelEdit () {
      this.userCopy = { ...this.user }
      this.isEditable = false
    },

    editProfile () {
      this.userCopy = { ...this.user }
      this.isEditable = true
    },

    async saveProfile () {
      if (!this.$refs.form.validate()) return
      this.loading = true
      try {
        const response = await Axios({
          method: 'post',
          url: '/api/user/save',
          data: {
            name: this.userCopy.name,
            email: this.userCopy.email
          }
        })
        this.$store.commit('updateUser', response.data.user)
        this.$bus.$emit('toast', {
          text: 'Profile Updated.'
        })
      } catch (error) {
        console.warn(error)
        this.handleErrors(error.response.data.errors)
      } finally {
        this.loading = false
        this.isEditable = false
      }
    }
  }
}
</script>

<style scoped lang="scss">
</style>
