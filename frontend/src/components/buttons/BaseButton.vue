<template>
  <button  type="button"  :disabled="isLoading">
    <slot/>
  </button>
</template>

<script>
export default {
  name: "BaseButton",
  props: {
    isLoading: {type: Boolean, default: false}
  },
}
</script>

<style scoped>

</style>