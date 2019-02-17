<template>
  <div class="rounded-lg shadow">
    <div class="bg-grey-lighter py-3 px-4 rounded-t-lg">
      <div class="flex text-blue-darker text-sm font-bold uppercase tracking-wide">
        <div class="w-12">&nbsp;</div>
        <div class="w-1/5">User</div>
        <div class="w-1/4">Email</div>
        <div class="flex-1">Role</div>
        <div class="flex-1">Joined at</div>
        <div class="flex-1">Status</div>
        <div class="w-24">&nbsp;</div>
      </div>
    </div>
    <div class="bg-white rounded-b-lg" :class="busy ? 'py-4' : ''">
      <Spinner v-if="busy"/>
      <div class="table-body" v-else>
        <div
          class="flex items-center text-blue-darker text-sm p-4 table-item"
          v-for="user of users"
          :key="user.name"
        >
          <div class="w-12">
            <img
              class="inline-block h-8 w-8 rounded-full"
              src="https://randomuser.me/portraits/lego/1.jpg"
              :alt="user.name"
            >
          </div>
          <div class="w-1/5 flex flex-col">
            <span class="mb-1">{{ user.name }}</span>
            <span class="text-grey-dark">#{{ user.id }}</span>
          </div>
          <div class="w-1/4">{{ user.email }}</div>
          <div class="flex-1 capitalize">{{ user.roles[0].name }}</div>
          <div class="flex-1">{{ user.created_at }}</div>
          <div class="flex-1" title="Verified" v-if="user.email_verified_at !== null">
            <svg
              class="h-8 h-8 text-green"
              fill="currentColor"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="24"
              height="24"
            >
              <path
                class="heroicon-ui"
                d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-3.54-4.46a1 1 0 0 1 1.42-1.42 3 3 0 0 0 4.24 0 1 1 0 0 1 1.42 1.42 5 5 0 0 1-7.08 0zM9 11a1 1 0 1 1 0-2 1 1 0 0 1 0 2zm6 0a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"
              ></path>
            </svg>
          </div>
          <div class="flex-1" title="Unverified" v-else>
            <svg
              class="h-8 h-8 text-red"
              fill="currentColor"
              xmlns="http://www.w3.org/2000/svg"
              viewBox="0 0 24 24"
              width="24"
              height="24"
            >
              <path
                class="heroicon-ui"
                d="M12 22a10 10 0 1 1 0-20 10 10 0 0 1 0 20zm0-2a8 8 0 1 0 0-16 8 8 0 0 0 0 16zm-3.54-4.54a5 5 0 0 1 7.08 0 1 1 0 0 1-1.42 1.42 3 3 0 0 0-4.24 0 1 1 0 0 1-1.42-1.42zM9 11a1 1 0 1 1 0-2 1 1 0 0 1 0 2zm6 0a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"
              ></path>
            </svg>
          </div>
          <div class="w-24 text-right">
            <span class="hover:underline hover:cursor-pointer mr-8">Toggle Role</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import Spinner from "./Spinner";
import UserService from "../services/UserService";

export default {
  name: "UsersTable",
  components: { Spinner },
  data() {
    return {
      users: [],
      busy: false
    };
  },
  created() {
    this.busy = true;
    UserService.index().then(({ data }) => {
      this.users = data;
      this.busy = false;
    });
  }
};
</script>
