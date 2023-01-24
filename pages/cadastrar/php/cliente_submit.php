<?php

    // Verificar se foi feito um post:
    if($_SERVER['REQUEST_METHOD'] != 'POST'){
        die('Acesso inválido');
    }

    // Verificar existe algum campo em branco:
    if(empty(trim($_POST['NomeCliente'])) || empty(trim($_POST['CpfCliente'])) || empty(trim($_POST['TelefoneCliente'])) || empty(trim($_POST['Logradouro']))
    || empty(trim($_POST['Cidade'])) || empty(trim($_POST['CepCliente'])) || empty(trim($_POST['NumeroEnderecoCliente']))){
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
        'Cep' => $_POST['CepCliente'],
        'Estado' => $_POST['Estado'],
        'Cidade' => mb_convert_case(trim($_POST['Cidade']), MB_CASE_TITLE),
        'Logradouro' => mb_convert_case(trim($_POST['Logradouro']), MB_CASE_TITLE)
    ]);
    if (count($endereco) >= 1) $erroendereco = 1;

    $cep = $select1->select("SELECT * FROM tbEndereco WHERE Cep= :Cep", [
        'Cep' => $_POST['CepCliente']
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

    // Verificar se cidade já é existe:
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
    $endereco = $select5->select("SELECT * FROM tbEndereco WHERE Cep = :CepCliente", ['CepCliente' => $_POST['CepCliente']]);
    // Descobrir qual a PK do cidade:
    $cidadeid = $select6->select("SELECT CidadeId FROM tbCidade WHERE Cidade = :Cidade", ['Cidade' => mb_convert_case(trim($_POST['Cidade']), MB_CASE_TITLE)]); 
    if(count($endereco) == 0 && $erroendereco == null){
        // Inserção de endereços:
        $insert2->insert("INSERT INTO tbEndereco VALUES(:CepCliente, :CidadeId, :Logradouro)", [
            'CepCliente' => $_POST['CepCliente'],
            'CidadeId' => $cidadeid[0]['CidadeId'],
            'Logradouro' => mb_convert_case(trim($_POST['Logradouro']), MB_CASE_TITLE)
        ]);
    }


    // Adicionar Cliente:
    $insert3 = new EasyPDO\EasyPDO();
    $select7 = new EasyPDO\EasyPDO();
    $select8 = new EasyPDO\EasyPDO();

    // Verificar se cliente já existe:
    $cliente = $select7->select("SELECT * FROM tbCliente WHERE Cpf = :CpfCliente", ['CpfCliente' => $_POST['CpfCliente']]);
    // Pegar CEP do endereço
    $cep = $select8->select("SELECT * FROM tbEndereco WHERE Cep = :CepCliente", ['CepCliente' => $_POST['CepCliente']]);
    if(count($cliente) == 0){
        // Inserção de clientes:
        $insert3->insert("INSERT INTO tbCliente VALUES(default, :Cep, :Cpf, :Nome, :DataNascimento, :NumeroEndereco, :Telefone)", [
            'Cep' => $cep[0]['Cep'],
            'Cpf' => $_POST['CpfCliente'],
            'Nome' => mb_convert_case(trim($_POST['NomeCliente']), MB_CASE_TITLE),
            'DataNascimento' => $_POST['DataNascimentoCliente'],
            'NumeroEndereco' => $_POST['NumeroEnderecoCliente'],
            'Telefone' => $_POST['TelefoneCliente'],
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
                <h1 id="sucesso"><?= $erro == 1 ? 'Não foi possível registrar. Cliente já existente' : 'Registro feito com sucesso!'?></h1>
                <p><a href="../cadastrar-cliente.html" class="voltar">Voltar</a></p>
            </div>
        </main>

        <footer>
            <p>Desenvolvido por <a href="#" target="_blank" rel="external">Thiago Gomes</a></p>
        </footer>
    </body>
</html>