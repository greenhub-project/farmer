<template>
  <div class="w-full mb-4 md:mb-0 md:w-1/3 md:px-2">
    <div class="bg-white h-auto rounded-lg shadow">
      <div class="p-4">
        <div class="text-blue-darker text-lg font-semibold">{{ title }}</div>
        <div class="text-grey-darkest my-4">{{ body }}</div>
        <div class="text-grey-dark text-sm">Last updated: Jul 2019</div>
      </div>
      <div class="bg-grey-lighter text-center py-2 rounded-b-lg">
        <div class="flex items-center justify-center">
          <a
            :href="link"
            class="text-blue-darker hover:text-blue-darkest text-sm no-underline leading-normal"
          >Download File</a>
          <svg
            class="w-6 h-6 text-blue-darker"
            xmlns="http://www.w3.org/2000/svg"
            fill="currentColor"
            viewBox="0 0 24 24"
            width="24"
            height="24"
          >
            <path
              class="heroicon-ui"
              d="M9.3 8.7a1 1 0 0 1 1.4-1.4l4 4a1 1 0 0 1 0 1.4l-4 4a1 1 0 0 1-1.4-1.4l3.29-3.3-3.3-3.3z"
            ></path>
          </svg>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "DatasetCard",
  props: {
    title: {
      type: String,
      required: true
    },
    body: {
      type: String,
      required: true
    },
    link: {
      type: String,
      required: true
    }
  }
};
</script>

<style>
</style>
