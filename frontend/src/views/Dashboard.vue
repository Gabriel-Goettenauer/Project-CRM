<template>
    <div class="main">
        <SideNavbar/>
        <h1 class="px-5">Dashboard</h1>
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
    .main{
        margin-left: 72px;
        background-color: red;
        /* background-color: #F9FAFC; */
        height: auto;
    }

    h1{
        font-family: 'RandomGrotesqueStandardMedium';
        color: #1B1B2B;
    }
</style>