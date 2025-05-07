<?php
require 'config.php';
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['id']) || $_SESSION['tipo'] !== 'prestadores') {
    header("Location: login.php");
    exit();
}

$prestador_id = $_SESSION['id'];

// Buscar dados do prestador logado
$query = $conn->prepare("SELECT nome_razao_social, email, tipo_servico FROM prestadores WHERE id = ?");
$query->bind_param("i", $prestador_id);
$query->execute();
$result = $query->get_result();
$prestador = $result->fetch_assoc();
$query->close();

$mensagem = "";

// Inserção do produto/serviço
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['submit'])) {
    $nome_produto_servico = trim($_POST['produto_servico']);
    $valor = trim($_POST['valor']);
    $tipo_servico = $prestador['tipo_servico'];  // Obtendo o tipo_serviço do prestador

    if (!empty($nome_produto_servico) && !empty($valor)) {
        $stmt = $conn->prepare("INSERT INTO produto_servico (prestador_id, nome_prestador, nome_produto_servico, valor, tipo_servico) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("issss", $prestador_id, $prestador['nome_razao_social'], $nome_produto_servico, $valor, $tipo_servico);

        if ($stmt->execute()) {
            $mensagem = "Produto ou serviço inserido com sucesso!";
        } else {
            $mensagem = "Erro ao inserir: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $mensagem = "Todos os campos são obrigatórios.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Inserir Produto ou Serviço</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to bottom, #e3f2fd, #90caf9);
            margin: 0;
            padding: 0;
        }

        a {
            position: absolute;
            top: 15px;
            left: 20px;
            background-color: #f0f8ff;
            padding: 10px 18px;
            text-decoration: none;
            font-weight: bold;
            border-radius: 8px;
            color: #1976d2;
            box-shadow: 2px 2px 5px rgba(0,0,0,0.1);
        }

        .box {
            position: absolute;
            top: 55%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #ffffffd9;
            padding: 30px;
            border-radius: 15px;
            width: 35%;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }

        fieldset {
            border: 2px solid #1976d2;
            padding: 20px;
        }

        legend {
            background-color: #1976d2;
            color: white;
            padding: 10px;
            border-radius: 8px;
            font-weight: bold;
            text-align: center;
        }

        .inputBox {
            margin-top: 20px;
            position: relative;
        }

        .inputUser {
            width: 100%;
            padding: 8px;
            border: none;
            border-bottom: 2px solid #1976d2;
            background: none;
            font-size: 16px;
            color: #000;
        }

        .labelinput {
            position: absolute;
            top: 0;
            left: 0;
            color: #666;
            pointer-events: none;
            transition: 0.3s ease;
        }

        .inputUser:focus ~ .labelinput,
        .inputUser:valid ~ .labelinput {
            top: -20px;
            font-size: 12px;
            color: #1976d2;
        }

        #submit {
            width: 100%;
            padding: 12px;
            background-color: #1976d2;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            margin-top: 25px;
            cursor: pointer;
        }

        #submit:hover {
            background-color: #155a9c;
        }

        .mensagem {
            text-align: center;
            color: green;
            font-weight: bold;
            margin-top: 15px;
        }

        .info {
            background-color: #f1f8ff;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            color: #333;
        }
    </style>
</head>
<body>

<a href="sistema.php">Voltar</a>

<div class="box">
    <form method="POST">
        <fieldset>
            <legend>Inserir Produto ou Serviço</legend>

            <div class="info">
                <p><strong>Nome:</strong> <?= htmlspecialchars($prestador['nome_razao_social']) ?></p>
                <p><strong>Email:</strong> <?= htmlspecialchars($prestador['email']) ?></p>
                <p><strong>Tipo:</strong> <?= htmlspecialchars($prestador['tipo_servico']) ?></p>
            </div>

            <div class="inputBox">
                <input type="text" name="produto_servico" class="inputUser" required>
                <label class="labelinput">Nome do Produto ou Serviço</label>
            </div>

            <div class="inputBox">
                <input type="text" name="valor" class="inputUser" required>
                <label class="labelinput">Valor (R$)</label>
            </div>

            <input type="submit" name="submit" id="submit" value="Salvar">
        </fieldset>

        <?php if (!empty($mensagem)): ?>
            <p class="mensagem"><?= $mensagem ?></p>
        <?php endif; ?>
    </form>
</div>

</body>
</html>
