<?php

    // Verificar se foi feito um post:
    if($_SERVER['REQUEST_METHOD'] != 'POST'){
        die('Acesso inválido');
    }

    // Verificar existe algum campo em branco:
    if(empty(trim($_POST['NomeFuncionario'])) || empty(trim($_POST['CpfFuncionario'])) || empty(trim($_POST['TelefoneFuncionario'])) || empty(trim($_POST['Salario'])) 
    || empty(trim($_POST['Funcao'])) || empty(trim($_POST['Logradouro'])) || empty(trim($_POST['Cidade'])) || empty(trim($_POST['CepFuncionario'])) 
    || empty(trim($_POST['NumeroEnderecoFuncionario']))){
        die('Algum campo foi preenchido com espaços');
    }

    // Variável para erro:
    $erro = null;
    $erroendereco = null;

    require_once('../../biblioteca/EasyPDO.php');

    
    // Verificar se endereço ou cep já existem
    $select = new EasyPDO\EasyPDO();
    $select1 = new EasyPDO\EasyPDO();
    
    $endereco = $select->select("SELECT * FROM tbEndereco INNER JOIN tbCidade ON tbEndereco.CidadeId = tbCidade.CidadeId INNER JOIN tbEstado ON tbCidade.EstadoId = tbEstado.EstadoId WHERE Cep= :Cep AND Estado= :Estado AND Cidade= :Cidade AND Logradouro= :Logradouro", [
        'Cep' => $_POST['CepFuncionario'],
        'Estado' => $_POST['Estado'],
        'Cidade' => mb_convert_case(trim($_POST['Cidade']), MB_CASE_TITLE),
        'Logradouro' => mb_convert_case(trim($_POST['Logradouro']), MB_CASE_TITLE)
    ]);
    if (count($endereco) >= 1) $erroendereco = 1;

    $cep = $select1->select("SELECT * FROM tbEndereco WHERE Cep= :Cep", [
        'Cep' => $_POST['CepFuncionario']
    ]);
    if (count($cep) >= 1) $erroendereco = 1;


    // Adicionar Estado:
    $insert = new EasyPDO\EasyPDO();
    $select2 = new EasyPDO\EasyPDO();

    // Verificar se estado já existe:
    $estado = $select2->select("SELECT * FROM tbEstado WHERE Estado = :Estado", ['Estado' => $_POST['Estado']]);
    if(count($estado) == 0 && $erroendereco == null){
        // Inserção de estados:
        $insert->insert("INSERT INTO tbEstado VALUES(default, :Estado)", [
            'Estado' => $_POST['Estado']
        ]);
    }


    // Adicionar cidade:
    $insert1 = new EasyPDO\EasyPDO();
    $select3 = new EasyPDO\EasyPDO();
    $select4 = new EasyPDO\EasyPDO();

    // Verificar se cidade já existe:
    $cidade = $select3->select("SELECT * FROM tbCidade WHERE Cidade = :Cidade", ['Cidade' => mb_convert_case(trim($_POST['Cidade']), MB_CASE_TITLE)]);
    // Descobrir qual a PK do estado:
    $estadoid = $select4->select("SELECT EstadoId FROM tbEstado WHERE Estado = :Estado", ['Estado' => $_POST['Estado']]);
    if(count($cidade) == 0 && $erroendereco == null){
        // Inserção de cidades:
        $insert1->insert("INSERT INTO tbCidade VALUES(default, :EstadoId, :Cidade)", [
            'EstadoId' => $estadoid[0]['EstadoId'],
            'Cidade' => mb_convert_case(trim($_POST['Cidade']), MB_CASE_TITLE)
        ]);
    }


    // Adicionar Endereço:
    $insert2 = new EasyPDO\EasyPDO();
    $select5 = new EasyPDO\EasyPDO();
    $select6 = new EasyPDO\EasyPDO();

    // Verificar se endereço já existe:
    $endereco = $select5->select("SELECT * FROM tbEndereco WHERE Cep = :CepFuncionario", ['CepFuncionario' => $_POST['CepFuncionario']]);
    // Descobrir qual a PK do cidade:
    $cidadeid = $select6->select("SELECT CidadeId FROM tbCidade WHERE Cidade = :Cidade", ['Cidade' => ucwords(trim($_POST['Cidade']))]); 
    if(count($endereco) == 0 && $erroendereco == null){
        // Inserção de endereços:
        $insert2->insert("INSERT INTO tbEndereco VALUES(:Cep, :CidadeId, :Logradouro)", [
            'Cep' => $_POST['CepFuncionario'],
            'CidadeId' => $cidadeid[0]['CidadeId'],
            'Logradouro' => mb_convert_case(trim($_POST['Logradouro']), MB_CASE_TITLE)
        ]);
    }


    // Adicionar Funcionário:
    $insert3 = new EasyPDO\EasyPDO();
    $select5 = new EasyPDO\EasyPDO();
    $select6 = new EasyPDO\EasyPDO();

    // Verificar se funcionário já existe:
    $funcionario = $select5->select("SELECT * FROM tbFuncionario WHERE Cpf = :CpfFuncionario", ['CpfFuncionario' => $_POST['CpfFuncionario']]);
    // Pegar CEP do endereço
    $cep = $select6->select("SELECT * FROM tbEndereco WHERE Cep = :CepFuncionario", ['CepFuncionario' => $_POST['CepFuncionario']]);
    if(count($funcionario) == 0){
        // Adicionar funcionário:
        $insert3->insert("INSERT INTO tbFuncionario VALUES(default, :Cep, :Cpf, :Nome, :DataNascimento, :NumeroEndereco, :Telefone, :Funcao, :Salario, :HorarioEntrada, :HorarioSaida)", [
            'Cep' => $cep[0]['Cep'],
            'Cpf' => $_POST['CpfFuncionario'],
            'Nome' => mb_convert_case(trim($_POST['NomeFuncionario']), MB_CASE_TITLE),
            'DataNascimento' => $_POST['DataNascimentoFuncionario'],
            'NumeroEndereco' => $_POST['NumeroEnderecoFuncionario'],
            'Telefone' => $_POST['TelefoneFuncionario'],
            'Funcao' => mb_convert_case(trim($_POST['Funcao']), MB_CASE_TITLE),
            'Salario' => $_POST['Salario'],
            'HorarioEntrada' => $_POST['HorarioEntrada'],
            'HorarioSaida' => $_POST['HorarioSaida']
        ]);
    }else{
        // Cliente já inserido:
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
                <h1 id="sucesso"><?= $erro == 1 ? 'Não foi possível registrar. Funcionário já existente' : 'Registro feito com sucesso!'?></h1>
                <p><a href="../cadastrar-funcionario.html" class="voltar">Voltar</a></p>
            </div>
        </main>

        <footer>
            <p>Desenvolvido por <a href="#" target="_blank" rel="external">Thiago Gomes</a></p>
        </footer>
    </body>
</html>