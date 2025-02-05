<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Listagem Produtos</title>
</head>
<body>
    <div class="container">
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
    </div>
    
</body>
</html>
