<template>
    <div class="mainstages d-flex mx-3 overflow-x-auto">
        <TableContacts v-for="table in tables" :key="table.id" :table="table" :stageId="table.id"/>
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

        <div class="card p-3 m-2">
            <InputComponent Placeholder="Nome da Etapa" InputType="text" class="p-1" @input-confirmed="updateFunnelName"/>
            <div class="px-3 py-3 d-flex justify-content-start align-items-center">
                <span class="px-1">Selecione uma cor :</span>
                <input type="color" name="cor" id="cor" class="cor" value="#D2DDEC" v-model="formData.user_color">
            </div>
        </div>
        <pre>
            {{ this.formData }}
        </pre>
        <div class="d-grid gap-2 col-6 mx-auto">
            <button class="btn btn-primary" type="button" @click="postFunnel()" @input-confirmed="updateFunnelName">Criar Etapa</button>
        </div>
    </div>
</template>

<script>
import TableContacts from './TableContacts.vue'
import { getTables} from '@/services/ApiPrivateService';
import InputComponent from "../components/InputComponent.vue";

export default {
    name: 'StagesDashboard',
    components: { 
        TableContacts,
        InputComponent
    },

    data(){
        return{
            tables:[],
            formData:{
                name:'',
                user_color:'',
            }
        }
    },
    methods:{
        async getInfo(){
            try {
                const response = await getTables();
                this.tables = response.data;
                console.log(this.tables);
            } catch (error) {
                console.error('Error:', error);
            }
        },
        updateFunnelName(newName) {
        this.formData.name = newName;
        },
    },
    created() {
        this.getInfo();
    }
}

</script>

<style scoped>
.mainstages{
    background-color: #F9FAFC;
    height: 100vh;
}
i{
    color: #677C92;
    font-size: 50px;
}
.offcanvas{
        background-color:#F9FAFC;
}
.voltar:hover{
    cursor: pointer;
}
span{

}
.card-body{
    height: auto;
}
#cor {
    height: 35px;
    border: none;
    padding: 0;
    background-color: #fff;
    cursor: pointer;
}
#cor:focus{
    box-shadow: 0 0 0 0;
    border: 0 none;
    outline: 0;
}
</style>