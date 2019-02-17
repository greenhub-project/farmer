<nav class="bg-white h-12 shadow mb-8 px-6 md:px-0">
  <div class="container mx-auto h-full">
      <div class="flex items-center justify-center h-12">
          <div class="flex items-center mr-6">
            <img class="h-8 h-8 mr-2" src="/images/brand.png" alt="{{ config('app.name', 'GreenHub Farmer') }}">
            <a href="{{ url('/') }}" class="text-lg font-hairline font-sans text-blue-darker no-underline hover:underline">
                {{ config('app.name', 'GreenHub Farmer') }}
            </a>
          </div>
          <div class="flex-1 text-right">
              @guest
                  <a class="no-underline hover:underline text-blue-darker pr-3 text-sm" href="{{ url('/login') }}">{{ __('Login') }}</a>
                  <a class="no-underline hover:underline text-blue-darker text-sm" href="{{ url('/register') }}">{{ __('Register') }}</a>
              @else
                  <span class="text-blue-darker text-sm pr-4">{{ Auth::user()->name }}</span>

                  <a href="{{ route('logout') }}"
                      class="no-underline hover:underline text-blue-darker text-sm"
                      onclick="event.preventDefault();
                      document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                      {{ csrf_field() }}
                  </form>
              @endguest
          </div>
      </div>
  </div>
</nav>