<?php
require 'config.php';


$queryPrestadores = "
SELECT 
    p.nome_razao_social AS nome_prestador,
    p.email as email,
    p.telefone as telefone,	
    ps.tipo_servico AS nome_servico,	
    ps.valor,
    AVG(a.nota) AS media_avaliacao
FROM prestadores p
JOIN produto_servico ps ON p.tipo_servico = ps.tipo_servico
LEFT JOIN avaliacoes a ON a.prestador_id = p.id
GROUP BY p.id, ps.id;
";
$resultadoPrestadores = mysqli_query($conn, $queryPrestadores);

// Organizando os dados dos prestadores em um array
$produtos = [];

while ($linha = mysqli_fetch_assoc($resultadoPrestadores)) {
    $produtos[] = [
        'icone' => '⚙️',
        'fornecedor' => $linha['nome_prestador'],  // CORRIGIDO
        'descricao' => $linha['nome_servico'],     // CORRIGIDO
        'valor' => $linha['valor'],
        'avaliacao' => number_format($linha['media_avaliacao'], 1, '.', ''), // CORRIGIDO
        'email' => $linha['email'] ?? '',
	'telefone' => $linha['telefone'] ?? '',
        'categoria' => 'Serviço',
        'subcategoria' => $linha['nome_servico']
    ];
}

$categorias = [
    'Serviços Elétricos',
    'Serviços Hidráulicos',
    'Reforma em Geral',
    'Jardinagem',
    'Limpeza',
    'Pequenos Reparos (Marido de Aluguel)',
    'Cabeleireira',
    'Barbearia',
    'Manicure e Pedicure',
    'Massagem e Estética',
    'Aulas Particulares (reforço escolar, idiomas)',
    'Personal Trainer',
    'Passeador de Cães / Pet Sitter',
    'Técnico de Informática',
    'Conserto de Eletrodomésticos',
    'Costureira / Ajustes de Roupas',
    'Serviços de Pintura',
    'Montador de Móveis',
    'Gesseiro',
    'Encanador',
    'Soldador',
    'Fotografia e Filmagem',
    'Transporte / Frete / Carretos',
    'Serviços de Chaveiro',
    'Cuidador de Idosos',
    'Babá / Cuidadora Infantil',
    'Doces e Bolos',
    'Marmitas / Comida Caseira',
    'Produtos Naturais / Fitoterápicos',
    'Artesanato / Produtos Artesanais',
    'Bijuterias / Acessórios'
];

$subcategorias = array_unique(array_column($produtos, 'subcategoria'));
?>

<!DOCTYPE html>

