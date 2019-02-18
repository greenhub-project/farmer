<template>
  <div class="rounded-lg shadow">
    <div class="bg-grey-lighter py-3 px-4 rounded-t-lg">
      <div class="flex text-blue-darker text-sm font-bold uppercase tracking-wide">
        <div class="w-12 hidden lg:block">&nbsp;</div>
        <div class="w-2/5 xs:flex-1 lg:w-1/5">User</div>
        <div class="w-1/4 hidden lg:block">Email</div>
        <div class="flex-1">Role</div>
        <div class="flex-1 hidden lg:block">Joined at</div>
        <div class="flex-1 text-center sm:text-left">Status</div>
        <div class="w-24 block xs:hidden">&nbsp;</div>
        <div class="w-16 block xs:hidden">&nbsp;</div>
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
          <div class="w-12 hidden lg:block">
            <img
              class="inline-block h-8 w-8 rounded-full"
              src="https://randomuser.me/portraits/lego/1.jpg"
              :alt="user.name"
            >
          </div>
          <div class="w-2/5 xs:flex-1 lg:w-1/5 flex flex-col">
            <span class="mb-1">{{ user.name }}</span>
            <span class="text-grey-dark">#{{ user.id }}</span>
          </div>
          <div class="w-1/4 hidden lg:block">{{ user.email }}</div>
          <div class="flex-1 capitalize">{{ user.roles[0].name }}</div>
          <div class="flex-1 hidden lg:block">{{ user.created_at }}</div>
          <div
            class="flex-1 text-center sm:text-left"
            title="Verified"
            v-if="user.email_verified_at !== null"
          >
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
          <div class="flex-1 text-center sm:text-left" title="Unverified" v-else>
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
          <div class="w-24 text-right block xs:hidden">
            <span
              class="hover:underline hover:cursor-pointer mr-4 sm:mr-8"
              @click="toggleRole(user.id, user.roles[0].name)"
            >Toggle Role</span>
          </div>
          <div class="w-16 text-right block xs:hidden">
            <span
              class="text-red-dark hover:underline hover:cursor-pointer"
              @click="deleteUser(user.id)"
            >Delete</span>
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
  methods: {
    toggleRole(id, role) {
      UserService.update(id, role).then(({ data }) => {
        if (data.user !== null) {
          const idx = this.users.findIndex(u => u.id === id);
          this.users = [
            ...this.users.slice(0, idx),
            { ...data.user },
            ...this.users.slice(idx + 1)
          ];
        }
      });
    },
    deleteUser(id) {
      if (confirm("Are you sure you want to delete this user?")) {
        UserService.destroy(id).then(({ data }) => {
          if (data.result) {
            this.users = this.users.filter(u => u.id !== id);
          }
        });
      }
    }
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
