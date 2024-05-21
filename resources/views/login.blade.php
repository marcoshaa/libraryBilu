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
    <link rel="stylesheet" href="sweetalert2.min.css">
    @yield('style')
</head>

<body class="bg-rose-950">
    <div class="bg-gray-50">
        <div>
            <div class="flex w-full bg-rose-950 p-5 mx-auto text-white">
                <i class="fa-solid fa-book-atlas  text-[40px] mr-[10px]"></i>
                <h2 class="text-3xl font-extrabold">{{env('TITLE_PAGE')}}</h2>
            </div>
        </div>
    </div>
    <div class="min-h-[92vh] bg-gray-50">
        <div class="w-full flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
            <div class="w-full sm:max-w-md p-5 mx-auto m-[20vh]">
                <form>
                    <div class="mb-4">
                        <label class="block mb-1" for="email">Email</label>
                        <input id="email" type="text" name="email"
                            class="py-2 px-3 border border-gray-300 focus:border-red-300 focus:outline-none focus:ring focus:ring-red-200 focus:ring-opacity-50 rounded-md shadow-sm disabled:bg-gray-100 mt-1 block w-full" />
                    </div>
                    <div class="mb-4">
                        <label class="block mb-1" for="password">Senha</label>
                        <input id="password" type="password" name="password"
                            class="py-2 px-3 border border-gray-300 focus:border-red-300 focus:outline-none focus:ring focus:ring-red-200 focus:ring-opacity-50 rounded-md shadow-sm disabled:bg-gray-100 mt-1 block w-full" />
                    </div>
                    <!-- <div class="mt-6 flex items-center justify-between">
        <div class="flex items-center">
          <input id="remember_me" type="checkbox" class="border border-gray-300 text-red-600 shadow-sm focus:border-red-300 focus:ring focus:ring-red-200 focus:ring-opacity-50" />
          <label for="remember_me" class="ml-2 block text-sm leading-5 text-gray-900"> Lembre de mim </label>
        </div>
        <a href="#" class="text-sm"> esqueceu a senha ? </a>
      </div> -->
                    <div class="mt-6">
                        <button
                            class="w-full inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold capitalize text-white hover:bg-red-700 active:bg-red-700 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 disabled:opacity-25 transition">Entrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="sweetalert2.min.js"></script>

</body>

</html>