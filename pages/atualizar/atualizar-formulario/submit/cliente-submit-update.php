<?php
    // Verificar se foi feito um post:
    if($_SERVER['REQUEST_METHOD'] != 'POST'){
        die('Acesso inválido');
    }

    // Verificar existe algum campo em branco:
    if(empty(trim($_POST['NomeCliente'])) || empty(trim($_POST['CpfCliente'])) || empty(trim($_POST['TelefoneCliente']))){
        die('Algum campo foi preenchido com espaços');
    }

    // Criptografia:
    require_once('../../../biblioteca/config.php');

    // PDO:
    require_once('../../../biblioteca/EasyPDO.php');
    $update = new EasyPDO\EasyPDO(); 
    $select = new EasyPDO\EasyPDO();
    $select1 = new EasyPDO\EasyPDO();
    $select2 = new EasyPDO\EasyPDO();
    $select3 = new EasyPDO\EasyPDO();

    // Variável para erro:
    $erro = null;

    // Verificar se os campos unique já existem:
    $clientecpf = $select->select("SELECT Cpf FROM tbCliente WHERE ClienteId = :ClienteId", ['ClienteId' => aes_desencriptar($_POST['ClienteId'])])[0];
    $cpfexistentes = $select1->select("SELECT Cpf FROM tbCliente");
    // CPF já existente:
    if($clientecpf['Cpf'] != $_POST['CpfCliente']){
        foreach($cpfexistentes as $cpfexistente){
            if($_POST['CpfCliente'] == $cpfexistente['Cpf']) $erro = 1;
        }
    }

    $clientetelefone = $select2->select("SELECT Telefone FROM tbCliente WHERE ClienteId = :ClienteId", ['ClienteId' => aes_desencriptar($_POST['ClienteId'])])[0];
    $telefoneexistentes = $select3->select("SELECT Telefone FROM tbCliente");
    // Telefone já existente:
    if($clientetelefone['Telefone'] != $_POST['TelefoneCliente']){
        foreach($telefoneexistentes as $telefoneexistente){
            if($_POST['TelefoneCliente'] == $telefoneexistente['Telefone']) $erro = 2;
        }
    }

    // Atualização de dados:
    if($erro == null){
        $update->update("UPDATE tbCliente SET `Nome`=:NomeCliente, `Cpf`=:CpfCliente, `DataNascimento`=:DataNascimentoCliente, `Telefone`=:TelefoneCliente WHERE `ClienteId`=:ClienteId", [
            'CpfCliente' => $_POST['CpfCliente'],
            'NomeCliente' => mb_convert_case(trim($_POST['NomeCliente']), MB_CASE_TITLE),
            'DataNascimentoCliente' => $_POST['DataNascimentoCliente'],
            'TelefoneCliente' => $_POST['TelefoneCliente'],
            'ClienteId' => aes_desencriptar($_POST['ClienteId'])
        ]);
    }
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
                <h1 id="sucesso"><?php 
                switch ($erro){
                    case 1:
                        echo 'Não foi possível atualizar. CPF já existente.';
                        break;

                    case 2:
                        echo 'Não foi possível atualizar. Telefone existente.';
                        break;
                        
                    default:
                        echo 'Atualização feita com sucesso!';
                        break;
                }?></h1>
                <p><a href="../../atualizar-cliente.php" class="voltar">Voltar</a></p>
            </div>
        </main>

        <footer>
            <p>Desenvolvido por <a href="#" target="_blank" rel="external">Thiago Gomes</a></p>
        </footer>
    </body>
</html>