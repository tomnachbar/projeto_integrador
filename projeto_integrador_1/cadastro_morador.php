<?php
require 'config.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro Morador</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(to bottom, #d0e9f6, #a3cce4);
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
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #ffffffcc;
            padding: 30px;
            border-radius: 20px;
            width: 25%;
            color: #333;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }

        fieldset {
            border: 2px solid #4682B4;
        }

        legend {
            border: 1px solid #4682B4;
            padding: 10px;
            text-align: center;
            background-color: #4682B4;
            border-radius: 8px;
            color: white;
            font-weight: bold;
        }

        .inputBox {
            position: relative;
        }

        .inputUser {
            background: none;
            border: none;
            border-bottom: 1px solid #4682B4;
            outline: none;
            color: #000;
            font-size: 15px;
            width: 100%;
            letter-spacing: 2px;
        }

        .labelinput {
            position: absolute;
            top: 0px;
            left: 0px;
            pointer-events: none;
            transition: .5s;
            color: #666;
        }

        .inputUser:focus ~ .labelinput,
        .inputUser:valid ~ .labelinput {
            top: -20px;
            font-size: 12px;
            color: #0056b3;
        }

        #datanasc {
            border: 1px solid #ccc;
            padding: 8px;
            border-radius: 8px;
            outline: none;
            font-size: 15px;
            width: 100%;
            margin-top: 5px;
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
            transition: background-color 0.3s ease;
        }

        #submit:hover {
            background-color: #004494;
        }
    </style>
</head>
<body>
<a href="home.php">Voltar</a>
<div class="box">
    <form action="" method="POST">
        <fieldset>
            <legend><b>Cadastro Morador</b></legend><br>
            <div class="inputBox">
                <input type="text" name="nome" id="nome" class="inputUser" required>
                <label for="nome" class="labelinput">Nome Completo</label>
            </div><br><br>
            <div class="inputBox">
                <input type="password" name="senha" id="senha" class="inputUser" required>
                <label for="senha" class="labelinput">Senha</label>
            </div><br><br>
            <div class="inputBox">
                <input type="text" name="email" id="email" class="inputUser" required>
                <label for="email" class="labelinput">E-mail</label>
            </div><br><br>
            <div class="inputBox">
                <input type="tel" name="telefone" id="telefone" class="inputUser" required>
                <label for="telefone" class="labelinput">Telefone</label>
            </div><br><br>
            <p>Sexo:</p>
            <input type="radio" id="feminino" name="genero" value="feminino" required>
            <label for="feminino">Feminino</label>
            <input type="radio" id="masculino" name="genero" value="masculino" required>
            <label for="masculino">Masculino</label>
            <br><br>
            <div class="inputBox">
                <label for="datanasc"><b>Data de Nascimento:</b></label>
                <input type="date" name="datanasc" id="datanasc" required>
            </div><br><br>
            <div class="inputBox">
                <input type="text" name="cidade" id="cidade" class="inputUser" required>
                <label for="cidade" class="labelinput">Cidade</label>
            </div><br><br>
            <div class="inputBox">
                <input type="text" name="estado" id="estado" class="inputUser" required>
                <label for="estado" class="labelinput">Estado</label>
            </div><br><br>
            <div class="inputBox">
                <input type="text" name="endereco" id="endereco" class="inputUser" required>
                <label for="endereco" class="labelinput">Endereço</label>
            </div><br><br>
