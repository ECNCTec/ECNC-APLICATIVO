<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Clientes</title>
    </style>
</head>

<body>
    @extends('dashboard')
    @section('content')
        <style>
            .titulo {
                margin-top: -42px;
                margin-bottom: 15px;
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

            #form-container input,
            #form-container select {
                border-radius: 1px;
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
                .titulo {
                    margin-top: -24px;
                    margin-bottom: -5px;
                    z-index: 0;
                }

                .titulo h6 {
                    font-size: 18px;
                }

                #form {
                    margin: 30px 10px 30px 10px;
                }
            }
        </style>
        <div id="form">
            <div class="titulo">
                <h6>Cadastrar Cliente</h6>
            </div>
            <div id="form-container">
                <form action="{{ route('clientes.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label>CNPJ/CPF:</label>
                            <input type="text" name="cpf_cnpj" class="form-control" value="{{ old('cpf_cnpj') }}" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Tipo de Pessoa:</label>
                            <select name="tipo_pessoa" class="form-control" required>
                                <option disabled selected>Selecione uma opção:</option>
                                <option value="fisica" {{ old('tipo_pessoa') == 'fisica' ? 'selected' : '' }}>Física</option>
                                <option value="juridica" {{ old('tipo_pessoa') == 'juridica' ? 'selected' : '' }}>Jurídica</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Sexo:</label>
                            <select name="sexo" class="form-control">
                                <option disabled selected>Selecione uma opção:</option>
                                <option value="masculino" {{ old('sexo') == 'masculino' ? 'selected' : '' }}>Masculino</option>
                                <option value="feminino" {{ old('sexo') == 'feminino' ? 'selected' : '' }}>Feminino</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Inscrição Estadual/RG:</label>
                            <input type="text" name="inscricao_rg" class="form-control" value="{{ old('inscricao_rg') }}" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Razão Social:</label>
                            <input type="text" name="razao_social" class="form-control" value="{{ old('razao_social') }}" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Nome Fantasia:</label>
                            <input type="text" name="nome_fantasia" class="form-control" value="{{ old('nome_fantasia') }}" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label>CEP:</label>
                            <input type="text" name="cep" class="form-control" value="{{ old('cep') }}" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Endereço:</label>
                            <input type="text" name="endereco" class="form-control" value="{{ old('endereco') }}" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Complemento:</label>
                            <input type="text" name="complemento" class="form-control" value="{{ old('complemento') }}" placeholder="Ex: lote 3 sala 1" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Bairro:</label>
                            <input type="text" name="bairro" class="form-control" value="{{ old('bairro') }}" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Estado:</label>
                            <select name="estado" class="form-control" required>
                                <option disabled selected>Selecione uma opção:</option>
                                @foreach(['AC', 'AL', 'AP', 'AM', 'BA', 'CE', 'DF', 'ES', 'GO', 'MA', 'MT', 'MS', 'MG', 'PA', 'PB', 'PR', 'PE', 'PI', 'RJ', 'RN', 'RS', 'RO', 'RR', 'SC', 'SP', 'SE', 'TO'] as $estado)
                                    <option value="{{ $estado }}" {{ old('estado') == $estado ? 'selected' : '' }}>{{ $estado }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Cidade:</label>
                            <input type="text" name="cidade" class="form-control" value="{{ old('cidade') }}" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>E-mail:</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Telefone:</label>
                            <input type="text" name="telefone" class="form-control" value="{{ old('telefone') }}" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label>Inscrição Municipal:</label>
                            <input type="text" name="inscricao_municipal" class="form-control" value="{{ old('inscricao_municipal') }}">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Regime Tributário:</label>
                            <input type="text" name="regime_tributario" class="form-control" value="{{ old('regime_tributario') }}">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Contribuinte ICMS:</label>
                            <input type="text" name="contribuinte_icms" class="form-control" value="{{ old('contribuinte_icms') }}">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Operação Consumidor Final:</label>
                            <input type="text" name="operacao_consumidor_final" class="form-control" value="{{ old('operacao_consumidor_final') }}">
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="button-cadastrar btn btn-sm d-none d-sm-inline-block">Cadastrar Cliente</button>
                    </div>
                    <button type="submit" class="button-cadastrar btn btn-sm btn-block d-inline-block d-sm-none">Cadastrar Cliente</button>
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
