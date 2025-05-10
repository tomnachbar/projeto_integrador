<?php
require 'config.php';

// Agrupamento de categorias em divisões
$divisoes = [
    'Manutenção' => [
        'Serviços Elétricos',
        'Serviços Hidráulicos',
        'Pequenos Reparos (Marido de Aluguel)',
        'Técnico de Informática',
        'Conserto de Eletrodomésticos',
        'Encanador',
        'Jardinagem',
        'Limpeza',
        'Serviços de Chaveiro'
    ],
    'Reforma' => [
        'Reforma em Geral',
        'Serviços de Pintura',
        'Montador de Móveis',
        'Gesseiro',
        'Soldador'
    ],
    'Beleza' => [
        'Cabeleireira',
        'Barbearia',
        'Manicure e Pedicure',
        'Massagem e Estética',
        'Costureira / Ajustes de Roupas'
    ],
    'Alimentação' => [
        'Doces e Bolos',
        'Marmitas / Comida Caseira',
        'Produtos Naturais / Fitoterápicos'
    ],
    'Administrativo' => [
        'Aulas Particulares (reforço escolar, idiomas)',
        'Personal Trainer',
        'Passeador de Cães / Pet Sitter',
        'Fotografia e Filmagem',
        'Transporte / Frete / Carretos',
        'Cuidador de Idosos',
        'Babá / Cuidadora Infantil',
        'Artesanato / Produtos Artesanais',
        'Bijuterias / Acessórios'
    ]
];

// Lista completa de categorias
$todas_categorias = [];
foreach ($divisoes as $categorias) {
    $todas_categorias = array_merge($todas_categorias, $categorias);
}

// Consulta SQL com média das avaliações
$queryPrestadores = "
SELECT 
    p.nome_razao_social AS nome_prestador,
    p.email,
    p.telefone,
    p.tipo_servico AS categoria, 
    ps.nome_produto_servico AS subcategoria,
    ps.valor,
    AVG(a.nota) AS media_avaliacao
FROM prestadores p
JOIN produto_servico ps ON p.tipo_servico = ps.tipo_servico
LEFT JOIN avaliacoes a ON a.prestador_id = p.id
GROUP BY p.id, ps.id;
";

$resultadoPrestadores = mysqli_query($conn, $queryPrestadores);
$produtos = [];

while ($linha = mysqli_fetch_assoc($resultadoPrestadores)) {
    $produtos[] = [
        'nome' => $linha['nome_prestador'],
        'email' => $linha['email'],
        'telefone' => $linha['telefone'],
        'categoria' => $linha['categoria'],
        'subcategoria' => $linha['subcategoria'],
        'valor' => $linha['valor'],
        'avaliacao' => number_format($linha['media_avaliacao'], 1)
    ];
}

// Obtém subcategorias únicas do resultado da consulta
$subcategorias = array_unique(array_column($produtos, 'subcategoria'));
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Vitrine de Soluções</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { 
            background-color: #dceaf5; 
        }
        .produto-card {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
            padding: 15px;
            margin-bottom: 20px;
        }
        .tag {
            font-size: 12px;
            background: #2c3e50;
            color: white;
            border-radius: 8px;
            padding: 3px 7px;
        }
        .divisao-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
            padding: 20px;
            margin-bottom: 20px;
            text-align: center;
        }
        .filtros-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
            padding: 20px;
            margin-bottom: 20px;
        }
        .btn-ver-prestadores {
            background-color: #fff;
            color: #2c3e50;
            border: 1px solid #2c3e50;
            border-radius: 5px;
            padding: 8px 15px;
            transition: all 0.3s;
        }
        .btn-ver-prestadores:hover {
            background-color: #2c3e50;
            color: #fff;
        }
        .btn-aplicar {
            background-color: #2c3e50;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px;
            width: 100%;
            margin-bottom: 10px;
        }
        .btn-limpar {
            background-color: #6c757d;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px;
            width: 100%;
        }
        .search-container {
            margin-bottom: 30px;
        }
        .search-box {
            border-radius: 5px;
            padding: 10px;
            border: 1px solid #ced4da;
        }
        .btn-buscar {
            background-color: #2c3e50;
            color: #fff;
        }
        .results-container {
            background-color: #e8f4ff;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
        }
        .btn-voltar {
            background-color: #2c3e50;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 8px 15px;
            margin-bottom: 20px;
            text-decoration: none;
            display: inline-block;
        }
        .btn-voltar:hover {
            background-color: #1a252f;
            color: #fff;
        }
        .btn-secondary {
            background-color: #6c757d;
            color: #fff;
        }
    </style>
