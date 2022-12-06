<?php
    

    function selectBd($id_user){
        include "connex.php";
        $cv = $connect ->prepare('SELECT * FROM curriculo WHERE id_curriculo_usuario = :idc');
        $cv ->bindValue(':idc', $id_user);
        $cv ->execute();
    }

?>