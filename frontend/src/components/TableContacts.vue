<template>
    <div class="mainTable m-2">
        <div class="line"></div>
        <div class="mx-3 my-2">
            <p class="tableTitle">Sem etapa</p>
        </div>
        <CardContact/>
        <CardContact/>
        <CardContact/>
        <CardContact/>

    </div>
</template>

<script>
import CardContact from './CardContact.vue'

export default {
    name:'TableContacts',
    components: { CardContact },
}
</script>

<style scoped>
    .mainTable{
        background-color: #F9FAFC;
        width: 256px;
        border-radius: 5px;
    }
    .mainTable:hover{
        background-color: #F0F4FA;
    }
    .line{
        background-color: #D2DDEC;
        border-radius: 21px;
        width:256px;
        height: 8px;
    }
    .tableTitle{
        font-size: 18px;
        color: #1B1B2B;
        font-family: 'CerebriSansProRegular';
    }
</style>