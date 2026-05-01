<nav class="nav-container" id="main-nav">
    <div class="nav">

        <a href="{{ route('home') }}" class="nav-brand">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" style="display:inline;vertical-align:middle;margin-right:8px;">
                <circle cx="12" cy="12" r="10" stroke="currentColor" stroke-width="1.5"/>
                <path d="M8 12 Q12 6 16 12 Q12 18 8 12Z" fill="currentColor" opacity="0.85"/>
            </svg>
            One Spirit
        </a>

        <div class="nav-links" id="nav-links-main">
            @foreach([
                ['home', 'Armada'],
                ['about', 'Tentang Kami'],
                ['testimonials', 'Testimoni'],
                ['mobil.katalog', 'Katalog'],
            ] as [$routeName, $label])
                <a href="{{ route($routeName) }}"
                   class="nav-link {{ request()->routeIs($routeName) ? 'nav-link--active' : '' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>

        <div class="nav-right">
            @auth
                <div class="dropdown" x-data="{ open: false }" @click.away="open = false">
                    <button @click="open = !open" class="dropdown-btn">
                        <span class="dropdown-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                        <span class="dropdown-name">{{ Str::limit(Auth::user()->name, 14) }}</span>
                        <svg width="14" height="14" viewBox="0 0 20 20" fill="currentColor"
                             :style="open ? 'transform:rotate(180deg);transition:.2s' : 'transition:.2s'">
                            <path fill-rule="evenodd"
                                  d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </button>

                    <div class="dropdown-menu" :class="{ 'show': open }">
                        @if(Auth::user()->role == 'admin')
                            <a href="{{ route('booking.index') }}" class="dropdown-item dropdown-item--special">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/>
                                    <rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/>
                                </svg>
                                Admin Dashboard
                            </a>
                        @endif
                        <a href="{{ route('profile.edit') }}" class="dropdown-item">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/>
                            </svg>
                            {{ Auth::user()->role == 'admin' ? 'Profile' : 'My Profile' }}
                        </a>
                        <div class="dropdown-divider"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item dropdown-item--danger">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4"/><polyline points="16 17 21 12 16 7"/>
                                    <line x1="21" y1="12" x2="9" y2="12"/>
                                </svg>
                                Log Out
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}" class="nav-btn nav-btn--ghost {{ request()->routeIs('login') ? 'nav-btn--active' : '' }}">
                    Masuk
                </a>
                <a href="{{ route('register') }}" class="nav-btn nav-btn--primary {{ request()->routeIs('register') ? 'nav-btn--active' : '' }}">
                    Daftar
                </a>
            @endauth
        </div>

        {{-- Mobile hamburger --}}
        <button class="nav-hamburger" id="nav-hamburger" aria-label="Toggle menu">
            <span></span><span></span><span></span>
        </button>
    </div>

    {{-- Mobile drawer --}}
    <div class="nav-mobile-menu" id="nav-mobile-menu">
        <a href="{{ route('home') }}" class="nav-mobile-link {{ request()->routeIs('home') ? 'active' : '' }}">Armada</a>
        <a href="{{ route('about') }}" class="nav-mobile-link {{ request()->routeIs('about') ? 'active' : '' }}">Tentang Kami</a>
        <a href="{{ route('testimonials') }}" class="nav-mobile-link {{ request()->routeIs('testimonials') ? 'active' : '' }}">Testimoni</a>
        <a href="{{ route('mobil.katalog') }}" class="nav-mobile-link {{ request()->routeIs('mobil.katalog') ? 'active' : '' }}">Katalog</a>
        <div class="nav-mobile-divider"></div>
        @auth
            <a href="{{ route('profile.edit') }}" class="nav-mobile-link">My Profile</a>
            <form method="POST" action="{{ route('logout') }}">@csrf
                <button type="submit" class="nav-mobile-link nav-mobile-link--danger" style="width:100%;text-align:left;background:none;border:none;cursor:pointer;">Log Out</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="nav-mobile-link">Masuk</a>
            <a href="{{ route('register') }}" class="nav-mobile-link nav-mobile-link--cta">Daftar</a>
        @endauth
    </div>
</nav>
