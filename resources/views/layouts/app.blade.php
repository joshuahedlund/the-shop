<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>TheShop</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.5/angular.min.js"></script>
</head>
<body style="background:#ccc" ng-app="myApp">
@if(Auth::user())
    <nav class="navbar navbar-inverse">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="/">TheShop</a>
            </div>
            <ul class="nav navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/">Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('inventory.index') }}">Inventory</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/">Orders</a>
                </li>
            </ul>
        </div>
    </nav>
@endif


<div class="container" style="background:#fff">
    @if(Auth::user())
        <p>Logged in as {{ Auth::user()->email }} - <a href="/logout">Log Out</a></p>
    @endif

    @yield('content')
</div>

@stack('scripts')

</body>
</html>
