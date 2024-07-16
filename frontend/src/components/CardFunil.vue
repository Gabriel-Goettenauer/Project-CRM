<template>
    <div>
        <div class="card m-3" style="width: 18rem;">
            <div class="card-body">
                <div class="d-flex justify-content-between card-info">
                    <h5 class="card-title">Card title</h5>
                    <i class="bi bi-trash-fill" @click="s"></i>
                </div>

                <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'CardFunil',
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