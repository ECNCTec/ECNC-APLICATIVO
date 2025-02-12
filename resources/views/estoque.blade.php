<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Estoque</title>
    </style>
</head>

<body>
    @extends('dashboard')
    @section('content')
        <style>
            .titulo {
                margin-top: -48px;
                margin-bottom: 20px;
                display: flex;
                justify-content: center;
                text-align: center;
                position: relative;
                z-index: 9999;
            }

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
                .titulo {
                    margin-top: -30px;
                    margin-bottom: 10px;
                    z-index: 0;
                }

                .titulo h6 {
                    font-size: 18px;
                }

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

                .modal {
                    z-index: 99999 !important;
                }

                .modal-backdrop {
                    z-index: 1040 !important;
                }
            }
        </style>
        <div id="form" class="crm-table-container">
            <div class="titulo">
                <h6>Estoque</h6>
            </div>
            <div class="search-container">
                <h6>Atualmente, a lista contém {{ $contagemEstoque }} registros.</h6>
                <div class="filtro">
                    <div>
                        <a href="{{ route('estoque') }}">
                            <img class="mr-2" src="{{ asset('storage/images/recarregar.png') }}" alt="Recarregar Filtros">
                        </a>
                    </div>
                    <div>
                        <a href="#" data-toggle="modal" data-target="#filtroModalEstoque">
                            <img class="mr-2" src="{{ asset('storage/images/filtro.png') }}" alt="Abrir Filtro">
                        </a>
                    </div>
                    <div class="modal fade" id="filtroModalEstoque" tabindex="-1" role="dialog"
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
                                    <form action="{{ route('estoque') }}" method="GET">
                                        <div class="form-group">
                                            <label for="idDescricao">ID ou Descrição</label>
                                            <div class="input-group">
                                                <input type="text" name="search"
                                                    class="filtro-id-descricao form-control" id="idDescricao"
                                                    placeholder="Digite ID ou descrição"
                                                    value="{{ old('search', request()->input('search')) }}">
                                                <i class="fas fa-search"></i>
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="quantidadeMaximaPecas">Quantidade Máxima Peças:</label>
                                                <input type="number" name="quantidadeMaximaPecas" class="form-control"
                                                    id="quantidadeMaximaPecas"
                                                    value="{{ old('quantidadeMaximaPecas', request()->input('quantidadeMaximaPecas')) }}">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="quantidadeMinimaPecas">Quantidade Mínima Peças:</label>
                                                <input type="number" name="quantidadeMinimaPecas" class="form-control"
                                                    id="quantidadeMinimaPecas"
                                                    value="{{ old('quantidadeMinimaPecas', request()->input('quantidadeMinimaPecas')) }}">
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="dataInicial">Data Inicial:</label>
                                                <input type="date" name="dataInicial" class="form-control"
                                                    id="dataInicial"
                                                    value="{{ old('dataInicial', request()->input('dataInicial')) }}">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="dataFinal">Data Final:</label>
                                                <input type="date" name="dataFinal" class="form-control" id="dataFinal"
                                                    value="{{ old('dataFinal', request()->input('dataFinal')) }}">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="operacao">Operação</label>
                                            <select name="operacao" class="form-control" id="operacao">
                                                <option value="" disabled selected>Selecione uma opção:</option>
                                                <option value="Entrada"
                                                    {{ old('operacao', request()->input('operacao')) == 'Entrada' ? 'selected' : '' }}>
                                                    Entrada</option>
                                                <option value="Saída"
                                                    {{ old('operacao', request()->input('operacao')) == 'Saída' ? 'selected' : '' }}>
                                                    Saída</option>
                                            </select>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit"
                                                class="button-atualizar-modal btn button-filtrar btn btn-sm">Aplicar
                                                Filtros</button>
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
                            <th>Fornecedor</th>
                            <th>Quant. Peças</th>
                            <th>Custo</th>
                            <th>Operação</th>
                            <th>Data Registro</th>
                            <th>Editar</th>
                            <th>Excluir</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($registrosEstoque as $estoque)
                            <tr>
                                <td>{{ $estoque->id }}</td>
                                <td>{{ $estoque->produto->descricao }}</td>
                                <td>{{ $estoque->fornecedor->razao_social }}</td>
                                <td>{{ $estoque->quantidade_pecas }}</td>
                                <td>{{ number_format($estoque->custo, 2, ',', '.') }}</td>
                                <td>{{ $estoque->operacao }}</td>
                                <td>{{ $estoque->created_at }}</td>
                                <td>
                                    <a type="button" class="buttonAction btn btn-sm" data-toggle="modal"
                                        data-target="#editModal{{ $estoque->id }}">
                                        <img src="{{ asset('storage/images/buttonEditar.png') }}" alt="Editar">
                                    </a>
                                </td>
                                <td>
                                    <a type="button" class="buttonAction btn btn-sm" data-toggle="modal"
                                        data-target="#deleteModal{{ $estoque->id }}">
                                        <img src="{{ asset('storage/images/buttonExcluir.png') }}" alt="Excluir">
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">Nenhum estoque encontrado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        <div id="form" class="d-md-none mb-2">
            @forelse($registrosEstoque as $estoque)
                <div class="mobile-table">
                    <p><strong>ID:</strong> {{ $estoque->id }}</p>
                    <p><strong>Descrição:</strong> {{ $estoque->produto->descricao }}</p>
                    <p><strong>Fornecedor</strong> {{ $estoque->fornecedor->razao_social }}</p>
                    <p><strong>Quant. Peças:</strong> {{ $estoque->quantidade_pecas }}</p>
                    <p><strong>Custo:</strong> {{ number_format($estoque->custo, 2, ',', '.') }}</p>
                    <p><strong>Operação:</strong> {{ $estoque->operacao }}</p>
                    <p><strong>Data Registro:</strong> {{ $estoque->created_at }}</p>
                    <div class="actions" style="position: absolute; top: 10px; right: 10px;">
                        <a class="buttonAction btn btn-sm mr-2" type="button" class="buttonAction btn btn-sm"
                            data-toggle="modal" data-target="#editModal{{ $estoque->id }}">
                            <img src="{{ asset('storage/images/buttonEditar.png') }}" alt="">
                        </a>
                        <a class="buttonAction btn btn-sm" type="button" class="buttonAction btn btn-sm"
                            data-toggle="modal" data-target="#deleteModal{{ $estoque->id }}">
                            <img src="{{ asset('storage/images/buttonExcluir.png') }}" alt="">
                        </a>
                    </div>
                </div>
            @empty
                <p class="text-center">Nenhum estoque encontrado.</p>
            @endforelse
        </div>
        @foreach ($registrosEstoque as $estoque)
            <div class="modal fade" id="editModal{{ $estoque->id }}" tabindex="-1" role="dialog"
                aria-labelledby="editModalLabel{{ $estoque->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editModalLabel{{ $estoque->id }}">Editar Estoque
                            </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('cadastroEstoque', $estoque->id ?? null) }}" method="POST">
                                @csrf
                                <input type="hidden" name="estoque_id" value="{{ $estoque->id ?? '' }}">
                                <input type="hidden" name="produto_id" value="{{ $estoque->produto_id ?? '' }}">
                                <input type="hidden" name="fornecedor_id" value="{{ $estoque->fornecedor_id ?? '' }}">
                                <div class="form-group">
                                    <label for="quantidade_pecas">Produto</label>
                                    <select id="produto_id" name="produto_id" class="form-control" required>
                                        <option value="" disabled>Selecione uma opção:</option>
                                        @foreach ($produtoEstoque as $produto)
                                            <option value="{{ $produto->id }}"
                                                {{ old('produto_id', $estoque->produto_id ?? '') == $produto->id ? 'selected' : '' }}>
                                                {{ $produto->id }} - {{ $produto->descricao }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="quantidade_pecas">Quantidade de Peças</label>
                                    <input type="number" class="form-control" id="quantidade_pecas"
                                        name="quantidade_pecas" value="{{ $estoque->quantidade_pecas }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="custo">Custo</label>
                                    <input type="text" class="form-control" id="custo" name="custo"
                                        value="{{ number_format($estoque->custo, 2, ',', '.') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="operacao">Operação</label>
                                    <select id="operacao" name="operacao" class="form-control" required>
                                        <option value="" disabled>Selecione uma opção:</option>
                                        @foreach ($operacao as $op)
                                            <option value="{{ $op->operacao }}"
                                                {{ old('operacao', $estoque->operacao ?? '') == $op->operacao ? 'selected' : '' }}>
                                                {{ $op->operacao }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="button-atualizar-modal btn">Atualizar
                                        Produto</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="deleteModal{{ $estoque->id }}" tabindex="-1" role="dialog"
                aria-labelledby="deleteModalLabel{{ $estoque->id }}" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteModalLabel{{ $estoque->id }}">Excluir Estoque</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Tem certeza de que deseja excluir este registro de "{{ $estoque->produto->descricao }}"?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="button-cancelar-modal btn"
                                data-dismiss="modal">Cancelar</button>
                            <form action="{{ route('estoque.destroy', $estoque->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="button-excluir-modal btn">Excluir</button>
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
