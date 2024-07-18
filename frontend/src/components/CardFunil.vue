<template>
    <div>
        <!-- v-for="funnel in funnels" :key="funnel.id" -->
        <div  class="card m-3" style="width: 18rem;">
            <div class="card-body">
                <div class="d-flex justify-content-between card-info">
                    <h5 class="card-title">{{ card.name }}</h5>                    
                    <i class="bi bi-trash-fill" data-bs-toggle="modal" data-bs-target="#deleteModal"></i>
                </div>
                <p class="card-text overflow-x-auto">{{ card.description }}</p>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered d-flex justify-content-center">
                <div class="modal-content ">
                    <div class="modal-header d-flex justify-content-center">
                        <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="bi bi-exclamation-octagon"></i></h1>
                    </div>
                    <div class="modal-body d-flex justify-content-center">
                        <p>Tem certeza que deseja excluir esse funil?</p>
                    </div>
                    <pre>
                        {{ this.card.id }}  
                    </pre>
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" class="btn cancel btn-lg" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn delete btn-lg">Deletar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>


export default {
    name: 'CardFunil',
    props:{
        card:{}
    }
}
</script>

<style scoped>
.card {
    background-color: #FFFFFF;
    color: #373753;
    font-family: 'CerebriSansProRegular';
    border: 1px solid #E1E9F4;
    height: 170px;
}
.card:hover{
    border: 1px solid #B1C2D9;
    cursor: pointer;
}
.card-text {
    color: #677C92;
    height: 104px;
}
.card-info i {
    color: #677C92;
}
.bi-trash-fill:hover {
    color: #FF3F3E;
    font-size: 20px;
    transition: 0.5s;
}
.modal-header{
    --bs-modal-header-border-color:0;
}
.modal-body{
    --bs-modal-footer-border-color:0;
}
.bi-exclamation-octagon{
    color: #FF4444;;
    font-size:35px;
}
.delete{
    background-color:#FF4444;
    color: #FFFFFF;
}
.delete:hover{
    background-color: #CC0001;
}
.cancel{
    background-color: #E1E9F4;
    color: #677C92;
}
.cancel:hover{
    background-color: #D2DDEC;
    border: solid 1px #B1C2D9;
}
</style>
