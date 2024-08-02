<template>
  <div class="mainTable m-2">
    <div class="line" :style="{ backgroundColor: table.user_color }"></div>
    <div class="mx-3 my-2 d-flex align-items-center justify-content-between">
      <p class="tableTitle">{{ table?.name }}</p>
      <span class="newContact d-flex align-items-center justify-content-center"
            data-bs-toggle="offcanvas" :data-bs-target="'#' + offcanvasContact">
        <i class="bi bi-plus-lg mt-1"></i>
      </span>
    </div>
    <draggable v-model="filteredContactsList" group="contacts" @change="updateStage" item-key="id" :animation="300" ghost-class="hidden-ghost">
      <template #item="{ element }">
        <CardContact :card="element" :key="element.id" @card-clicked="setCardId"/>
      </template>
    </draggable>
  </div>

  <div class="offcanvas offcanvas-end" tabindex="-1" :id="offcanvasContact">
    <div class="offcanvas-header d-flex justify-content-between align-items-center">
      <div class="d-flex justify-content-between align-items-center">
        <i class="voltar" data-bs-dismiss="offcanvas" aria-label="Close">
          <svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#373753">
            <path d="M524-480 394-350l42 43 173-173-173-173-42 43 130 130ZM480-80q-83 0-156-31.5t-127-86Q143-252 111.5-325T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 155.5 31.5t127 85.5q54.5 54 86 127T880-480q0 82-31.5 155t-86 127.5q-54.5 54.5-127 86T480-80Zm0-60q141 0 240.5-99.5T820-480q0-142-99.5-241T480-820q-142 0-241 99t-99 241q0 141 99 240.5T480-140Zm0-340Z"/>
          </svg>
        </i>
        <label class="px-2">Voltar</label>
      </div>
      <h5 class="offcanvas-title">Novo Contato</h5>
    </div>

    <div class="card p-3 m-2">
      <InputComponent Placeholder="Nome do Contato" InputType="text" class="p-1" @input-confirmed="updateContactName"/>
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
          <InputComponent Placeholder="Adicionar número" InputType="text" class="p-1" @input-confirmed="updateContactPhoneNumber"/>
        </div>
        <div class="d-flex align-items-center px-2">
          <h5 class="mx-2">E-mail:</h5>
          <InputComponent Placeholder="Adicionar e-mail" InputType="text" class="p-1" @input-confirmed="updateContactEmail"/>
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
      <button class="btn btn-primary" type="button" @click="postContact">Criar Contato</button>
    </div>
  </div>
</template>

<script>
import CardContact from './CardContact.vue';
import { getContacts, postContact, updateContactPosition, updateContactStage } from '../services/ApiPrivateService';
import InputComponent from "@/components/InputComponent.vue";
import draggable from 'vuedraggable';

export default {
  name: 'TableContacts',
  components: {
    InputComponent,
    CardContact,
    draggable
  },
  data() {
    return {
      contacts: [],
      filteredContactsList: [],
      isContactRotated: false,
      isDataRotated: false,
      funnel_id: '',
      formData: {
        name: '',
        email: '',
        ddd_location: '',
        phone: '',
        cpf: '',
        date_of_birth: '',
        value: '',
        address: '',
        stage_id: this.stageId,
      },
      card_id: '',
      stage_id: this.stageId,
      offcanvasContact: 'offcanvas-' + this.stageId,
    };
  },
  props: {
    table: {
      type: Object,
      required: true,
    },
    stageId: {
      type: Number,
      required: true,
    },
  },
  methods: {
    async getInfo() {
      try {
        const response = await getContacts();
        this.contacts = response.data;
        this.updateFilteredContacts();
      } catch (error) {
        console.error('Error:', error);
      }
    },
    async postContact() {
      try {
        const response = await postContact(this.formData);
        console.log("criado");
      } catch (error) {
        console.error('Falha ao criar contato', error);
      }
    },
    async updateStage(evt) {
      try {
        if (evt.added) {
          const contact = evt.added.element;
          contact.stage_id = this.stageId;
          await updateContactStage(contact.id, { stage_id: contact.stage_id });
          await updateContactPosition(contact.id, { position: evt.added.newIndex });
          this.updateFilteredContacts();
          this.getInfo();
        } else if (evt.moved) {
          const contact = evt.moved.element;
          await updateContactPosition(contact.id, { position: evt.moved.newIndex });
          this.updateFilteredContacts();
          this.getInfo();
        }
      } catch (error) {
        // console.error('Error:', error);
      }
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
    toggleRotation(section) {
      if (section === 'contact') {
        this.isContactRotated = !this.isContactRotated;
      } else if (section === 'data') {
        this.isDataRotated = !this.isDataRotated;
      }
    },
    setCardId(cardId) {
      this.card_id = cardId;
      console.log('Card ID:', cardId);
    },
    updateFilteredContacts() {
      this.filteredContactsList = this.contacts.filter(contact => contact.stage_id === this.stageId);
    },
  },
  created() {
    this.getInfo();
  },
  watch: {
    contacts() {
      this.updateFilteredContacts();
    }
  },
};
</script>

<style scoped>
.mainTable {
  background-color: #F9FAFC;
  width: 256px;
  border-radius: 5px;
}

.mainTable:hover {
  background-color: #F0F4FA;
}

.line {
  border-radius: 21px;
  width: 256px;
  height: 8px;
}

.tableTitle {
  font-size: 18px;
  color: #1B1B2B;
  font-family: 'CerebriSansProRegular';
}

.newContact {
  width: 32px;
  height: 32px;
  background-color: #E1E9F4;
  border-radius: 8px;
  color: #677C92;
}

.newContact:hover {
  background-color: #D2DDEC;
  cursor: pointer;
}

h1 {
  font-family: 'RandomGrotesqueStandardMedium';
  color: #1B1B2B;
}

svg {
  background-color: #F9FAFC;
  transform: rotate(180deg);
}

.offcanvas {
  background-color: #F9FAFC;
  width: 600px;
}

.voltar:hover {
  cursor: pointer;
}

.bi-chevron-down {
  transition: transform 0.3s;
}

.bi-chevron-up {
  transform: rotate(180deg);
  transition: transform 0.5s;
}

.hidden-ghost {
  opacity: 0.3;
}
</style>
