<?php

    include "connex.php";

    session_start();
    if(!$_SESSION['extand']){
        header('location:login.php');
    }

    $id_perfil = $_SESSION['extand'];
    $usuarioDados = $connect ->prepare('SELECT * FROM usuario_rs WHERE id_usuario = :idusuario');
    $usuarioDados ->bindValue('idusuario', $id_perfil);
    $usuarioDados ->execute();
    $rowUsuarioDados = $usuarioDados ->fetch();
    

    //consulta saida dados usuario editar

    $editarSaida = $connect ->prepare('SELECT * FROM info_adicionais_usuario WHERE id_info_usuario = :pinfo');
    $editarSaida ->bindValue(':pinfo', $id_perfil);
    $editarSaida ->execute();
    $rowSaida = $editarSaida ->fetch();

    //consultas pais
    $saidaPais = $connect ->prepare('SELECT * FROM pais WHERE id_pais = :pais');
    $saidaPais ->bindValue(':pais', $id_perfil);
    $saidaPais ->execute();
    $pais = $saidaPais ->fetch();

    //consulta Estado
    $saidaCidade = $connect ->prepare('SELECT * FROM cidades WHERE id_cidade = :cid');
    $saidaCidade ->bindValue(':cid', $id_perfil);
    $saidaCidade ->execute();
    $cidade = $saidaCidade ->fetch();


    //Pegar a imgem do banco de dados
    $img = $connect ->prepare('SELECT * FROM usuario_img WHERE id_img_usuario = :idimg');
    $img ->bindValue(':idimg', $id_perfil);
    $img ->execute();
    $imgrow = $img ->fetch();
    

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
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="navbar-brand">
            
        </div>
        <div class="d-flex search" role="search">
            <form class="d-flex" action="" method="post">
                <input class="form-control me-2" type="search" placeholder="Pesquisar 'Estágo'" aria-label="Search">
                <button class="btn" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>
        <div class="user-setting">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="inicio.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="vaga.php">vaga</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="">Mensagen</a>
                </li>
            </ul>
            <button class="btn-toggle"><i class="fa-solid fa-arrow-left"></i></button>
        </div>
        <div class="user-foto d-flex">
            <a class="nav-link" href="user.html">
                <img class="user-picture" src="<?= $imgrow['url_arquivo'] ?>" alt="foto de perfil usuario"/>
            </a>
        </div>
    </nav>
    <section class="user">
        <?php echo "<a hidden href='function.php?id=".$rowUsuarioDados['id_usuario']."'>Teste</a>"; ?>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 col-sm-12 user-wrapper">
                    <div class="user-profil-picture">

                        <!--Pegar a imgem do banco de dados-->
                       
                        <img src="<?= $imgrow['url_arquivo'] ?>" alt="user perfil picture"/>
                        <button class="btn"><i class="fa-solid fa-user-pen"></i></button>
                        <form id="editImgForm" action="user.php" method="post" enctype="multipart/form-data">
                            <input type="file" name="userpic"/>
                            <button class="btn" name="imgperfil" type="submit">Confirmar</button>
                        </form>
                        <!--script Trocar de imagem-->
                        <?php
                            if(isset($_POST['imgperfil'])){
                                $_UP['pasta'] = "arquivoimg/";
                                $_UP['tamanho'] = 1024*1024*2;
                                $_UP['extensao'] = array('jpeg', 'png', 'jpg');
                                $_UP['renomear'] = true;

                                $explode = explode('.', $_FILES['userpic']['name']);
                                $extansaoArquivo = end($explode);
                                $extensao = strtolower($extansaoArquivo);

                                if(array_search($extensao,$_UP['extensao'])==false){
                                    echo "Não aceito esse tipo de arquivo";
                                    exit();
                                 }

                                //validação tamanho do arquivo
                                if($_UP['tamanho'] <= $_FILES['userpic']['size']){
                                    echo "Arquivo muito grande";
                                    exit();
                                }

                                //renomear Arquivo
                                if($_UP['renomear'] == true){
                                    $nomeArquivo = MD5(time()).".$extensao";
                                }else{
                                    $nomeArquivo = $_FILES['userpic']['name'];
                                }

                                //mover o arquivo para a pasta
                                if(move_uploaded_file($_FILES['userpic']['tmp_name'], $_UP['pasta'].$nomeArquivo)){
                                    $urlimg = $_UP['pasta'].$nomeArquivo;
                                    $gravaArquivoimg = $connect ->prepare('UPDATE usuario_img SET url_arquivo = :arqimg WHERE id_img_usuario = :idimg');
                                    $gravaArquivoimg ->bindValue(':arqimg', $urlimg);
                                    $gravaArquivoimg ->bindValue(':idimg', $id_perfil);
                                    $gravaArquivoimg ->execute();
                                }
                            }
                        ?>
                    </div>
                    <div class="user-info">
                        <h4><?php echo $rowUsuarioDados['nome_usuario']." ".$rowUsuarioDados['sobre_nome']; ?></h4>
                        <p class="user-function"><?= $rowSaida['titulo_perfil']; ?></p>
                        <p><?= $rowSaida['nome_faculdade'] ?><br/><small class="user-local"><?= $cidade['nome_cidade'] ?>, <?= $pais['nome_pais'] ?></small></p>
                    </div>
                    <ul class="user-public">
                        <li>
                            <i class="fa-solid fa-users"></i> +500
                        </li>
                        <li>
                            <a class="nav-link" href="#"><i class="fa-solid fa-square-plus"></i> Novo post</a>
                        </li>
                    </ul>
                    <div class="user-socilamedia-link">
                        <a class="nav-link" href="#" data-content="LindIn"><i class="fa-brands fa-linkedin"></i></a>
                        <a class="nav-link" href="#" data-content="Github"><i class="fa-brands fa-github"></i></a>
                        <a class="nav-link" href="#" data-content="E-mail"><i class="fa-solid fa-envelope"></i></a>
                    </div>
                    <div class="user-about">
                        <h5>Sobre: </h5>
                        <p class="about-text"><?= $rowSaida['texto_sobre_usuario']; ?></p>

                        <?php
                            $cv = $connect ->prepare('SELECT * FROM curriculo WHERE id_curriculo_usuario = :idcv');
                            $cv ->bindValue(':idcv', $id_perfil);
                            $cv ->execute();
                            $cvrow = $cv ->fetch();
                            echo "<a class='saidacv' href='".$cvrow['url_curriculo']."' target='_blank'>Curriculo</a>";
                        ?>
                    </div>
                    <!--<div class="user-resum">
                        <a class="nav-link" href="">Meu curiculo<i class="fa-solid fa-chevron-right"></i></a>
                    </div>-->
                    
                </div>
                <div class="col-md-7 col-sm-2 center-wrapper">
                    <p id="sd"></p>
                    <div class="user-setting-button">
                        <button class="bton" id="showM">Editar perfil</button>
                        <form action="vaga.php" method="post">
                            <input type="hidden" name="vagasession" value="<?php session_start(); $_SESSION['vaga'] = $rowUsuarioDados['id_usuario']; ?>">
                            <button class="bton" type="submit">Vaga</button>
                        </form>
                    </div>
                    <div class="user-saida-info">
                        <span><i class="fa-solid fa-user"></i> Nome :</span>
                        <p class="user-detalhe"><?= $rowUsuarioDados['nome_usuario']." ".$rowUsuarioDados['sobre_nome']; ?></p>
                        <span><i class="fa-solid fa-envelope"></i> Email :</span>
                        <p class="user-detalhe"><?= $rowUsuarioDados['mail_usuario'] ?></p>
                        <span><i class="fa-solid fa-briefcase"></i>Titulo Perfil: </span>
                        <p class="user-detalhe"><?= $rowSaida['titulo_perfil']; ?></p>
                        <span><i class="fa-solid fa-phone"></i> Celular :</span>
                        <p class="user-detalhe"><?= $rowSaida['celular_1'] ?></p>
                        <span><i class="fa-solid fa-cake-candles"></i>Aniversario: </span>
                        <p class="user-detalhe"><?php echo $rowUsuarioDados['datanascimento_usuario'] ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../htmlphp/app.js"></script>

    <?php 
        if(isset($_POST['editar'])){
            $mailEdit = $_POST['mailEditar'];
            $titulo = $_POST['tituloPerfil'];
            $cel = $_POST['celula'];
            $nomeFac = $_POST['fac'];
            $sobre = $_POST['sobreText'];
    
            if(empty($mailEdit) || empty($titulo) || empty($cel) || empty($nomeFac) || empty($sobre)){
                ?>
                <script>
                    $('#sd').text('Atualise todas as informações');
                    $('#sd').css('color', '#ff0000');
                </script>
            <?php 
            }else{
                $update = $connect ->prepare('UPDATE info_adicionais_usuario SET celular_1 = :cel, texto_sobre_usuario = :sobre, 
                titulo_perfil = :ptitulo, nome_faculdade = :pfac WHERE id_info_usuario = :upid');
                $update ->bindValue(':cel', $cel);
                $update ->bindValue(':sobre',$sobre);
                $update ->bindValue(':ptitulo', $titulo);
                $update ->bindValue(':pfac', $nomeFac);
                $update ->bindValue(':upid', $id_perfil);
                $update ->execute();

                $updateMail = $connect ->prepare('UPDATE usuario_rs SET mail_usuario = :edmail WHERE id_usuario = :idedit');
                $updateMail ->bindValue(':edmail', $mailEdit);
                $updateMail ->bindValue(':idedit', $id_perfil);
                $updateMail ->execute();

                //arquivo curriculo

                $_UP['pasta'] = "arquivospdf/";
                $_UP['tamanho'] = 1024*1024*2;
                $_UP['extensao'] = array('pdf');
                $_UP['renomear'] = true;

                $explode = explode('.', $_FILES['cv']['name']);
                $extansaoArquivo = end($explode);
                $extensao = strtolower($extansaoArquivo);

                if(array_search($extensao,$_UP['extensao']) == false){
                    ?>
                    <script>
                        $('#sd').text('Não aceito esse tipo de arquivo');
                        $('#sd').css('color', '#ff0000');
                    </script>
                <?php }
                //validação tamanho do arquivo

                if($_UP['tamanho'] <= $_FILES['cv']['size']){
                    ?>
                    <script>
                        $('#sd').text('Arquivo muito grande');
                        $('#sd').css('color', '#ff0000');
                    </script>

                    <?php
                }
                //renomear Arquivo

                 if($_UP['renomear'] == true){
                    $nomeArquivo = MD5(time()).".$extensao";
                }else{
                    $nomeArquivo = $_FILES['cv']['name'];
                 }

                //mover o arquivo para a pasta
                 if(move_uploaded_file($_FILES['cv']['tmp_name'], $_UP['pasta'].$nomeArquivo)){
                    $url = $_UP['pasta'].$nomeArquivo;
                    $gravaArquivo = $connect ->prepare('UPDATE curriculo SET url_curriculo = :arq WHERE id_curriculo_usuario = :id');
                    $gravaArquivo ->bindValue(':arq', $url);
                    $gravaArquivo ->bindValue(':id', $id_perfil);
                    $gravaArquivo ->execute();
                    }else{
                        ?>
                        <script>
                            $('#sd').text('Não aceito esse tipo de arquivo');
                        </script>
                   <?php }
                ?>
                <script>
                    $('#sd').text('Atualizado com sucesso');
                    $('#sd').css('color', 'green');
                </script>
           <?php }
        }    
    ?>
</body>
</html>
