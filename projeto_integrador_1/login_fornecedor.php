<?php
session_start();
require 'config.php';

// Se já estiver logado, redireciona para sistema.php
if (isset($_SESSION['id']) && isset($_SESSION['tipo']) && isset($_SESSION['email'])) {
    header("Location: sistema.php");
    exit();
}

// Definindo o tipo como 'prestadores' para login de fornecedor
$tipo = 'prestadores';

// Processa o login se o formulário for enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';

    if ($email && $senha) {
        // Consulta para verificar o usuário
        $sql = "SELECT id, email, senha FROM $tipo WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows === 1) {
            $stmt->bind_result($id, $emailBanco, $senhaBanco);
            $stmt->fetch();

            if ($senha === $senhaBanco) {
                // Login válido
                $_SESSION['id'] = $id;
                $_SESSION['email'] = $emailBanco;
                $_SESSION['tipo'] = $tipo;

                header("Location: sistema.php");
                exit();
            } else {
                $erro = "Senha incorreta.";
            }
        } else {
            $erro = "Usuário não encontrado.";
        }

        $stmt->close();
    } else {
        $erro = "Preencha todos os campos corretamente.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Login Fornecedor</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #dceaf5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #f8fbfd;
            padding: 50px 40px;
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 350px;
            text-align: center;
        }

        h1 {
            background-color: #d1e3f3;
            color: #2c3e50;
            padding: 10px;
            border-radius: 10px;
            font-size: 24px;
            margin-bottom: 30px;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #bdd3e7;
            border-radius: 8px;
            font-size: 16px;
            background-color: #ffffff;
            box-sizing: border-box;
        }

        .inputSubmit {
            width: 100%;
            padding: 14px;
            background-color: #2c3e50;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            margin-top: 20px;
        }

        .inputSubmit:hover {
            background-color: #1a252f;
        }

        .voltar {
            display: block;
            margin-top: 15px;
            width: 100%;
            padding: 14px;
            background-color: #2c3e50;
            color: white;
            font-size: 16px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
        }

        .voltar:hover {
            background-color: #1a252f;
        }

        .erro {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Login Fornecedor</h1>
        <?php if (!empty($erro)): ?>
            <div class="erro"><?= htmlspecialchars($erro); ?></div>
        <?php endif; ?>
        <form method="post">
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="senha" placeholder="Senha" required><br>
            <button type="submit" class="inputSubmit">Entrar</button>
        </form>
        <button class="voltar" onclick="window.location.href='home.php'">Voltar</button>
<a href="recuperar_senha.php" style="display: block; margin-top: 15px; color: #2c3e50; text-decoration: underline; font-size: 14px;">
    Esqueci minha senha
</a>
    </div>
</body>

</html>
