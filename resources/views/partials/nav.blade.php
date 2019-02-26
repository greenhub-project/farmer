<nav class="bg-white h-12 font-sans shadow mb-8 px-6 md:px-0">
  <div class="container mx-auto h-full">
      <div class="flex items-center justify-center h-12">
          <div class="flex items-center mr-6">
            <img class="h-8 h-8 mr-2" src="/images/brand.png" alt="{{ config('app.name', 'GreenHub Farmer') }}">
            <a href="{{ url('/') }}" class="hidden md:inline-block text-lg font-hairline text-blue-darker no-underline hover:underline">
                {{ config('app.name', 'GreenHub Farmer') }}
            </a>
          </div>
          <div class="flex-1 text-right">
              @guest
                  <a class="no-underline hover:underline text-blue-darker pr-3 text-sm" href="{{ url('/login') }}">{{ __('Login') }}</a>
                  <a class="no-underline hover:underline text-blue-darker text-sm" href="{{ url('/register') }}">{{ __('Register') }}</a>
              @else
                  <div class="flex justify-end">
                    <dropdown-link>
                        <div slot="link" class="flex hover:cursor-pointer">
                            <div>
                                <img class="inline-block h-8 w-8 rounded-full mr-2" src="https://randomuser.me/portraits/lego/1.jpg" alt="{{ Auth::user()->name }}">
                            </div>
                            <div class="hidden md:block md:flex md:items-center">
                                <span class="text-blue-darker text-sm mr-1">{{ Auth::user()->name }}</span>
                                <div>
                                    <svg class="fill-current text-blue-darker h-4 w-4 block opacity-50" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M4.516 7.548c.436-.446 1.043-.481 1.576 0L10 11.295l3.908-3.747c.533-.481 1.141-.446 1.574 0 .436.445.408 1.197 0 1.615-.406.418-4.695 4.502-4.695 4.502a1.095 1.095 0 0 1-1.576 0S4.924 9.581 4.516 9.163c-.409-.418-.436-1.17 0-1.615z"/></svg>
                                </div>
                            </div>
                        </div>
                        <div slot="dropdown" class="bg-white shadow rounded border overflow-hidden text-right">
                            <a href="{{ route('account') }}" class="no-underline block px-4 py-3 border-b text-sm text-blue-darker bg-white hover:text-white hover:bg-blue-dark whitespace-no-wrap">{{ __('Account') }}</a>
                            <a href="#" class="no-underline block px-4 py-3 border-b text-sm text-blue-darker bg-white hover:text-white hover:bg-blue-dark whitespace-no-wrap" onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                @csrf
                            </form>
                        </div>
                    </dropdown-link>
                  </div>
              @endguest
          </div>
      </div>
  </div>
</nav>