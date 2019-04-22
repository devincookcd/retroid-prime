<template>
  <v-snackbar
    v-if="toast"
    v-model="snackbar"
    top
    :color="toast.color"
    :timeout="toastTimeout"
  >
    <span v-if="toast">{{ toast.text }}</span>
    <v-btn
      flat
      @click="closeToast()"
    >
      Close
    </v-btn>
  </v-snackbar>
</template>

<script>
export default {
  // Name
  name: 'TheToaster',

  // Data
  data () {
    return {
      snackbar: false,
      positionY: 'top',
      text: undefined,
      timeout: 6000,
      toast: undefined,
      color: undefined,
      toastQueue: [],
      processing: false,
      processingTimeout: undefined,
      queueTimeout: undefined
    }
  },

  // Computed
  computed: {
    toastTimeout () {
      if (this.toast && this.toast.timeout) {
        return this.toast.timeout
      } else {
        return this.timeout
      }
    }
  },

  // Created
  created () {
    this.$bus.$on('toast', (toast) => {
      this.queueToast(toast)
    })
  },

  // Mounted
  mounted () {},

  // Methods
  methods: {
    /**
     * Queue Toast
     * Queues up a toast in the array
     */
    queueToast (toast) {
      this.toastQueue.push(toast)
      if (!this.processing) this.processQueue()
    },

    /**
     * Process Queue
     * Show the next toast in the queue. After waiting a set time, check the queue.
     */
    processQueue () {
      this.snackbar = true
      this.processing = true
      this.toast = this.toastQueue.shift()
      this.processingTimeout = setTimeout(() => {
        this.checkQueue()
      }, this.toastTimeout)
    },

    /**
     * Check Queue
     * If there are still toasts left, continue to process the queue
     */
    checkQueue () {
      if (this.toastQueue.length > 0) {
        this.queueTimeout = setTimeout(() => {
          this.processQueue()
        }, 500)
      } else {
        this.processingQueue = false
      }
    },

    /**
     * Close Toast
     * clear timeouts, hide toast, check queue
     */
    closeToast () {
      clearTimeout(this.processTimeout)
      clearTimeout(this.queueTimeout)
      this.snackbar = false
      this.checkQueue()
    }
  }
}
</script>

<style scoped lang="scss">
</style>
