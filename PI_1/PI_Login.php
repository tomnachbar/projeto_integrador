<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Login</title>
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

        input[type="text"],
        input[type="password"] {
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
    </style>
</head>
<body>
    <div class="container">
        <a class="voltar" href="Home.php">← Voltar</a>
        <h1>Login</h1>
        <form action="testLogin.php" method="POST">
            <input type="text" name="email" placeholder="E-mail" required>
            <input type="password" name="senha" placeholder="Senha" required>
            <input class="inputSubmit" type="submit" name="submit" value="Enviar">
        </form>
    </div>
</body>
</html>
