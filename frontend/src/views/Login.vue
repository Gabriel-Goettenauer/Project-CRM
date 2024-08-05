<template>
  <div>
    <div class="main z-0 d-flex align-items-center justify-content-center">
      <LoginComponent />
    </div>
  </div>
</template>

<script>
import LoginComponent from "../components/LoginComponent.vue";
export default {
  name: "LoginView",
  components: {
    LoginComponent,
  },
};
</script>

<style scoped>
.main {
  background: url(@/assets/images/Background-image.webp) no-repeat;
  background-size: cover;
  background-position: center center;
  height: 100vh;
}
</style>
