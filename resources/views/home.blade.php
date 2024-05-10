@extends('template')

@section('content')
    <div class="grid w-full grid grid-cols-1 gap-5">
        <div class="w-[80%] mt-[2vh] place-self-center">
            <div class="relative">
                <input type="text" placeholder="Buscar livros..." class="rounded-md w-full pl-2 pr-10 py-2 border-2 border-gray-300 focus:border-gray-600 focus:outline-none">
                <button class="absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                🔍
                </button>
            </div>
        </div>
        <div  class="flex justify-end px-[5vh]">
            <button class="border-2 rounded-md bg-rose-950 text-white px-[2vh] py-[1vh] text-[18px]">
                Novo Livro
            </button>
        </div>
        <div class="overflow-x-auto p-[2vh]">
            <table class="min-w-full divide-y divide-gray-200 border border-gray-300 rounded-lg">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 border text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Imagem
                        </th>
                        <th scope="col" class="px-6 py-3 border text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Titulo
                        </th>
                        <th scope="col" class="px-6 py-3 border text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nome do Autor
                        </th>
                        <th scope="col" class="px-6 py-3 border text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Idioma
                        </th>
                        <th scope="col" class="px-6 py-3 border text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Valor
                        </th>
                        <th scope="col" class="px-6 py-3 border text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Quantidade
                        </th>
                        <th scope="col" class="px-6 py-3 border text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Data de Chegada
                        </th>
                    </tr>
                </thead>
                <tbody id="bodyTable" class="bg-white divide-y divide-gray-200">                    
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap border border-gray-300">
                                
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap border border-gray-300">
                                livro 1
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap border border-gray-300">
                                eu
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap border border-gray-300">
                                pt
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap border border-gray-300">
                                R$ 10,00
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap border border-gray-300">
                                5
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap border border-gray-300">
                                11/02/2000
                            </td>
                        </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            function carregarLivros() {
                $.ajax({
                    url: 'route(getBooks)',
                    type: 'GET',
                    success: function(data) {
                        var tbody = '';
                        data.forEach(function(livro) {
                            tbody += `
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap border border-gray-300">
                                        <img src="${livro.imagem}" alt="${livro.nome}" class="h-10 w-10 rounded-full">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap border border-gray-300">
                                        ${livro.autor}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap border border-gray-300">
                                        ${livro.idioma}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap border border-gray-300">
                                        R$ ${livro.valor}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap border border-gray-300">
                                        ${livro.data_chegada}
                                    </td>
                                </tr>
                            `;
                        });
                        $('#bodyTable').html(tbody);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }

            carregarLivros();

            $('button').click(function() {
                carregarLivros();
            });
        });

        document.getElementById('openModal').addEventListener('click', function() {
            Swal.fire({
                title: 'Cadastro de Livro',
                html: `
                    <form id="bookForm">
                        <input type="text" id="titulo" name="titulo" class="swal2-input" placeholder="Título do Livro" required>
                        <input type="text" id="autor" name="autor" class="swal2-input" placeholder="Autor" required>
                        <input type="text" id="idioma" name="idioma" class="swal2-input" placeholder="Idioma" required>
                        <input type="text" id="valor" name="valor" class="swal2-input" placeholder="Preço" required>
                        <input type="date" id="data_chegada" name="data_chegada" class="swal2-input" required>
                        <input type="file" id="imagem" name="imagem" class="swal2-input" required>
                    </form>
                `,
                focusConfirm: false,
                preConfirm: () => {
                    const form = document.getElementById('bookForm');
                    const formData = new FormData(form);
                    $.ajax({
                        url: 'route(creatBook)',
                        type: 'GET',
                        data: formData,
                    });
                },
                confirmButtonText: 'Cadastrar Livro',
                showCancelButton: true,
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {
                    // Aqui você pode tratar a resposta do servidor
                    Swal.fire('Sucesso!', 'O livro foi cadastrado.', 'success');
                }
            });
        });

    </script>
@endsection