<template>
  <div>
    <span v-if="!isEditing" @click="toggleEdit" class="editable-span">
      {{ Name }}
      <i class="bi bi-pencil pencil-icon"></i>
    </span>

    <div v-else class="input-wrapper">
      <input :type="typeInput" v-model="newName" class="form-control input-with-icons" @keyup.enter="confirmEdit" @keyup.esc="cancelEdit">
      <i class="bi bi-x icon cancel-icon" @click="cancelEdit"></i>
      <i class="bi bi-check icon check-icon" @click="confirmEdit"></i>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      isEditing: false,
      Name: this.Placeholder,
      newName: this.Placeholder,
      typeInput: this.InputType
    }
  },
  props: {
    Placeholder: {
      type: String,
      required: true
    },
    InputType: {
      type: String,
      required: true,
    },
  },
  methods: {
    toggleEdit() {
      this.newName = this.Name;
      this.isEditing = true;
    },
    confirmEdit() {
      this.Name = this.newName;
      this.isEditing = false;
      this.$emit('input-confirmed', this.newName);
    },
    cancelEdit() {
      this.isEditing = false;
    }
  }
};
</script>

<style scoped>
  .editable-span {
    cursor: pointer;
    font-size: 22px;
    font-family: 'CerebriSansProRegular';
    color: #1B1B2B;
    padding: 11px 17px;
    display: inline-block;
    box-sizing: border-box;
  }

  .form-control {
    font-size: 22px;
    padding: 10px 16px;
    box-sizing: border-box;
    width: 100%;
    font-family: 'CerebriSansProRegular';
  }

  .pencil-icon {
    margin-left: 10px;
    display: none;
    color: #B1C2D9;
    font-size: 20px;
  }

  .editable-span:hover .pencil-icon {
    display: inline-block;
  }

  .input-wrapper {
    position: relative;
    display: inline-block;
  }

  .input-with-icons {
    padding-right: 50px;
  }

  .icon {
    font-size: 20px;
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    cursor: pointer;
  }

  .check-icon {
    right: 30px;
    color: #5CB868;
  }

  .cancel-icon {
    right: 10px;
    color: #677C92;
  }
</style>
