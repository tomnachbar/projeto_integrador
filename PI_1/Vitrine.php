<?php
// Simulação de produtos/serviços
$produtos = [
    [
        'icone' => '⚙️',
        'fornecedor' => 'Fornecedor A',
        'descricao' => 'Manutenção de Equipamentos',
        'valor' => '150,00',
        'avaliacao' => '9/10'
    ],
    [
        'icone' => '🖌️',
        'fornecedor' => 'Fornecedor B',
        'descricao' => 'Pintura Residencial',
        'valor' => 'Orçamento',
        'avaliacao' => '8/10'
    ],
    [
        'icone' => '📝',
        'fornecedor' => 'Fornecedor C',
        'descricao' => 'Serviços Administrativos',
        'valor' => 'Orçamento',
        'avaliacao' => '10/10'
    ],
    [
        'icone' => '🛠️',
        'fornecedor' => 'Fornecedor D',
        'descricao' => 'Serviços Elétricos',
        'valor' => 'Orçamento',
        'avaliacao' => '9/10'
    ],
    [
        'icone' => '🧁',
        'fornecedor' => 'Fornecedor E',
        'descricao' => 'Bolos e Doces',
        'valor' => ' A partir de 50,00',
        'avaliacao' => '9/10'
    ],
    [
        'icone' => '✂️',
        'fornecedor' => 'Fornecedor F',
        'descricao' => 'Cortes de Cabelo',
        'valor' => 'A partir de 50,00',
        'avaliacao' => '9/10'
    ]
];
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vitrine de Soluções - Portal do Lago</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #dceaf5;
            background-size: cover;
            font-family: Arial, Helvetica, sans-serif;
            color: #333;
        }
        h1, h2 {
            text-align: center;
            font-weight: bold;
            margin-top: 20px;
        }
        u {
            text-decoration: underline;
        }
        .filtro {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            margin: 20px;
        }
        .filtro h4 {
            margin-bottom: 15px;
            font-weight: bold;
        }
        .filtro button {
            margin: 5px 0;
            background-color: #2c3e50; /* Azul escuro */
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 10px;
            font-weight: bold;
            width: 200px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .filtro button:hover {
            background-color: #1a252f;
        }
        .vitrine {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            margin: 20px;
            gap: 20px 20px; /* espaço entre as boxes */
        }
        .produto {
            width: 180px;
            height: 220px;
            background-color: #f8f9fa;
            border-radius: 15px;
            padding: 10px;
            margin: 10px;
            text-align: center;
            box-shadow: 0 0 8px rgba(0,0,0,0.2);
            font-size: 13px; /* Fonte menor */
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
        }
        .produto-icone {
            font-size: 30px;
            margin-bottom: 8px;
        }
    </style>
</head>
<body>

    <h1>VITRINE DE SOLUÇÕES - RESIDENCIAL PORTAL DO LAGO</h1>
    <h2>CATÁLOGO DE SERVIÇOS E PRODUTOS</h2>

    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <div class="filtro">
                    <h4>ORDENAR POR:</h4>
                    <button>TIPO DE SERVIÇO</button>
                    <button>TIPO DE PRODUTO</button>
                    <button>VALOR</button>
                    <button>AVALIAÇÃO</button>
                </div>
            </div>

            <div class="col-md-9">
                <div class="vitrine">
                    <?php foreach($produtos as $produto): ?>
                        <div class="produto">
                            <div class="produto-icone"><?= $produto['icone']; ?></div>
                            <p><strong>Fornecedor:</strong> <?= $produto['fornecedor']; ?></p>
                            <p><strong>Descrição:</strong> <?= $produto['descricao']; ?></p>
                            <p><strong>Valor:</strong> R$ <?= $produto['valor']; ?></p>
                            <p><strong>Avaliação:</strong> <?= $produto['avaliacao']; ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
