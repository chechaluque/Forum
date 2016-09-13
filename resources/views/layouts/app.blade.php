<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.head')
</head>
<body>
    @include('partials.navbar')
    @include('partials.messages');
<div class="container">
    @yield('content')
</div>



    @include('partials.javascript')
   
</body>
</html>
