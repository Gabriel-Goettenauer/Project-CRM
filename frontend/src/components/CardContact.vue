<template>
<div>
    <div @click="emitCardId" :data-bs-target="'#' + modaleditID">
        <div  class="card m-3" >
            <div class="card-body">
                <div class="card-info">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title overflow-y-hidden">{{ card.name }}</h5>                    
                        <div class="icon-container">
                            <i class="bi bi-trash-fill" data-bs-toggle="modal" :data-bs-target="'#' + modalId" @click.stop></i>
                        </div>
                    </div>
                    <p class="card-text">R$ {{ card.value }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" :id="modalId" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered d-flex justify-content-center">
          <div class="modal-content">
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

    <div class="offcanvas offcanvas-end" tabindex="-1" :id="offCanvaEditContact">
    <div class="offcanvas-header d-flex justify-content-between align-items-center">
      <div class="d-flex justify-content-between align-items-center">
        <i class="voltar" data-bs-dismiss="offcanvas" aria-label="Close">
          <svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#373753">
            <path d="M524-480 394-350l42 43 173-173-173-173-42 43 130 130ZM480-80q-83 0-156-31.5t-127-86Q143-252 111.5-325T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 155.5 31.5t127 85.5q54.5 54 86 127T880-480q0 82-31.5 155t-86 127.5q-54.5 54.5-127 86T480-80Zm0-60q141 0 240.5-99.5T820-480q0-142-99.5-241T480-820q-142 0-241 99t-99 241q0 141 99 240.5T480-140Zm0-340Z"/>
          </svg>
        </i>
        <label class="px-2">Voltar</label>
      </div>
      <h5 class="offcanvas-title">Editar contato</h5>
    </div>

    <div class="card p-3 m-2">
      <InputComponent :Placeholder="card.nome" InputType="text" class="p-1" @input-confirmed="updateContactName"/>
    </div>

    <div class="card p-3 m-2">
      <span class="d-flex align-items-center px-2">
        <i :class="{'bi-chevron-down': !isContactRotated, 'bi-chevron-up': isContactRotated}" @click="toggleRotation('contact')" data-bs-toggle="collapse" data-bs-target="#contact" class="p-2"></i>
        <h4 class="m-0">Contato</h4>
      </span>
      <div class="collapse" id="contact">
        <hr>
        <div class="d-flex align-items-center px-2">
          <h5 class="mx-2">Telefone:</h5>
          <InputComponent :Placeholder="card.phone" InputType="text" class="p-1" @input-confirmed="updateContactPhoneNumber"/>
        </div>
        <div class="d-flex align-items-center px-2">
          <h5 class="mx-2">E-mail:</h5>
          <InputComponent :Placeholder="card.email" InputType="text" class="p-1" @input-confirmed="updateContactEmail"/>
        </div>
      </div>
    </div>

    <div class="card p-3 m-2">
      <span class="d-flex align-items-center px-2">
        <i :class="{'bi-chevron-down': !isDataRotated, 'bi-chevron-up': isDataRotated}" @click="toggleRotation('data')" data-bs-toggle="collapse" data-bs-target="#data" class="p-2"></i>
        <h4 class="m-0">Dados</h4>
      </span>
      <div class="collapse" id="data">
        <hr>
        <div class="d-flex align-items-center px-2">
          <h5 class="mx-2">CPF:</h5>
          <InputComponent Placeholder="000.000.000-00" InputType="string" class="p-1" @input-confirmed="updateContactCPF"/>
        </div>
        <div class="d-flex align-items-center px-2">
          <h5 class="mx-2">Data de nascimento:</h5>
          <InputComponent Placeholder="DD/MM/AAAA" InputType="date" class="p-1" @input-confirmed="updateContactDateOfBirth"/>
        </div>
        <div class="d-flex align-items-center px-2">
          <h5 class="mx-2">Endereço:</h5>
          <InputComponent Placeholder="-" InputType="text" class="p-1" @input-confirmed="updateContactAddress"/>
        </div>
        <div class="d-flex align-items-center px-2">
          <h5 class="mx-2">Valor:</h5>
          <InputComponent Placeholder="R$ 0,00" InputType="number" class="p-1" @input-confirmed="updateContactValue"/>
        </div>
      </div>
    </div>
    <div class="d-grid gap-2 col-6 mx-auto">
      <button class="btn btn-primary" type="button" @click="postContact">Editar Contato</button>
    </div>
  </div>

</div>
</template>

<script>
export default {
    name:'CardContact',
    data(){
        return{
            modalId: 'deleteModal' + this.card.id,
            offCanvaEditContact: 'offcanvas-' + this.stageId,
        }
    },
    props:{
        card:{}
    },
    methods: {
        mitCardId() {
            this.$emit('card-clicked', this.card.id);
        },
        updateContactName(newName) {
        this.formData.name = newName;
        },
        updateContactPhoneNumber(newPhoneNumber) {
        this.formData.ddd_location = newPhoneNumber.slice(0, 2);
        this.formData.phone = newPhoneNumber.slice(2);
        },
        updateContactEmail(newEmail) {
        this.formData.email = newEmail;
        },
        updateContactCPF(newCPF) {
        this.formData.cpf = newCPF;
        },
        updateContactDateOfBirth(newDateOfBirth) {
        this.formData.date_of_birth = newDateOfBirth;
        },
        updateContactAddress(newAddress) {
        this.formData.address = newAddress;
        },
        updateContactValue(newValue) {
        this.formData.value = newValue;
        },
    }
}

</script>

<style scoped>
.card {
    background-color: #FFFFFF;
    color: #373753;
    font-family: 'CerebriSansProRegular';
    border: 1px solid #E1E9F4;
    height: 114px;
}
.card:hover{
    border: 1px solid #B1C2D9;
    cursor: pointer;
}
.card-title{
    color: #373753;
    font-family: 'CerebriSansProRegular';
    height: 45px;
}
.card-text {
    color: #677C92;
    font-family: 'CerebriSansProRegular';
}
.modal-content{
  background-color:#F9FAFC;
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