<template>
  <div class="modal fade" ref="PostModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="PostModalLabel">{{ title }}</h5>
          <button type="button" class="btn-close" aria-label="Close" @click="close"></button>
        </div>
        <div class="modal-body">
          <div class="row mb-3 px-3">
            <div class="col-12">
              <TextField
                  id="title"
                  tab-index="1"
                  label="Title"
                  v-model="post.title"
                  :value="post.title"
              />
            </div>
          </div>
          <div class="row mb-3 px-3">
            <div class="col-12">
              <TextAreaField
                  id="body"
                  tab-index="1"
                  label="Body"
                  v-model="post.body"
                  :value="post.body"
              />
            </div>
          </div>
          <div class="row mb-3 px-3">
            <div class="col-12">
              <label for="formFile" class="form-label">Upload Image</label>
              <input class="form-control" type="file" id="formFile" @change="uploadFile" ref="file">
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light" @click="close">Cancel</button>
          <button type="button" class="btn btn-primary text-white" @click="save">Save</button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import {Modal} from 'bootstrap'
import TextField from "../fields/TextField.vue";
import TextAreaField from "../fields/TextAreaField.vue";

export default {
  name: "PostModal",
  props: {
    show: {type: Boolean, required: true},
    title: {type: String, required: true},
    post: {
      type: Object, default: {
        id: 0,
        title: "",
        body: "",
      }
    },
  },
  components: {TextField, TextAreaField},
  data() {
    return {
      modal: null,
      image: null,
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
    save() {
      let ps = {
        ...this.post,
        files: {
          post_image: this.image,
        }
      }
      this.$emit('save', ps)
      this.close()
    },
    uploadFile(event) {
      this.image =  event.target.files[0];
    },
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
    this.modal = new Modal(this.$refs.PostModal)
  }
}
</script>

<style scoped>

</style>
