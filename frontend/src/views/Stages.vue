<template>
    <div class="main-stages">
        <SideNavbar/>
        <div class="d-flex justify-content-between align-items-center"> 
            <h1 class="px-5 pt-3 pb-2">Etapas</h1>
        </div>
        <StagesDashboard/>
    </div>
</template>

<script>
import SideNavbar from "../components/SideNavbar.vue"
import StagesDashboard from '../components/StagesDashboard.vue'

export default {
    components: { 
        SideNavbar,
        StagesDashboard,
    }
}
</script>

<style scoped>
    .main-stages{
        margin-left: 72px;
        height: 100vh;
        background-color: #F9FAFC;
    }

    h1{
        font-family: 'RandomGrotesqueStandardMedium';
        color: #1B1B2B;
    }
</style>