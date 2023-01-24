<?php
    // Verificar se foi feito um post:
    if($_SERVER['REQUEST_METHOD'] != 'POST'){
        die('Acesso inválido');
    }

    // Verificar existe algum campo em branco:
    if(empty(trim($_POST['NomeFuncionario'])) || empty(trim($_POST['CpfFuncionario'])) || empty(trim($_POST['TelefoneFuncionario'])) || empty(trim($_POST['Salario'])) || empty(trim($_POST['Funcao']))){
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
    $funcionariocpf = $select->select("SELECT Cpf FROM tbFuncionario WHERE FuncionarioId = :FuncionarioId", ['FuncionarioId' => aes_desencriptar($_POST['FuncionarioId'])])[0];
    $cpfexistentes = $select1->select("SELECT Cpf FROM tbFuncionario");
    // CPF já existente:
    if($funcionariocpf['Cpf'] != $_POST['CpfFuncionario']){
        foreach($cpfexistentes as $cpfexistente){
            if($_POST['CpfFuncionario'] == $cpfexistente['Cpf']) $erro = 1;
        }
    }

    $funcionariotelefone = $select2->select("SELECT Telefone FROM tbFuncionario WHERE FuncionarioId = :FuncionarioId", ['FuncionarioId' => aes_desencriptar($_POST['FuncionarioId'])])[0];
    $telefoneexistentes = $select3->select("SELECT Telefone FROM tbFuncionario");
    // Telefone já existente:
    if($funcionariotelefone['Telefone'] != $_POST['TelefoneFuncionario']){
        foreach($telefoneexistentes as $telefoneexistente){
            if($_POST['TelefoneFuncionario'] == $telefoneexistente['Telefone']) $erro = 2;
        }
    }
    
    if($erro == null){
        // Atualização de dados:  # está faltando capturar alguns campos

        $update->update("UPDATE tbFuncionario SET `Nome`=:NomeFuncionario, `Cpf`=:CpfFuncionario, `DataNascimento`=:DataNascimentoFuncionario, `Telefone`=:TelefoneFuncionario, `Salario`=:Salario, `Funcao`=:Funcao, `HorarioEntrada`=:HorarioEntrada, `HorarioSaida`=:HorarioSaida WHERE FuncionarioId = :FuncionarioId", [
            'CpfFuncionario' => $_POST['CpfFuncionario'],
            'NomeFuncionario' => mb_convert_case(trim($_POST['NomeFuncionario']), MB_CASE_TITLE),
            'DataNascimentoFuncionario' => $_POST['DataNascimentoFuncionario'],
            'TelefoneFuncionario' => $_POST['TelefoneFuncionario'],
            'Salario' => $_POST['Salario'],
            'Funcao' => $_POST['Funcao'],
            'HorarioEntrada' => $_POST['HorarioEntrada'],
            'HorarioSaida' => $_POST['HorarioSaida'],
            'FuncionarioId' => aes_desencriptar($_POST['FuncionarioId'])
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
                        echo 'Não foi possível atualizar. Telefone já existente.';
                        break;
                        
                    default:
                        echo 'Atualização feita com sucesso!';
                        break;
                }?></h1>
                <p><a href="../../atualizar-funcionario.php" class="voltar">Voltar</a></p>
            </div>
        </main>

        <footer>
            <p>Desenvolvido por <a href="#" target="_blank" rel="external">Thiago Gomes</a></p>
        </footer>
    </body>
</html>