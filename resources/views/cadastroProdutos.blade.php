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

            .search-container h6 {
                font-size: 13px;
                font-weight: 600;
                color: #333;
                margin-bottom: 0;
            }

            .input-container {
                position: relative;
                display: flex;
                align-items: center;
                width: auto;
            }

            .input-container input {
                padding-right: 30px;
                height: 25px;
                border: 1px solid #ccc;
                border-radius: 3px;
                font-size: 13px;
                line-height: 25px;
                width: 100%;
            }

            .input-container svg {
                position: absolute;
                right: 8px;
                top: 50%;
                transform: translateY(-50%);
            }

            .input-container input:focus {
                border-color: #007bff;
                outline: none;
                box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
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

            .descricao_produto,
            .comprimento_produto,
            .largura_produto,
            .tipoMedidaProduto {
                font-size: 13px;
            }

            .buttonAction {
                border-radius: 25px;
                margin: 0px;
                padding: 0px;
            }

            @media (max-width: 768px) {
                #form {
                    margin: 30px 10px -25px 10px;
                }

                .search-container {
                    flex-direction: column;
                    align-items: flex-start;
                }

                .input-container {
                    width: 100%;
                    margin-top: 5px;
                }

                .input-container input {
                    width: 100%;
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

                /* .crm-table-container {
                        overflow-x: auto;
                        padding: 5px;
                        background: #f8f9fa;
                        border: 1px solid #ddd;
                        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                    } */

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
                <h6>Produtos Cadastrados</h6>
                <div class="input-container">
                    <input type="text" placeholder="Pesquisar..." />
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="gray"
                        class="bi bi-search" viewBox="0 0 16 16">
                        <path
                            d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.099zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z" />
                    </svg>
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
                                        <img src="{{ asset('storage/images/buttonEditar4.png') }}" alt="">
                                    </a>
                                </td>
                                <td>
                                    <a type="button" class="buttonAction btn btn-sm" data-toggle="modal"
                                        data-target="#deleteModal{{ $produto->id }}">
                                        <img src="{{ asset('storage/images/buttonExcluir2.png') }}" alt="">
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
                        <a class="buttonAction btn btn-sm" data-toggle="modal" data-target="#editModal{{ $produto->id }}">
                            <img src="{{ asset('storage/images/buttonEditar4.png') }}" alt="">
                        </a>
                        <a class="buttonAction btn btn-sm" data-toggle="modal"
                            data-target="#deleteModal{{ $produto->id }}">
                            <img src="{{ asset('storage/images/buttonExcluir2.png') }}" alt="">
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
                            <h5 class="modal-title" id="editModalLabel{{ $produto->id }}">Editar Produto</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('produtos.update', $produto->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <label for="descricao_produto">Descrição do Produto:</label>
                                    <input type="text" id="descricao_produto" name="descricaoProduto"
                                        class="descricao_produto form-control" value="{{ $produto->descricao }}"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="comprimento_produto">Comprimento (mm):</label>
                                    <input type="number" id="comprimento_produto" name="comprimentoProduto"
                                        class="comprimento_produto form-control" value="{{ $produto->comprimento }}"
                                        required>
                                </div>
                                <div class="form-group">
                                    <label for="largura_produto">Largura (mm):</label>
                                    <input type="number" id="largura_produto" name="larguraProduto"
                                        class="largura_produto form-control" value="{{ $produto->largura }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="tipo_medida">Tipo de Medida:</label>
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
                                    <button type="button" class="btn btn-secondary"
                                        data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-warning">Atualizar Produto</button>
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
                            <h5 class="modal-title" id="deleteModalLabel{{ $produto->id }}">Confirmar Exclusão</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Tem certeza que deseja excluir o produto "{{ $produto->descricao }}"?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <form action="{{ route('produtos.destroy', $produto->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Excluir</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endsection
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
