<template>
    <div class="main-dash">
        <SideNavbar/>
        <div class="d-flex justify-content-between align-items-center"> 
            <h1 class="px-5 pt-3 pb-2">Dashboard</h1>
        </div>
            <DashboardFunis/>
    </div>
</template>

<script>
import DashboardFunis from '../components/DashboardFunis.vue'
import SideNavbar from "../components/SideNavbar.vue"


export default {
    components: { 
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
</style>