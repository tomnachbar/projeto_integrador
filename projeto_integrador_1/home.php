<?php
require 'config.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Vitrine de Soluções</title>
  <style>
    body {
      font-family: Arial, Helvetica, sans-serif;
      margin: 0;
      padding: 0;
      background-image: url('Fundo.jpg');
      background-position: center;
      background-size: cover;
      background-repeat: no-repeat;
      height: 100vh;
      display: flex;
      flex-direction: column;
      align-items: center;
      position: relative;
      overflow: hidden;
    }

    body::before {
      content: "";
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(255, 255, 255, 0.7);
      z-index: -1;
    }

    .header {
      text-align: center;
      margin-top: 50px;
      color: #000;
      z-index: 1;
    }

    .header h1 {
      font-size: 48px;
      margin-bottom: 0;
    }

    .header h2 {
      font-size: 28px;
      margin-top: 10px;
    }

    .container {
      display: flex;
      justify-content: space-around;
      width: 100%;
      max-width: 1200px;
      margin-top: 50px;
      z-index: 1;
    }

    .box {
      width: 45%;
      max-width: 400px;
      padding: 20px;
      border: 2px solid #000;
      background-color: rgba(255, 255, 255, 0.3);
      text-align: center;
      backdrop-filter: blur(5px);
    }

    .box h3 {
      font-size: 24px;
      margin-bottom: 20px;
    }

    .button {
      display: block;
      width: 80%;
      margin: 20px auto;
      padding: 15px;
      background-color: rgba(211, 211, 211, 0.7);
      border-radius: 50px;
      text-decoration: none;
      color: #000;
      font-weight: bold;
      text-align: center;
      border: none;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      transition: all 0.3s ease;
    }

    .button:hover {
      background-color: rgba(169, 169, 169, 0.9);
      transform: translateY(-2px);
    }

    .footer {
      position: absolute;
      bottom: 20px;
      font-size: 16px;
      color: #000;
      text-align: center;
      width: 100%;
      z-index: 1;
    }
  </style>
</head>

<body>
  <div class="header">
    <h1>Vitrine de Soluções</h1>
    <h2>Produtos e Serviços</h2>
  </div>

  <div class="container">
    <div class="box">
      <h3>CADASTROS</h3>
      <a href="cadastro_morador.php" class="button">Cadastro Morador</a>
      <a href="cadastro_fornecedor.php" class="button">Cadastro Fornecedor</a>
    </div>
    <div class="box">
      <h3>Área de acesso</h3>
      <a href="login_morador.php" class="button">Acesso Morador</a>
      <a href="login_fornecedor.php" class="button">Acesso Fornecedor</a>
    </div>
  </div>

  <div class="footer">
    &copy; 2025 Vitrine de Soluções
  </div>
</body>
</html>
