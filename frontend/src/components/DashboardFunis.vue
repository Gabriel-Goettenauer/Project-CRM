<template>
    <div class="main d-inline-flex flex-wrap justify-content-start my-4">

        <CardFunil v-for="funnel in funnels" :key="funnel.id" :card="funnel"/>
        <div class="card m-3" id="card-button" style="width: 18rem;" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight">
            <div class="card-body d-flex justify-content-center align-items-center">
                <i class="bi bi-plus-lg"></i>
            </div>
        </div>

        <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header d-flex justify-content-between align-items-center">
                <div class="d-flex justify-content-between align-items-center">
                    <i class="voltar " data-bs-dismiss="offcanvas" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#373753"><path d="M524-480 394-350l42 43 173-173-173-173-42 43 130 130ZM480-80q-83 0-156-31.5t-127-86Q143-252 111.5-325T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 155.5 31.5t127 85.5q54.5 54 86 127T880-480q0 82-31.5 155t-86 127.5q-54.5 54.5-127 86T480-80Zm0-60q141 0 240.5-99.5T820-480q0-142-99.5-241T480-820q-142 0-241 99t-99 241q0 141 99 240.5T480-140Zm0-340Z"/></svg>
                    </i>
                    <label class="px-2">Voltar</label>
                </div>
                <!-- class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close" -->
                <h5 class="offcanvas-title" id="offcanvasRightLabel">Novo Funil</h5>
            </div>

            <div class="offcanvas-body card-body m-2 card">
                <div class="Formulario"> 
                    <label class="pt-3 pb-2">Nome do Funil</label>
                    <input class="form-control" type="email" placeholder="Digite o Nome do funil" v-model="formData.name">

                    <label class="pt-3 pb-2">Descrição</label>
                    <textarea class="form-control" placeholder="Leave a comment here" id="floatingTextarea" style="height: 300px" v-model="formData.description"></textarea>
                </div>
            </div>
            <pre>
                {{ this.formData }}
            </pre>
            <div class="d-grid gap-2 col-6 mx-auto">
                <button class="btn btn-primary" type="button" @click="postFunnel()">Button</button>
            </div>

        </div>
    </div>
</template>

<script>
import CardFunil from '../components/CardFunil.vue'
import { getFunnels,postFunnel } from '@/services/HttpService';

export default {
    name: 'DashboardFunis',
    components: {
        CardFunil,
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