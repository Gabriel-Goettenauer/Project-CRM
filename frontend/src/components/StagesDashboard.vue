    <template>
    <div class="mainstages d-flex mx-3 overflow-x-auto">
        <TableContacts v-for="table in tables" :key="table.id" :table="table" :stageId="table.id"/>
    </div>

      <div class="modal fade" id="exampleModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header d-flex justify-content-between align-items-center">
              <h5 class="modal-title" id="exampleModalLabel">Nova Etapa</h5>
              <div class="d-flex justify-content-between align-items-center">
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
              </div>
            </div>
            <div class="modal-body">
              <div class="card p-2 m-2">
                <InputComponent Placeholder="Nome da Etapa" InputType="text" class="p-1" @input-confirmed="updateStageName"/>
                <div class="px-3 py-3 d-flex justify-content-start align-items-center">
                  <span class="px-1">Selecione uma cor :</span>
                  <input type="color" name="cor" id="cor" class="cor" value="#D2DDEC" v-model="formData.user_color">
                </div>
              </div>
            <div class="d-grid gap-2 col-6 mx-auto">
              <button class="btn btn-primary" type="button" @click="postStage()" @input-confirmed="updateStageName">Criar Etapa</button>
            </div>
          </div>
          </div>
        </div>
      </div>
    </template>

    <script>
    import TableContacts from './TableContacts.vue'
    import {getTables, postStage,} from '@/services/ApiPrivateService';
    import InputComponent from "../components/InputComponent.vue";

    export default {
    name: 'StagesDashboard',
    components: {
        TableContacts,
        InputComponent
    },

    data() {
        return {
        tables: [],
        formData: {
            name: '',
            user_color: '',
            funnel_id: this.$route.params.id,
        },
        funnelID: this.$route.params.id,
        }
    },
    methods: {
        async getInfo() {
        try {
            const response = await getTables(this.funnelID);
            this.tables = response.data;
        } catch (error) {
            console.error('Error:', error);
        }
        },
        async postStage() {
        try {
            const response = await postStage(this.formData);
            alert('Etapa criada com sucesso');
            this.getInfo();
        } catch (error) {
            console.error('ERRO', error);
            alert('Falha ao criar etapa');
        }
        },
        updateStageName(newName) {
        this.formData.name = newName;
        },
    },
    created() {
        this.getInfo();
    }
    }

    </script>

    <style scoped>
    .mainstages {
    background-color: #F9FAFC;
    height: 100vh;
    }

    i {
    color: #677C92;
    font-size: 50px;
    }

    .offcanvas {
    background-color: #F9FAFC;
    }

    .voltar:hover {
    cursor: pointer;
    }

    span {

    }

    .card-body {
    height: auto;
    }

    #cor {
    height: 35px;
    border: none;
    padding: 0;
    background-color: #fff;
    cursor: pointer;
    }

    #cor:focus {
    box-shadow: 0 0 0 0;
    border: 0 none;
    outline: 0;
    }
    </style>