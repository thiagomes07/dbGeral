<?php

    // Verificar se foi feito um post:
    if($_SERVER['REQUEST_METHOD'] != 'POST'){
        die('Acesso inválido');
    }

    // Verificar existe algum campo em branco:
    if(empty(trim($_POST['CodigoBarras'])) || empty(trim($_POST['ValorProduto'])) || empty(trim($_POST['Marca'])) || empty(trim($_POST['Tipo']))
    || empty(trim($_POST['QtdEstoque'])) || empty(trim($_POST['NomeProduto']))){
        die('Algum campo foi preenchido com espaços');
    }

    // Variável para erro:
    $erro = null;

    require_once('../../biblioteca/EasyPDO.php');

    $insert = new EasyPDO\EasyPDO();
    $select = new EasyPDO\EasyPDO();

    // Verificar se produto existe:
    $produto = $select->select("SELECT * FROM tbProduto WHERE CodigoBarras = :CodigoBarras", ['CodigoBarras' => $_POST['CodigoBarras']]);
    if(count($produto) == 0){
        // Inserção de produto:
        $insert->insert("INSERT INTO tbProduto VALUES(:CodigoBarras, :Valor, :Validade, :Marca, :Tipo, :QtdEstoque, :Nome)", [
            'CodigoBarras' => $_POST['CodigoBarras'],
            'Valor' => $_POST['ValorProduto'],
            'Validade' => $_POST['Validade'],
            'Marca' => mb_convert_case(trim($_POST['Marca']), MB_CASE_TITLE),
            'Tipo' => mb_convert_case(trim($_POST['Tipo']), MB_CASE_TITLE),
            'QtdEstoque' => $_POST['QtdEstoque'],
            'Nome' => mb_convert_case(trim($_POST['NomeProduto']), MB_CASE_TITLE)
        ]);
    }else{
        $erro = 1;
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="../../../images/bd.ico" type="image/x-icon">
        <link rel="stylesheet" href="../../../css/estilo.css">
        <link rel="stylesheet" href="../../../css/estilo-submit.css">
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
                <h1 id="sucesso"><?= $erro == 1 ? 'Não foi possível registrar. Produto já existente' : 'Registro feito com sucesso!'?></h1>
                <p><a href="../cadastrar-produto.html" class="voltar">Voltar</a></p>
            </div>
        </main>

        <footer>
            <p>Desenvolvido por <a href="#" target="_blank" rel="external">Thiago Gomes</a></p>
        </footer>
    </body>
</html>