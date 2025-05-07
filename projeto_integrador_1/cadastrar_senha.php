<?php
require 'config.php';
session_start();

// Verifica se as variáveis de sessão existem
if (!isset($_SESSION['email']) || !isset($_SESSION['tipo_usuario'])) {
    echo "Acesso inválido.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $novaSenha = $_POST['senha'];
    $confirmarSenha = $_POST['confirmar_senha'];

    if ($novaSenha === $confirmarSenha) {
        $email = $_SESSION['email'];  // capturado anteriormente
        $tipoUsuario = $_SESSION['tipo_usuario']; // 'morador' ou 'prestador'

        // Atualizar a senha no banco de dados com base no tipo de usuário
        if ($tipoUsuario === 'morador') {
            $sql = "UPDATE usuarios SET senha = ? WHERE email = ?";
        } elseif ($tipoUsuario === 'prestador') {
            $sql = "UPDATE prestadores SET senha = ? WHERE email = ?";
        } else {
            echo "Tipo de usuário inválido.";
            exit;
        }

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $novaSenha, $email);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            // Redirecionar com mensagem de sucesso
            echo "<script>
                    alert('Senha atualizada com sucesso!');
                    window.location.href = 'login.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Senha não pode ser igual a anterior!');
                    window.location.href = 'cadastrar_senha.php';
                  </script>";
        }

        $stmt->close();
        $conn->close();
    } else {
        echo "<script>
                alert('As senhas não coincidem. Tente novamente.');
                window.location.href = 'cadastrar_senha.php';
              </script>";
    }
} 
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Nova Senha</title>
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
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 350px;
            text-align: center;
        }

        h2 {
            background-color: #d1e3f3;
            color: #2c3e50;
            padding: 10px;
            border-radius: 10px;
            font-size: 24px;
            margin-bottom: 30px;
        }

        input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #bdd3e7;
            border-radius: 8px;
            font-size: 16px;
            background-color: #ffffff;
        }

        input[type="submit"] {
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

        input[type="submit"]:hover {
            background-color: #1a252f;
        }

        .voltar {
            display: block;
            margin-bottom: 15px;
            color: #2c3e50;
            text-decoration: none;
            font-size: 14px;
        }

        .voltar:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <a class="voltar" href="recuperar_senha.php">← Voltar</a>
        <h2>Cadastrar Nova Senha</h2>
        <form method="post" action="">
            <input type="password" name="senha" placeholder="Digite sua nova senha" required>
            <input type="password" name="confirmar_senha" placeholder="Confirme sua nova senha" required>
            <input type="submit" value="Cadastrar Nova Senha">
        </form>
    </div>
</body>
</html>


