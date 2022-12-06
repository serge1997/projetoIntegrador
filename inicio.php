<?php

    include "connex.php";
    session_start();
    if(!$_SESSION['login']){
        header('location:login.php');
    }

    $id_us = $_SESSION['login'];
    $dados_usuario = $connect->prepare(('SELECT * FROM usuario_rs WHERE id_usuario = :dadosus'));
    $dados_usuario ->bindValue(':dadosus', $id_us);
    $dados_usuario ->execute();
    $rowDados_usuario = $dados_usuario ->fetch();

?>

<!DOCTYPE html>
<html lang pt="pt-BR">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Usuario</title>
    <!--font awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!--link bootstrap-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="../htmlphp/css files/user.css"/>
    <style>
        
        .navbar-brand{
            color: #fff;
        }
        .navbar{
            color: #fff;
            background: #4075cb;
        }
        body{
            background: #fff;
        }

    
    </style>
</head>
<body class="inicio-body">
    <nav class="navbar navbar-expand-lg">
        <div class="navbar-brand">
           <span><?=$rowDados_usuario['nome_usuario']." ".$rowDados_usuario['sobre_nome'] ?></span>
            <img src="imagem/logo.png" alt="">
        </div>
        <div class="d-flex search" role="search">
            <form class="d-flex" action="inicio.php" method="post">
                <input class="form-control me-2" name="nomevaga" type="search" placeholder="Pesquisar 'Estágo'" aria-label="Search">
                <button class="btn" name="search" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>
        <div class="user-setting">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="vaga.php">vaga</a>
                </li>
                <li class="nav-item">
                    <?= "<button class='btn' data-bs-toggle='modal' data-bs-target='#exampleModal'>Post</button>"; ?>
                </li>
            </ul>
            <button name="logut" class="btn-toggle"><i class="fa-solid fa-arrow-left"></i></button>
        </div>
        <div class="user-foto d-flex">
            <?= "<a class='nav-link link-out' href='inicio.php?logout'><i class='fa-solid fa-right-from-bracket'></i>sair </a>"; ?>
            <form action="user.php" method="post">
                <input type="hidden" name="extand" value="<?php session_start(); $_SESSION['extand'] = $rowDados_usuario['id_usuario']; ?>">
                <input style="background: transparent; border: none;" class="nav-link" type="submit" value=" Perfil">
            </form>
            <?php //echo "<a class='nav-link' href='user.php?perfil&id=".$rowDados_usuario['id_usuario']."'>Perfil</a>";

                if(isset($_GET['logout'])){
                    session_destroy();
                    header('location:login.php');
                }
     
                
            ?>
            <!--<a class="nav-link" href="user.php">-->
                <!--<img class="user-picture" src="../htmlphp/imagem/serge.webp" alt="foto de perfil usuario"/>
            </a>-->
        
        </div>
    </nav>
    <div class="container">
        <?php
             if(isset($_POST['search'])){
                $vaga = "%".$_POST['nomevaga']."%";
                $pesquivaga = $connect ->prepare("SELECT * FROM vagapublicado WHERE titulo_vaga LIKE :nvaga");
                $pesquivaga ->bindValue(':nvaga', $vaga);
                $pesquivaga ->execute();

                if($pesquivaga ->rowCount()==0){
                    echo "Erro";
                }else{
                    while($row=$pesquivaga ->fetch()){
                        echo $row['titulo_vaga']."</br>";
                    }
                }
            }
           
        ?>
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="inicio.php" method="post" enctype="multipart/form-data">
                        <textarea name="posttext" id="" cols="30" rows="10"></textarea>
                        <input class="form-control" type="file" name="post">
                        <input class="btn" type="submit" name="enviarpost">
                    </form>
                    <?php
                        if(isset($_POST['enviarpost'])){
                            $text = $_POST['posttext'];
                            date_default_timezone_set('America/Sao_Paulo');
                            $hoje = date('Y/m/d H:i:s');
                            $_UP['pasta'] = "arquivoimg/";
                                $_UP['tamanho'] = 1024*1024*2;
                                $_UP['extensao'] = array('jpeg', 'png', 'jpg');
                                $_UP['renomear'] = true;

                                $explode = explode('.', $_FILES['post']['name']);
                                $extansaoArquivo = end($explode);
                                $extensao = strtolower($extansaoArquivo);

                                if(array_search($extensao,$_UP['extensao'])==false){
                                    echo "Não aceito esse tipo de arquivo";
                                    exit();
                                 }

                                //validação tamanho do arquivo
                                if($_UP['tamanho'] <= $_FILES['post']['size']){
                                    echo "Arquivo muito grande";
                                    exit();
                                }

                                //renomear Arquivo
                                if($_UP['renomear'] == true){
                                    $nomeArquivo = MD5(time()).".$extensao";
                                }else{
                                    $nomeArquivo = $_FILES['post']['name'];
                                }

                                //mover o arquivo para a pasta
                                if(move_uploaded_file($_FILES['post']['tmp_name'], $_UP['pasta'].$nomeArquivo)){
                                    $urlpost = $_UP['pasta'].$nomeArquivo;
                                    $gravapost = $connect ->prepare('INSERT INTO post (id_post,id_usuario,url_arquivo,conteudo_post,data_post) VALUES 
                                    (NULL, :idus, :urlarq, :cont, :datap)');
                                    $gravapost ->bindValue(':idus', $rowDados_usuario['id_usuario']);
                                    $gravapost ->bindValue(':urlarq', $urlpost);
                                    $gravapost ->bindValue(':cont', $text);
                                    $gravapost ->bindValue(':datap', $hoje);
                                    $gravapost ->execute();
                                }
                            }
                    ?>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
                $saidapost = $connect ->prepare('SELECT * FROM post P JOIN usuario_rs U ON(P.id_usuario = U.id_usuario)');
                $saidapost ->execute();
            ?>
            <?php if($saidapost ->rowCount()==0){
                echo "Não tem postes";
            }else{
                while($rowpost = $saidapost ->fetch()){ ?>
                    <div class="post-wrapper">
                        <div class="post-header">
                            <img src="<?=$rowpost['url_arquivo']?>" alt="">
                        </div>
                        <div class="post-body">
                            <img src="<?=$rowpost['url_arquivo']?>" alt="">
                        </div>
                        <div class="post-footer">
                            <button type="button"> <i class="fa-regular fa-comment"></i></button>
                            <p><?= "<b>".$rowpost['nome_usuario']."</b> <br/>".$rowpost['conteudo_post'] ?></p>
                        </div>
                    </div>
                    <div class="comment-wrapper">
                        <div class="hr"></div>
                        <form id="formComment" method="post" action="coment.php">
                            <input type="text" name="comment" id="comment" placeholder="Comment...">
                            <input type="hidden" name="idpost" id="idpost" value="<?=$rowpost['id_post']; ?>">
                            <input type="hidden" name="idus" id="idus" value="<?=$rowDados_usuario['id_usuario']; ?>" >
                            <?php //"<a class='btn toggleCom' href='inicio.php?insericoment&idc=".$rowpost['id_post']."'><i class='fa-sharp fa-solid fa-paper-plane'></i></a>"; ?>
                            <button class="btn toggleCom" name="com" type="submit"><i class="fa-sharp fa-solid fa-paper-plane"></i></button>
                        </form>
                    </div>
                    
                <?php }
            }   

                    $getC = $connect ->prepare('SELECT * FROM comentarios C JOIN usuario_rs U ON(C.id_usuario = U.id_usuario)
                    ');
                    $getC -> execute();
                    if($getC ->rowCount() == 0){
                        echo "";
                    }else{
                        while($rowC = $getC ->fetch()){ ?>
                            <div class="saida-comment">
                                <h5 id="nme"><?= $rowC['nome_usuario'] ?></h5>
                                <p id="cmt"><?= $rowC['conteudo_comentario'] ?></p>
                            </div>
                        
                        <?php }
                    }
            
            
            ?>
                <!--<div class="post-wrapper">
                    <div class="post-header">
                        <img src="../htmlphp/imagem/serge.webp" alt="">
                    </div>
                    <div class="post-body">
                        <img src="../htmlphp/imagem/serge.webp" alt="">
                    </div>
                    <div class="post-footer">
                    <button type="button"> <i class="fa-regular fa-comment"></i></button>
                    <p>Meu text descriptivo de meu post</p>
                    </div>
                </div>-->
            <!--<div class="comment-wrapper">
                <div class="hr"></div>
                <form id="formComment">
                    <input type="text" name="comment" id="comment" placeholder="Comment...">
                    <button class="btn toggleCom" type="submit"><i class="fa-sharp fa-solid fa-paper-plane"></i></button>
                </form>
            </div>
            <div class="saida-comment">
                <h5>serge Gogo</h5>
                <p>Paráben para seu novo emprego</p>
            </div>
            <div class="saida-comment">
                <h5>serge Gogo</h5>
                <p>Paráben para seu novo emprego</p>
            </div>-->
        </div>
    </div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../htmlphp/app.js"></script>
</body>
</html>