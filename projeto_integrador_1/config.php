<?php
// Defina as variáveis para a conexão
$servername = "localhost";  // Servidor do banco de dados (normalmente localhost)
$username = "root";         // Nome de usuário do banco de dados
$password = "";             // Senha do banco de dados
$dbname = "servicosdb";  // Nome do banco de dados

// Cria a conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se a conexão foi bem-sucedida
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}
?>