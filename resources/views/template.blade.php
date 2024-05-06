<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{env('TITLE_PAGE')}}</title>
    <link rel="shortcut icon" href="{{ asset('/favicon.ico') }}" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="{{ asset('fontawesome/css/all.min.css') }}" rel="stylesheet">
    @yield('style')
</head>
<body class="bg-rose-950">
    <x-header/>
    <div class="min-h-[92vh] bg-gray-50 content-center">
        @yield('content')
    </div>
    @yield('script')
</body>
</html>