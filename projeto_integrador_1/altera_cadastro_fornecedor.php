<?php
include('config.php');
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['id']) || $_SESSION['tipo'] !== 'prestadores') {
    header("Location: login.php");
    exit();
}

$id = $_SESSION['id'];

// Buscar dados do usuário para exibir no cabeçalho
$usuario = $conn->query("SELECT nome_razao_social, email FROM prestadores WHERE id = $id")->fetch_assoc();

// Atualizar dados se o formulário for enviado
$mensagem = "";
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
    $nome_razao_social = trim($_POST['nome_razao_social']);
    $tipo_servico = trim($_POST['tipo_servico']);
    $descricao = trim($_POST['descricao']);
    $telefone = trim($_POST['telefone']);
    $email = trim($_POST['email']);
    $disponibilidade = trim($_POST['disponibilidade']);
    $referencias = trim($_POST['referencias']);
    $senha = trim($_POST['senha']);

    $stmt = $conn->prepare("UPDATE prestadores SET nome_razao_social=?, tipo_servico=?, descricao=?, telefone=?, email=?, disponibilidade=?, referencias=?, senha=? WHERE id=?");
    $stmt->bind_param("ssssssssi", $nome_razao_social, $tipo_servico, $descricao, $telefone, $email, $disponibilidade, $referencias, $senha, $id);

    if ($stmt->execute()) {
        $mensagem = "Cadastro atualizado com sucesso!";
    } else {
        $mensagem = "Erro ao atualizar: " . $stmt->error;
    }
}

// Buscar dados atuais do usuário para o formulário
$dados = $conn->query("SELECT * FROM prestadores WHERE id = $id")->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Atualizar Cadastro</title>
    <style>
body, html {
    height: 100%;
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
    background-color: #ffffffd9;
    padding: 30px;
    border-radius: 15px;
    width: 90%;
    max-width: 600px;
    max-height: 90vh;
    margin: 40px auto;
    overflow-y: auto;
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
    <h1>Bem-vindo, <?= htmlspecialchars($usuario['nome_razao_social']); ?>!</h1>
    <p><strong>Email:</strong> <?= htmlspecialchars($usuario['email']); ?></p>

    <?php if (!empty($mensagem)) : ?>
        <p class="mensagem"><?= $mensagem ?></p>
    <?php endif; ?>

    <form method="POST">
        <fieldset>
            <legend>Atualizar Cadastro</legend>

            <div class="info">
                <p><strong>Nome ou Razão Social:</strong> <?= htmlspecialchars($dados['nome_razao_social']) ?></p>
                <p><strong>Tipo de Serviço:</strong> <?= htmlspecialchars($dados['tipo_servico']) ?></p>
            </div>

            <div class="inputBox">
                <input type="text" name="nome_razao_social" class="inputUser" value="<?= htmlspecialchars($dados['nome_razao_social']) ?>" required>
                <label class="labelinput">Nome ou Razão Social</label>
            </div>

            <div class="inputBox">
                <select name="tipo_servico" class="inputUser" required>
                    <option value="" disabled>Selecione o tipo de serviço</option>
                    <?php
                    $opcoes = [
    // Serviços
    "Serviços Elétricos",
    "Serviços Hidráulicos",
    "Reforma em Geral",
    "Jardinagem",
    "Limpeza",
    "Pequenos Reparos (Marido de Aluguel)",
    "Cabeleireira",
    "Barbearia",
    "Manicure e Pedicure",
    "Massagem e Estética",
    "Aulas Particulares (reforço escolar, idiomas)",
    "Personal Trainer",
    "Passeador de Cães / Pet Sitter",
    "Técnico de Informática",
    "Conserto de Eletrodomésticos",
    "Costureira / Ajustes de Roupas",
    "Serviços de Pintura",
    "Montador de Móveis",
    "Gesseiro",
    "Encanador",
    "Soldador",
    "Fotografia e Filmagem",
    "Transporte / Frete / Carretos",
    "Serviços de Chaveiro",
    "Cuidador de Idosos",
    "Babá / Cuidadora Infantil",

    // Produtos
    "Doces e Bolos",
    "Marmitas / Comida Caseira",
    "Produtos Naturais / Fitoterápicos",
    "Artesanato / Produtos Artesanais",
    "Bijuterias / Acessórios",
    "Cosméticos",
    "Roupas e Calçados",
    "Produtos de Limpeza",
    "Utensílios Domésticos",
    "Plantas e Vasos",
    "Brinquedos Educativos"
];

                    foreach ($opcoes as $opcao) {
                        $selected = ($dados['tipo_servico'] == $opcao) ? 'selected' : '';
                        echo "<option value='$opcao' $selected>$opcao</option>";
                    }
                    ?>
                </select>
                <label class="labelinput">Tipo de Serviço</label>
            </div>

            <div class="inputBox">
                <textarea name="descricao" class="inputUser" rows="4" required><?= htmlspecialchars($dados['descricao']) ?></textarea>
                <label class="labelinput">Descrição do Serviço</label>
            </div>

            <div class="inputBox">
                <input type="text" name="telefone" class="inputUser" value="<?= htmlspecialchars($dados['telefone']) ?>" required>
                <label class="labelinput">Telefone</label>
            </div>

            <div class="inputBox">
                <input type="email" name="email" class="inputUser" value="<?= htmlspecialchars($dados['email']) ?>" required>
                <label class="labelinput">Email</label>
            </div>

            <div class="inputBox">
                <textarea name="disponibilidade" class="inputUser" rows="2" required><?= htmlspecialchars($dados['disponibilidade']) ?></textarea>
                <label class="labelinput">Disponibilidade</label>
            </div>

            <div class="inputBox">
                <input type="text" name="referencias" class="inputUser" value="<?= htmlspecialchars($dados['referencias']) ?>">
                <label class="labelinput">Referências</label>
            </div>

            <div class="inputBox">
                <input type="password" name="senha" class="inputUser" value="<?= htmlspecialchars($dados['senha']) ?>" required>
                <label class="labelinput">Senha</label>
            </div>

            <input type="submit" name="submit" value="Atualizar" id="submit">
        </fieldset>
    </form>
</div>

</body>
</html>
