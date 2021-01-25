<?php
session_start();

$servername = "localhost";
$database = "lojinha";
$username = "root";
$password = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    mysql_connect($servername, $username, $password);
    mysql_select_db($database);
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];
    $query = "select user_name, password from user where user_name = '$usuario' and password = '$senha' ";

    $_SESSION['query'] = $query;
    $result = mysql_query($query);
    $rows = mysql_fetch_assoc($result);
    if ($rows) {
        $_SESSION['login'] = $rows;
        header('Location: ../logado.php');
    } else {
        echo "Login ou senha errado";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="./../css/style.css">
    <title>Mysql Injection</title>
</head>
<body>
<div id="class">
    <div id="greenCube">
        <h1>Mysql Injection</h1>
        <p> O mysql injection tem como base fazer a injeção de um comando sql ou mais utilizando de um campo de texto que não tem tratamento.</p>
        <p>Nessa tela de login, não se tem tratamento algum de Mysql, possibilitando que o invasor faça comandos sql para acessar informações que podem ser sensiveis</p>
        <h2>Comando que podem ser rodados</h2>
        <p><b>Comando para testar se é possivel fazer o teste de sql injection</b>: a' OR 'x'='x'#;</p>
        <p><b>Comando para  trazer os logins do sistema do banco de dados</b>: a' UNION ALL SELECT system_user(),user();#</p>
    </div>
    <div id="login">
        <h1>Login feito sem tratamento possibilitando injection</h1>
        <form action='Mysql.php' method='POST'>
            <input type='text' name='usuario'>
            <input type='password' name='senha' >
            <input type='submit' name='manda' value='Logar'>
        </form>
    </div>
</div>
</body>
</html>