<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css files/style.css"/>
    <title>Cadastre-se</title>
</head>
<body>

    <?php
        include "../php/connex.php";
        include "../php/function.php";

    ?>
    <div class="header-cont">
        <a href="home.html"><h5>STUD.<span style="color:#f0ad4e ;">wo</span></h5></a>
    </div>
    <!--INITIAÇÂO PRINCIPAL CONTEUDO-->
    <div class="container princip-cont">
        <h2>Cria sua Conta !</h2>
        <form id="cadastroForm" class="formcadastra-box">
            <div class="mb-3 row">
                <span class="nomemsg msgErro"></span>
                <label for="inputNome" class="col-sm-2 col-lg-2 col-form-label">Nome:</label>
                <div class="col-sm-10 col-lg-4">
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="Nome">
                </div>
            </div>
            <div class="mb-3 row">
                <span class="msg msgErro"></span>
                <label for="inputNome" class="col-sm-2 col-lg-2 col-form-label">Sobrenome:</label>
                <div class="col-sm-10 col-lg-4">
                    <input type="text" class="form-control" id="sobrenome" name="sobrenome" placeholder="sobrenome">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputcpf" class="col-sm-2 col-lg-2 col-form-label">Seu CPF:</label>
                <div class="col-sm-10 col-lg-4">
                    <input type="text" class="form-control" id="cpf" name="cpf" placeholder="CPF">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="inputDatnasc" class="col-sm-2 col-lg-2 col-form-label">Nascimento:</label>
                <div class="col-sm-10 col-lg-4">
                    <input type="date" class="form-control" id="dNasc" name="dNasc" placeholder="Nascimento">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="mail" class="col-sm-2 col-lg-2 col-form-label">Email:</label>
                <div class="col-sm-10 col-lg-4">
                    <input type="text" class="form-control" id="mail" name="mail" placeholder="Email">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="pais" class="col-sm-2 col-lg-2 col-form-label">Pais:</label>
                <div class="col-sm-10 col-lg-4">

                <select class="form-select" aria-label="Default" name="paises" id="paises">
                    <?php
                        $selectPais = $connect ->prepare('SELECT * FROM pais');
                        $selectPais ->execute();

                        if($selectPais ->rowCount() == 0){
                            json_encode("Não há registro");
                        }else{
                            while($rowPais = $selectPais ->fetch()){
                                echo "<option value=\"".$rowPais['id_pais']."\">".$rowPais['nome_pais']."</option><br/>";
                            }
                        }
                    ?>
                </select>
                    <!--<input type="text" class="form-control" id="pais" name="pais" placeholder="Pais">-->
                </div>
            </div>
            <div class="mb-3 row">
                <label for="estado" class="col-sm-2 col-lg-2 col-form-label">Estado:</label>
                <div class="col-sm-10 col-lg-4">
                <select class="form-select" aria-label="Default" name="estados" id="estados">
                    <?php
                        $selectEstado = $connect ->prepare('SELECT * FROM estados');
                        $selectEstado ->execute();
                        if($selectEstado ->rowCount() == 0){
                            json_encode("Nã ha registro estado cadastrado");
                        }else{
                            while($rowEstado = $selectEstado ->fetch()){
                                echo "<option value=\"".$rowEstado['id_estado']."\">".$rowEstado['nome_estado']."</option><br/>";
                            }
                        }
                    ?>
                    <!--<input type="text" class="form-control" id="estado" name="estado" placeholder="Estado">-->
                </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="cidade" class="col-sm-2 col-lg-2 col-form-label">Cidade:</label>
                <div class="col-sm-10 col-lg-4">
                <select class="form-select" aria-label="Default" name="cidades" id="cidades">
                    <?php
                        $selectCidade = $connect ->prepare('SELECT * FROM cidades');
                        $selectCidade ->execute();
                        if($selectCidade ->rowCount() == 0){
                            json_encode("Nã ha registro cidade cadastrado");
                        }else{
                            while($rowCidade = $selectCidade ->fetch()){
                                echo "<option value=\"".$rowCidade['id_cidade']."\">".$rowCidade['nome_cidade']."</option><br/>";
                            }
                        }
                    ?>
                </select>
                    <!--<input type="text" class="form-control" id="cidade" name="cidade" placeholder="Cidade">-->
                </div>
            </div>
            <div class="mb-3 row">
                <label for="bairro" class="col-sm-2 col-lg-2 col-form-label">Bairro:</label>
                <div class="col-sm-10 col-lg-4">
                    <input type="text" class="form-control" id="bairro" name="bairro" placeholder="Bairro">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="rua" class="col-sm-2 col-lg-2 col-form-label">Rua:</label>
                <div class="col-sm-10 col-lg-4">
                    <input type="text" class="form-control" id="rua" name="rua" placeholder="Rua">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="Numerocasa" class="col-sm-2 col-lg-2 col-form-label">Numero:</label>
                <div class="col-sm-10 col-lg-4">
                    <input type="text" class="form-control" id="numerocasa" name="numerocasa" placeholder="Numero da rua">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="complemente" class="col-sm-2 col-lg-2 col-form-label">Complemente:</label>
                <div class="col-sm-10 col-lg-4">
                    <input type="text" class="form-control" id="complemente" name="complemente" placeholder="Complemente">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="senha" class="col-sm-2 col-lg-2 col-form-label">Senha:</label>
                <div class="col-sm-10 col-lg-4">
                    <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha">
                </div>
            </div>
            <div class="mb-3 row">
                <label for="confsenha" class="col-sm-2 col-lg-2 col-form-label">Confirme a senha:</label>
                <div class="col-sm-10 col-lg-4">
                    <input type="password" class="form-control" id="confsenha" name="confsenha" placeholder="Confirme sua senha">
                </div>
            </div>
            <div class="d-grid gap-2 col-sm-8 col-lg-6 mx-auto">
                <small>Ler e aceitar as condições de confidencialidade para continuar, <a href="#">Clique aqui</a></small>
                <small id="saidaCadastro"></small>
            </br>
                <div class="spinner-grow" style="width: 3rem; height: 3rem;" role="status">
                </div>
                <button id="cadastrar" type="submit">Continuar</button>
                <p>OU</p>
                <p>Já se cadastrou no <b>Stud.<span style="color: #f0ad4e;">wo? </span></b><a href="#">Entre aqui </a></p>
            </div>
        </form>
    </div>
    <div class="container-fluid footer-box">
        <div class="row foot-cont1">
            <div class="col-lg-3 col-md-2">
                <p><a href="#">STUD.<span style="color: #f0ad4e;">wo</span>&copy;</a></p>
            </div>
            <div class="col-lg-3 col-md-2">
                <p><a href="#"><small>Acessibilidade</small></a></p>
            </div>
            <div class="col-lg-3 col-md-2">
                <p><a href="#"><small>Sóbre Nós</small></a></p>
            </div>
            <div class="col-lg-3 col-md-2">
                <p><a href="#"><small>Pólitica de privacidade STUD.<span style="color: #f0ad4e;">wo</span></small></a></p>
            </div>
        </div>
        <div class="row foot-cont2">
            <div class="col-lg-3 col-md-2">
                <p><a href="#"><small>Contrato do usuario</small></a></p>
            </div>
            <div class="col-lg-3 col-md-2">
                <p><a href="#"><small>Politica de direito autorais</small></a></p>
            </div>
            <div class="col-lg-3 col-md-2">
                <p><a href="#"><small>Politica da marca STUD.<span style="color: #f0ad4e;">wo</span></small></a></p>
            </div>
            <div class="col-lg-3 col-md-2">
                <p><a href="#"><small>Obter Ajuda </small></a></p>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="app.js"></script>
</body>
</html>