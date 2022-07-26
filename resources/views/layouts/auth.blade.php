<!DOCTYPE html>
<html lang="en" class="w-full h-full">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>CollegeGram | {{ Request::is('register') ? 'Register' : 'Login' }}</title>
   @include('partials.font')
   <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>

<body class="font-poppins text-primary-white w-full h-full">
   <div class="flex h-full w-full justify-center items-center bg-primary">
      @yield('content')
   </div>
</body>

</html>
