<?php
require 'config.php';
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['id']) || $_SESSION['tipo'] !== 'usuarios') {

    header("Location: login.php");
    exit();
}

$usuario_id = $_SESSION['id'];

// Buscar dados do usuário
$usuario = $conn->query("SELECT nome_completo, email FROM usuarios WHERE id = $usuario_id")->fetch_assoc();

// Buscar lista de prestadores
$prestadores = $conn->query("SELECT id, nome_razao_social FROM prestadores");

// Variável de mensagem
$mensagem = "";

// Processar formulário
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $prestador_id = $_POST['prestador_id'];
    $nota = $_POST['nota'] ?? '';
    $comentario = trim($_POST['comentario']);
    $data_inicio = $_POST['data_inicio'] ?? null;
    $data_fim = $_POST['data_fim'] ?? null;

    if (!empty($prestador_id) && !empty($nota)) {
        $stmt = $conn->prepare("INSERT INTO avaliacoes (usuario_id, prestador_id, data_inicio, data_fim, nota, comentario) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("iissis", $usuario_id, $prestador_id, $data_inicio, $data_fim, $nota, $comentario);

        if ($stmt->execute()) {
            $mensagem = "Avaliação enviada com sucesso!";
        } else {
            $mensagem = "Erro ao salvar avaliação: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $mensagem = "Por favor, preencha os campos obrigatórios.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Inserir Avaliação</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(to bottom, #f3f3f3, #cde1f2);
            margin: 0;
            padding: 0;
        }

        a {
            color: #0056b3;
            text-decoration: none;
            font-weight: bold;
            position: absolute;
            top: 15px;
            left: 20px;
            background-color: #e6f2fb;
            padding: 8px 15px;
            border-radius: 8px;
        }

    .box {
    position: absolute;
    top: 55%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: #ffffffcc;
    padding: 30px;
    border-radius: 20px;
    width: 90%; /* antes 40% */
    max-width: 600px;
    color: #333;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
}
        fieldset {
            border: 2px solid #4682B4;
        }

        legend {
            background-color: #4682B4;
            color: white;
            padding: 10px;
            border-radius: 8px;
            font-weight: bold;
            text-align: center;
        }

        .inputBox, .selectBox, .radioBox, .commentBox, .dateBox {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        select, textarea, input[type="date"] {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }

   .dateBox {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}

.dateBox label,
.dateBox input[type="date"] {
    width: 48%;
}

.radioBox {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 15px;
}

.radioBox label {
    width: 100%;
}

        #submit {
            background-color: #0056b3;
            width: 100%;
            border: none;
            padding: 15px;
            color: white;
            font-size: 15px;
            cursor: pointer;
            border-radius: 10px;
            margin-top: 20px;
        }

        #submit:hover {
            background-color: #004494;
        }

        .mensagem {
            color: green;
            text-align: center;
            margin-top: 15px;
            font-weight: bold;
        }

        .info {
            background: #e6f2fb;
            padding: 15px;
            border-radius: 10px;
            color: #333;
        }
    </style>
</head>
<body>
<a href="sistema.php">Voltar</a>

<div class="box">
    <form action="" method="POST">
        <fieldset>
            <legend><b>Avaliar Prestador</b></legend><br>

            <div class="info">
                <p><strong>Usuário:</strong> <?= htmlspecialchars($usuario['nome_completo']) ?></p>
                <p><strong>Email:</strong> <?= htmlspecialchars($usuario['email']) ?></p>
            </div>

            <div class="selectBox">
                <label for="prestador_id">Selecione o Prestador</label>
                <select name="prestador_id" required>
                    <option value="">-- Escolha --</option>
                    <?php while ($p = $prestadores->fetch_assoc()): ?>
                        <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['nome_razao_social']) ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="dateBox">
                <label for="data_inicio">Data de Início do Serviço</label>
                <input type="date" name="data_inicio" required>

                <label for="data_fim">Data de Término do Serviço</label>
                <input type="date" name="data_fim" required>
            </div>

            <div class="radioBox">
                <label>Nota (1 a 5):</label>
                <?php for ($i = 1; $i <= 5; $i++): ?>
                    <input type="radio" name="nota" value="<?= $i ?>" required> <?= $i ?>
                <?php endfor; ?>
            </div>

            <div class="commentBox">
                <label for="comentario">Comentário:</label>
                <textarea name="comentario" rows="4" placeholder="Deixe aqui seu comentário..."></textarea>
            </div>

            <input type="submit" name="submit" id="submit" value="Enviar Avaliação">
        </fieldset>

        <?php if (!empty($mensagem)): ?>
            <p class="mensagem"><?= $mensagem ?></p>
        <?php endif; ?>
    </form>
</div>
</body>
</html>
