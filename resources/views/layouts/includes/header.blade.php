<div class="container-fluid">

    <!-- Navbar Header -->
    <div class="navbar-header">

        <!-- Brand Logo -->
        <a href="/" class="navbar-brand"></a>
    </div>

    <!-- Main topbar elements -->
    <div class="be-right-navbar">
        <ul class="nav navbar-nav navbar-right be-user-nav">
            <!-- User Menu -->
            <li class="dropdown"><a href="#" data-toggle="dropdown" role="button" aria-expanded="false"
                    class="dropdown-toggle"><img src="{{ asset('assets/img/avatar.png')}}" alt="Avatar"><span class="user-name">{{Auth::user()->username}}</span></a>
                <ul role="menu" class="dropdown-menu">
                    <li>
                        <div class="user-info">
                            <div class="user-name">{{Auth::user()->name}}</div>
                            <div class="user-position online">Available</div>
                        </div>
                    </li>
                    <li><a href="#"><span class="icon mdi mdi-face"></span> Account</a></li>
                    <li><a href="#"><span class="icon mdi mdi-settings"></span> Settings</a></li>
                    <li><a href="/logout" onClick="event.preventDefault(); document.getElementById('logout-form').submit();"><span class="icon mdi mdi-power"></span> Logout</a></li>
                    <div class="text-center">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </ul>
            </li>
        </ul>

        </ul>

        <!-- Page title -->
        <div class="page-title"><span>@yield('title_content')</span></div>

        <ul class="nav navbar-nav navbar-right be-icons-nav">
            <!-- Icons Menu -->
        </ul>
    </div>

    <!-- Left navbar (Used only when there is no left sidebar) -->
    <a href="#" data-toggle="collapse" data-target="#be-navbar-collapse" class="be-toggle-top-header-menu collapsed">No
        Sidebar Left</a>
    <div id="be-navbar-collapse" class="navbar-collapse collapse">
        <!-- Default bootstrap navbar -->
    </div>

</div>
