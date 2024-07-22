<template>
    <div class="main-stages">
        <SideNavbar/>
        <div class="d-flex justify-content-between align-items-center"> 
            <h1 class="px-5 pt-3 pb-2">Etapas</h1>
            <button type="button" class="btn addStage mx-5 mt-3 mb-2" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight">
                <i class="bi bi-file-plus px-2">
                </i>Nova Etapa</button>
        </div>

        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header d-flex justify-content-between align-items-center">
                <div class="d-flex justify-content-between align-items-center">
                    <i class="voltar " data-bs-dismiss="offcanvas" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#373753"><path d="M524-480 394-350l42 43 173-173-173-173-42 43 130 130ZM480-80q-83 0-156-31.5t-127-86Q143-252 111.5-325T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 155.5 31.5t127 85.5q54.5 54 86 127T880-480q0 82-31.5 155t-86 127.5q-54.5 54.5-127 86T480-80Zm0-60q141 0 240.5-99.5T820-480q0-142-99.5-241T480-820q-142 0-241 99t-99 241q0 141 99 240.5T480-140Zm0-340Z"/></svg>
                    </i>
                    <label class="px-2">Voltar</label>
                </div>
                <h5 class="offcanvas-title" id="offcanvasRightLabel">Nova Etapa</h5>
            </div>

            <div class="offcanvas-body card-body m-2 card">
                <InputComponent Placeholder="Nome da Etapa"/>
            </div>
            <div class="d-grid gap-2 col-6 mx-auto">
                <button class="btn btn-primary" type="button" @click="postFunnel()">Button</button>
            </div>
        </div>

        <StagesDashboard/>
    </div>
</template>

<script>
import SideNavbar from "../components/SideNavbar.vue"
import StagesDashboard from '../components/StagesDashboard.vue'
import InputComponent from "../components/InputComponent.vue";

export default {
    components: { 
        SideNavbar,
        StagesDashboard,
        InputComponent,
    },
    data() {
        return {
            formData:{
                name:'',
            }
        }
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