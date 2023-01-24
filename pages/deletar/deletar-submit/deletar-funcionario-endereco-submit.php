<?php
    // Verifica se existe o id:
    if(!isset($_GET['id'])){
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

    $delete->delete("DELETE tbFuncionario, tbEndereco FROM tbFuncionario INNER JOIN tbEndereco ON tbCliente.Cep = tbEndereco.Cep WHERE `FuncionarioId`=:FuncionarioId", [
        'FuncionarioId' => aes_desencriptar($_GET['id'])
    ]);

    $funcionarios = $select->select("SELECT * FROM tbFuncionario WHERE `FuncionarioId`=:FuncionarioId", [
        'FuncionarioId' => aes_desencriptar($_GET['id'])
    ]);
    if(count($funcionarios) >= 1) $erro = 1;
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
                <h1 id="sucesso"><?= $erro == 1 ? 'Não foi possível deletar.' : 'Funcionário e seu respectivo endereço foram deletados com sucesso!'?></h1>
                <p><a href="../deletar-funcionario.php" class="voltar">Voltar</a></p>
            </div>
        </main>

        <footer>
            <p>Desenvolvido por <a href="#" target="_blank" rel="external">Thiago Gomes</a></p>
        </footer>
    </body>
</html>