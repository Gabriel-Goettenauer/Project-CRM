<template>
  <div>
    <div class="Card">
      <h1 class="d-flex justify-content-center mt-5 mb-3 pb-2">Cadastro</h1>
      <div class="Formulario">
        <label class="pt-3 pb-2">Nome Completo</label>
        <input
          class="form-control"
          type="text"
          placeholder="Digite seu nome completo"
          v-model="formData.name"
        />
        <label class="pt-3 pb-2">Telefone</label>
        <input
          class="form-control"
          type="tel"
          pattern="\(\d{2}\) \d{4,5}-\d{4}"
          placeholder="(11) 99999-9999"
          v-model="formData.phone"
        />
        <label class="pt-3 pb-2">E-mail</label>
        <input
          class="form-control"
          type="email"
          placeholder="Digite seu e-mail"
          v-model="formData.email"
        />
        <label class="pt-3 pb-2">Data de Nascimento</label>
        <input
          class="data form-control"
          type="date"
          placeholder="DD/MM/AAAAA"
          v-model="formData.dateOfBirth"
        />
        <label class="pt-3 pb-2">Senha</label>
        <div class="input-group mb-3">
          <input
            :type="type"
            class="form-control"
            id="confirm-password"
            placeholder="Digite sua senha novamente"
            v-model="formData.password"
          />
          <span
            class="input-group-text"
            id="basic-addon1"
            @click="showPassword()"
            ><i :class="eyeType"></i
          ></span>
        </div>
      </div>
      <div class="d-flex justify-content-center mt-4">
        <button class="btn" type="submit" @click="postFormRegister()">
          Registrar
        </button>
      </div>
      <div class="d-flex justify-content-center p-4">
        <p>Já tem uma conta ?</p>
        <p class="Login px-3"><router-link to="/login">Login</router-link></p>
      </div>
    </div>
  </div>
</template>

<script>
import { postUser } from "@/services/HttpService";

export default {
  name: "RegisterComponent",
  data() {
    return {
      formData: {
        name: "",
        phone: "",
        email: "",
        dateOfBirth: "",
        password: "",
      },
      type: "password",
      eyeType: "bi bi-eye-fill",
    };
  },
  methods: {
    async postFormRegister() {
      try {
        const response = await postUser(this.formData);
        if (response.status === 201) {
          alert("Cadastro feito com Sucesso");
          this.formData = {};
          this.errors = {};
          this.$router.push("/login");
        }
      } catch (error) {
        if (error.response && error.response.data.errors) {
          this.errors = error.response.data.errors;

          let errorMessage = "";

          if (this.errors.email) {
            errorMessage = "Email já está em uso";
          } else if (this.errors.phone) {
            errorMessage = "Telefone já está em uso";
          } else {
            errorMessage =
              "Ocorreu um erro ao tentar realizar o cadastro. Tente novamente.";
          }
          alert(errorMessage);
        } else {
          alert(
            "Ocorreu um erro ao tentar realizar o cadastro. Tente novamente."
          );
        }
      }
    },
    showPassword() {
      if (this.type === "password") {
        this.type = "text";
        this.eyeType = "bi bi-eye-slash-fill";
      } else {
        this.type = "password";
        this.eyeType = "bi bi-eye-fill";
      }
    },
  },
};
</script>

<style scoped>
.Card {
  margin: 46px;
  background-color: #f9fafc;
  width: 540px;
  height: 753px;
  border-radius: 24px;
  border: 1px solid #e1e9f4;
}
.Formulario {
  padding: 0 106px;
}
label {
  color: #373753;
  font-size: 16px;
  font-family: "CerebriSansProRegular";
}
h1 {
  font-family: "RandomGrotesqueSpaciousBold";
  font-size: 40px;
  color: #1b1b2b;
}
input {
  font-family: "CerebriSansProRegular";
  --bs-body-color: #72777a;
}
input::placeholder {
  font-family: "CerebriSansProLight";
  font-size: 16px;
  color: #72777a;
  --bs-body-color: #72777a;
}
.btnEye {
  background-color: transparent;
}
button {
  background-color: #3333ff;
  color: #ffffff;
  font-family: "CerebriSansProBold";
  font-size: 16px;
  width: 327px;
  height: 48px;
}
button:hover {
  background-color: #2336c7;
  color: #ffffff;
}
p {
  font-family: "RandomGrotesqueStandardLight";
  color: #000000;
  font-size: 20px;
}
.Login {
  font-family: "RandomGrotesqueStandardMedium";
  color: #000000;
}
.Login:hover {
  transition: 0.5s;
  color: #2336c7;
  font-size: 21px;
}
</style>
