<?php
    // Verifica se existe o id:
    if(!isset($_GET['cep'])){
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

    $delete->delete("DELETE FROM tbEndereco WHERE `Cep`=:Cep", [
        'Cep' => $_GET['cep']
    ]);
    
    $enderecos = $select->select("SELECT * FROM tbEndereco WHERE `Cep`=:Cep", [
        'Cep' => $_GET['cep']
    ]);
    if(count($enderecos) >= 1) $erro = 1;
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
                <h1 id="sucesso"><?= $erro == 1 ? 'Não foi possível deletar. Endereço pertencente a funcionário ou cliente' : 'Endereço deletado com sucesso!'?></h1>
                <p><a href="../deletar-endereco.php" class="voltar">Voltar</a></p>
            </div>
        </main>

        <footer>
            <p>Desenvolvido por <a href="#" target="_blank" rel="external">Thiago Gomes</a></p>
        </footer>
    </body>
</html>