<?php
    // Verificar se foi feito um post:
    if($_SERVER['REQUEST_METHOD'] != 'POST'){
        die('Acesso inválido');
    }

    // Verificar existe algum campo em branco:
    if(empty(trim($_POST['Logradouro'])) || empty(trim($_POST['Cidade']))){
        die('Algum campo foi preenchido com espaços');
    }

    // PDO:
    require_once('../../../biblioteca/EasyPDO.php');
    $update = new EasyPDO\EasyPDO(); 
    $insert = new EasyPDO\EasyPDO();
    $insert1 = new EasyPDO\EasyPDO();
    $select = new EasyPDO\EasyPDO();
    $select1 = new EasyPDO\EasyPDO();
    $select2 = new EasyPDO\EasyPDO();
    $select3 = new EasyPDO\EasyPDO();

    // Variável para erro:
    $erroendereco = null;

    $endereco = $select->select("SELECT * FROM tbEndereco INNER JOIN tbCidade ON tbEndereco.CidadeId = tbCidade.CidadeId INNER JOIN tbEstado ON tbCidade.EstadoId = tbEstado.EstadoId WHERE Cep= :Cep AND Estado= :Estado AND Cidade= :Cidade AND Logradouro= :Logradouro", [
        'Cep' => $_POST['Cep'],
        'Estado' => $_POST['Estado'],
        'Cidade' => mb_convert_case(trim($_POST['Cidade']), MB_CASE_TITLE),
        'Logradouro' => mb_convert_case(trim($_POST['Logradouro']), MB_CASE_TITLE)
    ]);
    if (count($endereco) >= 1) $erroendereco = 1;

    
    // Atualizar Estado:
    // Verificar se estado já é existe:
    $estado = $select1->select("SELECT * FROM tbEstado WHERE Estado = :Estado", ['Estado' => $_POST['Estado']]);
    if(count($estado) == 0 && $erroendereco == null){
        // Inserção de estados:
        $insert->insert("INSERT INTO tbEstado VALUES(default, :Estado)", [
            'Estado' => $_POST['Estado']
        ]);
    }

    // Verificar se cidade já é existe:
    $cidade = $select2->select("SELECT * FROM tbCidade WHERE Cidade = :Cidade", ['Cidade' => mb_convert_case(trim($_POST['Cidade']), MB_CASE_TITLE)]);
    // Descobrir qual a PK do estado:
    $estadoid = $select3->select("SELECT EstadoId FROM tbEstado WHERE Estado = :Estado", ['Estado' => $_POST['Estado']]);
    if(count($cidade) == 0 && $erroendereco == null){
        // Inserção de cidades:
        $insert1->insert("INSERT INTO tbCidade VALUES(default, :EstadoId, :Cidade)", [
            'EstadoId' => $estadoid[0]['EstadoId'],
            'Cidade' => mb_convert_case(trim($_POST['Cidade']), MB_CASE_TITLE)
        ]);
    }


    // Atualização de dados:
    if($erroendereco == null){
        $update->update("UPDATE tbEndereco INNER JOIN tbCidade ON tbEndereco.CidadeId = tbCidade.CidadeId INNER JOIN tbEstado ON tbCidade.EstadoId = tbEstado.EstadoId SET `Logradouro`=:Logradouro, `Cidade`=:Cidade, `Estado`=:Estado WHERE `Cep`=:Cep", [
            'Cep' => $_POST['Cep'],
            'Logradouro' => mb_convert_case(trim($_POST['Logradouro']), MB_CASE_TITLE),
            'Cidade' => mb_convert_case(trim($_POST['Cidade']), MB_CASE_TITLE),
            'Estado' => $_POST['Estado']
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
                <h1 id="sucesso"><?= $erroendereco == 1 ? 'Não foi possível atualizar. Endereço já existente' : 'Atualização feita com sucesso!'?></h1>
                <p><a href="../../atualizar-endereco.php" class="voltar">Voltar</a></p>
            </div>
        </main>

        <footer>
            <p>Desenvolvido por <a href="#" target="_blank" rel="external">Thiago Gomes</a></p>
        </footer>
    </body>
</html>