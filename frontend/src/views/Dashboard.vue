<template>
    <div class="main">
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
    .main{
        margin-left: 72px;
        background-color: red;
        /* background-color: #F9FAFC; */
    }

    h1{
        font-family: 'RandomGrotesqueStandardMedium';
        color: #1B1B2B;
    }
</style>