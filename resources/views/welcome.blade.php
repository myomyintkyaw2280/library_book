@include('layouts.welcome')
  
    <div class="flex-center position-ref full-height">
        @if (Route::has('login'))
        <div class="top-right links color-white">
            @auth
            <a href="{{ url('/admin') }}">Go to Admin Panel</a>
            @else
            <a style="color: white" href="{{ route('login') }}">Login</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}">Register</a>
            @endif
            @endauth
        </div>
        @endif

        <div class="content">
            <div class="title m-b-md">
                <div class="clockStyle" id="clock">Kyaw ICT Solution Ltd,.</div>
            </div>

            
        </div>
    </div>

