<template>
  <div class="relative">
    <div role="button" class="inline-block select-none" @click="open = !open">
      <slot name="link"></slot>
    </div>
    <div class="absolute pin-r mt-px" v-show="open">
      <slot name="dropdown"></slot>
    </div>
  </div>
</template>

<script>
export default {
  name: "DropdownLink",
  data() {
    return {
      open: false
    };
  }
};
</script>
