<template>
  <ConfirmDeleteModal
      :show="showDeleteModal"
      :postId="post.id"
      @delete="deletePost"
      @close="closeDeleteModal"
  />
  <PostModal
      :show="showEditPostModal"
      title="Edit post"
      :post="post"
      @close="closeAddNewPostModal"
      @save="savePt"
  />

  <div class="row bg-light shadow-sm rounded-5 p-3 mb-3 ">
    <div class="col-2">
      <img class="post-img"
           :src="post.image_url ? post.image_url : '/assets/img/no-image.png'"
           alt="post img">
    </div>
    <div :class='owner ? "col-8" : "col-10"'>
      <h3 class="post-title">
        <router-link class="text-decoration-none" :to="{name: 'PostPage', params: {id: post.id}}">
          {{ post.title }}
        </router-link>
      </h3>
      <p class="post-body">
        {{ textBody }}
      </p>

      <span class="post-author">Posted By: {{ post.user.name }}</span>
      <a v-show="post.body.length > 60" class="post-read-more"
         @click="showHideButton">{{ readMore ? "Hide" : "Read More" }}</a>
    </div>

    <div v-if="owner === true" class="col-2 d-grid align-items-center">
      <div class="row">
        <div class="col-12">
          <a class="edit-button" @click="showEditPostModal = true">
            <font-awesome-icon class="text-white" icon="edit"></font-awesome-icon>
          </a>
        </div>
        <div class="col-12">
          <a class="delete-button" @click="showDeleteModal = true">
            <font-awesome-icon class="text-white" icon="trash"></font-awesome-icon>
          </a>
        </div>
      </div>

    </div>
  </div>

</template>

<script>
import ConfirmDeleteModal from "@/components/modal/ConfirmDeleteModal.vue";
import PostModal from "../modal/PostModal.vue";

export default {
  name: "Post",
  components: {ConfirmDeleteModal, PostModal},
  props: {
    post: {},
    owner: false
  },
  computed: {
    textBody() {
      if (this.readMore) {
        return this.post.body
      } else {
        if (this.post.body.length > 60) {
          return this.post.body.substring(0, 60) + ".."
        } else {
          return this.post.body
        }
      }
    }

  },
  data() {
    return {
      readMore: false,
      showDeleteModal: false,
      showEditPostModal: false,
    }
  },
  methods:
      {
        showHideButton() {
          this.readMore = !this.readMore;
        },
        closeDeleteModal() {
          this.showDeleteModal = false
        },
        closeAddNewPostModal() {
          this.showEditPostModal = false
        },
        async deletePost(id) {
          try {
            const response = await this.$store.dispatch("post/delete", id);
            this.$emit('updatePosts')
          } catch (e) {
          }
        },
        savePt(post) {
          this.$emit('savePost', post)
        }

      }
  ,


}
</script>

<style scoped>

</style>