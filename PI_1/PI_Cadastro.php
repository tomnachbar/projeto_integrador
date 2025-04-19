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
<a href="Home.php">Voltar</a>
<div class="box">
    <form action="PI_Cadastro.php" method="POST">
        <fieldset>
            <legend><b>Formulário</b></legend><br>
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
            <input type="submit" name="submit" id="submit" value="Cadastrar">
        </fieldset>
    </form>
</div>
</body>
</html>
