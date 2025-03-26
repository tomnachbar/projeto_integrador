<?php
session_start();
    // print_r($_SESSION);
    if((isset($_SESSION['email']) == true) and (!isset ($_SESSION['senha']) == true))
    {
        unset($_SESSION['email'] );
        unset($_SESSION['senha'] );
        header('Location: login.php');
    }
    $logado = $_SESSION['email'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
     body{
                background: linear-gradient(to right, rgb(20,147,220), rgb(17,54,71));
                text-align:center;
                text:white;
            }
    .navbar{
        background: linear-gradient(to right, rgb(28, 60, 78), rgb(98, 110, 116));
        }
    </style>
    <title>Sistema</title>
</head>
<body>
<nav class="navbar">
  <a class="btn btn-danger" href="sair.php">Sair</a>
</nav>
<?php   
    echo "<h1>Bem vindo <u>$logado</u></h1>"
?>
    <h1> Acessou o sistema </h1>
</body>
</html>