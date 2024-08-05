<template>
  <div>
    <div class="mainstages d-flex mx-3 overflow-x-auto">
      <TableContacts
        v-for="table in tables"
        :key="table.id"
        :table="table"
        :stageId="table.id"
      />
    </div>

    <div class="modal fade" id="modalNewStage" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div
            class="modal-header d-flex justify-content-between align-items-center"
          >
            <h5 class="modal-title" id="exampleModalLabel">Nova Etapa</h5>
            <div class="d-flex justify-content-between align-items-center">
              <button
                type="button"
                class="btn-close"
                data-bs-dismiss="modal"
              ></button>
            </div>
          </div>
          <div class="modal-body">
            <div class="card p-2 m-2">
              <InputComponent
                Placeholder="Nome da Etapa"
                InputType="text"
                class="p-1"
                @input-confirmed="updateStageName"
              />
              <div
                class="px-3 py-3 d-flex justify-content-start align-items-center"
              >
                <span class="px-1">Selecione uma cor :</span>
                <input
                  type="color"
                  name="cor"
                  id="cor"
                  class="cor"
                  value="#D2DDEC"
                  v-model="formData.user_color"
                />
              </div>
            </div>
            <div class="d-grid gap-2 col-6 mx-auto">
              <button
                class="btn addNewStage"
                type="button"
                @click="postStage()"
                @input-confirmed="updateStageName"
              >
                Criar Etapa
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div
      class="offcanvas offcanvas-end"
      tabindex="-1"
      :id="offcanvasUpdateContact"
    >
      <div
        class="offcanvas-header d-flex justify-content-between align-items-center"
      >
        <div class="d-flex justify-content-between align-items-center">
          <i class="voltar" data-bs-dismiss="offcanvas" aria-label="Close">
            <svg
              xmlns="http://www.w3.org/2000/svg"
              height="40px"
              viewBox="0 -960 960 960"
              width="40px"
              fill="#373753"
            >
              <path
                d="M524-480 394-350l42 43 173-173-173-173-42 43 130 130ZM480-80q-83 0-156-31.5t-127-86Q143-252 111.5-325T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 155.5 31.5t127 85.5q54.5 54 86 127T880-480q0 82-31.5 155t-86 127.5q-54.5 54.5-127 86T480-80Zm0-60q141 0 240.5-99.5T820-480q0-142-99.5-241T480-820q-142 0-241 99t-99 241q0 141 99 240.5T480-140Zm0-340Z"
              />
            </svg>
          </i>
          <label class="px-2">Voltar</label>
        </div>
        <h5 class="offcanvas-title">Novo Contato</h5>
      </div>

      <div class="card p-3 m-2">
        <InputComponent
          Placeholder="Nome do Contato"
          InputType="text"
          class="p-1"
          @input-confirmed="updateContactName"
        />
      </div>

      <div class="card p-3 m-2">
        <span class="d-flex align-items-center px-2">
          <i
            :class="{
              'bi-chevron-down': !isContactRotated,
              'bi-chevron-up': isContactRotated,
            }"
            @click="toggleRotation('contact')"
            data-bs-toggle="collapse"
            data-bs-target="#contact"
            class="p-2"
          ></i>
          <h4 class="m-0">Contato</h4>
        </span>
        <div class="collapse" id="contact">
          <hr />
          <div class="d-flex align-items-center px-2">
            <h5 class="mx-2">Telefone:</h5>
            <InputComponent
              Placeholder="Adicionar número"
              InputType="text"
              class="p-1"
              @input-confirmed="updateContactPhoneNumber"
            />
          </div>
          <div class="d-flex align-items-center px-2">
            <h5 class="mx-2">E-mail:</h5>
            <InputComponent
              Placeholder="Adicionar e-mail"
              InputType="text"
              class="p-1"
              @input-confirmed="updateContactEmail"
            />
          </div>
        </div>
      </div>

      <div class="card p-3 m-2">
        <span class="d-flex align-items-center px-2">
          <i
            :class="{
              'bi-chevron-down': !isDataRotated,
              'bi-chevron-up': isDataRotated,
            }"
            @click="toggleRotation('data')"
            data-bs-toggle="collapse"
            data-bs-target="#data"
            class="p-2"
          ></i>
          <h4 class="m-0">Dados</h4>
        </span>
        <div class="collapse" id="data">
          <hr />
          <div class="d-flex align-items-center px-2">
            <h5 class="mx-2">CPF:</h5>
            <InputComponent
              Placeholder="000.000.000-00"
              InputType="string"
              class="p-1"
              @input-confirmed="updateContactCPF"
            />
          </div>
          <div class="d-flex align-items-center px-2">
            <h5 class="mx-2">Data de nascimento:</h5>
            <InputComponent
              Placeholder="DD/MM/AAAA"
              InputType="date"
              class="p-1"
              @input-confirmed="updateContactDateOfBirth"
            />
          </div>
          <div class="d-flex align-items-center px-2">
            <h5 class="mx-2">Endereço:</h5>
            <InputComponent
              Placeholder="-"
              InputType="text"
              class="p-1"
              @input-confirmed="updateContactAddress"
            />
          </div>
          <div class="d-flex align-items-center px-2">
            <h5 class="mx-2">Valor:</h5>
            <InputComponent
              Placeholder="R$ 0,00"
              InputType="number"
              class="p-1"
              @input-confirmed="updateContactValue"
            />
          </div>
        </div>
      </div>
      <div class="d-grid gap-2 col-6 mx-auto">
        <button class="btn btn-primary" type="button" @click="postContact">
          Criar Contato
        </button>
      </div>
    </div>
  </div>
</template>

<script>
import TableContacts from "./TableContacts.vue";
import { getTables, postStage } from "@/services/ApiPrivateService";
import InputComponent from "../components/InputComponent.vue";

export default {
  name: "StagesDashboard",
  components: {
    TableContacts,
    InputComponent,
  },

  data() {
    return {
      tables: [],
      formData: {
        name: "",
        user_color: "",
        funnel_id: this.$route.params.id,
      },
      funnelID: this.$route.params.id,
    };
  },
  methods: {
    async getInfo() {
      try {
        const response = await getTables(this.funnelID);
        this.tables = response.data;
      } catch (error) {
        console.error("Error:", error);
      }
    },
    async postStage() {
      try {
        const response = await postStage(this.formData);
        this.getInfo();
      } catch (error) {
        console.error("ERRO", error);
        alert("Falha ao criar etapa");
      }
    },
    updateStageName(newName) {
      this.formData.name = newName;
    },
  },
  created() {
    this.getInfo();
  },
};
</script>

<style scoped>
.mainstages {
  background-color: #f9fafc;
  height: 100vh;
}

i {
  color: #677c92;
  font-size: 50px;
}

.offcanvas {
  background-color: #f9fafc;
}

.voltar:hover {
  cursor: pointer;
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

.addNewStage {
  background-color: #3057f2;
  color: #ffffff;
  border-radius: 10px;
  width: 261px;
  height: 40px;
}
.btn {
  font-weight: bold;
}
</style>
