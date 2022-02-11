<div class="sidebar" data-color="white" data-active-color="danger">
    <div class="logo">
        <a href="{{ route('admin.dashboard') }}" class="simple-text logo-mini">
            <div class="logo-image-small">
                <img src="{{ asset('img/logo-preto.png') }}">
            </div>
        </a>
        <a href="{{ route('admin.dashboard') }}" class="simple-text logo-normal">
            Marcelo Fabro
        </a>
    </div>
    <div class="sidebar-wrapper">
        <ul class="nav">
            @foreach ($modules as $module)
                <li @isset($module['active']) {{ 'class=active'}} @endif>
                    <a href="{{ $module['route'] }}">
                        <i class="nc-icon {{ $module['icon'] }}"></i>
                        <p>{{ $module['text'] }}</p>
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