<html lang="pt-br">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vitrine de Soluções - Portal do Lago</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 0 8px rgba(0,0,0,0.1);
            margin-bottom: 20px;
        }
        .filtro h4 {
            margin-bottom: 15px;
            font-weight: bold;
            border-bottom: 2px solid #2c3e50;
            padding-bottom: 8px;
        }
        .filtro-grupo {
            margin-bottom: 15px;
        }
        .filtro-grupo label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }
        .filtro button {
            background-color: #2c3e50;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%;
            margin-top: 10px;
        }
        .filtro button:hover {
            background-color: #1a252f;
        }
        .barra-pesquisa {
            position: relative;
            margin-bottom: 30px;
        }
        .barra-pesquisa input {
            width: 100%;
            padding: 12px 45px 12px 15px;
            border-radius: 25px;
            border: 2px solid #2c3e50;
            outline: none;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .barra-pesquisa .icone-pesquisa {
            position: absolute;
            right: 15px;
            top: 12px;
            color: #2c3e50;
        }
        .vitrine {
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
            gap: 20px;
        }
   .produto {
    width: 250px; /* Aumentando a largura para acomodar mais texto */
    height: auto; /* Permitindo altura dinâmica */
    background-color: #f8f9fa;
    border-radius: 15px;
    padding: 15px;
    text-align: center;
    box-shadow: 0 0 8px rgba(0, 0, 0, 0.2);
    font-size: 13px;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    transition: transform 0.3s ease;
    overflow: hidden;
}

.produto\:hover {
transform: translateY(-5px);
box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
}

.produto-icone {
font-size: 36px;
margin-bottom: 10px;
}

.produto p {
margin: 5px 0;
text-align: left;
word-wrap: break-word;
overflow-wrap: break-word;
width: 100%;
white-space: normal;
font-size: 12px; /\* Ajustando o tamanho da fonte para caber melhor \*/
}

.tag {
display: inline-block;
background-color: #2c3e50;
color: white;
padding: 2px 8px;
border-radius: 10px;
font-size: 10px;
margin-bottom: 5px;
}

.sem-resultados {
width: 100%;
text-align: center;
padding: 30px;
background-color: #f8f9fa;
border-radius: 15px;
font-weight: bold;
}

/\* Adicionando uma borda fina para as tags de informações como fornecedor, valor, etc. \*/
.produto p strong {
color: #2c3e50;
font-weight: bold;
}
select {
width: 100%;
padding: 8px;
border-radius: 5px;
border: 1px solid #ced4da;
background-color: white;
} </style>

</head>
<body>

<div class="container mt-4 mb-5">
    <h1>VITRINE DE SOLUÇÕES</h1>
    <h2>RESIDENCIAL PORTAL DO LAGO</h2>
    
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="barra-pesquisa">
                <input type="text" id="pesquisa" placeholder="Buscar por fornecedor, serviço ou produto..." onkeyup="filtrarProdutos()">
                <span class="icone-pesquisa"><i class="fas fa-search"></i></span>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="filtro">
                <h4>FILTROS</h4>
                
                <div class="filtro-grupo">
                    <label for="categoria">Categoria:</label>
                    <select id="categoria" onchange="filtrarProdutos()">
                        <option value="">Todas</option>
                        <?php foreach($categorias as $categoria): ?>
                            <option value="<?= $categoria ?>"><?= $categoria ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                
                <div class="filtro-grupo">
                    <label for="subcategoria">Tipo:</label>
                    <select id="subcategoria" onchange="filtrarProdutos()">
                        <option value="">Todos</option>
                        <?php foreach($subcategorias as $subcategoria): ?>
   			 <option value="<?= $subcategoria ?>"><?= $subcategoria ?></option>
			<?php endforeach; ?>
                    </select>
                </div>
                
                <div class="filtro-grupo">
                    <label for="ordenacao">Ordenar por:</label>
                    <select id="ordenacao" onchange="filtrarProdutos()">
                        <option value="">Sem ordenação</option>
                        <option value="avaliacao-desc">Melhor avaliação</option>
                        <option value="valor-asc">Menor valor</option>
                        <option value="valor-desc">Maior valor</option>
                        <option value="fornecedor-asc">Fornecedor (A-Z)</option>
                    </select>
                </div>
                
                <button onclick="limparFiltros()">LIMPAR FILTROS</button>
            </div>
        </div>

        <div class="col-md-9">
            <div id="vitrine" class="vitrine"></div>
        </div>
    </div>
</div>
<div style="text-align: center; margin-top: 20px;">
    <a href="sistema.php" class="botao" style="text-decoration: none; padding: 10px 20px; background-color: #2c3e50; color: white; border-radius: 5px; display: inline-block;">Voltar</a>

</a>

<script>
    
    const produtos = <?php echo json_encode($produtos); ?>;
    
    
    function renderizarProdutos(lista) {
        const vitrine = document.getElementById('vitrine');
        vitrine.innerHTML = '';
        
        if (lista.length === 0) {
            vitrine.innerHTML = '<div class="sem-resultados">Nenhum resultado encontrado</div>';
            return;
        }
        
        lista.forEach(produto => {
            const produtoEl = document.createElement('div');
            produtoEl.className = 'produto';
            produtoEl.innerHTML = `
                <div class="produto-icone">${produto.icone}</div>
                <div class="tag">${produto.categoria} - ${produto.subcategoria}</div>
                <p style="margin: 5px 0; text-align: left;"><strong>Fornecedor:</strong> ${produto.fornecedor}</p>
                <p style="margin: 5px 0; text-align: left; overflow-wrap: break-word;"><strong>Descrição:</strong> ${produto.descricao}</p>
                <p style="margin: 5px 0; text-align: left;"><strong>Valor:</strong> R$ ${produto.valor}</p>
                <p style="margin: 5px 0; text-align: left;"><strong>Avaliação:</strong> ${produto.avaliacao}</p>
	    <p style="margin: 5px 0; text-align: left;"><strong>E-mail:</strong> ${produto.email}</p>
                <p style="margin: 5px 0; text-align: left;"><strong>Telefone:</strong> ${produto.telefone}</p>
            `;
            vitrine.appendChild(produtoEl);
        });
    }
    
    
    function filtrarProdutos() {
        const termo = document.getElementById('pesquisa').value.toLowerCase();
        const categoria = document.getElementById('categoria').value;
        const subcategoria = document.getElementById('subcategoria').value;
        const ordenacao = document.getElementById('ordenacao').value;
        
        let produtosFiltrados = produtos.filter(produto => {
            const matchTermo = 
                produto.fornecedor.toLowerCase().includes(termo) || 
                produto.descricao.toLowerCase().includes(termo) ||
                produto.categoria.toLowerCase().includes(termo) ||
                produto.subcategoria.toLowerCase().includes(termo);
                
            const matchCategoria = categoria === '' || produto.categoria === categoria;
            const matchSubcategoria = subcategoria === '' || produto.subcategoria === subcategoria;
            
            return matchTermo && matchCategoria && matchSubcategoria;
        });
        
        
        if (ordenacao) {
            produtosFiltrados = ordenarProdutos(produtosFiltrados, ordenacao);
        }
        
        renderizarProdutos(produtosFiltrados);
    }
    
    
    function ordenarProdutos(lista, criterio) {
        const listaOrdenada = [...lista];
        
        switch (criterio) {
            case 'avaliacao-desc':
                listaOrdenada.sort((a, b) => {
                    const avalA = parseInt(a.avaliacao.split('/')[0]);
                    const avalB = parseInt(b.avaliacao.split('/')[0]);
                    return avalB - avalA;
                });
                break;
            case 'valor-asc':
                listaOrdenada.sort((a, b) => {
                    const valorA = converterValorParaNumero(a.valor);
                    const valorB = converterValorParaNumero(b.valor);
                    return valorA - valorB;
                });
                break;
            case 'valor-desc':
                listaOrdenada.sort((a, b) => {
                    const valorA = converterValorParaNumero(a.valor);
                    const valorB = converterValorParaNumero(b.valor);
                    return valorB - valorA;
                });
                break;
            case 'fornecedor-asc':
                listaOrdenada.sort((a, b) => a.fornecedor.localeCompare(b.fornecedor));
                break;
        }
        
        return listaOrdenada;
    }
    
    
    function converterValorParaNumero(valor) {
        if (valor === 'Orçamento') return 0;
        if (valor.includes('A partir de')) {
            return parseFloat(valor.replace('A partir de ', '').replace(',', '.'));
        }
        return parseFloat(valor.replace(',', '.'));
    }
    
    
    function limparFiltros() {
        document.getElementById('pesquisa').value = '';
        document.getElementById('categoria').value = '';
        document.getElementById('subcategoria').value = '';
        document.getElementById('ordenacao').value = '';
        filtrarProdutos();
    }
    
    
    document.addEventListener('DOMContentLoaded', function() {
        renderizarProdutos(produtos);
    });

</script>
</body>
</html>


