<?php
    // Verificar se foi feito um post:
    if($_SERVER['REQUEST_METHOD'] != 'POST'){
        die('Acesso inválido');
    }

    // Verificar existe algum campo em branco:
    if(empty(trim($_POST['NumeroEnderecoCliente']))){
        die('Algum campo foi preenchido com espaços');
    }

    // Criptografia:
    require_once('../../../biblioteca/config.php');

    // PDO:
    require_once('../../../biblioteca/EasyPDO.php');
    $update = new EasyPDO\EasyPDO(); 
    $select = new EasyPDO\EasyPDO();

    // Atualização do cliente:
    $update->update("UPDATE tbCliente SET NumeroEndereco = :NumeroEndereco, Cep = :CepCliente WHERE ClienteId = :ClienteId", [
        'NumeroEndereco' => $_POST['NumeroEnderecoCliente'],
        'CepCliente' => $_POST['CepCliente'],
        'ClienteId' => aes_desencriptar($_POST['ClienteId'])
    ]); 
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="../../../../images/bd.ico" type="image/x-icon">
        <link rel="stylesheet" href="../../../../css/estilo.css">
        <link rel="stylesheet" href="../../../../css/estilo-submit.css">
        <title>Banco de Dados Geral</title>
    </head>

    <body>
        
        <header>
            <h1>Banco de Dados Geral</h1>
            <p>Um Banco de Dados; vários comércios</p>
        </header>

        <div id="circulo"></div>
        <div id="circulo2"></div>
        <div id="circulo3"></div>
        <div id="circulo4"></div>

        <main>
            <div class="centro">
                <h1 id="sucesso">Atualização feita com sucesso!</h1>
                <p><a href="../../atualizar-endereco-cliente.php" class="voltar">Voltar</a></p>
            </div>
        </main>

        <footer>
            <p>Desenvolvido por <a href="#" target="_blank" rel="external">Thiago Gomes</a></p>
        </footer>
    </body>
</html>