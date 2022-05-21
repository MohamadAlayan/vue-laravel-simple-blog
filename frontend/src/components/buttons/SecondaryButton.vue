<template>
  <BaseButton class="btn btn-secondary text-white">
    <slot/>
  </BaseButton>
</template>

<script>
import BaseButton from "./BaseButton.vue";
export default {
  name: "SecondaryButton",
  components: {BaseButton},
  props: {
    isLoading: {type: Boolean, default: false}
  },
}
</script>

<style scoped>

</style>