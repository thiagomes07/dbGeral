<?php
    // Verificar se foi feito um post:
    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
        die('Acesso inválido');
    }

    // Verificar existe algum campo em branco:
    if (empty(trim($_POST['Quantidade'])) || empty(trim($_POST['ValorVenda']))) {
        die('Algum campo foi preenchido com espaços');
    }

    // Criptografia:
    require_once('../../../biblioteca/config.php');

    // PDO:
    require_once('../../../biblioteca/EasyPDO.php');
    $update = new EasyPDO\EasyPDO();
    $update1 = new EasyPDO\EasyPDO();


    $update->update("UPDATE tbVenda SET `FuncionarioId`=:FuncionarioId, `ClienteId`=:ClienteId, `DataVenda`=:DataVenda WHERE `NfId`=:NfId", [
        'FuncionarioId' => $_POST['CpfFuncionario'],
        'ClienteId' => $_POST['CpfCliente'],
        'DataVenda' => str_replace('T', ' ', $_POST['DataVenda']),
        'NfId' => aes_desencriptar($_POST['NfId'])
    ]);

    $update1->update("UPDATE tbItem SET `CodigoBarras`=:CodigoBarrasNovo, `Quantidade`=:Quantidade, `Valor`=:Valor WHERE `NfId`=:NfId AND `CodigoBarras`=:CodigoBarras", [
        'CodigoBarrasNovo' => $_POST['CodigoBarrasNovo'],
        'Quantidade' => $_POST['Quantidade'],
        'Valor' => $_POST['ValorVenda'],
        'CodigoBarras' => aes_desencriptar($_POST['CodigoBarras']),
        'NfId' => aes_desencriptar($_POST['NfId'])
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
            <p><a href="../../atualizar-venda.php" class="voltar">Voltar</a></p>
        </div>
    </main>

    <footer>
        <p>Desenvolvido por <a href="#" target="_blank" rel="external">Thiago Gomes</a></p>
    </footer>
</body>

</html>