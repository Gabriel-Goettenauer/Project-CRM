<template>
  <div class="Card">
    <h1 class="d-flex justify-content-center mt-5 mb-3 pb-2">Login</h1>
    <div class="Formulario">
      <label class="pt-3 pb-2">E-mail</label>
      <input
        class="form-control"
        type="email"
        placeholder="Digite seu e-mail"
        v-model="formData.email"
      />
      <label class="pt-3 pb-2">Senha</label>
      <div class="input-group mb-3">
        <input
          :type="type"
          class="form-control"
          id="confirm-password"
          placeholder="Digite sua senha"
          v-model="formData.password"
        />
        <span class="input-group-text" id="basic-addon1" @click="showPassword()"
          ><i :class="eyeType"></i
        ></span>
      </div>
    </div>
    <div class="d-flex justify-content-center mt-4">
      <button class="btn" type="button" @click="postFormLogin()">Entrar</button>
    </div>
    <div class="d-flex justify-content-center mt-4">
      <p class="forgotpassword">
        <router-link to="/reset_password">Esqueceu sua senha ?</router-link>
      </p>
    </div>
    <div class="d-flex justify-content-center">
      <p>É novo por aqui?</p>
      <p class="Cadastrese px-3">
        <router-link to="/register">Cadastra-se</router-link>
      </p>
    </div>
  </div>
</template>

<script>
import { postLogin } from "@/services/HttpService";
import { mapActions } from "vuex";

export default {
  name: "LoginComponent",
  data() {
    return {
      formData: {
        email: "",
        password: "",
      },
      type: "password",
      eyeType: "bi bi-eye-fill",
    };
  },
  methods: {
    ...mapActions(["setToken", "setTokenableId"]),

    async postFormLogin() {
      try {
        const response = await postLogin(this.formData);
        const token = response.data.access_token;
        const tokenableId = response.data.tokenable_id;

        this.setToken(token);
        this.setTokenableId(tokenableId);

        localStorage.setItem("token", token);
        localStorage.setItem("tokenableID", tokenableId);

        this.$router.push("/home");
      } catch (error) {
        if (error.response && error.response.data.errors) {
          this.errors = error.response.data.errors;

          let errorMessage = "";

          if (this.errors.email) {
            errorMessage = "E-mail Incorreto";
          } else if (this.errors.senha) {
            errorMessage = "Senha Incorreta";
          } else {
            errorMessage =
              "Ocorreu um erro ao tentar realizar o cadastro. Tente novamente.";
          }
          alert(errorMessage);
        } else {
          alert("Ocorreu um erro ao tentar realizar o login. Tente novamente.");
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
  width: 541px;
  height: 543px;
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
.forgotpassword {
  font-family: "CerebriSansProLight";
  font-size: 14px;
  color: #3333ff;
}
.Cadastrese {
  font-family: "RandomGrotesqueStandardMedium";
  color: #000000;
}
.Cadastrese:hover {
  transition: 0.5s;
  font-size: 21px;
}
</style>
