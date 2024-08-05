<template>
  <div>
    <div class="main z-0 d-flex align-items-center justify-content-center">
      <RegisterComponent />
    </div>
  </div>
</template>

<script>
import RegisterComponent from "@/components/RegisterComponent.vue";
export default {
  name: "RegisterView",
  components: {
    RegisterComponent,
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
