<template>
    <div>
        <div class="card m-3" style="width: 18rem;">
            <div class="card-body">
                <div class="d-flex justify-content-between card-info">
                    <h5 class="card-title"></h5>
                                            <!-- {{ funnel.name }} -->
                    <i class="bi bi-trash-fill"></i>
                </div>

                <p class="card-text"></p>
                                    <!-- {{ funnel.description }} -->
            </div>
        </div>
    </div>
</template>

<script>
import { getFunnels } from '@/services/HttpService';

export default {
    name: 'CardFunil',

    data(){
        return{
            funnels:{
            }
        }
    },
    methods:{
        async getInfo(){
            try{
                const funnels = await getFunnels();
                // name = response.name;
                // description = response.description;
                if (funnels && funnels.length > 0) {
                    this.funnel = funnels[0]; // Supondo que você pegue o primeiro funil da lista
                }
            } catch (error) {
                console.error('Error fetching funnels:', error);
            }
        }
    }
}
</script>

<style scoped>

.card{
    background-color:#FFFFFF;
    color: #373753;
    font-family: 'CerebriSansProRegular';
    border: 1px solid #E1E9F4;

}
.card-text{
    color:#677C92;
}
.card-info i{
    color:#677C92;
}
i:hover{
    color: #FF3F3E;
}
</style>