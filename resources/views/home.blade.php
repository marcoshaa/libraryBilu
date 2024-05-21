@extends('template')

@section('content')
    <div class="grid w-full grid-cols-1 gap-5">
        <div class="w-[80%] mt-[2vh] place-self-center">
            <div class="relative">
                <input type="text" placeholder="Buscar livros..." class="rounded-md w-full pl-2 pr-10 py-2 border-2 border-gray-300 focus:border-gray-600 focus:outline-none">
                <button class="absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                🔍
                </button>
            </div>
        </div>
        <div class="flex justify-end px-[5vh]">
            <button id="openModal" class="border-2 rounded-md bg-rose-950 text-white px-[2vh] py-[1vh] text-[18px]">
                Novo Livro
            </button>
        </div>
        <div class="overflow-x-auto p-[2vh]">
            <table id="booksTable" class="min-w-full divide-y divide-gray-200 border border-gray-300 rounded-lg">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 border text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Imagem
                        </th>
                        <th scope="col" class="px-6 py-3 border text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Título
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
                            Data de Chegada
                        </th>
                        <th scope="col" class="px-6 py-3 border text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Ações
                        </th>
                    </tr>
                </thead>
                <tbody id="bodyTable" class="bg-white divide-y divide-gray-200">
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('script')

    <script>
        $(document).ready(function() {
            var table;

            function carregarLivros() {
                $.ajax({
                    url: '{{ route("getBooks") }}',
                    type: 'GET',
                    success: function(data) {
                        var tbody = '';
                        data.forEach(function(livro) {
                            tbody += `
                                <tr data-id="${livro.id}">
                                    <td class="px-6 py-4 whitespace-nowrap border border-gray-300">
                                        <img src="${livro.image_url}" alt="${livro.title}" class="h-10 w-10 rounded-full">
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap border border-gray-300">
                                        ${livro.title}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap border border-gray-300">
                                        ${livro.author}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap border border-gray-300">
                                        ${livro.language}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap border border-gray-300">
                                        R$ ${livro.price}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap border border-gray-300">
                                        ${livro.arrival_date}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap border border-gray-300">
                                        <button class="edit-btn bg-blue-500 text-white px-2 py-1 rounded">Editar</button>
                                    </td>
                                </tr>
                            `;
                        });
                        $('#bodyTable').html(tbody);
                        if ($.fn.DataTable.isDataTable('#booksTable')) {
                            table.destroy();
                        }
                        table = $('#booksTable').DataTable();
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }

            carregarLivros();

            $('#openModal').click(function() {
                Swal.fire({
                    title: 'Cadastro de Livro',
                    html: `
                        <form id="bookForm" enctype="multipart/form-data">
                            <input type="text" id="title" name="title" class="swal2-input" placeholder="Título do Livro" required>
                            <input type="text" id="author" name="author" class="swal2-input" placeholder="Autor" required>
                            <input type="text" id="language" name="language" class="swal2-input" placeholder="Idioma" required>
                            <input type="number" id="price" name="price" class="swal2-input" placeholder="Preço" required>
                            <input type="date" id="arrival_date" name="arrival_date" class="swal2-input" required>
                            <input type="file" id="image" name="image" class="swal2-input" required>
                        </form>
                    `,
                    focusConfirm: false,
                    preConfirm: () => {
                        const form = document.getElementById('bookForm');
                        const formData = new FormData(form);
                        return $.ajax({
                            url: '{{ route("createBook") }}',
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                        });
                    },
                    confirmButtonText: 'Cadastrar Livro',
                    showCancelButton: true,
                    cancelButtonText: 'Cancelar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire('Sucesso!', 'O livro foi cadastrado.', 'success');
                        carregarLivros();
                    }
                });
            });

            $('#bodyTable').on('click', '.edit-btn', function() {
                var row = $(this).closest('tr');
                var id = row.data('id');
                var livro = {
                    title: row.find('td:eq(1)').text(),
                    author: row.find('td:eq(2)').text(),
                    language: row.find('td:eq(3)').text(),
                    price: row.find('td:eq(4)').text().replace('R$ ', ''),
                    arrival_date: row.find('td:eq(5)').text(),
                    image_url: row.find('img').attr('src'),
                };

                Swal.fire({
                    title: 'Editar Livro',
                    html: `
                        <form id="editBookForm" enctype="multipart/form-data">
                            <input type="text" id="edit_title" name="title" class="swal2-input" placeholder="Título do Livro" value="${livro.title}" required>
                            <input type="text" id="edit_author" name="author" class="swal2-input" placeholder="Autor" value="${livro.author}" required>
                            <input type="text" id="edit_language" name="language" class="swal2-input" placeholder="Idioma" value="${livro.language}" required>
                            <input type="number" id="edit_price" name="price" class="swal2-input" placeholder="Preço" value="${livro.price}" required>
                            <input type="date" id="edit_arrival_date" name="arrival_date" class="swal2-input" value="${livro.arrival_date}" required>
                            <input type="file" id="edit_image" name="image" class="swal2-input">
                            <img src="${livro.image_url}" alt="${livro.title}" class="swal2-input" style="height: 100px;">
                        </form>
                    `,
                    focusConfirm: false,
                    preConfirm: () => {
                        const form = document.getElementById('editBookForm');
                        const formData = new FormData(form);
                        formData.append('_method', 'PUT');
                        return $.ajax({
                            url: '{{ url("books") }}/' + id,
                            type: 'POST',
                            data: formData,
                            processData: false,
                            contentType: false,
                        });
                    },
                    confirmButtonText: 'Atualizar Livro',
                    showCancelButton: true,
                    cancelButtonText: 'Cancelar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire('Sucesso!', 'O livro foi atualizado.', 'success');
                        carregarLivros();
                    }
                });
            });
        });
    </script>
@endsection
