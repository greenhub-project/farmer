<div class="mb-12">
  <div class="mb-6">
      <div class="text-xl tracking-wide mb-1">Control Panel</div>
      <div class="text-grey-dark text-sm tracking-wide">Manage database</div>
  </div>
  <form action="{{ url('/fix') }}" method="post">
    @csrf
    <div class="w-full mb-4 md:mb-0 md:w-1/3 md:px-2">
      <div class="bg-white h-auto rounded-lg shadow">
        <div class="p-4">
          <div class="text-blue-darker text-lg font-semibold">Fix failed uploads</div>
          <div class="my-4">
            <label class="block text-grey-darker text-sm font-bold mb-2" for="bag">
              Number
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-grey-darker leading-tight focus:outline-none focus:shadow-outline"
                   id="bag" name="bag" type="number" required>
          </div>
        </div>
        <div class="bg-grey-lighter text-center py-2 rounded-b-lg">
          <div class="flex items-center justify-center">
            <button
              class="text-blue-darker hover:text-blue-darkest text-sm no-underline leading-normal"
              type="submit"
            >Process</button>
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
  </form>
</div>