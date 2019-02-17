<template>
  <div class="w-full mb-8 sm:flex-1 sm:mb-0">
    <div class="text-blue-lighter font-semibold uppercase tracking-ultrawide mb-2">{{ label }}</div>
    <div class="text-blue-lightest text-4xl font-light">{{ animatedNumber }}</div>
  </div>
</template>

<script>
import { TweenLite } from "gsap/TweenMax";
import StatsService from "../services/StatsService";

export default {
  name: "HeaderStatsItem",
  props: {
    label: {
      type: String,
      required: true
    },
    model: {
      type: String,
      required: true
    },
    interval: {
      type: Number,
      default: 10000
    }
  },
  data() {
    return {
      number: 0,
      tweenedNumber: 0
    };
  },
  computed: {
    animatedNumber() {
      return this.tweenedNumber.toFixed(0);
    }
  },
  watch: {
    number(newValue) {
      TweenLite.to(this.$data, 2.0, { tweenedNumber: newValue });
    }
  },
  methods: {
    fetchData() {
      StatsService.index(this.model).then(
        ({ data }) => (this.number = data.total)
      );
    }
  },
  created() {
    this.fetchData();
    setInterval(() => this.fetchData(), this.interval);
  }
};
</script>

<style>
</style>
