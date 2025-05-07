<?php
session_start();
require 'config.php';

if (!isset($_SESSION['tipo']) || !isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$id = $_SESSION['id'];
$tipo = $_SESSION['tipo'];
$email = $_SESSION['email'];
$nome = "";

// Pega o nome de acordo com o tipo
if ($tipo === 'usuarios') {
    $sql = "SELECT nome_completo FROM usuarios WHERE id = ?";
} else {
    $sql = "SELECT nome_razao_social FROM prestadores WHERE id = ?";
}

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$stmt->bind_result($nome);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Sistema</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e7f1f8;
            text-align: center;
            padding-top: 50px;
        }

        h1 {
            margin-bottom: 20px;
        }

        .botoes {
            margin-top: 30px;
        }

        .botao {
            display: inline-block;
            margin: 10px;
            padding: 15px 30px;
            font-size: 16px;
            background-color: #2c3e50;
            color: white;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            transition: background-color 0.3s;
        }

        .botao:hover {
            background-color: #1a252f;
        }
    </style>
</head>
<body>
    <h1>Bem-vindo, <?= htmlspecialchars($nome); ?>!</h1>
    <p>Email: <?= htmlspecialchars($email); ?></p>

    <div class="botoes">
        <a class="botao" href="vitrine.php">Vitrine de Produtos e Serviços</a>

        <?php if ($tipo === 'usuarios'): ?>
            <a class="botao" href="alterar_cadastro_morador.php">Alterar Cadastro</a>
            <a class="botao" href="inserir_avaliacao.php">Inserir Avaliação</a>
        <?php else: ?>
            <a class="botao" href="altera_cadastro_fornecedor.php">Alterar Cadastro</a>
            <a class="botao" href="inserir_produto_servico.php">Inserir Produto ou Serviço</a>
        <?php endif; ?>
    </div>

<div style="margin-top: 30px;">
    <a class="botao" href="sair.php" style="background-color: #c0392b;">Sair</a>
</div>

</body>
</html>

