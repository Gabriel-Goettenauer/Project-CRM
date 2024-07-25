<template>
    <div class="main d-inline-flex flex-wrap justify-content-start my-4">

        <CardFunil v-for="funnel in funnels" :key="funnel.id" :card="funnel"/>

        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header d-flex justify-content-between align-items-center">
                <div class="d-flex justify-content-between align-items-center">
                    <i class="voltar " data-bs-dismiss="offcanvas" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#373753"><path d="M524-480 394-350l42 43 173-173-173-173-42 43 130 130ZM480-80q-83 0-156-31.5t-127-86Q143-252 111.5-325T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 155.5 31.5t127 85.5q54.5 54 86 127T880-480q0 82-31.5 155t-86 127.5q-54.5 54.5-127 86T480-80Zm0-60q141 0 240.5-99.5T820-480q0-142-99.5-241T480-820q-142 0-241 99t-99 241q0 141 99 240.5T480-140Zm0-340Z"/></svg>
                    </i>
                    <label class="px-2">Voltar</label>
                </div>
                <h5 class="offcanvas-title" id="offcanvasRightLabel">Novo Funil</h5>
            </div>

            <div class="card p-2 m-2">
                    <InputComponent Placeholder="Nome do Funil" InputType="Text" class="p-1"/>
                    <TextAreaComponent class="p-1"/>
            </div>
            <div class="d-grid gap-2 col-6 mx-auto">
                <button class="btn btn-primary" type="button" @click="postFunnel()">Criar Novo Funil</button>
            </div>

        </div>
    </div>
</template>

<script>
import CardFunil from '../components/CardFunil.vue'
import InputComponent from '../components/InputComponent.vue';
import TextAreaComponent from '../components/TextAreaComponent.vue'
import { getFunnels,postFunnel } from '../services/ApiPrivateService';

export default {
    name: 'DashboardFunis',
    components: {
        CardFunil,
        InputComponent,
        TextAreaComponent,
    },
    data() {
        return {
            funnels: [],
            formData:{
                name:'',
                description:'',
            }
        }
    },
    methods: {
        async getInfo() {
            try {
                const response = await getFunnels();
                this.funnels = response.data;
                console.log(this.funnels);
            } catch (error) {
                console.error('Error:', error);
            }
        },
        async postFunnel(){
            try{
                const response = await postFunnel(this.formData);
                console.log("Funil criado");
                window.location.reload(true);
            }catch (error) {
                console.error('Falha ao criar funil', error);
                alert('Falha ao criar o funil');
            }
        }
    },
    created() {
        this.getInfo();
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
    svg{
        background-color: #F9FAFC;
        transform: rotate(180deg)
    }
    .voltar:hover{
        cursor: pointer;
    }

</style>