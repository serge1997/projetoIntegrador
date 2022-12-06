<?php

    // inserir dados no banco
    header('Content-Type: application/json');
    include "connex.php";

    if(empty($_POST['nome'])){
        echo json_encode("prenche todos campos");
        exit();
    }

    if(empty($_POST['sobrenome'])){
        echo json_encode("* prenche todos os campos");
        exit();
    }
    if(empty($_POST['cpf'])|| !is_numeric($_POST['cpf']) || strlen($_POST['cpf']) != 11){
        echo json_encode("* Cpf incoreto");
        exit();
    }
    if(empty($_POST['dNasc'])){
        echo json_encode("* prenche todos os campos");
        exit();
    }
    if(empty($_POST['mail']) || substr_count($_POST['mail'],"@") != 1 || substr_count($_POST['mail'], ".") == 0){
        echo json_encode("* Email incoreto");
        exit();
    }
    if(empty($_POST['bairro'])){
        echo json_encode("* prenche todos os campos");
        exit();
    }
    if(empty($_POST['rua'])){
        echo json_encode("* prenche todos os campos");
        exit();
    }

    if(empty($_POST['senha'])){
        echo json_encode("* prenche todos os campos");
        exit();
    }
    if(empty($_POST['confsenha'])){
        echo json_encode("* prenche todos os campos");
        exit();
    }

    if($_POST['senha'] != $_POST['confsenha']){
        echo json_encode("* Os campos de senha devem ser iguais");
        exit();
    }

    $nome = $_POST['nome'];
    $sobreNome = $_POST['sobrenome'];
    $cpf = $_POST['cpf'];
    $dataNasc = $_POST['dNasc'];
    $mail = $_POST['mail'];
    $pais = $_POST['paises'];
    $estado = $_POST['estados'];
    $cidade = $_POST['cidades'];
    $bairro = $_POST['bairro'];
    $rua = $_POST['rua'];
    $numeroCasa = $_POST['numerocasa'];
    $complemente = $_POST['complemente'];
    $senha = $_POST['senha'];
    $confSenha = $_POST['confsenha'];


    $inserir = $connect ->prepare('INSERT INTO usuario_rs (id_usuario, nome_usuario, sobre_nome, cpf_usuario, mail_usuario, senha_usuario, confirm_usuario, datanascimento_usuario) VALUES 
    (NULL, :pnome, :psobnome, :pcpf, :pmail, MD5(:psenha), MD5(:pconf), :pdata)');
    $inserir->bindValue(':pnome', $nome);
    $inserir->bindValue(':psobnome', $sobreNome);
    $inserir->bindValue(':pcpf', $cpf);
    $inserir->bindValue(':pmail', $mail);
    $inserir->bindValue(':psenha', $senha);
    $inserir->bindValue(':pconf', $confSenha);
    $inserir->bindValue(':pdata', $dataNasc);
    $inserir->execute();

    $inseriEndereco = $connect ->prepare('INSERT INTO endereco_usuario (id_usuarioend, id_pais_usuario,id_estado_usuario,id_cidade_usuario,bairro_usuario,rua_usuario,
    numero_casa,complemente) VALUES (NULL, :pais, :pestado, :pcidade, :pbairro, :prua, :pcasa, :pcomp)');
    $inseriEndereco ->bindValue(':pais', $pais);
    $inseriEndereco ->bindValue(':pestado', $estado);
    $inseriEndereco ->bindValue(':pcidade', $cidade);
    $inseriEndereco ->bindValue(':pbairro', $bairro);
    $inseriEndereco ->bindValue(':prua', $rua);
    $inseriEndereco ->bindValue(':pcasa',$numeroCasa);
    $inseriEndereco ->bindValue(':pcomp', $complemente);
    $inseriEndereco ->execute();

    $info_add = $connect ->prepare('INSERT INTO info_adicionais_usuario (id_info_usuario) VALUES (NULL)');
    $info_add ->execute();

    $curriculo = $connect ->prepare('INSERT INTO curriculo (id_curriculo_usuario) VALUES (NULL)');
    $curriculo ->execute();

    $img = $connect ->prepare('INSERT INTO  usuario_img (id_img_usuario) VALUES (NULL)');
    $img->execute();


    
    if($inserir && $inseriEndereco){
        echo json_encode("Cadastrado Com successo");
    }else{
        echo json_encode("Erro ao enviar dados");
    }




?>
