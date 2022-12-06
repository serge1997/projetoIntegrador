
<?php
    
    session_start();
    if(!$_SESSION['vaga']){
        header('location:login.php');
    }

    include "connex.php";

?>



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
    <link rel="stylesheet" href="../htmlphp/css files/user.css">
    <title>Vagas</title>

    <style>
        .navbar{
            color: #fff;
            background: #4075cb;
            padding: 12px;
            display: flex;
            justify-content: space-between;
        }
        .navbar .d-flex{
            display: flex;
            gap: 16px;
        }

        .navbar-brand{
            width: 120px;
            border: none;
            border-radius: 30px;
            color: #fff;
            text-transform: lowercase;
            text-align: center;
        }
        .navbar-brand:hover{
            background: #fa5450;
            color: #fff;
        }
    </style>
</head>

<?php


?>
<body style="background-color: #fff;">
    <?php
        //pegar osdados de vagas publicada
        include "connex.php";

        $vagapublic = $connect ->prepare('SELECT * FROM vagapublicado');
        $vagapublic ->execute();
        $rowVaga = $vagapublic ->fetch();
        

    ?>
    <nav class="navbar">
        <?= "<a class='navbar-brand' id='addvaga' href='vaga.php?diconarVaga&id=".$_SESSION['vaga']."'>Nova Vaga</a>";?>
        <div class="d-flex">
            <a class="d-flex nav-link" href="inicio.php">Inicio</a>
            <a class="nav-link" href="user.php">Perfil</a>
        </div>
    </nav>
    <div class="container container-vagas">
    </div>
    <form id="formAddVaga">
        <h4>Adiciona Nova Vaga</h4>
        <p class="resultvagaPublicada"></p>
        <input type="text" name="tituloVaga" id="tituloVaga" placeholder="Titulo da Vaga">
        <input type="text" name="localVaga" id="localVaga" placeholder="Local da Vaga">
        <input type="hidden" value="<?= $_SESSION['vaga']; ?>" id="sessionVaga" name="sessionVaga"/>
        <textarea name="detalheVaga" id="detalheVaga" cols="30" rows="10" placeholder="Informações sobre a vaga"></textarea>
        <input type="submit" name="publicarVaga" value="Publicar"/>
    </form>
    <?php 
        while($rowVaga = $vagapublic ->fetch()){ ?>
            <div class="container container-vagas">
                <div class="row">
                    <div class="vaga-header">
                        <h6><?= $rowVaga['titulo_vaga']; ?></h6>
                        <p><?= $rowVaga['local_vaga']; ?></p>
                    </div>
                    <div class="vaga-body">
                        <p><?= $rowVaga['dethale_vaga']; ?></p>
                    </div>
                    <div class="vaga-footer">
                        <?= "<a class='button' href='vaga.php?vaga&id=".$rowVaga['id_vagapublicado']."'>Canditar-se</a>"; ?>
                    </div>
                </div>
            </div>

        <?php
             
        }
        date_default_timezone_set('America/Sao_Paulo');
        $hoje = date('Y/m/d H:i:s');
        echo $hoje;

            #candidata automatico

            if(isset($_GET['vaga'])){
                $id = $_GET['id'];
                date_default_timezone_set('America/Sao_Paulo');
                $hoje = date('Y/m/d H:i:s');
                //pegar o curriculo do usuario dentro do banco de dados 
                $cur = $connect ->prepare('SELECT * FROM curriculo WHERE id_curriculo_usuario = :idcv');
                $cur ->bindValue(':idcv', $_SESSION['vaga']);
                $cur ->execute();
                $rowcur = $cur ->fetch();

                //inserir o dados do usuario na tabela de vaga que ele se candidato
                $aplicar = $connect ->prepare('INSERT INTO vaga_candidata (id_vagacandidata, id_vagapublicado, id_usuario, data_candidata, curiculo_usuario) VALUES 
                (NULL, :idvaga, :idus, :pdata, :pcv)');
                $aplicar ->bindValue(':idvaga', $id);
                $aplicar ->bindValue(':idus', $_SESSION['vaga']);
                $aplicar ->bindValue(':pdata', $hoje);
                $aplicar ->bindValue(':pcv', $rowcur['url_curriculo']);
                $aplicar ->execute();
                ?>
                <script>alert('Candidatura enviada com sucesso')</script>
            <?php }
        
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="../htmlphp/app.js"></script>
    <script src="../htmlphp/inserirvaga.js"></script>

</body>
</html>