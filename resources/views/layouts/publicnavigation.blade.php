<!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('admin.index') }}" class="nav-link">Admin home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('manage.users') }}" class="nav-link">Manage users</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('manage.padcasts') }}" class="nav-link">Manage padcasts</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('manage.articles') }}" class="nav-link">Manage articles</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('manage.lessons') }}" class="nav-link">Manage lessons</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('manage.jobs') }}" class="nav-link">Manage jobs</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <form method="POST" action="{{ route('admin.logout') }}">
          @csrf
          <button class="nav-link" type="submit" name="submit">logout</button>
        </form>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="@auth
      background-color: darkgoldenrod;
    @endif
  ">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
      <img src="/admin/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">{{ config('app.name') }}</span>
    </a>
   

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                    <li class="nav-item active">
                      <a class="nav-link" href="{{ route('admin.index') }}" class="text-sm text-gray-700 underline">Admin home</a>
                    </li>
                    <li class="nav-item active">
                      <a class="nav-link" href="{{ route('manage.users') }}" class="text-sm text-gray-700 underline">Manage users</a>
                    </li>
                    <li class="nav-item active">
                      <a class="nav-link" href="{{ route('manage.padcasts') }}" class="text-sm text-gray-700 underline">Manage padcasts</a>
                    </li>
                    <li class="nav-item active">
                      <a class="nav-link" href="{{ route('manage.articles') }}" class="text-sm text-gray-700 underline">Manage articles</a>
                    </li>
                    <li class="nav-item active">
                      <a class="nav-link" href="{{ route('manage.lessons') }}" class="text-sm text-gray-700 underline">Manage lessons</a>
                    </li>
                    <li class="nav-item active">
                      <a class="nav-link" href="{{ route('manage.jobs') }}" class="text-sm text-gray-700 underline">Manage jobs</a>
                    </li>
                    <li class="nav-item active">
                      <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button class="nav-link" type="submit" name="submit">logout</button>
                      </form>
                    </li>


                  

                  
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>