<?php
require 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $tipo_usuario = $_POST['tipo_usuario'];
    $email = $_POST['email'];
    $ultimos_4_digitos_telefone = $_POST['ultimos_4_digitos_telefone'];

    if ($tipo_usuario === "morador") {
        $data_nascimento = $_POST['data_nascimento'];
        $sql = "SELECT * FROM usuarios WHERE email = ? AND data_nascimento = ? AND SUBSTRING(telefone, -4) = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $email, $data_nascimento, $ultimos_4_digitos_telefone);
    } elseif ($tipo_usuario === "prestador") {
        $sql = "SELECT * FROM prestadores WHERE email = ? AND SUBSTRING(telefone, -4) = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $email, $ultimos_4_digitos_telefone);
    } else {
        echo "<script>alert('Tipo de usuário inválido.');</script>";
        exit;
    }

    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $_SESSION['email'] = $email;
        $_SESSION['tipo_usuario'] = $tipo_usuario;
        header("Location: cadastrar_senha.php");
        exit;
    } else {
        echo "<script>alert('Informações incorretas. Tente novamente.');</script>";
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Senha</title>
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

        h1 {
            background-color: #d1e3f3;
            color: #2c3e50;
            padding: 10px;
            border-radius: 10px;
            font-size: 24px;
            margin-bottom: 30px;
        }

        select,
        input[type="email"],
        input[type="date"],
        input[type="text"] {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #bdd3e7;
            border-radius: 8px;
            font-size: 16px;
            background-color: #ffffff;
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
            margin-bottom: 15px;
            color: #2c3e50;
            text-decoration: none;
            font-size: 14px;
        }

        .voltar:hover {
            text-decoration: underline;
        }

        #data_nascimento {
            display: block;
        }
    </style>

    <script>
        function toggleDataNascimento() {
            const tipoUsuario = document.querySelector('select[name="tipo_usuario"]').value;
            const dataNascimentoInput = document.getElementById('data_nascimento');
            if (tipoUsuario === 'morador') {
                dataNascimentoInput.style.display = 'block';
                dataNascimentoInput.required = true;
            } else {
                dataNascimentoInput.style.display = 'none';
                dataNascimentoInput.required = false;
            }
        }
    </script>
</head>
<body>
    <div class="container">
        <a class="voltar" href="home.php">← Voltar ao Inicio</a>
        <h1>Recuperar Senha</h1>
        <form method="post" action="">
            <select name="tipo_usuario" required onchange="toggleDataNascimento()">
                <option value="" disabled selected>Selecione o tipo de usuário</option>
                <option value="morador">Morador</option>
                <option value="prestador">Fornecedor</option>
            </select>
            <input type="email" name="email" placeholder="Digite seu e-mail" required>
            <input type="date" name="data_nascimento" id="data_nascimento" placeholder="Data de nascimento">
            <input type="text" name="ultimos_4_digitos_telefone" placeholder="Últimos 4 dígitos do telefone" required pattern="[0-9]{4}" title="Informe os 4 últimos dígitos do telefone">
            <input class="inputSubmit" type="submit" value="Verificar Informações">
        </form>
    </div>
</body>
</html>
