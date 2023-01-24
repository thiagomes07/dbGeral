<?php
    // Verificar se foi feito um post:
    if($_SERVER['REQUEST_METHOD'] != 'POST'){
        die('Acesso inválido');
    }

    // Verificar existe algum campo em branco:
    if(empty(trim($_POST['CodigoBarras'])) || empty(trim($_POST['NomeProduto'])) || empty(trim($_POST['Marca'])) || empty(trim($_POST['Tipo'])) || empty(trim($_POST['ValorProduto']))
    || empty(trim($_POST['QtdEstoque'])) || empty(trim($_POST['Validade']))){
        die('Algum campo foi preenchido com espaços');
    }

    // Criptografia:
    require_once('../../../biblioteca/config.php');

    // PDO:
    require_once('../../../biblioteca/EasyPDO.php');
    $update = new EasyPDO\EasyPDO();

    // Atualização de dados:
    $update->update("UPDATE tbProduto SET `CodigoBarras`=:CodigoBarrasInput, `Nome`=:NomeProduto, `Marca`=:Marca, `Tipo`=:Tipo, `Valor`=:Valor, `QtdEstoque`=:QtdEstoque, `Validade`=:Validade WHERE `CodigoBarras`=:CodigoBarras", [
        'CodigoBarrasInput' => $_POST['CodigoBarrasInput'],
        'NomeProduto' => mb_convert_case(trim($_POST['NomeProduto']), MB_CASE_TITLE),
        'Marca' => mb_convert_case(trim($_POST['Marca']), MB_CASE_TITLE),
        'Tipo' => mb_convert_case(trim($_POST['Tipo']), MB_CASE_TITLE),
        'Valor' => $_POST['ValorProduto'],
        'QtdEstoque' => $_POST['QtdEstoque'],
        'Validade' => $_POST['Validade'],
        'CodigoBarras' => aes_desencriptar($_POST['CodigoBarras'])
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
                <p><a href="../../atualizar-produto.php" class="voltar">Voltar</a></p>
            </div>
        </main>

        <footer>
            <p>Desenvolvido por <a href="#" target="_blank" rel="external">Thiago Gomes</a></p>
        </footer>
    </body>
</html>