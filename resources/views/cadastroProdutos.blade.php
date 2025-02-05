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
                border-radius: 5px;
                font-size: 13px;
                cursor: pointer;
                display: flex;
                align-items: center;
                justify-content: center;
                text-align: center;
                transition: background 0.3s ease;
            }

            @media (max-width: 768px) {
                #form {
                    margin: 30px 10px 30px 10px;
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
                            <input type="text" id="descricao_produto" name="descricaoProduto" class="form-control" value="{{ old('descricaoProduto') }}" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="comprimento_produto">Comprimento do Produto (mm):</label>
                            <input type="text" id="comprimento_mm" name="comprimentoProduto" class="form-control" value="{{ old('comprimentoProduto') }}" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="largura_mm">Largura do Produto (mm):</label>
                            <input type="text" id="largura_mm" name="larguraProduto" class="form-control" value="{{ old('larguraProduto') }}" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="tipo_medida">Tipo de Medida:</label>
                            <select id="tipo_medida" name="tipoMedidaProduto" class="form-control" required>
                                <option disabled selected>Selecione uma opção:</option>
                                <option value="unidade" {{ old('tipoMedidaProduto') == 'unidade' ? 'selected' : '' }}>Unidade</option>
                                <option value="peso" {{ old('tipoMedidaProduto') == 'peso' ? 'selected' : '' }}>Peso</option>
                            </select>
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="button-cadastrar btn btn-sm d-none d-sm-inline-block">Cadastrar Produto</button>
                    </div>
                    <button type="submit" class="button-cadastrar btn btn-sm btn-block d-inline-block d-sm-none">Cadastrar Produto</button>
                </form>                
            </div>
        </div>
        {{-- <div class="container">
            <h1>Produtos Cadastrados</h1>
        
            <!-- Tabela para exibir produtos -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Descrição</th>
                        <th>Comprimento (mm)</th>
                        <th>Largura (mm)</th>
                        <th>Tipo de Medida</th>
                        <th>Ações</th>
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
                                <!-- Botão de Edição - Abre o Modal -->
                                <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#editModal{{ $produto->id }}">
                                    Editar
                                </button>
        
                                <!-- Modal de Edição -->
                                <div class="modal fade" id="editModal{{ $produto->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $produto->id }}" aria-hidden="true">
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
                                                        <input type="text" id="descricao_produto" name="descricaoProduto" class="form-control" value="{{ $produto->descricao }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="comprimento_produto">Comprimento do Produto (mm):</label>
                                                        <input type="number" id="comprimento_produto" name="comprimentoProduto" class="form-control" value="{{ $produto->comprimento }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="largura_produto">Largura do Produto (mm):</label>
                                                        <input type="number" id="largura_produto" name="larguraProduto" class="form-control" value="{{ $produto->largura }}" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="tipo_medida">Tipo de Medida:</label>
                                                        <select id="tipo_medida" name="tipoMedidaProduto" class="form-control" required>
                                                            <option value="unidade" {{ $produto->tipo_medida == 'unidade' ? 'selected' : '' }}>Unidade</option>
                                                            <option value="peso" {{ $produto->tipo_medida == 'peso' ? 'selected' : '' }}>Peso</option>
                                                        </select>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                        <button type="submit" class="btn btn-warning">Atualizar Produto</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
        
                                <!-- Botão de Exclusão - Abre o Modal -->
                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal{{ $produto->id }}">
                                    Excluir
                                </button>
        
                                <!-- Modal de Confirmação de Exclusão -->
                                <div class="modal fade" id="deleteModal{{ $produto->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel{{ $produto->id }}" aria-hidden="true">
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
                                                <!-- Formulário de Exclusão -->
                                                <form action="{{ route('produtos.destroy', $produto->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Excluir</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center">Nenhum produto encontrado</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        
            <div class="pagination-wrapper">
                {{ $produtos->links() }}
            </div>
        
            <a href="{{ route('produtos.create') }}" class="btn btn-primary">Cadastrar Novo Produto</a>
        </div> --}}
    @endsection

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
