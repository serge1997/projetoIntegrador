<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <!--font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Login Form</title>
    <link rel="stylesheet" href="../htmlphp/css files/user.css">
    <style>
        body{
            background: url('../htmlphp/imagem/18.-Login.png') no-repeat;
            background-position-x: -6%;
        }

        #sd{
            color: #ff0000;
            padding: 4px;
        }
    </style>
</head>
<body style="background-color: #fff;">
    <div class="container">
        <div class="row login-content">
            <h2>Conectar-se:</h2>

            <?php
                include "connex.php";

                if(isset($_POST['FazerLogin'])){
                    $mail_us = $_POST['loginMail'];
                    $senha_us = $_POST['loginSenha'];

                    $login = $connect ->prepare('SELECT * FROM usuario_rs WHERE mail_usuario = :mail AND senha_usuario = MD5(:senha)');
                    $login ->bindValue(':mail', $mail_us);
                    $login->bindValue(':senha', $senha_us);
                    $login ->execute();
                    if($login ->rowCount() == 0){
                        echo "<small id='sd'>*email ou senha invalido</small>";
                    }else{
                        session_start();
                        $rowLogin = $login ->fetch();
                        $_SESSION['login'] = $rowLogin['id_usuario'];
                        header('location:inicio.php');
                    }
                }
            ?>
            <p class="consigne"><small>Novo usuário?<span> <a href="../htmlphp/cadastra.php">Criar uma conta</a></span></small></p>
            <form id="loginform" action="login.php" method="post">
                <input class="form-control" type="text" name="loginMail" id="loginMail" placeholder="Email">
                <input class="form-control" type="password" name="loginSenha" id="loginSenha" placeholder="Senha">
                <input type="submit" id="loginSubmit" name="FazerLogin" value="Entrar">
            </form>
        </div>
    </div>
</body>
</html>