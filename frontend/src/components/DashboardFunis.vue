<template>
    <div class="main d-inline-flex flex-wrap justify-content-start my-4">
        <CardFunil/>
        <CardFunil/><CardFunil/><CardFunil/><CardFunil/><CardFunil/><CardFunil/><CardFunil/><CardFunil/>
        <div class="card m-3" id="card-button" style="width: 18rem;" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
            <div class="card-body d-flex justify-content-center align-items-center">
                <i class="bi bi-plus-lg"></i>
            </div>
        </div>

        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header d-flex justify-content-between">
                <div>
                    <i class="bi bi-arrow-left-circle-fill" data-bs-dismiss="offcanvas" aria-label="Close"></i>
                    <label>Voltar</label>
                </div>
                <!-- class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close" -->
                <h5 class="offcanvas-title" id="offcanvasRightLabel">Novo Funil</h5>
            </div>
            <div class="offcanvas-body">
                <div class="Formulario">
                    <label class="pt-3 pb-2">Nome do Funil</label>
                    <input class="form-control" type="email" placeholder="Digite o nome do funil" v-model="formData">
                    <label class="pt-3 pb-2">Descrição</label>
                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" style="height: 300px"></textarea>
                </div>
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
</style>