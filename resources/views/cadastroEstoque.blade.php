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

            @media (max-width: 768px) {
                #form {
                    margin: 30px 10px 30px 10px;
                }
            }
        </style>
        <div id="form">
            <div id="form-container">
                <form action="entradaEstoque" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="produto_id">Selecione um Produto:</label>
                            <select id="produto_id" name="produto_id" class="form-control" required>
                                <option value="" disabled selected>Selecione uma opção:</option>
                                @foreach ($produtos as $produto)
                                    <option value="{{ $produto->id }}">{{ $produto->id }} - {{ $produto->descricao }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="fornecedor_id">Selecione um Fornecedor:</label>
                            <select id="fornecedor_id" name="fornecedor_id" class="form-control" required>
                                <option value="" disabled selected>Selecione uma opção:</option>
                                @foreach ($fornecedores as $fornecedor)
                                    <option value="{{ $fornecedor->id }}">{{ $fornecedor->cpf_cnpj }} - {{ $fornecedor->razao_social }}</option>
                                @endforeach
                            </select>
                        </div>                        
                        <div class="form-group col-md-2">
                            <label for="quantidade_pecas">Quantidade de Peças:</label>
                            <input type="text" id="quantidade_pecas" name="quantidade_pecas" class="form-control" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="custo">Valor de Custo:</label>
                            <input type="number" id="custo" name="custo" class="form-control" placeholder="0.00"
                                step="0.01" required>
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="button-cadastrar btn btn-sm d-none d-sm-inline-block">Registrar
                            Entrada</button>
                    </div>
                    <button type="submit" class="button-cadastrar btn btn-sm btn-block d-inline-block d-sm-none">Registrar
                        Entrada</button>
                </form>
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
