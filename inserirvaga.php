
<?php

    header('Content-Type: application/json');

    include "connex.php";


    $tituloV = $_POST['tituloVaga'];
    $localV = $_POST['localVaga'];
    $detailV = $_POST['detalheVaga'];
    $sessionVaga = $_POST['sessionVaga'];

    $inserirVaga = $connect ->prepare('INSERT INTO vagapublicado (id_vagapublicado, id_usuario, titulo_vaga, local_vaga, dethale_vaga) VALUES 
    (NULL, :psession, :titulo, :localv, :detail)');
    $inserirVaga ->bindValue(':psession', $sessionVaga);
    $inserirVaga ->bindValue(':titulo', $tituloV);
    $inserirVaga ->bindValue(':localv', $localV);
    $inserirVaga ->bindValue(':detail', $detailV);
    $inserirVaga ->execute();
    if(!$inserirVaga){
        echo json_encode("Erro ao cadastrar a vaga");
    }else{
        echo json_encode("Vaga publicada com sucesso");
    }

?>