<div class="inputBox">
    <label for="interesse" class="labelinput" style="top:-20px; font-size:12px; color:#0056b3;">Interesse</label>
    <select name="interesse" id="interesse" class="inputUser" required>
        <option value="" disabled selected>Selecione o tipo de serviço ou produto</option>
        <option value="Serviços Elétricos">Serviços Elétricos</option>
        <option value="Serviços Hidráulicos">Serviços Hidráulicos</option>
        <option value="Reforma em Geral">Reforma em Geral</option>
        <option value="Jardinagem">Jardinagem</option>
        <option value="Limpeza">Limpeza</option>
        <option value="Pequenos Reparos (Marido de Aluguel)">Pequenos Reparos (Marido de Aluguel)</option>
        <option value="Cabeleireira">Cabeleireira</option>
        <option value="Barbearia">Barbearia</option>
        <option value="Manicure e Pedicure">Manicure e Pedicure</option>
        <option value="Massagem e Estética">Massagem e Estética</option>
        <option value="Aulas Particulares">Aulas Particulares</option>
        <option value="Personal Trainer">Personal Trainer</option>
        <option value="Passeador de Cães / Pet Sitter">Passeador de Cães / Pet Sitter</option>
        <option value="Técnico de Informática">Técnico de Informática</option>
        <option value="Conserto de Eletrodomésticos">Conserto de Eletrodomésticos</option>
        <option value="Costureira / Ajustes de Roupas">Costureira / Ajustes de Roupas</option>
        <option value="Serviços de Pintura">Serviços de Pintura</option>
        <option value="Montador de Móveis">Montador de Móveis</option>
        <option value="Gesseiro">Gesseiro</option>
        <option value="Encanador">Encanador</option>
        <option value="Soldador">Soldador</option>
        <option value="Fotografia e Filmagem">Fotografia e Filmagem</option>
        <option value="Transporte / Frete / Carretos">Transporte / Frete / Carretos</option>
        <option value="Serviços de Chaveiro">Serviços de Chaveiro</option>
        <option value="Cuidador de Idosos">Cuidador de Idosos</option>
        <option value="Babá / Cuidadora Infantil">Babá / Cuidadora Infantil</option>
        <option value="Doces e Bolos">Doces e Bolos</option>
        <option value="Marmitas / Comida Caseira">Marmitas / Comida Caseira</option>
        <option value="Produtos Naturais / Fitoterápicos">Produtos Naturais / Fitoterápicos</option>
        <option value="Artesanato / Produtos Artesanais">Artesanato / Produtos Artesanais</option>
        <option value="Bijuterias / Acessórios">Bijuterias / Acessórios</option>
        <option value="Cosméticos">Cosméticos</option>
        <option value="Roupas e Calçados">Roupas e Calçados</option>
        <option value="Produtos de Limpeza">Produtos de Limpeza</option>
        <option value="Utensílios Domésticos">Utensílios Domésticos</option>
        <option value="Plantas e Vasos">Plantas e Vasos</option>
        <option value="Brinquedos Educativos">Brinquedos Educativos</option>
    </select>
</div><br><br>

            <input type="submit" name="submit" id="submit" value="Cadastrar">
        </fieldset>
    </form>
</div>
</body>
</html>

<?php
require 'config.php';

if (isset($_POST['submit'])) {
    $nome = trim($_POST['nome']);
    $senha = trim($_POST['senha']);
    $email = trim($_POST['email']);
    $telefone = trim($_POST['telefone']);
    $sexo = trim($_POST['genero']);
    $data_nasc = trim($_POST['datanasc']);
    $cidade = trim($_POST['cidade']);
    $estado = trim($_POST['estado']);
    $endereco = trim($_POST['endereco']);
    $interesse = trim($_POST['interesse']);

    // Validação
    if (empty($nome) || empty($senha) || empty($email) || empty($telefone) || empty($sexo) || empty($data_nasc) || empty($cidade) || empty($estado) || empty($endereco) || empty($interesse)) {
        echo "<script>alert('Todos os campos são obrigatórios.'); window.history.back();</script>";
        exit();
    }

    // Inserção no banco de dados
    $stmt = $conn->prepare("INSERT INTO usuarios (nome_completo, senha, email, telefone, sexo, data_nascimento, cidade, estado, endereco, interesse) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssssss", $nome, $senha, $email, $telefone, $sexo, $data_nasc, $cidade, $estado, $endereco, $interesse);

    if ($stmt->execute()) {
        echo "<script>alert('Cadastro de morador realizado com sucesso!'); window.location.href = 'login_morador.php';</script>";
    } else {
        echo "<script>alert('Erro ao cadastrar: {$stmt->error}');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>
