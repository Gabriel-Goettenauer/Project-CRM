<template>
  <div>
    <div class="card m-3" style="width: 18rem" @click="goToStage()">
      <div class="card-body">
        <div class="d-flex justify-content-between card-info">
          <h5 class="card-title">{{ card.name }}</h5>
          <div class="icon-container">
            <i
              class="bi bi-pencil-fill px-3"
              data-bs-toggle="modal"
              :data-bs-target="'#' + modaleditID"
              @click.stop
            ></i>
            <i
              class="bi bi-trash-fill"
              data-bs-toggle="modal"
              :data-bs-target="'#' + modalId"
              @click.stop
            ></i>
          </div>
        </div>
        <p class="card-text overflow-x-auto">{{ card.description }}</p>
      </div>
    </div>

    <div class="modal fade" :id="modalId" tabindex="-1">
      <div
        class="modal-dialog modal-dialog-centered d-flex justify-content-center"
      >
        <div class="modal-content">
          <div class="modal-header d-flex justify-content-center">
            <h1 class="modal-title fs-5">
              <i class="bi bi-exclamation-octagon"></i>
            </h1>
          </div>
          <div class="modal-body d-flex justify-content-center">
            <p>Tem certeza que deseja excluir esse funil?</p>
          </div>
          <div class="modal-footer d-flex justify-content-center">
            <button
              type="button"
              class="btn cancel btn-lg"
              data-bs-dismiss="modal"
            >
              Cancelar
            </button>
            <button
              type="button"
              class="btn delete btn-lg"
              @click="deleteFunnel(card.id)"
            >
              Deletar
            </button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" tabindex="-1" :id="modaleditID">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div
            class="modal-header d-flex justify-content-between align-items-center"
          >
            <h5 class="modal-title" id="modalRightLabel">Editar Funil</h5>
            <button
              type="button"
              class="btn-close"
              data-bs-dismiss="modal"
            ></button>
          </div>
          <div class="modal-body">
            <div class="card p-2 m-2">
              <InputComponent
                :Placeholder="card.name"
                InputType="text"
                sizeInput="425px"
                class="p-1"
                @input-confirmed="updateFunnelName"
              />
              <TextAreaComponent
                class="p-1 overflow-auto"
                :Placeholder="card.description"
                @textarea-confirmed="updateFunnelDescription"
                sizeInput="400px"
              />
            </div>
            <div class="d-grid gap-2 col-6 mx-auto">
              <button
                class="btn btn-primary"
                type="button"
                @click="updateFunnel(card.id)"
              >
                Atualizar Funil
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { deleteFunnel, updateFunnel } from "@/services/ApiPrivateService";
import InputComponent from "../components/InputComponent.vue";
import TextAreaComponent from "../components/TextAreaComponent.vue";

export default {
  name: "CardFunil",
  components: {
    InputComponent,
    TextAreaComponent,
  },
  data() {
    return {
      modalId: "deleteModal" + this.card.id,
      modaleditID: "editModal" + this.card.id,
      formData: {
        name: "",
        description: "",
      },
    };
  },
  props: {
    card: {
      type: Object,
      required: true,
    },
  },
  methods: {
    async deleteFunnel(id) {
      try {
        await deleteFunnel(id);
        alert("Funnel deleted successfully!");
        window.location.reload(true);
      } catch (error) {
        console.error("Failed to delete the funnel:", error);
        alert("Failed to delete the funnel.");
      }
    },
    async updateFunnel(id) {
      try {
        await updateFunnel(id, this.formData);
        window.location.reload(true);
      } catch (error) {
        console.error("ERRO", error);
        alert("FALHA AO ATUALIZAR FUNIL");
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
    },
  },
};
</script>

<style scoped>
.modal-content {
  background-color: #f9fafc;
}
.card {
  background-color: #ffffff;
  color: #373753;
  font-family: "CerebriSansProRegular";
  border: 1px solid #e1e9f4;
  height: 170px;
}
.card:hover {
  border: 1px solid #b1c2d9;
  cursor: pointer;
}
.card-text {
  color: #677c92;
  height: 104px;
}
.card-info i {
  color: #677c92;
}
.icon-container i.bi-pencil-fill {
  display: none;
}
.icon-container i.bi-trash-fill {
  display: none;
}
.card:hover .icon-container i.bi-pencil-fill {
  display: inline-block;
}
.card:hover .icon-container i.bi-trash-fill {
  display: inline-block;
}
.bi-trash-fill:hover {
  color: #ff3f3e;
  font-size: 20px;
  transition: 0.5s;
}
.bi-pencil-fill:hover {
  font-size: 20px;
  transition: 0.5s;
}
.modal-body {
  --bs-modal-footer-border-color: #ffffff;
}
.modal-footer {
  --bs-modal-footer-border-color: #ffffff;
}
.bi-exclamation-octagon {
  color: #ff4444;
  font-size: 35px;
}
.delete {
  background-color: #ff4444;
  color: #ffffff;
}
.delete:hover {
  background-color: #cc0001;
}
.cancel {
  background-color: #e1e9f4;
  color: #677c92;
}
.cancel:hover {
  background-color: #d2ddec;
  border: solid 1px #b1c2d9;
}
</style>
