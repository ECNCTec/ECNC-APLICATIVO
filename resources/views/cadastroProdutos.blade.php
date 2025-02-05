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
    @endsection

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
