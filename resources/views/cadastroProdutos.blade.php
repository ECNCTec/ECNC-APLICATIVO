<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Produtos</title>
    </style>
</head>

<body>
    @extends('dashboard')
    @section('content')
        <style>
            #form {
                margin: 0px 10px 0px 10px;
            }

            #form-container {
                background: #f8f9fa;
                padding: 10px;
                border: 1px solid #ddd;
                font-size: 12px;
            }

            #form-container label {
                font-weight: bold;
                font-size: 12px;
            }

            #form-container .form-control {
                height: 27px;
                padding: 2px 5px;
                font-size: 12px;
            }

            #form-container select {
                height: 27px;
                font-size: 12px;
            }

            #form-container .btn {
                padding: 3px 10px;
                font-size: 12px;
            }

            .button-cadastrar {
                background: linear-gradient(to bottom, #3387fb, #4242ff, #3387fb);
                color: #fff;
                height: 28px;
                padding: 0 20px;
                border: none;
                border-radius: 3px;
                font-size: 13px;
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
                text-align: center;
                transition: background 0.3s ease;
            }

            .modal-backdrop {
                background-color: rgba(0, 0, 0, 0.2);
            }

            .crm-table-container {
                border: 1px solid #ddd;
                padding: 5px;
                margin: 10px 0;
                background: #f8f9fa;
                box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            }

            .search-container {
                display: flex;
                align-items: center;
                justify-content: space-between;
                width: 100%;
                margin-bottom: 5px;
            }

            .filtro {
                display: flex;
            }

            .filtro img {
                height: 18px;
            }

            .modal-content {
                font-size: 14px;
            }

            .form-control,
            .form-control option {
                height: 30px;
                font-size: 12px;
                border-radius: 1px;
                padding: 5px 10px;
            }

            .form-control::placeholder {
                font-size: 12px;
            }

            select.form-control {
                padding: 3px 10px;
            }

            .input-group {
                position: relative;
            }

            .input-group .form-control {
                padding-right: 30px;
            }

            .input-group .fa-search {
                position: absolute;
                right: 12px;
                top: 50%;
                transform: translateY(-50%);
                color: gray;
                font-size: 14px;
                cursor: pointer;
            }

            .button-filtrar {
                height: 30px;
                font-size: 14px;
                padding: 5px 15px;
                border-radius: 3px;
                background-color: #007bff;
                color: white;
                border: none;
                cursor: pointer;
                outline: none;
                box-shadow: none;
            }

            .button-filtrar:hover {
                background-color: #0056b3;
            }

            .button-filtrar:focus {
                outline: none;
                box-shadow: none;
            }

            .submit-btn {
                position: absolute;
                top: 50%;
                right: 3px;
                transform: translateY(-50%);
                background: none;
                border: none;
                cursor: pointer;
                padding: 0;
                outline: none;
            }

            .crm-table-container table.table {
                width: 100%;
                border-collapse: collapse;
                font-family: 'Arial', sans-serif;
            }

            .crm-table-container table.table th,
            .crm-table-container table.table td {
                padding: 2px 8px;
                text-align: center;
                font-size: 12px;
                border-bottom: 1px solid #f2f2f2;
            }

            .crm-table-container table.table th {
                background: linear-gradient(to bottom, #dcdcdc, #ffffff, #e7e7e7);
                color: #333;
                font-weight: 600;
                text-transform: uppercase;
            }

            .crm-table-container table.table tr:nth-child(odd) {
                background-color: #f9f9f9;
            }

            .crm-table-container table.table tr:nth-child(even) {
                background-color: #f1f1f1;
            }

            .crm-table-container table.table td {
                color: #555;
            }

            .crm-table-container table.table td button {
                font-size: 13px;
                padding: 5px 12px;
                margin: 0 5px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }

            .crm-table-container table.table td button.btn-warning {
                background-color: #f1b500;
                color: #fff;
            }

            .crm-table-container table.table td button.btn-danger {
                background-color: #dc3545;
                color: #fff;
            }

            .crm-table-container table.table td button:hover {
                opacity: 0.9;
            }

            .modal-title {
                font-size: 18px;
            }

            .descricao_produto,
            .comprimento_produto,
            .largura_produto,
            .tipoMedidaProduto,
            .modal-body,
            .filtro-id-descricao {
                font-size: 13px;
            }

            .buttonAction {
                border-radius: 25px;
                margin: 0px;
                padding: 0px;
            }

            .buttonAction img {
                width: 16px;
            }

            .modal-dialog {
                display: flex;
                align-items: center;
                justify-content: center;
                min-height: 70vh;
            }

            .modal-content {
                width: 100%;
                max-width: 800px;
                margin: auto;
                border-radius: 3px;
            }

            .button-atualizar-modal,
            .button-excluir-modal,
            .button-cancelar-modal,
            .button-filtrar {
                color: #fff;
                height: 26px;
                padding: 0 15px;
                border: none;
                border-radius: 3px;
                font-size: 13px;
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
                text-align: center;
                transition: background 0.3s ease;
            }

            .button-atualizar-modal,
            .button-filtrar {
                background: linear-gradient(to bottom, #3387fb, #4242ff, #3387fb);
            }

            .button-excluir-modal {
                background: linear-gradient(to bottom, #ff7272, #d60909, #ff7272);
            }

            .button-cancelar-modal {
                background: linear-gradient(to bottom, #d9d9d9, #6b6b6b, #acacac);
            }

            .message {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                padding: 20px;
                border-radius: 1px;
                z-index: 1000;
                min-width: 200px;
                text-align: center;
                font-size: 16px;
                opacity: 1;
                transition: opacity 1s ease-out;
            }

            .alert-success,
            .alert-warning,
            .alert-danger {
                background: linear-gradient(10deg, #c8d8f1d3, #dee9f9d3, #c8d8f1d3, #dee9f9d3);
                color: rgb(40, 40, 40);
                font-weight: bold;
                border: none;
            }

            @media (max-width: 768px) {
                #form {
                    margin: 30px 10px -25px 10px;
                }

                .filtro img {
                    height: 25px;
                }

                .crm-table-container {
                    margin: 10px 0;
                }

                .crm-table-container table.table {
                    font-size: 12px;
                }

                .crm-table-container table.table th,
                .crm-table-container table.table td {
                    padding: 2px 15px;
                }

                .crm-table-container table.table td {
                    display: block;
                    text-align: left;
                    padding-left: 20px;
                    padding-right: 20px;
                    border: none;
                    border-bottom: 1px solid #f2f2f2;
                    margin-bottom: 2px;
                }

                .crm-table-container table.table th {
                    display: none;
                }

                .crm-table-container table.table tr {
                    border-bottom: 1px solid #ddd;
                }

                .crm-table-container table.table td:before {
                    content: attr(data-label);
                    font-weight: bold;
                    color: #007bff;
                    display: block;
                    margin-bottom: 5px;
                }

                .crm-table-container table.table td button {
                    font-size: 12px;
                    padding: 5px 10px;
                }

                .mobile-table {
                    background: #f8f9fa;
                    border: 1px solid #ddd;
                    padding: 10px;
                    margin-bottom: 5px;
                    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
                    border-radius: 1px;
                    position: relative;
                }

                .mobile-table p {
                    margin: 5px 0;
                    font-size: 13px;
                    color: #323232;
                    padding-bottom: 5px;
                    border-bottom: 1px solid #ddd;
                }

                .mobile-table p:last-child {
                    border-bottom: none;
                }

                .mobile-table p strong {
                    color: #2a2a2a;
                    font-weight: 600;
                }

                .mobile-table .actions .buttonAction {
                    background: none;
                    border: none;
                    cursor: pointer;
                    padding: 0;
                }

                .buttonAction img {
                    width: 22px;
                }

                .modal-dialog {
                    min-height: 100vh;
                }

                .modal-content {
                    max-width: 100%;
                }
            }
        </style>
        <div id="form">
            <div id="form-container">
                <form action="{{ route('produtos.store') }}" method="POST">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="descricao_produto">Descrição do Produto:</label>
                            <input type="text" id="descricao_produto" name="descricaoProduto" class="form-control"
                                value="{{ old('descricaoProduto') }}" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="comprimento_produto">Comprimento do Produto (mm):</label>
                            <input type="text" id="comprimento_mm" name="comprimentoProduto" class="form-control"
                                value="{{ old('comprimentoProduto') }}" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="largura_mm">Largura do Produto (mm):</label>
                            <input type="text" id="largura_mm" name="larguraProduto" class="form-control"
                                value="{{ old('larguraProduto') }}" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="tipo_medida">Tipo de Medida:</label>
                            <select id="tipo_medida" name="tipoMedidaProduto" class="form-control" required>
                                <option disabled selected>Selecione uma opção:</option>
                                <option value="unidade" {{ old('tipoMedidaProduto') == 'unidade' ? 'selected' : '' }}>
                                    Unidade</option>
                                <option value="peso" {{ old('tipoMedidaProduto') == 'peso' ? 'selected' : '' }}>Peso
                                </option>
                            </select>
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="button-cadastrar btn btn-sm d-none d-sm-inline-block">Cadastrar
                            Produto</button>
                    </div>
                    <button type="submit" class="button-cadastrar btn btn-sm btn-block d-inline-block d-sm-none">Cadastrar
                        Produto</button>
                </form>
            </div>
        </div>
        <div id="form" class="crm-table-container">
            <div class="search-container">
                <h6>Atualmente, {{ $quantidadeProdutos }} produtos estão cadastrados.</h6>
                <div class="filtro">
                    <div>
                        <a href=""><img class="mr-2" src="{{ asset('storage/images/recarregar.png') }}"
                                alt=""></a>
                    </div>
                    <div>
                        <a href="#" data-toggle="modal" data-target="#filtroModal">
                            <img class="mr-2" src="{{ asset('storage/images/filtro.png') }}" alt="">
                        </a>
                    </div>
                    <style>

                    </style>
                    <div class="modal fade" id="filtroModal" tabindex="-1" role="dialog"
                        aria-labelledby="filtroModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h6 class="modal-title" id="filtroModalLabel">Filtros</h6>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('cadastroProdutos') }}" method="GET">
                                        <div class="form-group">
                                            <label for="idDescricao">ID ou Descrição</label>
                                            <div class="input-group">
                                                <input type="text" name="search" class="filtro-id-descricao form-control" id="idDescricao" placeholder="Digite ID ou descrição">
                                                <i class="fas fa-search"></i>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="maiorComprimento">Comprimento máximo:</label>
                                                <input type="number" name="maiorComprimento" class="form-control" id="maiorComprimento">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="menorComprimento">Comprimento mínimo</label>
                                                <input type="number" name="menorComprimento" class="form-control" id="menorComprimento">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="maiorLargura">Largura máxima:</label>
                                                <input type="number" name="maiorLargura" class="form-control" id="maiorLargura">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="menorLargura">Largura máxima:</label>
                                                <input type="number" name="menorLargura" class="form-control" id="menorLargura">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="tipoMedida">Tipo de Medida</label>
                                            <select name="tipoMedida" class="form-control" id="tipoMedida">
                                                <option value="" disabled selected>Selecione uma opção:</option>
                                                <option value="Unidade">Unidade</option>
                                                <option value="Peso">Peso</option>
                                            </select>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="button-atualizar-modal btn button-filtrar btn btn-sm">Aplicar Filtros</button>
                                        </div>
                                    </form>                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-none d-md-block">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Descrição</th>
                            <th>Comprimento (mm)</th>
                            <th>Largura (mm)</th>
                            <th>Tipo de Medida</th>
                            <th>Editar</th>
                            <th>Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($produtos as $produto)
                            <tr>
                                <td>{{ $produto->id }}</td>
                                <td>{{ $produto->descricao }}</td>
                                <td>{{ $produto->comprimento }}</td>
                                <td>{{ $produto->largura }}</td>
                                <td>{{ ucfirst($produto->tipo_medida) }}</td>
                                <td>
                                    <a type="button" class="buttonAction btn btn-sm" data-toggle="modal"
                                        data-target="#editModal{{ $produto->id }}">
                                        <img src="{{ asset('storage/images/buttonEditar.png') }}" alt="">
                                    </a>
                                </td>
                                <td>
                                    <a type="button" class="buttonAction btn btn-sm" data-toggle="modal"
                                        data-target="#deleteModal{{ $produto->id }}">
                                        <img src="{{ asset('storage/images/buttonExcluir.png') }}" alt="">
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Nenhum produto encontrado</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div id="form" class="d-md-none mb-2">
            @forelse($produtos as $produto)
                <div class="mobile-table">
                    <p><strong>ID:</strong> {{ $produto->id }}</p>
                    <p><strong>Descrição:</strong> {{ $produto->descricao }}</p>
                    <p><strong>Comprimento (mm):</strong> {{ $produto->comprimento }}</p>
                    <p><strong>Largura (mm):</strong> {{ $produto->largura }}</p>
                    <p><strong>Tipo de Medida:</strong> {{ ucfirst($produto->tipo_medida) }}</p>
                    <div class="actions" style="position: absolute; top: 10px; right: 10px;">
                        <a class="buttonAction btn btn-sm mr-2" data-toggle="modal"
                            data-target="#editModal{{ $produto->id }}">
                            <img src="{{ asset('storage/images/buttonEditar.png') }}" alt="">
                        </a>
                        <a class="buttonAction btn btn-sm" data-toggle="modal"
                            data-target="#deleteModal{{ $produto->id }}">
                            <img src="{{ asset('storage/images/buttonExcluir.png') }}" alt="">
                        </a>
                    </div>
                </div>
            @empty
                <p class="text-center">Nenhum produto encontrado</p>
            @endforelse
        </div>
        @foreach ($produtos as $produto)
            <div class="modal fade" id="editModal{{ $produto->id }}" tabindex="-1" role="dialog"
                aria-labelledby="editModalLabel{{ $produto->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title" id="editModalLabel{{ $produto->id }}">Editar Produto</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('produtos.update', $produto->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="descricao_produto" class="descricao_produto">Descrição do Produto:</label>
                                    <input type="text" id="descricao_produto" name="descricaoProduto"
                                        class="descricao_produto form-control" value="{{ $produto->descricao }}"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="comprimento_produto" class="comprimento_produto">Comprimento (mm):</label>
                                    <input type="number" id="comprimento_produto" name="comprimentoProduto"
                                        class="comprimento_produto form-control" value="{{ $produto->comprimento }}"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="largura_produto" class="largura_produto">Largura (mm):</label>
                                    <input type="number" id="largura_produto" name="larguraProduto"
                                        class="largura_produto form-control" value="{{ $produto->largura }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="tipo_medida" class="tipoMedidaProduto">Tipo de Medida:</label>
                                    <select id="tipo_medida" name="tipoMedidaProduto"
                                        class="tipoMedidaProduto form-control" required>
                                        <option value="unidade"
                                            {{ $produto->tipo_medida == 'unidade' ? 'selected' : '' }}>
                                            Unidade
                                        </option>
                                        <option value="peso" {{ $produto->tipo_medida == 'peso' ? 'selected' : '' }}>
                                            Peso
                                        </option>
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="button-cancelar-modal btn"
                                        data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="button-atualizar-modal btn">Atualizar Produto</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="deleteModal{{ $produto->id }}" tabindex="-1" role="dialog"
                aria-labelledby="deleteModalLabel{{ $produto->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h6 class="modal-title" id="deleteModalLabel{{ $produto->id }}">Confirmar Exclusão</h6>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Tem certeza que deseja excluir o produto "{{ $produto->descricao }}"?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="button-cancelar-modal btn"
                                data-dismiss="modal">Cancelar</button>
                            <form action="{{ route('produtos.destroy', $produto->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <div>
                                    <button type="submit" class="button-excluir-modal btn">Excluir</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div>
                @if (session('success'))
                    <div class="alert alert-success message">
                        {{ session('success') }}
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger message">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('deleted'))
                    <div class="alert alert-warning message">
                        {{ session('deleted') }}
                    </div>
                @endif
            </div>
        @endforeach
    @endsection
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    {{-- script para controle do tempo de aparição das mensagens no sistema --}}
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const messages = document.querySelectorAll('.message');
            messages.forEach(function(message) {
                setTimeout(function() {
                    message.style.opacity = '0';
                }, 2000);

                setTimeout(function() {
                    message.remove();
                }, 15000);
            });
        });
    </script>
</body>

</html>
