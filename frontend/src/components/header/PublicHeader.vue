<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid mx-3">
      <router-link class="navbar-brand" :to="{ name: 'HomePage' }">
        <img class="logo" src="/assets/img/logo.svg" alt="logo"/>
      </router-link>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0 ">
          <li class="nav-item">
            <router-link class="nav-link" :to="{ name: 'HomePage' }">
              Home
            </router-link>
          </li>
          <template v-if="isLoggedIn">
            <li class="nav-item">
              <router-link class="nav-link" :to="{ name: 'MyPostsPage' }">
                My Posts
              </router-link>
            </li>
          </template>

          <li class="nav-item">
            <router-link class="nav-link" :to="{ name: 'AboutPage' }">
              About
            </router-link>
          </li>
          <template v-if="isLoggedIn">
            <SecondaryButton class="ms-3 px-3" @click="logout">
              Logout
            </SecondaryButton>
          </template>
          <template v-else>
            <PrimaryButton class="ms-3 px-3" :onclick="() => { this.$router.push({name: 'LoginPage'})}">
              Login
            </PrimaryButton>
          </template>
        </ul>
      </div>
    </div>
  </nav>

</template>

<script>
import PrimaryButton from "@/components/buttons/PrimaryButton.vue";
import SecondaryButton from "@/components/buttons/SecondaryButton.vue";

export default {
  name: "PublicHeader",
  components: {PrimaryButton, SecondaryButton},
  computed: {
    isLoggedIn() {
      return this.$store.getters['auth/isAuthenticated']
    }
  },
  methods: {
    async logout() {
      await this.$store.dispatch("auth/logout")
    }
  }


}
</script>

<style scoped>

</style>