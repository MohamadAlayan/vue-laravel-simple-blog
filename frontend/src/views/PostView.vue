<template>
  <h1 class="text-primary py-3">{{post.title}}</h1>
  <img class="single-post-image" :src="post.image_url ? post.image_url : '/assets/img/no-image.png' ">
  <p class="text-black py-3">
    {{post.body}}
  </p>
</template>

<script>
export default {
  name: "PostView",
  data() {
    return {
      post: {
        title:'',
        body:'',
        image_url:''
      }
    }
  },
  watch: {
    "$route.params.id": {
      immediate: true,
      async handler(id) {
        if (id) {
          this.post = await this.$store.dispatch("post/getById", parseInt(id));
        }
      }
    },
  }
}
</script>

<style scoped>

</style>