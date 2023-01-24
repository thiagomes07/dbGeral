<?php
    // Verificar se foi feito um post:
    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        die('Acesso inválido');
    }

    // Verificar existe algum campo em branco:
    if (empty(trim($_POST['DataVenda'])) || empty(trim($_POST['Quantidade'])) || empty(trim($_POST['ValorVenda']))) {
        die('Algum campo foi preenchido com espaços');
    }

    // Variável para erro:
    $erro = null;

    require_once('../../biblioteca/EasyPDO.php');

    $insert = new EasyPDO\EasyPDO();
    $insert1 = new EasyPDO\EasyPDO();
    $select = new EasyPDO\EasyPDO();
    $select1 = new EasyPDO\EasyPDO();
        
    // Verificar se venda existe:
    $venda = $select->select("SELECT * FROM tbVenda INNER JOIN tbitem ON tbVenda.NfId = tbItem.NfId WHERE FuncionarioId= :FuncionarioId AND ClienteId= :ClienteId AND DataVenda= :DataVenda AND CodigoBarras= :CodigoBarras AND Quantidade= :Quantidade", [
        'FuncionarioId' => $_POST['FuncionarioId'],
        'ClienteId' => $_POST['ClienteId'],
        'DataVenda' => $_POST['DataVenda'],
        'CodigoBarras' => $_POST['CodigoBarras'],
        'Quantidade' => $_POST['Quantidade']
    ]);

    if (count($venda) == 0) {
        // Inserção de venda:
        $insert->insert("INSERT INTO tbVenda VALUES(default, :FuncionarioId, :ClienteId, :DataVenda)", [
            'FuncionarioId' => $_POST['FuncionarioId'],
            'ClienteId' => $_POST['ClienteId'],
            'DataVenda' => $_POST['DataVenda']
        ]);

        // Pegar id da venda
        $venda = $select1->select("SELECT * FROM tbVenda WHERE FuncionarioId= :FuncionarioId AND ClienteId= :ClienteId AND DataVenda= :DataVenda", [
            'FuncionarioId' => $_POST['FuncionarioId'],
            'ClienteId' => $_POST['ClienteId'],
            'DataVenda' => $_POST['DataVenda']
        ]);

        // Inserção de item:
        $insert1->insert("INSERT INTO tbItem VALUES(:NfId, :CodigoBarras, :Quantidade, :ValorVenda)", [
            'NfId' => $venda[0]['NfId'],
            'CodigoBarras' => $_POST['CodigoBarras'],
            'Quantidade' => $_POST['Quantidade'],
            'ValorVenda' => $_POST['ValorVenda']
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
            <h1 id="sucesso"><?= $erro == 1 ? 'Não foi possível registrar. Venda já existente' : 'Registro feito com sucesso!'?></h1>
            <p><a href="../cadastrar-venda.php" class="voltar">Voltar</a></p>
        </div>
    </main>

    <footer>
        <p>Desenvolvido por <a href="#" target="_blank" rel="external">Thiago Gomes</a></p>
    </footer>
</body>

</html>