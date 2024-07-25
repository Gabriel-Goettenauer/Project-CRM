<template>
    <div class="main-stages">
        <SideNavbar/>
        <div class="d-flex justify-content-between align-items-center"> 
            <h1 class="px-5 pt-3 pb-2">Etapas</h1>
            <button type="button" class="btn addStage mx-5 mt-3 mb-2" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight">
                <i class="bi bi-file-plus-fill px-2"></i>
                Nova Etapa</button>
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
    },
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
    .addStage{
    background-color: #3057F2;
    color: #FFFFFF;
    border-radius: 10px;
    width: 261px;
    height: 40px;
    }
    .addStage:hover{
    background-color: #2336C7;
    }
    svg{
        background-color: #F9FAFC;
        transform: rotate(180deg)
    }
    .offcanvas{
        background-color:#F9FAFC;
    }
    .voltar:hover{
        cursor: pointer;
    }
</style>