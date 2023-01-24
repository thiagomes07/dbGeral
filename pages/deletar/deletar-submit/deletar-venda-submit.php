<?php
    // Verifica se existe o id:
    if(!isset($_GET['nfid'])){
        die('Acesso inválido');
    }

    // Criptografia:
    require_once('../../biblioteca/config.php');

    // PDO:
    require_once('../../biblioteca/EasyPDO.php');
    $delete = new EasyPDO\EasyPDO(); 
    $select = new EasyPDO\EasyPDO(); 

    // Variável para erro:
    $erro = null;

    // Retirar NfId e CodigoBarras do GET:
    $identificacoes = explode(';', $_GET['nfid']); 

    $delete->delete("DELETE tbItem, tbVenda FROM tbItem INNER JOIN tbVenda ON tbItem.NfId = tbVenda.NfId WHERE tbVenda.NfId=:NfId AND CodigoBarras=:CodigoBarras", [ 
        'NfId' => aes_desencriptar($identificacoes[0]),
        'CodigoBarras' => aes_desencriptar($identificacoes[1])
    ]);

    $vendas = $select->select("SELECT * FROM tbItem INNER JOIN tbVenda ON tbItem.NfId = tbVenda.NfId WHERE tbVenda.NfId=:NfId AND CodigoBarras=:CodigoBarras", [
        'NfId' => aes_desencriptar($identificacoes[0]),
        'CodigoBarras' => aes_desencriptar($identificacoes[1])
    ]);
    if (count($vendas) >= 1) $erro = 1;
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
                <h1 id="sucesso"><?= $erro == 1 ? 'Não foi possível deletar.' : 'Venda deletada com sucesso!'?></h1>
                <p><a href="../deletar-venda.php" class="voltar">Voltar</a></p>
            </div>
        </main>

        <footer>
            <p>Desenvolvido por <a href="#" target="_blank" rel="external">Thiago Gomes</a></p>
        </footer>
    </body>
</html>