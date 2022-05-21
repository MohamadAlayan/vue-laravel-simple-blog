<template>
  <div class="form-check">
    <input
      class="form-check-input"
      type="checkbox"
      value=""
      :id="id"
      v-model="value"
      :tabindex="tabIndex"
      :readonly="readonlyValue"
      :placeholder="placeHolder"
      @input="(e) => $emit('input', e.target.value)"
    />
    <label class="form-check-label" :for="id">
      {{ label }}
    </label>
  </div>
</template>

<script>

export default {
  name: "CheckboxField",
  props: {
    id: { type: String, default: "", required: true },
    placeHolder: { type: String, default: "", required: true },
    label: { type: String, default: "" },
    value: { type: String, default: "", required: true },
    readonlyValue: { type: Boolean, default: false },
    tabIndex: { type: String, default: "" },
  },
}
</script>

<style scoped></style>
