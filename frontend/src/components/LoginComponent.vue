<template>
    <div class="Card">
        <h1 class="d-flex justify-content-center mt-5 mb-3 pb-2">Acessar</h1>
        <div class="Formulario">
            <label class="pt-3 pb-2">Nome Completo</label>
            <input class="form-control" type="text" placeholder="Digite seu nome completo">
            <label class="pt-3 pb-2">Senha</label>
            <input class="form-control" type="password" placeholder="Digite sua senha">
        </div>
        <div class="d-flex justify-content-center mt-4">
            <button class="btn" type="button">Entrar</button>
        </div>
        <div class="d-flex justify-content-center mt-4">
        <p class="forgotpassword"><router-link>Esqueceu sua senha ?</router-link></p>
        </div>
        <div class="d-flex justify-content-center ">
            <p>É novo por aqui?</p>
            <p class="Cadastrese px-3"><a>Cadastre-se</a></p>
        </div>
    </div>
</template>

<script>
    export default {
        name:"LoginComponent"
    }
</script>

<style scoped>
.Card{
    margin: 46px;
    background-color: #F9FAFC;
    width:541px;
    height: 543px;
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
    font-size:25px;
}
</style>