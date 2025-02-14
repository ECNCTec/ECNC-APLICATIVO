<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://code.highcharts.com/highcharts.js"></script>
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
                height: auto;
                padding: 10px;
                border: 1px solid #ddd;
                font-size: 12px;
            }

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
                background-image: linear-gradient(45deg, #eeeeee, #f4f4f4, #eeeeee);
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

                #card {
                    margin-top: 10px;
                }
            }
        </style>
        {{-- Style gráfico principal de barras --}}
        <style>
            .highcharts-figure,
            .highcharts-data-table table {
                min-width: 310px;
                max-width: 100%;
                margin: 1em auto;
            }

            .highcharts-data-table table {
                font-family: Verdana, sans-serif;
                border-collapse: collapse;
                border: 1px solid #ebebeb;
                margin: 10px auto;
                text-align: center;
                width: 100%;
                max-width: 500px;
            }

            .highcharts-data-table caption {
                padding: 1em 0;
                font-size: 1.2em;
                color: #555;
            }

            .highcharts-data-table th {
                font-weight: 600;
                padding: 0.5em;
            }

            .highcharts-data-table td,
            .highcharts-data-table th,
            .highcharts-data-table caption {
                padding: 0.5em;
            }

            .highcharts-data-table thead tr,
            .highcharts-data-table tr:nth-child(even) {
                background: #f8f8f8;
            }

            .highcharts-data-table tr:hover {
                background: #f1f7ff;
            }

            .highcharts-description {
                margin: 0.3rem 10px;
            }
        </style>
        <div id="form">
            <div class="titulo">
                <h6>Dashboard</h6>
            </div>
            <div id="form-container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div id="card" style="media (max-width: 768px){margin-top: none;}">
                            <h6 class="tituloCard d-flex justify-content-between">Receita <img class="ml-auto mr-1"
                                    src="{{ asset('storage/images/iconReceita.png') }}" alt="Seta para subir" height="18"
                                    width="20">
                            </h6>
                            <div class="valoresCards">
                                <h6 class="valor ml-1"><strong>R$</strong> 2.390,00</h6>
                                <div class="d-flex ml-auto">
                                    <div class="icon mr-1">
                                        <img src="{{ asset('storage/images/seta-para-cima.png') }}" alt="Seta para subir"
                                            height="20" width="20">
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
                            <h6 class="tituloCard d-flex justify-content-between">Despesas <img class="ml-auto mr-1"
                                    src="{{ asset('storage/images/iconOrcamentos.png') }}" alt="Seta para subir"
                                    height="16" width="18"></h6>
                            <div class="valoresCards">
                                <h6 class="valor ml-1"><strong>R$</strong> 2.390,00</h6>
                                <div class="d-flex ml-auto">
                                    <div class="icon mr-1">
                                        <img src="{{ asset('storage/images/seta-para-cima.png') }}" alt="Seta para subir"
                                            height="20" width="20">
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
                    <div class="col-lg-3 col-md-6 col-sm-12 mt-md-2 mt-sm-2 mt-lg-0">
                        <div id="card">
                            <h6 class="tituloCard d-flex justify-content-between">Orçamentos Pendentes <img
                                    class="ml-auto mr-1" src="{{ asset('storage/images/iconPendente.png') }}"
                                    alt="Seta para subir" height="16" width="18"></h6>
                            <div class="valoresCards">
                                <h6 class="valor ml-1"><strong>R$</strong> 2.390,00</h6>
                                <div class="d-flex ml-auto">
                                    <div class="icon mr-1">
                                        <img src="{{ asset('storage/images/seta-para-baixo.png') }}" alt="Seta para subir"
                                            height="20" width="20">
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
                            <h6 class="tituloCard d-flex justify-content-between">Valor em Estoque <img class="ml-auto mr-1"
                                    src="{{ asset('storage/images/iconEstoque.png') }}" alt="Seta para subir" height="16"
                                    width="18"></h6>
                            <div class="valoresCards">
                                <h6 class="valor ml-1"><strong>R$</strong> 2.390,00</h6>
                                <div class="d-flex ml-auto">
                                    <div class="icon mr-1">
                                        <img src="{{ asset('storage/images/seta-para-cima.png') }}" alt="Seta para subir"
                                            height="20" width="20">
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
                <div class="row">
                    <figure class="highcharts-figure col-lg-12 col-md-12">
                        <div id="container"></div>
                    </figure>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="border m-0">
                            <div id="graficoEntradaeSaidaEstoque"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="border m-0">
                            <div id="graficoClientesCadastrados"></div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="border m-0">
                            <div id="graficoStatusOrcamento"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- Gráfico para os cards --}}
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
        {{-- Gráfico principal de barras --}}
        <script>
            Highcharts.chart('container', {
                chart: {
                    type: 'column',
                    height: 310,
                },
                title: {
                    text: 'Balanço Financeiro'
                },
                xAxis: {
                    categories: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto',
                        'Setembro', 'Outubro', 'Novembro', 'Dezembro'
                    ],
                    crosshair: true,
                    accessibility: {
                        description: 'Meses do ano'
                    }
                },
                yAxis: {
                    title: {
                        text: null
                    }
                },
                tooltip: {
                    valueSuffix: ' (R$)'
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                series: [{
                        name: 'Receitas',
                        color: '#0f4571',
                        data: [38000, 28000, 13000, 6400, 54000, 3400, 30000, 21000, 5000, 6000, 40000, 38000]
                    },
                    {
                        name: 'Despesas',
                        color: 'rgba(153, 40, 40, 1)',
                        data: [45000, 14000, 10000, 14050, 19050, 11350, 28000, 22000, 5000, 5400, 30000, 23000]
                    }
                ],
                exporting: {
                    enabled: false 
                }
            });
        </script>
        {{-- Graficos de Doughnut --}}
        <script>
            function createChart(containerId, title, data) {
                Highcharts.chart(containerId, {
                    chart: {
                        type: 'pie',
                        height: Math.min(window.innerHeight, 300),
                        custom: {},
                        events: {
                            render() {
                                const chart = this,
                                    series = chart.series[0];
                                let customLabel = chart.options.chart.custom.label;

                                if (!customLabel) {
                                    customLabel = chart.options.chart.custom.label =
                                        chart.renderer.label(
                                            'Total<br/>' +
                                            '<strong>' + data.reduce((acc, point) => acc + point.y, 0) + '</strong>'
                                        )
                                        .css({
                                            color: '#000',
                                            textAnchor: 'middle'
                                        })
                                        .add();
                                }

                                const x = series.center[0] + chart.plotLeft,
                                    y = series.center[1] + chart.plotTop - (customLabel.attr('height') / 2);

                                customLabel.attr({
                                    x,
                                    y
                                });

                                customLabel.css({
                                    fontSize: `${series.center[2] / 12}px`
                                });
                            }
                        }
                    },
                    accessibility: {
                        point: {
                            valueSuffix: '%'
                        }
                    },
                    title: {
                        text: title
                    },
                    tooltip: {
                        pointFormat: '{series.name}: <b>{point.percentage:.0f}%</b>'
                    },
                    legend: {
                        enabled: false
                    },
                    plotOptions: {
                        series: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            borderRadius: 8,
                            dataLabels: [{
                                    enabled: true,
                                    distance: 20,
                                    format: '{point.name}'
                                },
                                {
                                    enabled: true,
                                    distance: -15,
                                    format: '{point.percentage:.0f}%',
                                    style: {
                                        fontSize: '0.9em'
                                    }
                                }
                            ],
                            showInLegend: true
                        }
                    },
                    series: [{
                        name: 'Registrations',
                        colorByPoint: true,
                        innerSize: '75%',
                        data: data
                    }],
                    exporting: {
                        enabled: false 
                    }
                });
            }

            document.addEventListener("DOMContentLoaded", function() {
                createChart('graficoEntradaeSaidaEstoque', 'Entrada e Saída Estoque', [{
                        name: 'Entrada',
                        y: 90,
                        color: '#0f4571'
                    },
                    {
                        name: 'Saída',
                        y: 40,
                        color: '#009ddd'
                    }
                ]);

                createChart('graficoClientesCadastrados', 'Clientes Cadastrados', [{
                        name: 'Pessoa Física',
                        y: 254,
                        color: '#0f4571'
                    },
                    {
                        name: 'Pessoa Jurídica',
                        y: 187,
                        color: '#009ddd'
                    }
                ]);

                createChart('graficoStatusOrcamento', 'Status dos Orçamentos', [{
                        name: 'Aprovados',
                        y: 25,
                        color: '#0f4571'
                    },
                    {
                        name: 'Pendentes',
                        y: 40,
                        color: '#386dbd'
                    },
                    {
                        name: 'Não Aprovados',
                        y: 20,
                        color: '#009ddd'
                    },
                    {
                        name: 'Concluídos',
                        y: 25,
                        color: '#05d3f8'
                    }
                ]);
            });
        </script>
    @endsection
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
