<?php
    include "connex.php";

    header('Content-Type: application/json');

    $getC = $connect ->prepare('SELECT * FROM comentarios');
    $getC ->execute();

    if($getC ->rowCount() ==0){
        echo json_encode("Não há comentario");
    }else{
        echo json_encode($getC ->fetchAll(PDO::FETCH_ASSOC));
    }
?>