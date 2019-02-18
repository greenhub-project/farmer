<template>
  <div class="rounded-lg shadow">
    <div class="bg-grey-lighter py-3 px-4 rounded-t-lg">
      <div class="flex text-blue-darker text-sm font-bold uppercase tracking-wide">
        <div class="flex-1 hidden md:block">Email</div>
        <div class="flex-1">Key</div>
        <div class="flex-1 text-right hidden lg:block">Last updated</div>
        <div class="flex-1">&nbsp;</div>
      </div>
    </div>
    <div class="bg-white py-3 px-4 rounded-b-lg">
      <div class="flex items-center text-blue-darker text-sm">
        <div class="flex-1 hidden md:block">{{ user.email }}</div>
        <div
          :class="['flex-1 hover:cursor-pointer hover:text-blue-darkest', busy ? 'text-blue-dark' : '']"
          @click="copyToClipboard"
        >{{ apiKey }}</div>
        <div class="flex-1 text-right hidden lg:block">{{ lastUpdate }}</div>
        <div class="flex-1 text-right">
          <button
            class="bg-blue-darker hover:bg-blue-darkest text-blue-lightest font-semibold py-2 px-4 rounded-full inline-flex items-center"
            @click="regenerate"
          >
            <svg
              class="fill-current w-4 h-4 mr-0 sm:mr-2"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="24"
              height="24"
            >
              <path
                class="heroicon-ui"
                d="M6 18.7V21a1 1 0 0 1-2 0v-5a1 1 0 0 1 1-1h5a1 1 0 1 1 0 2H7.1A7 7 0 0 0 19 12a1 1 0 1 1 2 0 9 9 0 0 1-15 6.7zM18 5.3V3a1 1 0 0 1 2 0v5a1 1 0 0 1-1 1h-5a1 1 0 0 1 0-2h2.9A7 7 0 0 0 5 12a1 1 0 1 1-2 0 9 9 0 0 1 15-6.7z"
              ></path>
            </svg>
            <span class="hidden sm:block">Regenerate</span>
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { toClipboard } from "copee";
import TokenService from "../services/TokenService";

export default {
  name: "ApiCredentialsTable",
  props: {
    user: {
      type: Object,
      required: true
    },
    token: {
      type: String,
      required: true
    }
  },
  data() {
    return {
      busy: false,
      apiKey: this.token,
      lastUpdate: this.user.updated_at
    };
  },
  methods: {
    regenerate() {
      this.busy = true;
      TokenService.update().then(({ data }) => {
        this.lastUpdate = data.updated_at;
        this.apiKey = data.token;
        this.busy = false;
      });
    },
    copyToClipboard() {
      if (toClipboard(this.apiKey)) {
        alert("API key copied to the clipboard!");
      }
    }
  }
};
</script>