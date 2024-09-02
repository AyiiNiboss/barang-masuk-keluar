<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BNN &mdash; Permintaan Barang</title>
    {{-- link --}}
    @include('layout.partial.link')

</head>

<body class="">
    <div id="app">
        <div class="shadow-header"></div>
        @include('layout.partial.header')

        @yield('content')
        
        @include('layout.partial.footer')
    </div>

   {{-- Script --}}
   @include('layout.partial.script')
</body>

</html>