</head>
<body>
<div class="container my-4">
    <!-- Botão Voltar para sistema.php -->
    <div class="row">
        <div class="col-12">
            <a href="sistema.php" class="btn-voltar">← Voltar</a>
        </div>
    </div>

    <h1 class="text-center mb-4">Vitrine de Soluções</h1>

    <!-- Barra de busca -->
    <div class="row search-container">
        <div class="col-md-10">
            <input type="text" class="form-control search-box" placeholder="Buscar por fornecedor, serviço ou produto..." id="buscaInput" oninput="filtrarEmTempoReal()">
        </div>
        <div class="col-md-2">
            <button class="btn btn-buscar w-100" onclick="filtrar()">Buscar</button>
        </div>
    </div>

    <div class="row">
        <!-- Filtros -->
        <div class="col-md-3">
            <div class="filtros-card">
                <h4 class="mb-4">Filtros</h4>
                
                <div class="mb-3">
                    <label for="filtroCategoria" class="form-label fw-bold">Categoria:</label>
                    <select id="filtroCategoria" class="form-select" onchange="filtrarEmTempoReal()">
                        <option value="">Todas</option>
                        <?php foreach ($todas_categorias as $cat): ?>
                            <option value="<?= $cat ?>"><?= $cat ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="filtroSubcategoria" class="form-label fw-bold">Tipo:</label>
                    <select id="filtroSubcategoria" class="form-select" onchange="filtrarEmTempoReal()">
                        <option value="">Todos</option>
                        <?php foreach ($subcategorias as $sub): ?>
                            <option value="<?= $sub ?>"><?= $sub ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="mb-4">
                    <label for="ordenarSelect" class="form-label fw-bold">Ordenar por:</label>
                    <select id="ordenarSelect" class="form-select" onchange="filtrarEmTempoReal()">
                        <option value="">Sem ordenação</option>
                        <option value="avaliacao">Melhor avaliação</option>
                        <option value="valor-asc">Menor valor</option>
                        <option value="valor-desc">Maior valor</option>
                    </select>
                </div>
                
                <button class="btn btn-aplicar" onclick="filtrar()">Aplicar Filtros</button>
                <button class="btn btn-limpar" onclick="limparFiltros()">Limpar Filtros</button>
            </div>
        </div>
        
        <!-- Conteúdo principal -->
        <div class="col-md-9">
            <!-- Divisões de categorias em cards -->
            <div id="divisoesView" class="row">
                <?php foreach ($divisoes as $nome_divisao => $categorias): ?>
                <div class="col-md-6 mb-4">
                    <div class="divisao-card">
                        <h3 class="mb-4"><?= $nome_divisao ?></h3>
                        <button class="btn btn-ver-prestadores" onclick="filtrarPorDivisao('<?= $nome_divisao ?>')">Ver Prestadores</button>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>

            <!-- Container de resultados de busca/filtro (inicialmente oculto) -->
            <div id="resultadosView" class="row" style="display: none;">
                <div class="mb-3">
                    <button class="btn btn-secondary" onclick="voltarParaDivisoes()">← Voltar para categorias</button>
                    <h4 class="mt-3">Resultados da pesquisa</h4>
                </div>
                <div id="produtosContainer" class="row">
                    <!-- Produtos filtrados aparecerão aqui -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Container oculto com todos os produtos -->
<div class="d-none" id="todosProdutos">
    <?php foreach ($produtos as $p): ?>
        <div class="col-md-6 produto" 
             data-categoria="<?= $p['categoria'] ?>" 
             data-subcategoria="<?= $p['subcategoria'] ?>"
             data-nome="<?= $p['nome'] ?>"
             data-valor="<?= $p['valor'] ?>"
             data-avaliacao="<?= $p['avaliacao'] ?>">
            <div class="produto-card">
                <span class="tag"><?= htmlspecialchars($p['categoria']) ?></span>
                <h5 class="mt-2"><?= htmlspecialchars($p['nome']) ?></h5>
                <p><strong>Serviço:</strong> <?= htmlspecialchars($p['subcategoria']) ?></p>
                <p><strong>Valor:</strong> <?= $p['valor'] ? 'R$ ' . number_format($p['valor'], 2, ',', '.') : 'A consultar' ?></p>
                <p><strong>Avaliação:</strong> <?= $p['avaliacao'] ?>/5</p>
                <p><strong>Telefone:</strong> <?= htmlspecialchars($p['telefone']) ?></p>
                <p><strong>Email:</strong> <?= htmlspecialchars($p['email']) ?></p>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<script>
// Mapeamento de divisões para categorias
const divisoesParaCategorias = {
    'Manutenção': <?= json_encode($divisoes['Manutenção']) ?>,
    'Reforma': <?= json_encode($divisoes['Reforma']) ?>,
    'Beleza': <?= json_encode($divisoes['Beleza']) ?>,
    'Alimentação': <?= json_encode($divisoes['Alimentação']) ?>,
    'Administrativo': <?= json_encode($divisoes['Administrativo']) ?>
};

// Variável para controlar o timeout da busca em tempo real
let timeoutBusca = null;

