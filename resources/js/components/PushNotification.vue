<template>
  <div
    :class="[displayClass, 'pin-r pin-b bg-green-lightest border border-green-light text-green-dark text-sm px-4 py-3 rounded m-4']"
  >{{ status }}</div>
</template>

<script>
export default {
  props: {
    status: {
      type: String,
      required: true
    }
  },
  data() {
    return {
      display: true
    };
  },
  computed: {
    displayClass() {
      return this.display ? "fixed" : "hidden";
    }
  },
  mounted() {
    setTimeout(() => (this.display = false), 3000);
  }
};
</script>
