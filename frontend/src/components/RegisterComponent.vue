<template>
    <div class="Card">
        <h1 class="d-flex justify-content-center mt-5 mb-3 pb-2">Cadastro</h1>
        <div class="Formulario">
            <label class="pt-3 pb-2">Nome Completo</label>
            <input class="form-control" type="text" placeholder="Digite seu nome completo" v-model="formData.name">
            <label class="pt-3 pb-2">Telefone</label>
            <input class="form-control" type="tel" pattern="\(\d{2}\) \d{4,5}-\d{4}" placeholder="(11) 99999-9999" v-model="formData.phone">
            <label class="pt-3 pb-2">E-mail</label>
            <input class="form-control" type="email" placeholder="Digite seu e-mail" v-model="formData.email">
            <label class="pt-3 pb-2">Data de Nascimento</label>
            <input class="data form-control" type="date" placeholder="DD/MM/AAAAA" v-model="formData.dateOfBirth">
            <label class="pt-3 pb-2">Senha</label>
            <div class="input-group mb-3">
                <input :type="type" class="form-control" id="confirm-password" placeholder="Digite sua senha novamente" 
                v-model="formData.password"/>
                <span class="input-group-text" id="basic-addon1" @click="showPassword()"><i :class="eyeType"></i></span>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-4">
            <button class="btn" type="submit">Registrar</button>
        </div>
        <div class="d-flex justify-content-center p-4">
            <p>Já tem uma conta ?</p>
            <p class="Login px-3"><router-link to="/login">Login</router-link></p>
        </div>
    </div>
</template>

<script>
import { postUser } from '@/services/HttpService';

export default {
    name:"RegisterComponent",
    data(){
        return{
            formData:{
                name:'',
                phone:'',
                email:'',
                dateOfBirth:'',
                password:''
            },
            type: 'password',
            eyeType: 'bi bi-eye-fill'
        }
    },
    methods:{
        async postFormRegister(){
            await postUser(this.formData)
            console.log(postFormRegister);
        },
        showPassword() {
            if(this.type === 'password') {
                this.type = 'text'
                this.eyeType = 'bi bi-eye-slash-fill'
            } else {
                this.type = 'password'
                this.eyeType= 'bi bi-eye-fill'
            }
        }
    },
}
</script>

<style scoped>
.Card{
    margin: 46px;
    background-color: #F9FAFC;
    width:540px;
    height: 753px;
    border-radius: 24px;
    border: 1px solid #E1E9F4;
}
.Formulario{
    padding: 0 106px;
}
label{
    color: #373753;
    font-size: 16px;
    font-family: 'CerebriSansProRegular';
}
h1{
    font-family: 'RandomGrotesqueSpaciousBold';
    font-size: 40px;
    color:#1B1B2B;
}
input{
    font-family: 'CerebriSansProRegular';
    --bs-body-color: #72777A;
}
input::placeholder{
    font-family: 'CerebriSansProLight';
    font-size: 16px;
    color:#72777A;
    --bs-body-color: #72777A;
}
.btnEye{
    background-color: transparent;
}
button{
    background-color: #3333FF;
    color: #FFFFFF;
    font-family: 'CerebriSansProBold';
    font-size: 16px;
    width: 327px;
    height: 48px;
}
button:hover{
    background-color: #2336C7;
    color: #FFFFFF;
}
p{
    font-family: 'RandomGrotesqueStandardLight';
    color: #000000;
    font-size: 20px;
}
.Login{
    font-family: 'RandomGrotesqueStandardMedium';
    color: #000000;
}
.Login:hover{
    transition: 0.5s;
    color: #2336C7;
    font-size: 21px;
}
</style>