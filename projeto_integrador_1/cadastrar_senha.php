<?php
require 'config.php';
session_start();

// Verifica se as variáveis de sessão existem
if (!isset($_SESSION['email']) || !isset($_SESSION['tipo_usuario'])) {
    header("Location: recuperar_senha.php");
    exit;
}

$email = $_SESSION['email'];
$tipoUsuario = $_SESSION['tipo_usuario'];
$mensagem = "";
$redirecionarApos = false;

// Define tabela e login conforme tipo de usuário
if ($tipoUsuario === 'morador') {
    $tabela = 'usuarios';
    $paginaLogin = 'login_morador.php';
} elseif ($tipoUsuario === 'prestador') {
    $tabela = 'prestadores';
    $paginaLogin = 'login_fornecedor.php';
} else {
    header("Location: recuperar_senha.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $novaSenha = $_POST['senha'];
    $confirmarSenha = $_POST['confirmar_senha'];

    if ($novaSenha === $confirmarSenha) {

        // Verifica a senha atual no banco de dados
        $sqlBusca = "SELECT senha FROM $tabela WHERE email = ?";
        $stmtBusca = $conn->prepare($sqlBusca);
        $stmtBusca->bind_param("s", $email);
        $stmtBusca->execute();
        $stmtBusca->bind_result($senhaAtual);
        $stmtBusca->fetch();
        $stmtBusca->close();

        // Verifica se a nova senha é igual à anterior
        if ($novaSenha === $senhaAtual) {
            $mensagem = "Senha não pode ser igual à anterior.";
        } else {
            // Atualiza com a nova senha (sem hash, como no seu padrão)
            $sql = "UPDATE $tabela SET senha = ? WHERE email = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ss", $novaSenha, $email);
            $stmt->execute();

            if ($stmt->error) {
                $mensagem = "Erro ao atualizar senha: " . $stmt->error;
            } else {
                unset($_SESSION['email']);
                unset($_SESSION['tipo_usuario']);
                $mensagem = "Senha atualizada com sucesso!";
                $redirecionarApos = true;
                $baseUrl = "http://" . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
                $redirectUrl = rtrim($baseUrl, '/') . '/' . $paginaLogin;
            }

            $stmt->close();
        }
    } else {
        $mensagem = "As senhas não coincidem. Tente novamente.";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <?php if (!empty($mensagem)): ?>
    <script>
        // Este script será executado quando a página carregar
        window.onload = function() {
            alert("<?php echo $mensagem; ?>");
            <?php if ($redirecionarApos): ?>
            // Redireciona após o alerta fechar
            window.location.href = "<?php echo $redirectUrl; ?>";
            <?php endif; ?>
        };
    </script>
    <?php endif; ?>
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
