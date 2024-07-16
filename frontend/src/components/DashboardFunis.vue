<template>
    <div class="main d-inline-flex flex-wrap justify-content-start my-4">
        <CardFunil/>
        <div class="card m-3" id="card-button" style="width: 18rem;" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
            <div class="card-body d-flex justify-content-center align-items-center">
                <i class="bi bi-plus-lg"></i>
            </div>
        </div>

        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header d-flex justify-content-between align-items-center">
                <div class="d-flex justify-content-between align-items-center">
                    <i class="bi bi-arrow-left-circle-fill px-2" data-bs-dismiss="offcanvas" aria-label="Close"></i>
                    <label>Voltar</label>
                </div>
                <!-- class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close" -->
                <h5 class="offcanvas-title" id="offcanvasRightLabel">Novo Funil</h5>
            </div>
            <div class="offcanvas-body card-body m-2 card">
                <div class="Formulario"> 
                    <label class="pt-3 pb-2">Nome do Funil</label>
                    <input class="form-control" type="email" placeholder="Digite o Nome do funil" v-model="formData">
                    <label class="pt-3 pb-2">Descrição</label>
                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" style="height: 300px"></textarea>
                </div>
            </div>
            <div class="d-grid gap-2 col-6 mx-auto">
                <button class="btn btn-primary" type="button">Button</button>
            </div>
        </div>
    </div>
</template>

<script>
import CardFunil from '../components/CardFunil.vue'

export default {
    name: 'DashboardFunis',
    components: {
        CardFunil,
    }
}
</script>

<style scoped>
    .offcanvas{
        background-color:#F9FAFC;
    }
    .card{
        background-color: #FFFFFF;
    }
    #card-button{
        background-color: #E1E9F4;
    }
    i{
        color: #677C92;
    }
    #card-button:hover{
        background-color:#D2DDEC;
    }
    .bi{
        font-size: 40px;
        
    }
    .card:hover{
        cursor: pointer;
    }
    .voltar{

    }
</style>