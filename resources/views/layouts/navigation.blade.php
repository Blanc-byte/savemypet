<nav class="nav-container">
    <style>
        .nav-container {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: 200px;
            background-color: #2B7A78;
            border-right: 1px solid #e2e8f0;
            padding: 16px;
            box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1);
        }

        .nav-links {
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .nav-link {
            display: flex;
            align-items: center;
            color: #000000;
            font-size: 14px;
            font-weight: 500;
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 4px;
            transition: color 0.2s, background-color 0.2s;
        }

        .nav-link:hover {
            color: #000000;
            background-color: #e0efffd7;
        }

        .nav-link.active {
            color: #000000;
            background-color: #ffffff;
        }

        .nav-link-icon {
            margin-right: 8px;
            width: 16px;
            height: 16px;
            fill: currentColor;
        }

        .logout-form {
            display: inline;
        }
        
        .logo-section {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 24px;
        }

        .logo-section img {
            max-width: 80%;
            height: auto;
            border-radius: 50%;
        }
    </style>

    <!-- Navigation Menu -->
    <div class="nav-links">

        <!-- Logo Section -->
        <div class="logo-section">
            <img src="{{ asset('images/logo.jpg') }}" alt="Logo">
        </div>

        <!-- Profile -->
        <a href="{{ route('profile.edit') }}" class="nav-link {{ request()->routeIs('profile.edit') ? 'active' : '' }}">
            <svg class="nav-link-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
            </svg>
            {{ __('Profile') }}
        </a>

        <!-- View Appointments -->
        <a href="{{ route('viewAppointments') }}" class="nav-link {{ request()->routeIs('viewAppointments') ? 'active' : '' }}">
            <svg class="nav-link-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M19 3h-1V1h-2v2H8V1H6v2H5c-1.1 0-2 .9-2 2v16c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM5 21V9h14v12H5z"/>
            </svg>
            {{ __('View Appointments') }}
        </a>

        <!-- Currently -->
        <a href="{{ route('viewSchedule') }}" class="nav-link {{ request()->routeIs('viewSchedule') ? 'active' : '' }}">
            <svg class="nav-link-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/>
                <circle cx="12" cy="12" r="5"/>
            </svg>
            {{ __('Currently') }}
        </a>

        <!-- Rooms -->
        <a href="{{ route('viewRooms') }}" class="nav-link {{ request()->routeIs('viewRooms') ? 'active' : '' }}">
            <svg class="nav-link-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M4 6v14h16V6H4zm4 2h8v2H8V8zm0 4h8v2H8v-2z"/>
            </svg>
            {{ __('Rooms') }}
        </a>

        <!-- Services -->
        <a href="{{ route('viewServices') }}" class="nav-link {{ request()->routeIs('viewServices') ? 'active' : '' }}">
            <svg class="nav-link-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                <path d="M3 13h2v-2H3v2zm2-6h2V5H5v2zm0 12h2v-2H5v2zm4-12h10V5H9v2zm0 6h10v-2H9v2zm0 6h10v-2H9v2z"/>
            </svg>
            {{ __('Services') }}
        </a>

        <!-- Log Out -->
        <form method="POST" action="{{ route('logout') }}" class="logout-form">
            @csrf
            <a href="{{ route('logout') }}" class="nav-link" onclick="event.preventDefault(); this.closest('form').submit();">
                <svg class="nav-link-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                    <path d="M16 13v-2H7V8l-5 4 5 4v-3h9zm3-11H9c-1.1 0-2 .9-2 2v3h2V4h10v16H9v-3H7v3c0 1.1.9 2 2 2h10c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2z"/>
                </svg>
                {{ __('Log Out') }}
            </a>
        </form>
    </div>
</nav>
