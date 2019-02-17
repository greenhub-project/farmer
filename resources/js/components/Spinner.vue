<template>
  <div class="spinner bg-white mx-auto relative">
    <div class="double-bounce1 w-full h-full absolute pin-t pin-l bg-blue-dark rounded-full"></div>
    <div class="double-bounce2 w-full h-full absolute pin-t pin-l bg-blue-dark rounded-full"></div>
  </div>
</template>

<script>
export default {
  name: "Spinner"
};
</script>

<style scoped>
.spinner {
  width: 40px;
  height: 40px;
}

.double-bounce1,
.double-bounce2 {
  opacity: 0.6;

  -webkit-animation: sk-bounce 2s infinite ease-in-out;
  animation: sk-bounce 2s infinite ease-in-out;
}

.double-bounce2 {
  -webkit-animation-delay: -1s;
  animation-delay: -1s;
}

@-webkit-keyframes sk-bounce {
  0%,
  100% {
    -webkit-transform: scale(0);
  }
  50% {
    -webkit-transform: scale(1);
  }
}

@keyframes sk-bounce {
  0%,
  100% {
    transform: scale(0);
    -webkit-transform: scale(0);
  }
  50% {
    transform: scale(1);
    -webkit-transform: scale(1);
  }
}
</style>
