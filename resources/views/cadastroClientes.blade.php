<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Document</title>
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
                <form>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label>CNPJ/CPF:</label>
                            <input type="text" name="cpf_cnpj" class="form-control" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Tipo de Pessoa:</label>
                            <select name="tipo_pessoa" class="form-control" required>
                                <option disabled selected>Selecione uma opção:</option>
                                <option value="fisica">Física</option>
                                <option value="juridica">Jurídica</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Sexo:</label>
                            <select name="sexo" class="form-control">
                                <option disabled selected>Selecione uma opção:</option>
                                <option value="masculino">Masculino</option>
                                <option value="feminino">Feminino</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Inscrição Estadual/RG:</label>
                            <input type="text" name="inscricao_rg" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Razão Social:</label>
                            <input type="text" name="razao_social" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Nome Fantasia:</label>
                            <input type="text" name="nome_fantasia" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label>CEP:</label>
                            <input type="text" name="cep" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Endereço:</label>
                            <input type="text" name="endereco" class="form-control" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Complemento:</label>
                            <input type="text" name="complemento" class="form-control" placeholder="Ex: lote 3 sala 1"
                                required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Bairro:</label>
                            <input type="text" name="bairro" class="form-control" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Estado:</label>
                            <select name="estado" class="form-control" required>
                                <option disabled selected>Selecione uma opção:</option>
                                <option value="AC">Acre</option>
                                <option value="AL">Alagoas</option>
                                <option value="AP">Amapá</option>
                                <option value="AM">Amazonas</option>
                                <option value="BA">Bahia</option>
                                <option value="CE">Ceará</option>
                                <option value="DF">Distrito Federal</option>
                                <option value="ES">Espírito Santo</option>
                                <option value="GO">Goiás</option>
                                <option value="MA">Maranhão</option>
                                <option value="MT">Mato Grosso</option>
                                <option value="MS">Mato Grosso do Sul</option>
                                <option value="MG">Minas Gerais</option>
                                <option value="PA">Pará</option>
                                <option value="PB">Paraíba</option>
                                <option value="PR">Paraná</option>
                                <option value="PE">Pernambuco</option>
                                <option value="PI">Piauí</option>
                                <option value="RJ">Rio de Janeiro</option>
                                <option value="RN">Rio Grande do Norte</option>
                                <option value="RS">Rio Grande do Sul</option>
                                <option value="RO">Rondônia</option>
                                <option value="RR">Roraima</option>
                                <option value="SC">Santa Catarina</option>
                                <option value="SP">São Paulo</option>
                                <option value="SE">Sergipe</option>
                                <option value="TO">Tocantins</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Cidade:</label>
                            <input type="text" name="cidade" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>E-mail:</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Telefone:</label>
                            <input type="text" name="telefone" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label>Inscrição Municipal:</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Regime Tributário:</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Contribuinte ICMS:</label>
                            <input type="text" class="form-control">
                        </div>
                        <div class="form-group col-md-3">
                            <label>Operação Consumidor Final:</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="button-cadastrar btn btn-sm d-none d-sm-inline-block">Cadastrar</button>
                    </div>
                    <button type="submit" class="button-cadastrar btn btn-sm btn-block d-inline-block d-sm-none">Cadastrar</button>
                </form>
            </div>
        </div>
    @endsection

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
