<template>
    <div class="main z-0 d-flex align-items-center justify-content-center">
        <ResetPasswordComponent/>
    </div>
</template>

<script>
import ResetPasswordComponent from '@/components/ResetPasswordComponent.vue';

export default {
    components: {
        ResetPasswordComponent,
    },
    setup() {
        
    },
};
</script>

<style>
.main{
    background: url(@/assets/images/Background-image.webp) no-repeat;
    background-size: cover;
    background-position: center center;
    height: 100vh;
}
</style>