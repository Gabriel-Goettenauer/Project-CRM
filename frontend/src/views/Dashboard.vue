<template>
  <div class="main-dash">
    <SideNavbar />
    <div class="d-flex justify-content-between align-items-center">
      <h1 class="px-5 pt-3 pb-2">Dashboard</h1>
      <button
        type="button"
        class="btn addFunnel mx-5 mt-3 mb-2"
        data-bs-toggle="modal"
        data-bs-target="#modalRight"
      >
        <i class="bi bi-funnel-fill"></i>
        Novo Funil
      </button>
    </div>
    <DashboardFunis />
  </div>
</template>

<script>
import DashboardFunis from "../components/DashboardFunis.vue";
import SideNavbar from "../components/SideNavbar.vue";
import InputComponent from "@/components/InputComponent.vue";

export default {
  components: {
    InputComponent,
    SideNavbar,
    DashboardFunis,
  },
  computed: {
    id() {
      return this.$route.params.id;
    },
  },
};
</script>

<style scoped>
.main-dash {
  margin-left: 72px;
  height: 100vh;
  background-color: #f9fafc;
}
.bi {
  transform: rotate(90deg);
}
h1 {
  font-family: "RandomGrotesqueStandardMedium";
  color: #1b1b2b;
}
.user {
  font-size: 20px;
  color: #1b1b2b;
}
.bi-person-circle {
  font-size: 35px;
  color: #677c92;
}
.addFunnel {
  background-color: #3057f2;
  color: #ffffff;
  border-radius: 10px;
  width: 261px;
  height: 40px;
}
.addFunnel:hover {
  background-color: #2336c7;
}
button {
  font-family: "CerebriSansProBold";
}
.border {
  border: solid 2px white;
  border-radius: 5px;
  font-weight: bold;
}
</style>
