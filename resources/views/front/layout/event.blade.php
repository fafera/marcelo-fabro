<!doctype html>
<html lang="en">

<head>
    <title>{{ config('app.name') }}</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

    @include('admin.layout.css')
    @livewireStyles
</head>
<body>
    <div class="wrapper">
        <livewire:admin.sidebar>
        <div class="main-panel">
            @include('front.components.navbar')
            <div class="content">
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
                
                @yield('content')
            </div>
        </div>
    </div>
</body>
@include('admin.layout.js')
<script type="text/javascript">
    $(document).ready(function () {
        var songbook_check = {!!json_encode($songbook)!!}
        console.log(songbook_check);
        if(songbook_check != 1) {
            $('#setlist-li').remove();
        }
    });
</script>
@stack('scripts')
@livewireScripts
</html>
