<nav class="navbar navbar-expand-lg dashboard-navbar">

    <div class="container">

        {{-- Logo --}}
        <a class="navbar-brand dashboard-logo"
           href="{{ route('dashboard') }}">

            SafisAudio

        </a>

        {{-- Toggle Mobile --}}
        <button
            class="navbar-toggler"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#dashboardNavbar">

            <span class="navbar-toggler-icon"></span>

        </button>

        <div
            class="collapse navbar-collapse justify-content-between"
            id="dashboardNavbar">

            {{-- Menu --}}
            <ul class="navbar-nav dashboard-menu">

                <li class="nav-item">

                    <a
                        href="{{ route('dashboard') }}"
                        class="nav-link dashboard-link
                        {{ request()->routeIs('dashboard') ? 'active' : '' }}">

                        Audio Processing

                    </a>

                </li>

                <li class="nav-item">

                    <a
                        href="{{ route('history') }}"
                        class="nav-link dashboard-link
                        {{ request()->routeIs('history') ? 'active' : '' }}">

                        History

                    </a>

                </li>

                @php
                    $hasSubscription = Auth::user()
                        ->subscriptions()
                        ->where('status', 'active')
                        ->exists();
                @endphp

                @if(
                    Auth::user()->subscription_status === 'trial'
                    && !$hasSubscription
                )

                <li class="nav-item">

                    <a
                        href="/subscription"
                        class="nav-link dashboard-link">

                        Subscription

                    </a>

                </li>

                @endif

            </ul>

            {{-- User --}}
            <div class="dropdown">

                <button
                    class="profile-button dropdown-toggle"
                    data-bs-toggle="dropdown">

                    {{ Auth::user()->name }}

                </button>

                <ul class="dropdown-menu dropdown-menu-end">

                    <li>

                        <a
                            class="dropdown-item"
                            href="{{ route('profile.edit') }}">

                            Profile

                        </a>

                    </li>

                    <li>
                        <hr class="dropdown-divider">
                    </li>

                    <li>

                        <form
                            method="POST"
                            action="{{ route('logout') }}">

                            @csrf

                            <button
                                type="submit"
                                class="dropdown-item">

                                Log Out

                            </button>

                        </form>

                    </li>

                </ul>

            </div>

        </div>

    </div>

</nav>
