<template>
    <div>
        <div  class="card m-3">
            <div class="card-body">
                <div class="card-info">
                    <h5 class="card-title my-2">Titulo</h5>                    
                    <p class="card-text mt-4">R$ 0</p>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:'CardContact',
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
}
.card-text {
    color: #677C92;
    font-family: 'CerebriSansProRegular';
}
</style>