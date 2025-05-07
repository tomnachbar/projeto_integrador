<?php
session_start();
// Limpar as variáveis de sessão
session_unset();
// Destruir a sessão
session_destroy();
// Redirecionar para a página de login
header("Location: home.php");
exit();