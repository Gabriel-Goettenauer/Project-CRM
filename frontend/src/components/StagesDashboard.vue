<template>
    <div class="mainstages d-flex mx-3 overflow-x-auto">
        <TableContacts/>
        <TableContacts/>
        <TableContacts/>
        <TableContacts/>
        <TableContacts/>
<!--        <TableContacts/>-->
<!--        <TableContacts/>-->
<!--        <TableContacts/>-->
        
<!--        <div class="d-flex flex-column mx-3 my-3">-->
<!--            <div class="button d-flex justify-content-center align-items-center">-->
<!--                <i class="bi bi-plus-lg"></i>-->
<!--            </div>-->
<!--        </div>-->
    </div>
</template>

<script>
import TableContacts from './TableContacts.vue'
export default {
    name: 'StagesDashboard',
    components: { TableContacts },
}
</script>

<style scoped>
.mainstages{
    background-color: #F9FAFC;
    height: 850px;
}
.button{
    width: 256px;
    height: 833px;
    background-color: #E1E9F4;
    border: 1px solid #0000002d;
    border-radius:5px;
}
.button:hover{
        background-color:#D2DDEC;
    }
i{
    color: #677C92;
    font-size: 50px;
}

</style>