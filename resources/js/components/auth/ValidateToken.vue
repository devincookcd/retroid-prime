<script>
// import Axios from 'axios'

export default {
  // Name
  name: 'ValidateToken',

  // Mounted
  mounted () {
    this.validateToken()
  },

  // Methods
  methods: {
    async validateToken () {
      const token = localStorage.getItem('token')

      if (!token) {
        this.redirectUser()
        return
      }

      this.$axios.defaults.headers.common['Authorization'] = `Bearer ${token}`

      try {
        const response = await this.$axios.get('/api/validate-token')
        this.$store.commit('updateUser', response.data.user)
      } catch (error) {
        console.warn(error)
        this.removeToken()
        this.redirectUser()
      }
    },

    redirectUser () {
      this.$router.replace('/')
    },

    removeToken () {
      localStorage.removeItem('token')
    }
  },

  // Render
  render: () => {
    return undefined
  }
}
</script>
