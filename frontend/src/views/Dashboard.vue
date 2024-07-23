<template>
    <div class="main-dash">
        <SideNavbar/>
        <div class="d-flex justify-content-between align-items-center"> 
            <h1 class="px-5 pt-3 pb-2">Dashboard</h1>
            <button type="button" class="btn addFunnel mx-5 mt-3 mb-2" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight">
                <i class="bi bi-file-plus px-2">
                </i>Novo Funil</button>
        </div>
            <DashboardFunis/>
    </div>
</template>

<script>
import DashboardFunis from '../components/DashboardFunis.vue'
import SideNavbar from "../components/SideNavbar.vue"
import InputComponent from "@/components/InputComponent.vue";

export default {
    components: {
        InputComponent,
        SideNavbar,
        DashboardFunis,
    }
}
</script>

<style scoped>
    .main-dash{
        margin-left: 72px;
        height: 100vh;
        background-color: #F9FAFC;
    }
    .bi{
        transform: rotate(90deg);
    }
    h1{
        font-family: 'RandomGrotesqueStandardMedium';
        color: #1B1B2B;
    }
    .user{
        font-size: 20px;
        color:#1B1B2B;
    }
    .bi-person-circle{
        font-size: 35px;
        color:#677C92;
    }
    .addFunnel{
    background-color: #3057F2;
    color: #FFFFFF;
    border-radius: 10px;
    width: 261px;
    height: 40px;
    }
    .addFunnel:hover{
    background-color: #2336C7;
    }
</style>