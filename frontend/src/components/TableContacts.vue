<template>
    <div class="mainTable m-2">
        <div class="line" :style="{ backgroundColor: table.user_color }"></div>

        <div class="mx-3 my-2">
            <p class="tableTitle">{{table?.name}}</p>
        </div>
        <CardContact v-for="contact in filteredContacts" :key="contact.id" :card="contact"/>

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
    props: {
        table: {
            type: Object,
            required: true,
        },
        stageId: {
            type: Number,
            required: true,
        },
    },
    methods: {
        async getInfo() {
            try {
                const response = await getContacts();
                this.contacts = response.data;
                console.log(this.colorUser);
            } catch (error) {
                console.error('Error:', error);
            }
        },
    },
    created() {
        this.getInfo();
    },
    computed: {
        filteredContacts() {
            const filtered = this.contacts.filter(contact => contact.stage_id === this.stageId);
            console.log(`Filtered Contacts for stage ${this.stageId}:`, filtered);
            return filtered;
        }
    },
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
        background-color: ;
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