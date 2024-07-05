<template>
    <div class="Card">
        <h1 class="d-flex justify-content-center mt-5 pb-2">Recuperar Senha</h1>
        <div class="Formulario mb-4">
            <label class="pt-3 pb-2">E-mail</label>
            <input class="form-control" type="email" placeholder="Digite seu e-mail">
            <label class="pt-3 pb-2">Senha</label>
            <div class="input-group mb-3">
                <input :type="type" class="form-control" id="confirm-password" placeholder="Digite sua senha" 
                v-model="formData.password"/>
                <span class="input-group-text" id="basic-addon1" @click="showPassword()"><i :class="eyeType"></i></span>
            </div>
        </div>
        <div class="d-flex justify-content-center mt-4">
            <button class="btn mt-2" type="button">Recuperar Senha</button>
        </div>
    </div>
</template>

<script>
    export default {
        name:"ResetPasswordComponent",
        data(){
            return{
                formData:{
                email:'',
                password:''
            },
                type: 'password',
                eyeType: 'bi bi-eye-fill'
            }
        },
        methods:{
            showPassword() {
            if(this.type === 'password') {
                this.type = 'text'
                this.eyeType = 'bi bi-eye-slash-fill'
            } else {
                this.type = 'password'
                this.eyeType= 'bi bi-eye-fill'
            }
        }
        }
    }
</script>

<style scoped>
.Card{
    margin: 46px;
    background-color: #F9FAFC;
    width:541px;
    height: 443px;
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
    font-size: 33px;
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
.forgotpassword{
    font-family: 'CerebriSansProLight';
    font-size: 14px;
    color: #3333FF;
}
.Cadastrese{
    font-family: 'RandomGrotesqueStandardMedium';
    color: #000000;
}
.Cadastrese:hover{
    transition: 0.5s;
    font-size:21px;
    -webkit-transition: font-size   21px;
}
</style>