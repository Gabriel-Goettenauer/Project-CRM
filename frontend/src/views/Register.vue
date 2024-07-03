<template>
  <div class="main d-flex justify-content-center">
    <RegisterComponent/>
  </div>
</template>

<script>
import RegisterComponent from '../components/RegisterComponent.vue';
export default{
  name:"RegisterView",
  components:{
      RegisterComponent
    },
}
</script>

<style scoped>

</style>