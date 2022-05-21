<template>
  <PublicHeader/>
  <div class="container p-4">
    <router-view/>
  </div>
</template>

<script>
import PublicHeader from "@/components/header/PublicHeader.vue";

export default {
  name: "PublicLayout",
  components: {PublicHeader},
}
</script>

<style scoped>

</style>