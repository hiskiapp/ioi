<div class="breadcrumb-area pt-205 pb-210"
    style="background-image: url({{ isset($bg) ? asset($bg) : asset('img/bg/breadcrumb.jpg') }})">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <h2>@yield('title')</h2>
            <ul>
                <li><a href="#">home</a></li>
                <li>
                    @if (isset($parent))
                        {{ $parent }}
                    @else
                        @yield('title')
                    @endif
                </li>
            </ul>
        </div>
    </div>
</div>
