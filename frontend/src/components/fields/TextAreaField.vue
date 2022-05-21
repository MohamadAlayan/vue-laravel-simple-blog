<template>
  <label :for="id" class="form-label" v-show="label !== ''">
    <slot name="label">{{ label }}</slot>
  </label>
  <textarea
      class="form-control"
      type="text"
      :id="id"
      :name="id"
      v-model="value"
      :tabindex="tabIndex"
      :placeHolder="placeHolder"
      v-bind="$attrs"

  />
</template>

<script>

export default {
  name: "TextAreaField",
  props: {
    id: {type: String, default: "", required: true},
    placeHolder: {type: String, default: ""},
    label: {type: String, default: ""},
    value: {},
    tabIndex: {type: String, default: ""}
  }
}
</script>

<style scoped>

</style>
