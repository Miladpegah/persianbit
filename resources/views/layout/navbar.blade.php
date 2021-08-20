<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      @if (Route::has('login'))
        @auth
            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">          
              <li>
                <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline btn btn-light btn-sm" style="text-decoration: none;">Dashboard</a>
              </li>
      @else
              <li>
                  <a href="{{ route('login') }}" class="text-sm text-gray-700 underline btn btn-light btn-sm login-btn" style="text-decoration: none;">Log in</a>
              </li>
              @if (Route::has('register'))
                  <li>
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline btn btn-primary btn-sm" style="text-decoration: none;">Register</a>
                  </li>
              @endif
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <li>
                <a href="{{ route('questions.index') }}" class="text-sm text-gray-700 underline btn btn-light btn-sm" style="text-decoration: none;">Community</a>
              </li>
                    </div>
          </li>
        @endauth
      @endif
    </ul>
  </div>
</nav>