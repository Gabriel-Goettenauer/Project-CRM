<template>
    <div class="mainTable m-2">
        <div class="line"></div>
        <div class="mx-3 my-2">
            <p class="tableTitle">{{table?.name}}</p>
        </div>
        <CardContact v-for="contact in contacts" :key="contact.id" :card="contact"/>

    </div>
</template>

<script>
import CardContact from './CardContact.vue'
import { getContacts } from '../services/ApiPrivateService';

export default {
    name:'TableContacts',
    components: { 
        CardContact 
    },
    data() {
        return {
            contacts: [],
        }
    },
    props:{
        table:{}
    },
    methods: {
        async getInfo() {
            try {
                const response = await getContacts();
                this.contacts = response.data;
                console.log(this.contacts);
            } catch (error) {
                console.error('Error:', error);
            }
        },
    },
    created() {
        this.getInfo();
    }
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