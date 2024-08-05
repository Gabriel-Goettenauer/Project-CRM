<template>
  <div>
    <span v-if="!isEditing" @click="toggleEdit" class="editable-span m-2">
      {{ funnelDescription }}
      <i class="bi bi-pencil pencil-icon"></i>
    </span>
    <div v-else class="input-wrapper m-1">
      <textarea
        v-model="newFunnelDescription"
        class="form-control input-with-icons"
        rows="11"
        @keyup.enter="confirmEdit"
        @keyup.esc="cancelEdit"
        :style="{ width: inputSize }"
      ></textarea>
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
      funnelDescription: this.Placeholder,
      newFunnelDescription: this.Placeholder,
      inputSize: this.sizeInput,
    };
  },
  props: {
    Placeholder: {
      type: String,
      required: true,
    },
    sizeInput: {
      type: String,
      required: true,
    },
  },
  methods: {
    toggleEdit() {
      this.newFunnelDescription = this.funnelDescription;
      this.isEditing = true;
    },
    confirmEdit() {
      this.funnelDescription = this.newFunnelDescription;
      this.isEditing = false;
      this.$emit("textarea-confirmed", this.newFunnelDescription);
    },
    cancelEdit() {
      this.isEditing = false;
    },
  },
};
</script>

<style scoped>
.editable-span {
  cursor: pointer;
  font-size: 18px;
  font-family: "CerebriSansProRegular";
  color: #1b1b2b;
  padding: 10px;
  display: inline-block;
  box-sizing: border-box;
  width: 340px;
}

.form-control {
  font-size: 18px;
  padding: 10px;
  box-sizing: border-box;
  font-family: "CerebriSansProRegular";
}

.pencil-icon {
  margin-left: 10px;
  display: none;
  color: #b1c2d9;
  font-size: 18px;
}

.editable-span:hover .pencil-icon {
  display: inline-block;
}

.input-wrapper {
  position: relative;
  display: inline-block;
  width: 340px;
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
  color: #5cb868;
}

.cancel-icon {
  right: 10px;
  color: #677c92;
}
</style>
