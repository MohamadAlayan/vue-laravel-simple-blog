<template>
  <div class="row">
    <div class="col">
      <h1 class="section-title" v-bind="$attrs">
        <slot/>
      </h1>
      <hr v-if="line">
      <div/>
    </div>
  </div>
</template>

<script>

export default {
  name: "SectionTitle",
  props: {
    line: {default: true}
  }
}
</script>

<style scoped>

</style>