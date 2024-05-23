<div class="bg-gray-50">
    <div> 
        <div class="flex w-full bg-rose-950 p-5 mx-auto text-white justify-between">                        
            <div class="flex">
                <i class="fa-solid fa-book-atlas  text-[40px] mr-[10px]"></i>
                <h2 class="text-3xl font-extrabold">{{env('TITLE_PAGE')}}</h2>
            </div>
            <form id="logout-form" class="border-2 w-[5vh] rounded" action="{{ route('logout') }}" method="POST">
                @csrf
                <button>
                    Sair
                </button>
            </form>
        </div>
    </div>
    <nav>
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-center">
                <div class="flex space-x-4">
                    <a href="/inicio" class="text-gray-800 border-b-4 border-[#f9fafb] hover:border-[#4c0519] px-3 py-2 text-[18px] font-medium">Inicio</a>
                    <a href="/perfil" class="text-gray-800 border-b-4 border-[#f9fafb] hover:border-[#4c0519] px-3 py-2 text-[18px] font-medium">Perfil</a>
                </div>
            </div>
        </div>
    </nav>
</div>