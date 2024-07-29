<template>
    <div>
        <div  class="card m-3" style="width: 18rem;" @click="goToStage()">
            <div class="card-body">
                <div class="d-flex justify-content-between card-info">
                    <h5 class="card-title">{{ card.name }}</h5>
                    <div class="icon-container">
                        <i class="bi bi-pencil-fill px-3" data-bs-toggle="offcanvas" :data-bs-target="'#' + offcanvasID" @click.stop></i>
                        <i class="bi bi-trash-fill" data-bs-toggle="modal" :data-bs-target="'#' + modalId" @click.stop></i>
                    </div>           
                </div>
                <p class="card-text overflow-x-auto">{{ card.description }}</p>
            </div>
        </div>

        <div class="modal fade" :id="modalId" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered d-flex justify-content-center">
                <div class="modal-content ">
                    <div class="modal-header d-flex justify-content-center">
                        <h1 class="modal-title fs-5"><i class="bi bi-exclamation-octagon"></i></h1>
                    </div>
                    <div class="modal-body d-flex justify-content-center">
                        <p>Tem certeza que deseja excluir esse funil?</p>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" class="btn cancel btn-lg" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn delete btn-lg" @click="deleteFunnel(card.id)">Deletar</button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="offcanvas offcanvas-end" tabindex="-1" :id="offcanvasID">
            <div class="offcanvas-header d-flex justify-content-between align-items-center">
                <div class="d-flex justify-content-between align-items-center">
                    <i class="voltar" data-bs-dismiss="offcanvas" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#373753">
                            <path d="M524-480 394-350l42 43 173-173-173-173-42 43 130 130ZM480-80q-83 0-156-31.5t-127-86Q143-252 111.5-325T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 155.5 31.5t127 85.5q54.5 54 86 127T880-480q0 82-31.5 155t-86 127.5q-54.5 54.5-127 86T480-80Zm0-60q141 0 240.5-99.5T820-480q0-142-99.5-241T480-820q-142 0-241 99t-99 241q0 141 99 240.5T480-140Zm0-340Z"/>
                        </svg>
                    </i>
                    <label class="px-2">Voltar</label>
                </div>
                <h5 class="offcanvas-title" id="offcanvasRightLabel">Novo Funil</h5>
            </div>

                <div class="card-offcanvas p-2 m-2">
                    <InputComponent :Placeholder="card.name" InputType="text" class="p-1" @input-confirmed="updateFunnelName"/>
                    <TextAreaComponent class="p-1" :Placeholder="card.description" @textarea-confirmed="updateFunnelDescription"/>
                </div>
                <div class="d-grid gap-2 col-6 mx-auto">
                    <button class="btn btn-primary" type="button" @click="updateFunnel(card.id)">Atualizar Funil</button>
                </div>
        </div>
    </div>
</template>

<script>
import { deleteFunnel, updateFunnel } from '@/services/ApiPrivateService';
import InputComponent from '../components/InputComponent.vue';
import TextAreaComponent from '../components/TextAreaComponent.vue'

export default {
    name: 'CardFunil',
    components:{
        InputComponent,
        TextAreaComponent,
    },
    data() {
        return {
            modalId: 'deleteModal' + this.card.id,
            offcanvasID: '' + this.card.id,
            formData: {
                name: '',
                description: ''
            }
        }
    },
    props:{
        card:{}
    },

    methods:{
        async deleteFunnel(id){
            try {
                console.log(id);
                await deleteFunnel(id);
                alert('Funnel deleted successfully!');
                window.location.reload(true);
            } catch (error) {
                console.error('Failed to delete the funnel:', error);
                alert('Failed to delete the funnel.');
            }
        },
        async updateFunnel(id){
            try {
                console.log(id);
                await updateFunnel(id,this.formData);
                alert('Funil atualizado com sucesso');
                window.location.reload(true);
            } catch (error) {
                console.error('ERRO', error);
                alert('FALHA AO ATUALIZAR FUNIL');
            }
        },
        updateFunnelName(newName) {
        this.formData.name = newName;
        },
        updateFunnelDescription(newDescription) {
            this.formData.description = newDescription;
        },
        goToStage() {
          this.$router.push({ path: `/stage/${this.card.id}` });
        }
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
.card-offcanvas{
        background-color: #FFFFFF;
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
.icon-container i.bi-pencil-fill{
    display: none;
}
.icon-container i.bi-trash-fill{
    display: none
}
.card:hover .icon-container i.bi-pencil-fill {
    display: inline-block;
}
.card:hover .icon-container i.bi-trash-fill{
    display: inline-block;
}
.bi-trash-fill:hover {
    color: #FF3F3E;
    font-size: 20px;
    transition: 0.5s;
}
.bi-pencil-fill:hover {

    font-size: 20px;
    transition: 0.5s;
}
.modal-header{
    --bs-modal-header-border-color:#FFFFFF;
}
.modal-body{
    --bs-modal-footer-border-color:#FFFFFF;
}
.modal-footer{
    --bs-modal-footer-border-color:#FFFFFF
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
