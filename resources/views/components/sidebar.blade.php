 <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
 
 <script src="{{asset('js/bootstrap.bundle.min.js')}}"></script>
<div class="d-flex flex-column flex-shrink-0 p-3 bg-light" style="width: 280px; height: 100vh;">
    <!-- Sidebar Header -->
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
    <strong>Study now</strong>
    </a>
    <hr>
    
    <!-- Navigation Links -->
    <ul class="nav nav-pills flex-column mb-auto">
        <!-- Overview Link -->
        <li class="nav-item">
            <a href="/" class="nav-link {{ request()->is('overview') ? 'active custom-active' : 'link-dark' }}" aria-current="page">
                @lang('message.Overview')
            </a>
        </li>
        <!-- To-do List Link -->
        <li>
            <a href="/TodoList" class="nav-link {{ request()->is('todo-list') ? 'active custom-active' : 'link-dark' }}">
                @lang('message.To-Do')
            </a>
        </li>
        <!-- Study Timer Link -->
        <li>
            <a href="/study-timer" class="nav-link {{ request()->is('study-timer') ? 'active custom-active' : 'link-dark' }}">
                @lang('message.Study Timer')
            </a>
        </li>
        <!-- Scheduling Link -->
        <li>
            <a href="/scheduling" class="nav-link {{ request()->is('scheduling') ? 'active custom-active' : 'link-dark' }}">
                @lang('message.Scheduling')
            </a>
        </li>
        <!-- Music Link -->
        <li>
            <a href="/music" class="nav-link {{ request()->is('music') ? 'active custom-active' : 'link-dark' }}">
                @lang('message.Music')
            </a>
        </li>
        
        <!-- Language Dropdown -->
        <li class="nav-item dropdown">
            <a href="#" class="nav-link link-dark dropdown-toggle" id="languageDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                @lang('message.Language')
            </a>
            <ul class="dropdown-menu" aria-labelledby="languageDropdown">
                <li><a class="dropdown-item" href="locale/en">English</a></li>
                <li><a class="dropdown-item" href="locale/id">Indonesia</a></li>
            </ul>
        </li>
    </ul>
    
    <hr>
    
    <!-- Authentication Section -->
    <div class="auth-section">
        @auth
            <!-- Authenticated User Dropdown -->
            <div class="dropdown">
                <a href="#" class="d-flex align-items-center link-dark text-decoration-none dropdown-toggle" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <strong>{{ Auth::user()->name }}</strong>
                </a>
                <ul class="dropdown-menu text-small shadow" aria-labelledby="userDropdown">
              
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                     document.getElementById('logout-form').submit();">
                            @lang('message.Sign Out')
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        @else
            <!-- Guest Authentication Links -->
            <div class="d-grid gap-2">
                <a href="{{ route('login') }}" class="btn btn-dark">
                    @lang('Login')
                </a>
                <a href="{{ route('register') }}" class="btn btn-outline-dark">
                    @lang('Register')
                </a>
            </div>
        @endauth
    </div>
</div>

<!-- Ensure Bootstrap and Popper.js are loaded -->

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>


<style>
    /* Active link styling: background black, text white */
    .nav-link.custom-active {
        background-color: #000 !important;
        color: #fff !important;
    }
    /* Hover link styling: background black, text white */
    .nav-link:hover {
        background-color: #000 !important;
        color: #fff !important;
    }
    
    /* Ensure auth buttons are full width and have some spacing */
    .auth-section .btn {
        width: 100%;
        margin-bottom: 0.5rem;
    }
</style>