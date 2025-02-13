<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Resumo do Orçamento</title>
</head>
<body>
    <h2>Resumo do Orçamento</h2>
    <p><strong>Lucro Multiplicador:</strong> {{ $dados['lucro'] }}</p>

    <h3>Materiais Selecionados:</h3>
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
</body>
</html>
