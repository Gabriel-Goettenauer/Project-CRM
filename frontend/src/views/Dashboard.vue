<template>
    <div class="main-dash">
        <SideNavbar/>
        <div> 
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
</style>