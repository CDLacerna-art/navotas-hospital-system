<header class="topbar">
    <!-- Hamburger -->
    <button class="icon-btn" type="button" onclick="toggleSideMenu()" aria-label="Toggle menu">
        <i class="fa-solid fa-bars-staggered"></i>
    </button>

    <div class="topbar-title">
        <h1>{{ $heading ?? 'Navotas Hospital System' }}</h1>
        <p>{{ $currentTitle ?? 'Home' }}</p>
    </div>

    <div class="topbar-spacer"></div>

    <!-- Search -->
    <div class="search top">
        <i class="fa-solid fa-magnifying-glass"></i>
        <input id="globalSearch" type="text" placeholder="Search medical files, staff..." aria-label="Search">
    </div>

    <button class="icon-btn" type="button" aria-label="Notifications">
        <i class="fa-regular fa-bell"></i><span class="dot"></span>
    </button>

    <a href="{{ route('register') }}" class="btn btn-primary">
        <i class="fa-solid fa-plus"></i><span class="lbl">Admit Patient</span>
    </a>

    <!-- User dropdown -->
    <div class="user-dropdown" id="userDropdown">
        <button class="icon-btn profile-btn" type="button" onclick="toggleDropdown()" aria-label="Account menu">
            <i class="fa-solid fa-circle-user"></i>
        </button>
        <div class="dropdown-menu">
            <a href="{{ route('information') }}"><i class="fa-regular fa-id-card"></i> Information</a>
            <a href="{{ route('login') }}"><i class="fa-solid fa-right-to-bracket"></i> Login</a>
        </div>
    </div>
</header>
