<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Orçamento</title>
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

            @media (max-width: 768px) {
                #form {
                    margin: 30px 10px 30px 10px;
                }
            }
        </style>
        <div id="form">
            <div id="form-container">
                <form action="">
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label>Material:</label>
                            <input type="text" name="material" class="form-control" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Comprimento:</label>
                            <input type="number" class="form-control comprimentoCalculo" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Largura:</label>
                            <input type="number" class="form-control larguraCalculo" required>
                        </div>
                        <div class="form-group col-md-3">
                            <label>Tempo de Usinagem (min):</label>
                            <input type="number" class="form-control tempoUsinagem" required>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endsection

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
