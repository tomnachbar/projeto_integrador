<?php
if(isset($_POST['submit']))
{
    include_once('config.php'); // Inclui a configuração da conexão

    // Recebe os dados do formulário
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $sexo = $_POST['genero'];
    $datanasc = $_POST['datanasc'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $endereco = $_POST['endereco'];

    // Verifica se todos os campos obrigatórios foram preenchidos
    if (empty($nome) || empty($senha) || empty($email) || empty($telefone) || empty($sexo) || empty($datanasc) || empty($cidade) || empty($estado) || empty($endereco)) {
        die("Erro: Todos os campos são obrigatórios.");
    }

    // Verificar se o e-mail já existe no banco
    $sql_verifica = "SELECT * FROM cadastro WHERE email = ?";
    $stmt_verifica = $conexao->prepare($sql_verifica);
    $stmt_verifica->bind_param("s", $email);
    $stmt_verifica->execute();
    $result = $stmt_verifica->get_result();

    if ($result->num_rows > 0) {
        die("Erro: Este e-mail já está cadastrado.");
    }

    // Se o e-mail não existir, insere no banco
    $sql = "INSERT INTO cadastro (nome, senha, email, telefone, sexo, datanasc, cidade, estado, endereco) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("sssssssss", $nome, $senha, $email, $telefone, $sexo, $datanasc, $cidade, $estado, $endereco);

    if ($stmt->execute()) {
        echo "Cadastro realizado com sucesso!";
    } else {
        echo "Erro ao cadastrar: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-image: linear-gradient(to right, rgb(20, 147, 220), rgb(17, 54, 71));
        }
        .box {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(0, 0, 0, 0.6);
            padding: 15px;
            border-radius: 15px;
            width: 20%;
            color: white;
        }
        fieldset {
            border: 3px solid dodgerblue;
        }
        legend {
            border: 1px solid dodgerblue;
            padding: 10px;
            text-align: center;
            background-color: dodgerblue;
            border-radius: 8px;
        }
        .inputBox {
            position: relative;
        }
        .inputUser {
            background: none;
            border: none;
            border-bottom: 1px solid white;
            outline: none;
            color: white;
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
        }
        .inputUser:focus ~ .labelinput, .inputUser:valid ~ .labelinput {
            top: -20px;
            font-size: 12px;
            color: dodgerblue;
        }
        #data_nascimento {
            border: none;
            padding: 8px;
            border-radius: 10px;
            outline: none;
            font-size: 15px;
        }
        #submit {
            background-image: linear-gradient(to right, rgb(0, 92, 197), rgb(90, 20, 220));
            width: 100%;
            border: none;
            padding: 15px;
            color: white;
            font-size: 15px;
            cursor: pointer;
            border-radius: 10px;
        }
        #submit:hover {
            background-image: linear-gradient(to right, rgb(0, 80, 172), rgb(80, 10, 195));
        }
    </style>
</head>
<body>
<a href="Home.php">Voltar</a>
<div class="box">
    <form action="PI_Cadastro.php" method="POST">
        <fieldset><legend><b>Formulário</b></legend>
            <br>
            <div class="inputBox">
                <input type="text" name="nome" id="nome" class="inputUser" required>
                <Label for="nome" class="labelinput">Nome Completo</Label>
            </div>
            <br>
            <br>
            <div class="inputBox">
                <input type="password" name="senha" id="senha" class="inputUser" required>
                <Label for="senha" class="labelinput">Senha</Label>
            </div>
            <br>
            <br>
            <div class="inputBox">
                <input type="text" name="email" id="email" class="inputUser" required>
                <Label for="email" class="labelinput">E-mail</Label>
            </div>
            <br>
            <br>
            <div class="inputBox">
                <input type="tel" name="telefone" id="telefone" class="inputUser" required>
                <Label for="telefone" class="labelinput">Telefone</Label>
            </div>
            <br>
            <br>
            <p> Sexo:</p>
            <input type="radio" id="feminino" name="genero" value="feminino" required>
            <label for="feminino">Feminino</label>
            <input type="radio" id="masculino" name="genero" value="masculino" required>
            <label for="masculino">Masculino</label>
            <br>
            <br>
            <div class="inputBox">
                <Label for="datanasc"><b>Data de Nascimento:</b> </Label>
                <input type="date" name="datanasc" id="datanasc" required>
            </div>
            <br>
            <br>
            <div class="inputBox">
                <input type="text" name="cidade" id="cidade" class="inputUser" required>
                <Label for="cidade" class="labelinput">Cidade</Label>
            </div>
            <br>
            <br>
            <div class="inputBox">
                <input type="text" name="estado" id="estado" class="inputUser" required>
                <Label for="estado" class="labelinput">Estado</Label>
            </div>
            <br>
            <br>
            <div class="inputBox">
                <input type="text" name="endereco" id="endereco" class="inputUser" required>
                <Label for="endereco" class="labelinput">Endereço</Label>
            </div>
            <br>
            <br>
            <input type="submit" name="submit" id="submit">
        </fieldset>
    </form>
</div>
</body>
</html>
