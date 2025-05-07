<?php
session_start();
include('config.php');

// Verifica se o usuário está logado
if (!isset($_SESSION['id']) || $_SESSION['tipo'] !== 'usuarios') {
    header("Location: login.php");
    exit();
}

$id = $_SESSION['id'];

// Se o formulário for enviado
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $telefone = $_POST['telefone'];
    $data_nascimento = $_POST['data_nascimento'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $endereco = $_POST['endereco'];

    // Atualiza os dados do usuário
    $stmt = $conn->prepare("UPDATE usuarios SET nome_completo = ?, email = ?, senha = ?, telefone = ?, data_nascimento = ?, cidade = ?, estado = ?, endereco = ? WHERE id = ?");
    $stmt->bind_param("ssssssssi", $nome, $email, $senha, $telefone, $data_nascimento, $cidade, $estado, $endereco, $id);

    if ($stmt->execute()) {
        $mensagem = "Cadastro atualizado com sucesso!";
    } else {
        $mensagem = "Erro ao atualizar: " . $stmt->error;
    }
}

// Consulta para pegar os dados atualizados do usuário
$stmt = $conn->prepare("SELECT * FROM usuarios WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    $usuario = $resultado->fetch_assoc();
} else {
    echo "Usuário não encontrado.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Atualizar Cadastro</title>
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
            text-align: center;
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
    <h1>Bem-vindo, <?= htmlspecialchars($usuario['nome_completo']); ?>!</h1>
    <p>Seu e-mail é: <?= htmlspecialchars($usuario['email']); ?></p>

    <?php if (isset($mensagem)) { echo "<p class='mensagem'>$mensagem</p>"; } ?>

    <form method="POST">
        <fieldset>
            <legend>Atualizar Cadastro</legend>

            <div class="inputBox">
                <input type="text" name="nome" class="inputUser" value="<?= htmlspecialchars($usuario['nome_completo']) ?>" required>
                <label class="labelinput">Nome</label>
            </div>

            <div class="inputBox">
                <input type="email" name="email" class="inputUser" value="<?= htmlspecialchars($usuario['email']) ?>" required>
                <label class="labelinput">Email</label>
            </div>

            <div class="inputBox">
                <input type="password" name="senha" class="inputUser" value="<?= htmlspecialchars($usuario['senha']) ?>" required>
                <label class="labelinput">Senha de Acesso</label>
            </div>

            <div class="inputBox">
                <input type="text" name="telefone" class="inputUser" value="<?= htmlspecialchars($usuario['telefone']) ?>" required>
                <label class="labelinput">Telefone</label>
            </div>

            <div class="inputBox">
                <input type="text" name="data_nascimento" class="inputUser" value="<?= htmlspecialchars($usuario['data_nascimento']) ?>" required>
                <label class="labelinput">Data de Nascimento</label>
            </div>

            <div class="inputBox">
                <input type="text" name="cidade" class="inputUser" value="<?= htmlspecialchars($usuario['cidade']) ?>" required>
                <label class="labelinput">Cidade</label>
            </div>

            <div class="inputBox">
                <input type="text" name="estado" class="inputUser" value="<?= htmlspecialchars($usuario['estado']) ?>" required>
                <label class="labelinput">Estado</label>
            </div>

            <div class="inputBox">
                <input type="text" name="endereco" class="inputUser" value="<?= htmlspecialchars($usuario['endereco']) ?>" required>
                <label class="labelinput">Endereço</label>
            </div>

            <input type="submit" id="submit" name="submit" value="Atualizar">
        </fieldset>
    </form>
</div>

</body>
</html>
