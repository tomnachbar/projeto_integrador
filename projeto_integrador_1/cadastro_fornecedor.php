<?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    // Captura os dados do formulário
    $nome_razao_social = isset($_POST['nome']) ? trim($_POST['nome']) : '';
    $email_prestador = isset($_POST['email']) ? trim($_POST['email']) : '';
    $senha_prestador = isset($_POST['senha']) ? trim($_POST['senha']) : '';
    $telefone_prestador = isset($_POST['telefone']) ? trim($_POST['telefone']) : '';
    $tipo_servico = isset($_POST['produto_servico']) ? trim($_POST['produto_servico']) : '';
    $descricao = isset($_POST['descricao']) ? trim($_POST['descricao']) : '';
    $referencias = isset($_POST['referencias']) ? trim($_POST['referencias']) : '';

    $dias_disponiveis = isset($_POST['dias_disponiveis']) ? implode(', ', $_POST['dias_disponiveis']) : '';
    $horarios_disponiveis = isset($_POST['horarios_disponiveis']) ? implode(', ', $_POST['horarios_disponiveis']) : '';

    $disponibilidade = trim($dias_disponiveis . ' | ' . $horarios_disponiveis);

    // Validação
    if (empty($nome_razao_social) || empty($email_prestador) || empty($senha_prestador) || empty($telefone_prestador) || empty($tipo_servico) || empty($descricao)) {
        echo "<script>alert('Todos os campos obrigatórios devem ser preenchidos.'); window.history.back();</script>";
        exit();
    }

    // Inserção no banco de dados
    $stmt = $conn->prepare("INSERT INTO prestadores 
        (nome_razao_social, email, senha, referencias, telefone, tipo_servico, descricao, disponibilidade) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("ssssssss", 
        $nome_razao_social, 
        $email_prestador, 
        $senha_prestador, 
        $referencias, 
        $telefone_prestador, 
        $tipo_servico, 
        $descricao, 
        $disponibilidade
    );

    if ($stmt->execute()) {
        echo "<script>alert('Cadastro realizado com sucesso!'); window.location.href='login_fornecedor.php';</script>";
    } else {
        echo "<script>alert('Erro ao cadastrar: " . $stmt->error . "');</script>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
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
            width: 50%;
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
<a href="Home.php">Voltar</a>
<div class="box">
    <form action="" method="POST">
        <fieldset>
            <legend><b>Formulário</b></legend><br>

            <div class="inputBox">
                <input type="text" name="nome" id="nome" class="inputUser" required>
                <label for="nome" class="labelinput">Nome ou Razão Social</label>
            </div><br><br>

            <div class="inputBox">
                <input type="email" name="email" id="email" class="inputUser" required>
                <label for="email" class="labelinput">Email</label>
            </div><br><br>

            <div class="inputBox">
                <input type="text" name="telefone" id="telefone" class="inputUser" required>
                <label for="telefone" class="labelinput">Telefone</label>
            </div><br><br>

            <div class="inputBox">
                <input type="password" name="senha" id="senha" class="inputUser" required>
                <label for="senha" class="labelinput">Senha de Acesso</label>
            </div><br><br>

<div class="inputBox">
    <select name="produto_servico" id="produto_servico" class="inputUser" required>
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


            <div class="inputBox">
                <textarea name="descricao" id="descricao" class="inputUser" rows="4" required></textarea>
                <label for="descricao" class="labelinput">Descrição do Produto ou Serviço</label>
            </div><br><br>

            <div class="inputBox">
                <label class="labelinput">Disponibilidade (selecione os dias e horários)</label><br><br>
                <div style="display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 10px;">
                    <label><input type="checkbox" name="dias_disponiveis[]" value="Segunda-feira"> Segunda</label>
                    <label><input type="checkbox" name="dias_disponiveis[]" value="Terça-feira"> Terça</label>
                    <label><input type="checkbox" name="dias_disponiveis[]" value="Quarta-feira"> Quarta</label>
                    <label><input type="checkbox" name="dias_disponiveis[]" value="Quinta-feira"> Quinta</label>
                    <label><input type="checkbox" name="dias_disponiveis[]" value="Sexta-feira"> Sexta</label>
                    <label><input type="checkbox" name="dias_disponiveis[]" value="Sábado"> Sábado</label>
                    <label><input type="checkbox" name="dias_disponiveis[]" value="Domingo"> Domingo</label>
                </div><br>
                <div style="display: flex; flex-wrap: wrap; gap: 20px;">
                    <label><input type="checkbox" name="horarios_disponiveis[]" value="08h às 12h"> 08h às 12h</label>
                    <label><input type="checkbox" name="horarios_disponiveis[]" value="13h às 18h"> 13h às 18h</label>
                    <label><input type="checkbox" name="horarios_disponiveis[]" value="18h às 20h"> 18h às 20h</label>
                </div>
            </div><br><br>

            <div class="inputBox">
                <input type="text" name="referencias" id="referencias" class="inputUser">
                <label for="referencias" class="labelinput">Referências ou Portfólio</label>
            </div><br><br>

            <input type="submit" name="submit" id="submit" value="Cadastrar">
        </fieldset>
    </form>
</div>
</body>
</html>

