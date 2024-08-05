<template>
  <div class="main-stages">
    <SideNavbar />
    <div class="d-flex justify-content-between align-items-center">
      <h1 class="px-5 pt-3 pb-2">Etapas</h1>
      <button
        type="button"
        class="btn addStage mx-5 mt-3 mb-2"
        data-bs-toggle="modal"
        data-bs-target="#modalNewStage"
      >
        <i class="bi bi-file-plus-fill px-2"></i>
        Nova Etapa
      </button>
    </div>
    <StagesDashboard />
  </div>
</template>

<script>
import SideNavbar from "../components/SideNavbar.vue";
import StagesDashboard from "../components/StagesDashboard.vue";

export default {
  name: "Stages",
  components: {
    SideNavbar,
    StagesDashboard,
  },
  data() {
    return {
      funnel: {},
    };
  },
};
</script>

<style scoped>
.main-stages {
  margin-left: 72px;
  height: 100vh;
  background-color: #f9fafc;
}
h1 {
  font-family: "RandomGrotesqueStandardMedium";
  color: #1b1b2b;
}
.addStage {
  background-color: #3057f2;
  color: #ffffff;
  border-radius: 10px;
  width: 261px;
  height: 40px;
}
.btn {
  font-weight: bold;
}
.addStage:hover {
  background-color: #2336c7;
}
svg {
  background-color: #f9fafc;
  transform: rotate(180deg);
}
</style>
