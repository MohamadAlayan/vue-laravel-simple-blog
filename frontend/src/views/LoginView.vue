<template>
  <div class="container justify-content-center pt-5">
    <div class="row mx-auto pt-2"></div>
    <div class="row mx-auto bg-white shadow rounded-5 w-300">
      <div class="col-12 text-center py-3">
        <span class="fs-3 fw-bold">User Login</span>
      </div>
      <div class="col-12">
          <div class="row mb-3 px-3">
            <div class="col-12">
              <TextField
                  id="email"
                  tab-index="1"
                  label="Email"
                  v-model="credentials.email"
              />
            </div>
          </div>
          <div class="row mb-3 px-3">
            <div class="col-12">
              <PasswordField
                  id="password"
                  tab-index="2"
                  label="Password"
                  v-model="credentials.password"
              />
            </div>
          </div>
          <div class="row px-4 mb-3">
            <PrimaryButton @click="onSubmitLogin">Login</PrimaryButton>
          </div>
      </div>
      <div class="col-12 p-1 bg-primary-color rounded-bottom-5"/>
    </div>
  </div>
</template>

<script>

import PrimaryButton from "@/components/buttons/PrimaryButton.vue";
import PasswordField from "@/components/fields/PasswordField.vue";
import TextField from "@/components/fields/TextField.vue";

export default {
  name: "LoginView",
  components: {PrimaryButton, PasswordField, TextField},
  data() {
    return {
      credentials: {
        email: "",
        password: ""
      },
    }
  },
  methods:
      {
        async onSubmitLogin() {
          try {
            const response = await this.$store.dispatch("auth/login", this.credentials);
            await this.$router.push({name: 'HomePage'})
          } catch (e) {
          }

        }
      }
  ,
}
</script>

<style scoped>

</style>