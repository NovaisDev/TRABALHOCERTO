<?php
include('conexao.php');


if(isset($_POST['NumMat']) || isset($_POST['senha'])) {

    if(strlen($_POST['NumMat']) == 0) {
        echo "Preencha seu numero de matricula";
    } else if(strlen($_POST['senha']) == 0) {
        echo "Preencha sua senha";
    } else {

        $NumMat = $mysqli->real_escape_string($_POST['NumMat']);
        $senha = $mysqli->real_escape_string($_POST['senha']);

        $sql_code = "SELECT * FROM usuarios WHERE NumMat = '$NumMat' AND senha = '$senha'";
        $sql_query = $mysqli->query($sql_code) or die("Falha na execução do código SQL: " . $mysqli->error);

        $quantidade = $sql_query->num_rows;

        if($quantidade == 1) {
            
            $usuario = $sql_query->fetch_assoc();

            if(!isset($_SESSION)) {
                session_start();
            }

            $_SESSION['id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];

            header("Location: index2.html");

        } else {
            
            echo "Falha ao logar! Login ou senha incorretos";
           
        }


    }
}
?>
<!DOCTYPE html>
<html lang="PT-br">
<head>
    <link rel="stylesheet" href="login.css" class="css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
<div class="logoC"> <img src="logo_site_novo-removebg-preview.png" alt=""></div>

<div class="login-container">
    <h1>Acesse sua conta</h1>
    <form action="" method="POST">
        <p>
            <label>nº matricula</label>
            <input type="text" name="NumMat">
        </p>
        <p>
            <label>Senha</label>
            <input type="password" name="senha">
        </p>
        <p>
        <div class="botao"> <a href="#"><button type="submit">Entrar</button></a> </div>
            
        </p>
    </form>
</div>



    
</body>
</html> 