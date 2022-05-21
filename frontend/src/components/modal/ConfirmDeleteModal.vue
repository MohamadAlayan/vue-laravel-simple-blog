<template>
  <div class="modal fade" ref="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
          <button type="button" class="btn-close" aria-label="Close" @click="close"></button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete this post?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light" @click="close">Cancel</button>
          <button type="button" class="btn btn-danger text-white" @click="Delete">Delete</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {Modal} from 'bootstrap'

export default {
  name: "ConfirmDeleteModal",
  props: {
    show: {type: Boolean, required: true},
    postId: {type: Number, required: true},
  },
  data() {
    return {
      modal: null,
    }
  },
  methods: {
    open() {
      this.modal.show()
    },
    close() {
      this.modal.hide()
      this.$emit('close')
    },
    Delete() {
      this.$emit('delete', this.postId)
      this.close()
    }
  },
  computed: {},
  watch: {
    show(value) {
      if (value === true) {
        this.open()
      }
    }
  },
  mounted() {
    this.modal = new Modal(this.$refs.deleteModal)
  }
}
</script>

<style scoped>

</style>
