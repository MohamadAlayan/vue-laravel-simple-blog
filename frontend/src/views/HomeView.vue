<template>
  <SectionTitle>Posts</SectionTitle>
    <Post
        v-for="post in postsData.data"
        :key="post.id"
        :post="post"
    />
    <Pagination :data="postsData" @pagination-change-page="getMorePosts"/>
</template>-


<script>
import SectionTitle from "@/components/titles/SectionTitle.vue";
import Post from "@/components/posts/Post.vue";
import LaravelVuePagination from 'laravel-vue-pagination';

export default {
  name: "HomeView",
  components: {
    SectionTitle, Post,
    'Pagination': LaravelVuePagination
  },
  computed: {},
  data() {
    return {
      postsData: null
    }
  },
  methods:
      {
        async getMorePosts(page = 1) {
          try {
            this.postsData = await this.$store.dispatch("post/getAll", page);
          } catch (e) {
          }
        },

      },
  beforeMount() {
    this.postsData = this.$store.getters['post/getAll']
  },

}
</script>