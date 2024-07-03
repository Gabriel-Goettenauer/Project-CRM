<template>
    <div class="Card">
        <h1 class="d-flex justify-content-center mt-5 mb-3 pb-2">Cadastro</h1>
        <div class="Formulario">
            <label class="pt-3 pb-2">Nome Completo</label>
            <input class="form-control" type="text" placeholder="Digite seu nome completo">
            <label class="pt-3 pb-2">Telefone</label>
            <input class="form-control" type="tel" pattern="\(\d{2}\) \d{4,5}-\d{4}" placeholder="(11) 99999-9999">
            <label class="pt-3 pb-2">E-mail</label>
            <input class="form-control" type="email" placeholder="Digite seu e-mail">
            <label class="pt-3 pb-2">Data de Nascimento</label>
            <input class="data form-control" type="date" placeholder="DD/MM/AAAAA">
            <label class="pt-3 pb-2">Senha</label>
            <input class="form-control" type="password" placeholder="Digite sua senha">
            <label class="pt-3 pb-2">Confirmar senha</label>
            <input class="form-control" type="password" placeholder="Digite sua senha novamente">
        </div>
        <div class="d-flex justify-content-center mt-4">
            <button class="btn" type="button" >Registrar</button>
        </div>
        <div class="d-flex justify-content-center p-4">
            <p>Já tem uma conta ?</p>
            <p class="Login px-3"><a>Login</a></p>
        </div>
    </div>
</template>

<script>
    export default {
        name:"RegisterComponent"
    }
</script>

<style scoped>
.Card{
    background-color: #F9FAFC;
    width:540px;
    height: 853px;
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
    font-family: 'RandomGrotesqueSpaciousLight';
    color: #000000;
    font-size:16px
}
.Login{
    font-family: 'RandomGrotesqueSpaciousMedium';
    color: #000000;
}
.Login:hover{
    transition: 0.5s;
    font-size:18px;
}
</style>