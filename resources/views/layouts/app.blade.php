<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield("title",config('app.name', 'Save The Change'))</title>

    <!-- Styles -->
    <link href="https://use.fontawesome.com/releases/v5.0.4/css/all.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.css">
    <script src="https://cdn.jsdelivr.net/simplemde/latest/simplemde.min.js"></script>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
    @stack("scripts")
</head>
<body>
<div id="app">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#app-navbar-collapse" aria-expanded="false">
                    <span class="sr-only">{{_t('Toggle Navigation')}}</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}">{{ config('app.name', 'Save the Change') }}</a>
            </div>
            @include("layouts.navbar")
        </div>
    </nav>
    <script type="text/javascript">
        @foreach ($errors->all() as $error)
        $.notify({
            title: "<strong>{{_t("Error")}}:</strong> ",
            message: "{{_t($error)}}",
            icon: "fas fa-exclamation-triangle"
        }, {
            type: "danger"
        });
        @endforeach
    </script>
    @yield('content')
</div>

<script>
    $(document).ready(function () {
        $('[data-toggle="popover"]').popover();
    });
</script>

</body>
</html>