// Função para busca em tempo real com pequeno delay
function filtrarEmTempoReal() {
    // Limpa o timeout anterior se existir
    if (timeoutBusca) {
        clearTimeout(timeoutBusca);
    }
    
    // Define um novo timeout para evitar muitas buscas enquanto o usuário digita
    timeoutBusca = setTimeout(() => {
        const busca = document.getElementById('buscaInput').value;
        
        // Se o campo de busca estiver vazio e nenhum filtro estiver aplicado, volta para divisões
        if (!busca && 
            document.getElementById('filtroCategoria').value === '' && 
            document.getElementById('filtroSubcategoria').value === '' &&
            document.getElementById('ordenarSelect').value === '') {
            voltarParaDivisoes();
            return;
        }
        
        // Se houver algo para buscar, executa a filtragem
        filtrar();
    }, 300); // Delay de 300ms
}

function filtrarPorDivisao(divisao) {
    // Limpa os filtros atuais
    document.getElementById('buscaInput').value = '';
    document.getElementById('filtroSubcategoria').value = '';
    document.getElementById('ordenarSelect').value = '';
    
    // Atualiza o select de categoria com a primeira categoria da divisão
    const categoriasNaDivisao = divisoesParaCategorias[divisao];
    if (categoriasNaDivisao && categoriasNaDivisao.length > 0) {
        document.getElementById('filtroCategoria').value = '';
    }
    
    // Mostra a vista de resultados e oculta a vista de divisões
    document.getElementById('divisoesView').style.display = 'none';
    document.getElementById('resultadosView').style.display = 'block';
    
    // Filtra os produtos pela divisão
    filtrarProdutosPorDivisao(divisao);
}

function filtrarProdutosPorDivisao(divisao) {
    const categoriasNaDivisao = divisoesParaCategorias[divisao];
    const cards = Array.from(document.querySelectorAll('#todosProdutos .produto'));
    
    let filtrados = cards.filter(card => {
        const categoria = card.dataset.categoria;
        return categoriasNaDivisao.includes(categoria);
    });
    
    exibirResultados(filtrados);
}

function voltarParaDivisoes() {
    // Mostra a vista de divisões e oculta a vista de resultados
    document.getElementById('divisoesView').style.display = 'flex';
    document.getElementById('resultadosView').style.display = 'none';
    
    // Limpa os filtros
    limparFiltros();
}

function filtrar() {
    const busca = document.getElementById('buscaInput').value.toLowerCase();
    const categoria = document.getElementById('filtroCategoria').value;
    const subcategoria = document.getElementById('filtroSubcategoria').value;
    const ordenar = document.getElementById('ordenarSelect').value;
    
    // Obtém todos os cards de produto
    const cards = Array.from(document.querySelectorAll('#todosProdutos .produto'));
    
    // Verifica se algum filtro foi aplicado
    const filtroAplicado = busca !== '' || categoria !== '' || subcategoria !== '';
    
    // Se nenhum filtro foi aplicado, retorna para a visualização de divisões
    if (!filtroAplicado && ordenar === '') {
        voltarParaDivisoes();
        return;
    }

    let filtrados = cards.filter(card => {
        const nome = card.dataset.nome.toLowerCase();
        const cat = card.dataset.categoria;
        const sub = card.dataset.subcategoria.toLowerCase();
        
        return (
            (!busca || nome.includes(busca) || cat.toLowerCase().includes(busca) || sub.includes(busca)) &&
            (!categoria || cat === categoria) &&
            (!subcategoria || sub === subcategoria)
        );
    });

    // Ordenação
    if (ordenar === 'avaliacao') {
        filtrados.sort((a, b) => parseFloat(b.dataset.avaliacao) - parseFloat(a.dataset.avaliacao));
    } else if (ordenar === 'valor-asc') {
        filtrados.sort((a, b) => parseFloat(a.dataset.valor || 0) - parseFloat(b.dataset.valor || 0));
    } else if (ordenar === 'valor-desc') {
        filtrados.sort((a, b) => parseFloat(b.dataset.valor || 0) - parseFloat(a.dataset.valor || 0));
    }

    // Mostra a vista de resultados e oculta a vista de divisões
    document.getElementById('divisoesView').style.display = 'none';
    document.getElementById('resultadosView').style.display = 'block';
    
    exibirResultados(filtrados);
}

function exibirResultados(filtrados) {
    const container = document.getElementById('produtosContainer');
    container.innerHTML = '';
    
    if (filtrados.length > 0) {
        filtrados.forEach(card => {
            // Clona o card para não removê-lo do container original
            container.appendChild(card.cloneNode(true));
        });
    } else {
        container.innerHTML = '<div class="col-12"><div class="alert alert-warning text-center">Nenhum resultado encontrado.</div></div>';
    }
}

function limparFiltros() {
    // Limpa os filtros
    document.getElementById('buscaInput').value = '';
    document.getElementById('filtroCategoria').value = '';
    document.getElementById('filtroSubcategoria').value = '';
    document.getElementById('ordenarSelect').value = '';
    
    // Se estivermos na visão de resultados, volta para divisões
    if (document.getElementById('resultadosView').style.display !== 'none') {
        voltarParaDivisoes();
    }
}

// Adiciona eventos de tecla para a busca
document.getElementById('buscaInput').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        filtrar();
    }
});
</script>
</body>
</html>
