<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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

                #card .porcentagem {
                    background-image: linear-gradient(to right, #e0efff, #d1e5ff, #c2deff);
                    border: 1px rgb(219, 219, 219);
                    border-radius: 50%;
                    padding: 5px;
                }

                .icon img {
                    margin-top: 2px;
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
                                <div class="d-flex ml-auto">
                                    <div class="icon mr-1">
                                        <img src="{{ asset('storage/images/seta-para-cima.png') }}" alt="Seta para subir" height="20" width="20">
                                    </div>
                                    <h6 class="porcentagem mr-1">
                                        9%
                                    </h6>
                                </div>
                            </div>
                            <div>
                                <canvas id="graficoReceita" height="40"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div id="card">
                            <h6 class="tituloCard">Orçamentos Aprovados</h6>
                            <div class="valoresCards">
                                <h6 class="valor ml-1"><strong>R$</strong> 2.390,00</h6>
                                <div class="d-flex ml-auto">
                                    <div class="icon mr-1">
                                        <img src="{{ asset('storage/images/seta-para-cima.png') }}" alt="Seta para subir" height="20" width="20">
                                    </div>
                                    <h6 class="porcentagem mr-1">
                                        37%
                                    </h6>
                                </div>
                            </div>
                            <div>
                                <canvas id="graficoAprovados" height="40"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div id="card">
                            <h6 class="tituloCard">Orçamentos Pendentes</h6>
                            <div class="valoresCards">
                                <h6 class="valor ml-1"><strong>R$</strong> 2.390,00</h6>
                                <div class="d-flex ml-auto">
                                    <div class="icon mr-1">
                                        <img src="{{ asset('storage/images/seta-para-baixo.png') }}" alt="Seta para subir" height="20" width="20">
                                    </div>
                                    <h6 class="porcentagem mr-1">
                                        -14%
                                    </h6>
                                </div>
                            </div>
                            <div>
                                <canvas id="graficoPendentes" height="40"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 mt-md-2 mt-sm-2 mt-lg-0">
                        <div id="card">
                            <h6 class="tituloCard">Valor em Estoque</h6>
                            <div class="valoresCards">
                                <h6 class="valor ml-1"><strong>R$</strong> 2.390,00</h6>
                                <div class="d-flex ml-auto">
                                    <div class="icon mr-1">
                                        <img src="{{ asset('storage/images/seta-para-cima.png') }}" alt="Seta para subir" height="20" width="20">
                                    </div>
                                    <h6 class="porcentagem mr-1">
                                        19%
                                    </h6>
                                </div>
                            </div>
                            <div>
                                <canvas id="graficoEstoque" height="40"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function criarGrafico(id, dataValores, cor) {
                var ctx = document.getElementById(id).getContext('2d');
                new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
                        datasets: [{
                            label: id,
                            data: dataValores,
                            borderColor: cor,
                            backgroundColor: cor.replace('1)', '0.1)'), 
                            borderWidth: 1,
                            fill: true,
                            tension: 0.48,
                            pointRadius: 0,
                            pointHoverRadius: 4
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        scales: {
                            x: {
                                display: false
                            },
                            y: {
                                display: false
                            }
                        },
                        plugins: {
                            legend: {
                                display: false
                            }
                        }
                    }
                });
            }
            criarGrafico('graficoReceita', [1100, 1000, 1500, 1200, 1800, 2390, 1500, 1200, 2800, 2390, 1500, 1200],
                'rgba(0, 86, 179, 1)');
            criarGrafico('graficoAprovados', [400, 1900, 1400, 1100, 1600, 2200, 1300, 1100, 2600, 2200, 1400, 1100],
                'rgba(0, 128, 96, 1)');
            criarGrafico('graficoPendentes', [3000, 700, 1200, 900, 1500, 1200, 2200, 1000, 2400, 2000, 1300, 1700],
                'rgba(204, 163, 0, 1)');
            criarGrafico('graficoEstoque', [1200, 600, 1100, 800, 1400, 1900, 1100, 900, 2300, 1900, 1200, 1900],
                'rgba(153, 40, 40, 1)');
        </script>
    @endsection
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
