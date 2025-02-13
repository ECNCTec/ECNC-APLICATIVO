<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Resumo do Orçamento</title>
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

            .button-adicionar {
                background: linear-gradient(to bottom, #3387fb, #4242ff, #3387fb);
                color: #fff;
                height: 27px;
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

            .button-enviar {
                background: linear-gradient(to bottom, #32d758, #218838, #32d758);
                color: #fff;
                height: 27px;
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

            .form-row-wrapper {
                position: relative;
                width: 100%;
            }

            .buttonExcluir {
                position: absolute;
                top: -8px;
                right: 0;
                padding: 5px;
                z-index: 10;
            }

            .buttonExcluir img {
                height: 20px;
            }

            .form-row {
                border: 1px solid rgb(143, 143, 143);
                margin-top: 5px;
                padding: 10px;
            }

            @media (max-width: 768px) {
                .titulo {
                    margin-top: -5px;
                    margin-bottom: -34px;
                    z-index: 0;
                }

                .titulo h6 {
                    font-size: 18px;
                }

                #form {
                    margin: 0px 10px 30px 10px;
                }

                .buttonExcluir img {
                    height: 25px;
                }
            }
        </style>
        <div id="form">
            <div id="form-container">
                <h4>Resumo do Orçamento</h4>
                <p><strong>Lucro Multiplicador:</strong> {{ $dados['lucro'] }}</p>

                <h4>Materiais Selecionados:</h4>
                <ul>
                    @foreach ($dados['material'] as $index => $material)
                        @php
                            // Encontre o produto correspondente pelo ID (supondo que $produtos seja uma coleção de produtos)
                            $produto = $produtosCadastrados->firstWhere('id', $material);
                        @endphp
                        <li>
                            <strong>Material ID:</strong> {{ $material }}<br>
                            <strong>Material:</strong> {{ $produto->descricao ?? 'Produto desconhecido' }}<br>
                            <strong>Comprimento da Arte:</strong> {{ $dados['comprimento_arte'][$index] }}<br>
                            <strong>Largura da Arte:</strong> {{ $dados['largura_arte'][$index] }}<br>
                            <strong>Tempo de Usinagem:</strong> {{ $dados['tempo_usinagem'][$index] }} min<br>
                            <strong>Comprimento do Material:</strong> {{ $dados['comprimento'][$index] }}<br>
                            <strong>Largura do Material:</strong> {{ $dados['largura'][$index] }}<br>
                            <strong>Tipo de Medida:</strong> {{ $dados['tipo_medida'][$index] }}
                        </li>
                        <hr>
                    @endforeach
                </ul>
            </div>
        </div>
    @endsection
</body>

</html>
