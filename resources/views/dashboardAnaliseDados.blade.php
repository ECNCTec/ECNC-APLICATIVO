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
                margin-top: -44px;
                margin-bottom: 17px;
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
                <h6>Dashboard</h6>
            </div>
            <style>
                #card {
                    border: 1px solid rgba(243, 243, 243, 0.978);
                    border-left: 3px solid #5790d6;
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1), 0 4px 16px rgba(0, 0, 0, 0.1);
                    padding: 5px;
                    border-radius: 8px;
                }

                #card h6 {
                    font-size: 14px;
                    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                    color: #333;
                }

                #card strong {
                    color: rgb(58, 163, 54);
                    margin-right: 5px;
                }

                #card .valor {
                    font-size: 18px;
                }

                .tituloCard {
                    border-bottom: 1px solid #d9d9d9;
                    padding: 5px 0px 5px 8px;
                }

                .valoresCards {
                    padding: 5px 0px 0px 5px;
                    display: flex;
                }

                @media (max-width: 768px) {
                    #card {
                        margin-top: 10px;
                    }
                }
            </style>
            <div id="form-container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div id="card" style="media (max-width: 768px){margin-top: none;}">
                            <h6 class="tituloCard">Receita</h6>
                            <div class="valoresCards">
                                <h6 class="valor ml-1"><strong>R$</strong> 2.390,00</h6>
                                <h6 class="porcentagem ml-auto mr-1">48%</h6>
                            </div>
                            <div>
                                <h6>gráfico aqui</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div id="card">
                            <h6 class="tituloCard">Orçamentos Aprovados</h6>
                            <div class="valoresCards">
                                <h6 class="valor ml-1"><strong>R$</strong> 2.390,00</h6>
                                <h6 class="porcentagem ml-auto mr-1">21%</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div id="card">
                            <h6 class="tituloCard">Orçamentos Pendentes</h6>
                            <div class="valoresCards">
                                <h6 class="valor ml-1"><strong>R$</strong> 2.390,00</h6>
                                <h6 class="porcentagem ml-auto mr-1">5%</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 mt-md-2 mt-sm-2 mt-lg-0">
                        <div id="card">
                            <h6 class="tituloCard">Valor em Estoque</h6>
                            <div class="valoresCards">
                                <h6 class="valor ml-1"><strong>R$</strong> 2.390,00</h6>
                                <h6 class="porcentagem ml-auto mr-1">35%</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
