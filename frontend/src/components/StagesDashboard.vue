<template>
    <div class="mainstages d-flex mx-3 overflow-x-auto">
        <TableContacts v-for="table in tables" :key="table.id" :table="table"/>
    </div>
</template>

<script>
import TableContacts from './TableContacts.vue'
import { getTables} from '@/services/ApiPrivateService';

export default {
    name: 'StagesDashboard',
    components: { TableContacts },

    data(){
        return{
            tables:[],
        }
    },
    methods:{
        async getInfo(){
            try {
                const response = await getTables();
                this.tables = response.data;
                console.log(this.tables);
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