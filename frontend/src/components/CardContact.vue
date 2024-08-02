<template>
    <div @click="emitCardId">
        <div  class="card m-3" >
            <div class="card-body">
                <div class="card-info">
                    <h5 class="card-title my-2 overflow-y-hidden">{{ card.name }}</h5>                    
                    <p>{{ this.card.position }}</p>
                    <p class="card-text mt-2">R$ {{ card.value }}</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:'CardContact',
    props:{
        card:{}
    },
    methods: {
        mitCardId() {
            this.$emit('card-clicked', this.card.id);
        },
    }
}

</script>

<style scoped>
.card {
    background-color: #FFFFFF;
    color: #373753;
    font-family: 'CerebriSansProRegular';
    border: 1px solid #E1E9F4;
    height: 114px;
}
.card:hover{
    border: 1px solid #B1C2D9;
    cursor: pointer;
}
.card-title{
    color: #373753;
    font-family: 'CerebriSansProRegular';
    height: 45px;
}
.card-text {
    color: #677C92;
    font-family: 'CerebriSansProRegular';
}
</style>