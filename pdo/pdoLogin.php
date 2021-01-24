<?php
$user = 'root';
$pass = '';
$pdo = new PDO('mysql:host=localhost;dbname=lojinha', $user, $pass);

try {
    $pdo = new PDO('mysql:host=localhost;dbname=lojinha', $user, $pass, [PDO::MYSQL_ATTR_INIT_COMMAND =>  "SET NAMES 'UTF8'"]);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //Vai mostrar erros caso exista.
}catch (Exception $e) { /*Pegue a exception e coloque na variável $e */
    echo 'Erro ao conectar ao banco de dados';
    echo $e;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    $sql = $pdo->prepare("SELECT * FROM user WHERE user_name = ? and password = ?");
    $sql->execute([$usuario, $senha]);

    if($sql->rowCount() == 1){
        $info = $sql->fetch();
        $_SESSION['login'] = $info;
        header('Location: ../logado.php');
    }else{
        echo '<div class="box_erro_login"><p><i class="fas fa-exclamation-circle"></i> Usuário não encontrado.</p></div>';
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
    </div>
    <div id="login">
        <form action='Mysql.php' method='POST'>
            <input type='text' name='usuario'>
            <input type='password' name='senha' >
            <input type='submit' name='manda' value='Logar'>
        </form>
    </div>
</div>
</body>
</html>