<template>
  <div>
    <span v-if="!isEditing" @click="toggleEdit" class="editable-span">
      {{ contactName }}
      <i class="bi bi-pencil pencil-icon"></i>
    </span>
    <div v-else class="input-wrapper">
      <input type="text" v-model="newContactName" class="form-control input-with-icons" @keyup.enter="confirmEdit" @keyup.esc="cancelEdit">
      <i class="bi bi-check icon check-icon" @click="confirmEdit"></i>
      <i class="bi bi-x icon cancel-icon" @click="cancelEdit"></i>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      isEditing: false,
      contactName: 'Nome do Contato',
      newContactName: 'Nome do Contato'
    };
  },
  methods: {
    toggleEdit() {
      this.newContactName = this.contactName;
      this.isEditing = true;
    },
    confirmEdit() {
      this.contactName = this.newContactName;
      this.isEditing = false;
    },
    cancelEdit() {
      this.isEditing = false;
    }
  }
};
</script>

<style scoped>
.editable-span {
  position: relative;
  cursor: pointer;
}

.pencil-icon {
  margin-left: 10px;
  display: none;
}

.editable-span:hover .pencil-icon {
  display: inline-block;
}

.input-wrapper {
  position: relative;
  display: inline-block;
}

.input-with-icons {
  padding-right: 50px; /* espaço para os ícones */
}

.icon {
  position: absolute;
  top: 50%;
  transform: translateY(-50%);
  cursor: pointer;
}

.check-icon {
  right: 30px;
  color: green;
}

.cancel-icon {
  right: 10px;
  color: red;
}
</style>
