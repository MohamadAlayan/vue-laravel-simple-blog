<template>
  <BaseButton class="btn btn-primary text-white">
    <slot/>
  </BaseButton>
</template>

<script>
import BaseButton from "./BaseButton.vue";
export default {
  name: "PrimaryButton",
  components: {BaseButton},
  props: {
    isLoading: {type: Boolean, default: false}
  },
}
</script>

<style scoped>

</style>