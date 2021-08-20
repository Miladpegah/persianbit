
    <nav class="navbar navbar-expand-lg navbar-light sticky-top py-3 d-block"  style="background-color: #fff;">
        <div class="container"><a class="navbar-brand" href="{{ route('home') }}"><img src="/index/assets/img/gallery/logo-n.png" height="45" alt="Presian Bit" /></a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"> </span></button>
          <div class="collapse navbar-collapse border-top border-lg-0 mt-4 mt-lg-0" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto pt-2 pt-lg-0 font-base" style="padding-left: 0%;">
            @auth()
                @can('manage')
                    @if(session()->get('authadmin'))
                        <li class="nav-item px-2" style="font: bold;"><a class="btn btn-light nav-link" href="{{ route('admin.index') }}">Admin dashboard</a></li>
                    @else
                        <li class="nav-item px-2" style="font: bold;"><a class="btn btn-light nav-link" href="{{ route('admin.loginPage') }}">Admin Login</a></li>
                    @endif
                @endcan
                
            @endif
              <li class="nav-item px-2"><a href="{{ route('padcasts.index') }}" class="nav-link active" aria-current="page" href="index.html">Padcasts</a></li>
              <li class="nav-item px-2"><a href="{{ route('jobs.index') }}" class="nav-link active" aria-current="page" href="index.html">Jobs</a></li>
              <li class="nav-item px-2"><a href="{{ route('articles.index') }}" class="nav-link" aria-current="page" href="pricing.html">Articles</a></li>
              <li class="nav-item px-2"><a href="{{ route('lessons.index') }}" class="nav-link" aria-current="page" href="web-development.html">Lessons</a></li>
              <li class="nav-item px-2"><a href="{{ route('questions.index') }}" class="nav-link" aria-current="page" href="user-research.html">Community </a></li>
            </ul>
            @auth()
                <a>
                    <div class="dropdown">
                  <a class="btn btn-light dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ auth()->user()->name}}
                  </a>

                  <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <li><a class="dropdown-item" href="{{ route('dashboard') }}">dashboard</a></li>
                    <li><a class="dropdown-item" href="{{ route('setting', auth()->user()) }}">setting</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="nav-link">Logout</button>
                        </form>
                    </li>
                  </ul>
                </div>
                </a>
            @else
                    <a class="btn btn-primary order-1 order-lg-0" href="{{ route('register') }}" style="margin: 0%">Join</a>
                    &nbsp;
                    <a class="btn btn-outline-secondary" href="{{ route('login') }}" style="margin-left: 1%">Sign In</a>
            @endif
          </div>
          @auth()
            
          @endif
        </div>
      </nav>




      <!-- <nav x-data="{ open: false }" class="bg-white border-b border-gray-100">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">

                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <x-application-logo class="block h-10 w-auto fill-current text-gray-600" />
                    </a>
                </div>

                @auth()
                    <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                    </div>
                @endif
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('questions.index')" :active="request()->routeIs('questions.index')">
                        {{ __('Community') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('lessons.index')" :active="request()->routeIs('lessons.index')">
                        {{ __('Lessons') }}
                    </x-nav-link>
                </div>
            </div>
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('articles.index')" :active="request()->routeIs('articles.index')">
                        {{ __('Articles') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('jobs.index')" :active="request()->routeIs('jobs.index')">
                        {{ __('Jobs') }}
                    </x-nav-link>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                    <x-nav-link :href="route('padcasts.index')" :active="request()->routeIs('padcasts.index')">
                        {{ __('Padcasts') }}
                    </x-nav-link>
                </div>
                @auth()
                    @if(session()->get('authadmin'))
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <x-nav-link :href="route('admin.index')" :active="request()->routeIs('admin.index')">
                                {{ __('Admin dashboard') }}
                            </x-nav-link>
                        </div>
                    @else
                        <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                            <x-nav-link :href="route('admin.loginPage')" :active="request()->routeIs('admin.loginPage')">
                                {{ __('Admin login') }}
                            </x-nav-link>
                        </div>
                    @endif
                @endif
            </div>
            @auth()
                <div class="hidden sm:flex sm:items-center sm:ml-6">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300 focus:outline-none focus:text-gray-700 focus:border-gray-300 transition duration-150 ease-in-out">
                                <div>{{ Auth::user()->name }}</div>

                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                                    <x-dropdown-link :href="route('dashboard')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                        {{ __('Dashboard') }}
                                    </x-dropdown-link>
                                    <x-dropdown-link :href="route('setting', auth()->user())">
                                        {{ __('Setting') }}
                                    </x-dropdown-link>
                                    
                                    <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    
                                    <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                        {{ __('Log out') }}
                                    </x-dropdown-link>
                                </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            @endif

            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>
        @auth()
            <div class="pt-2 pb-3 space-y-1">
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                            {{ __('Dashboard') }}
                </x-nav-link>
            </div>
        @endif
        <div class="pt-2 pb-3 space-y-1">

            <x-nav-link :href="route('questions.index')" :active="request()->routeIs('questions.index')">
                        {{ __('Community') }}
            </x-nav-link>
        </div>
        <div class="pt-2 pb-3 space-y-1">

            <x-nav-link :href="route('lessons.index')" :active="request()->routeIs('lessons.index')">
                        {{ __('Lessons') }}
            </x-nav-link>
        </div>
        <div class="pt-2 pb-3 space-y-1">

            <x-nav-link :href="route('articles.index')" :active="request()->routeIs('articles.index')">
                        {{ __('Articles') }}
            </x-nav-link>
        </div>
        <div class="pt-2 pb-3 space-y-1">

            <x-nav-link :href="route('jobs.index')" :active="request()->routeIs('jobs.index')">
                        {{ __('Jobs') }}
            </x-nav-link>
        </div>
        <div class="pt-2 pb-3 space-y-1">

            <x-nav-link :href="route('padcasts.index')" :active="request()->routeIs('padcasts.index')">
                        {{ __('Padcasts') }}
            </x-nav-link>
        </div>
        @auth()
            @if(session()->get('authadmin'))
                <div class="pt-2 pb-3 space-y-1">

                    <x-nav-link :href="route('admin.index')" :active="request()->routeIs('admin.index')">
                                {{ __('Admin dashboard') }}
                    </x-nav-link>
                </div>
            @else
                <div class="pt-2 pb-3 space-y-1">

                    <x-nav-link :href="route('admin.loginPage')" :active="request()->routeIs('admin.loginPage')">
                                {{ __('Admin login') }}
                    </x-nav-link>
                </div>
            @endif
        @endif
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="flex items-center px-4">
                <div class="flex-shrink-0">
                    <svg class="h-10 w-10 fill-current text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>

                @auth()
                    <div class="ml-3">
                        <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                        <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                @endif
            </div>

            <div class="mt-3 space-y-1">

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

@auth()
    @livewire('user-message-show')
@endif -->
