<template>
    <div class="main d-inline-flex flex-wrap justify-content-start my-4">
        <CardFunil v-for="funnel in funnels" :key="funnel.id" :card="funnel"/>

      <div class="modal fade" tabindex="-1" id="modalRight">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header d-flex justify-content-between align-items-center">
              <h5 class="modal-title" id="modalRightLabel">Novo Funil</h5>
              <div class="d-flex justify-content-between align-items-center">
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>

            </div>
            <div class="modal-body">
              <div class="card p-2 m-2">
                <InputComponent Placeholder="Nome do Funil" InputType="text" class="p-1" @input-confirmed="CreateFunnelName"/>
                <TextAreaComponent class="p-1 " Placeholder="Descrição" @textarea-confirmed="CreateFunnelDescription"/>
              </div>
              <div class="d-grid gap-2 col-6 mx-auto">
                <button class="btn btn-primary" type="button" @click="postFunnel()">Criar Novo Funil</button>
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>
</template>

<script>
import CardFunil from '../components/CardFunil.vue'
import InputComponent from '../components/InputComponent.vue';
import TextAreaComponent from '../components/TextAreaComponent.vue'
import { getFunnels, postFunnel } from '../services/ApiPrivateService';

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
            formData: {
                name: '',
                description: ''
            }
        }
    },
    methods: {
    async getInfo() {
        try {
            const response = await getFunnels();
            this.funnels = response.data.data;
        } catch (error) {
            console.error('Error:', error);
        }
    },
    async postFunnel() {
        try {
            const response = await postFunnel(this.formData);
            console.log("Funil criado");
            window.location.reload(true);
        } catch (error) {
            console.error('Falha ao criar funil', error);
            alert('Falha ao criar o funil');
        }
    },
    CreateFunnelName(newName) {
        this.formData.name = newName;
    },
    CreateFunnelDescription(newDescription) {
        this.formData.description = newDescription;
    }
    },
    created() {
        this.getInfo();
    }
}
</script>

<style scoped>
    .modal-content{
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