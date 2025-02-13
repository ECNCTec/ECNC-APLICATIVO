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
                    border: 1px solid rgba(172, 172, 172, 0.322);
                    border-left: 3px solid #5790d6;
                    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1), 0 4px 16px rgba(0, 0, 0, 0.1);
                    padding: 15px 10px;

                    /* Efeito de vidro fosco */
                    background: rgba(255, 255, 255, 0.3);
                    /* Fundo levemente translúcido, mais opaco */
                    backdrop-filter: blur(8px);
                    /* Desfoque no fundo */
                    border-radius: 8px;
                    /* Bordas arredondadas */
                }

                #card h6 {
                    font-size: 16px;
                }
            </style>
            <div id="form-container">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div id="card">
                            <h5>Clientes Cadastrados</h5>
                            <h6>2.390,00</h6>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div id="card">
                            <h5>Peças no Estoque</h5>
                            <h6>2.390,00</h6>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div id="card">
                            <h5>Valor em Estoque</h5>
                            <h6>2.390,00</h6>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <div id="card">
                            <h5>card1</h5>
                            <h6>2.390,00</h6>
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
