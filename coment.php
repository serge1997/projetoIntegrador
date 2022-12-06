
<?php
    header('Content-Type: application/json');
    include "connex.php";
    
        $coment = $_POST['comment'];
        $idpost =$_POST['idpost'];
        $idus = $_POST['idus'];
        date_default_timezone_set('America/Sao_Paulo');
        $hoje = date('Y/m/d H:i:s');

        $inserirComent = $connect ->prepare('INSERT INTO comentarios (id_comentario, id_usuario, id_post, conteudo_comentario, data_comentario) VALUES 
        (NULL, :usuario, :post, :txt, :datac)');
        $inserirComent ->bindValue(':usuario', $idus);
        $inserirComent ->bindValue(':post', $idpost);
        $inserirComent ->bindValue(':txt', $coment);
        $inserirComent ->bindValue(':datac', $hoje);
        $inserirComent ->execute();
    

?>