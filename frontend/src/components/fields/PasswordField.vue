<template>
  <label :for="id" class="form-label" v-show="label !== ''">
    <slot name="label">{{ label }}</slot>
  </label>
  <div class="input-group">
    <input class="form-control"
           :type="passwordFieldType"
           :id="id"
           :name="id"
           v-model="value"
           :tabindex="tabIndex"
           :placeHolder="placeHolder"
           v-bind="$attrs"
    />
    <div class="eye-btn input-group-text">
      <font-awesome-icon :icon="passwordEyeIcon" @click="switchVisibility"></font-awesome-icon>
    </div>
  </div>
</template>

<script>


export default {
  name: "PasswordField",
  props: {
    id: {type: String, default: "", required: true},
    placeHolder: {type: String, default: ""},
    label: {type: String, default: ""},
    value: {},
    tabIndex: {type: String, default: ""}
  },
  data: () => ({
    passwordEyeIcon: 'eye-slash',
    passwordFieldType: 'password',
    password: "",
  }),
  methods: {
    switchVisibility() {
      if (this.passwordFieldType === 'password') {
        this.passwordFieldType = 'text'
        this.passwordEyeIcon = 'eye'
      } else {
        this.passwordFieldType = 'password'
        this.passwordEyeIcon = 'eye-slash'
      }
    }
  },

}
</script>

<style scoped>
.eye-btn {
  width: 45px;
}
</style>
