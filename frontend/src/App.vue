<template>
  <div>
    <router-view/>
  </div>
</template>

<script setup>
</script>

<style>
*::-webkit-scrollbar {
  width: 12px;
}

*::-webkit-scrollbar-track {
  background: #F9FAFC;
}

*::-webkit-scrollbar-thumb {
  background-color: #FFBD00;
  border-radius: 20px;
  border: 3px solid #FFFFFF
}

@font-face {
    font-family: 'CerebriSansProRegular';
    src: url('@/assets/fonts/CerebriSansPro-Regular.ttf');
}
@font-face{
  font-family: 'CerebriSansProLight';
  src: url('@/assets/fonts/CerebriSansPro-Light.ttf');
}
@font-face{
  font-family: 'CerebriSansProBold';
  src: url('@/assets/fonts/CerebriSansPro-Bold.ttf');
}

/* ==================================================== */
@font-face{
  font-family: 'RandomGrotesqueSpaciousBold';
  src: url('@/assets/fonts/RG-SpaciousBold.ttf');
}
@font-face{
  font-family: 'RandomGrotesqueSpaciousLight';
  src: url('@/assets/fonts/RG-SpaciousLight.ttf');
}
@font-face{
  font-family: 'RandomGrotesqueSpaciousMedium';
  src: url('@/assets/fonts/RG-SpaciousMedium.ttf');
}
@font-face{
  font-family: 'RandomGrotesqueStandardLight';
  src: url('@/assets/fonts/RG-StandardLight.ttf');
}
@font-face{
  font-family: 'RandomGrotesqueStandardMedium';
  src: url('@/assets/fonts/RG-StandardMedium.ttf');
}
</style>
