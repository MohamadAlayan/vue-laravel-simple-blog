<template>
  <PostModal
      :show="showAddNewPostModal"
      title="Add new post"
      @close="closeAddNewPostModal"
      @save="savePost"

  />
  <SectionTitle>My Posts</SectionTitle>
  <Post
      v-for="post in postsData.data"
      :key="post.id"
      :post="post"
      :owner=true
      @updatePosts="getMorePosts"
      @savePost="savePost"

  />
  <Pagination :data="postsData" @pagination-change-page="getMorePosts"/>

  <button class="btn-add-post btn-primary text-white" id="myBtn" title="Go to top" @click="AddNewPost">
    <font-awesome-icon class="text-white" icon="plus"></font-awesome-icon>
  </button>
</template>

<script>
import SectionTitle from "@/components/titles/SectionTitle.vue";
import Post from "@/components/posts/Post.vue";
import LaravelVuePagination from 'laravel-vue-pagination';
import PostModal from "@/components/modal/PostModal.vue";

export default {
  name: "MyPostsView",
  components: {
    SectionTitle, Post, PostModal,
    'Pagination': LaravelVuePagination
  }, computed: {},
  emits: ["updatePosts"],
  data() {
    return {
      postsData: null,
      showAddNewPostModal: false
    }
  },
  methods:
      {
        async getMorePosts(page = 1) {
          try {
            this.postsData = await this.$store.dispatch("post/getMyPosts", page);
          } catch (e) {
          }
        },
        AddNewPost() {
          this.showAddNewPostModal = true
        },
        closeAddNewPostModal() {
          this.showAddNewPostModal = false
        },
        async savePost(post) {
          await this.$store.dispatch("post/save", post);
          await this.getMorePosts()
        }
      },
  beforeMount() {
    this.postsData = this.$store.getters['post/getMyPosts']
  },

}
</script>