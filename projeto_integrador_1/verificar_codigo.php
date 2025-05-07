<?php
session_start();

if (!isset($_SESSION['codigo_sms'])) {
    // Volta para o início se tentar acessar diretamente
    header("Location: recuperar_senha.php");
    exit;
}

$mensagem_erro = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $codigo_digitado = $_POST['codigo'];

    if ($codigo_digitado == $_SESSION['codigo_sms']) {
        // Código correto, redireciona para redefinir senha
        header("Location: nova_senha.php");
        exit();
    } else {
        $mensagem_erro = "Código incorreto. Tente novamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificar Código</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-color: #dceaf5; /* Cor de fundo igual ao login.php */
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

        input[type="text"] {
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

        .mensagem-erro {
            text-align: center;
            color: red;
            margin-top: 10px;
            font-size: 14px;
        }

        .voltar {
            display: block;
            margin-top: 20px;
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
        <h2>Digite o Código</h2>
        <form method="post" action="">
            <input type="text" name="codigo" placeholder="Código de 6 dígitos" pattern="[0-9]{6}" required>
            <input type="submit" value="Verificar Código">
        </form>
        <?php if (!empty($mensagem_erro)): ?>
            <div class="mensagem-erro"><?= $mensagem_erro ?></div>
        <?php endif; ?>
        <div class="voltar"><a href="recuperar_senha.php">← Voltar</a></div>
    </div>
</body>
</html>
