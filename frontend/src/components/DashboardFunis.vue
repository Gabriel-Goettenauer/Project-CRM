<template>
    <div class="main d-inline-flex flex-wrap justify-content-start m-4">
        <CardFunil/>
        <button type="button" class="btn btn-lg">Primary</button>
    </div>
</template>

<script>
import CardFunil from '../components/CardFunil.vue'

export default {
    name: 'DashboardFunis',
    components: {
        CardFunil,
    }
}
</script>

<style scoped>
</style>