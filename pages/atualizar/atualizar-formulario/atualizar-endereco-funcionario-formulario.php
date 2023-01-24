<?php
    // Verifica se existe o id:
    if (!isset($_GET['id'])) {
        die('Acesso inválido');
    }

    // Criptografia:
    require_once('../../biblioteca/config.php');

    // PDO:
    require_once('../../biblioteca/EasyPDO.php');
    $select = new EasyPDO\EasyPDO();
    $select1 = new EasyPDO\EasyPDO();

    // Pegar o endereço do funcionario especificado:
    $endereco = $select->select("SELECT * FROM tbFuncionario INNER JOIN tbEndereco ON tbFuncionario.Cep = tbEndereco.Cep
        INNER JOIN tbCidade ON tbEndereco.CidadeId = tbCidade.CidadeId INNER JOIN tbEstado ON tbCidade.EstadoId = tbEstado.EstadoId
        WHERE FuncionarioId = :FuncionarioId", ['FuncionarioId' => aes_desencriptar($_GET['id'])])[0];

    if (aes_desencriptar($_GET['id']) == -1) {
        die('Acesso inválido.');
    };

    $ceps = $select1->select("SELECT Cep, Logradouro, Estado, Cidade FROM tbEndereco INNER JOIN tbCidade ON tbEndereco.CidadeId = tbCidade.CidadeId INNER JOIN tbEstado ON tbCidade.EstadoId = tbEstado.EstadoId");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../../images/bd.ico" type="image/x-icon">
    <link rel="stylesheet" href="../../../css/estilo.css">
    <link rel="stylesheet" href="../../../css/estilo-formulario.css">
    <script language="javascript" src="../../biblioteca/mascaras.js"></script>
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
        <nav id="menu">
            <ul>
                <li><a href="../../../index.html" class="borda-corrigida3 negrito"><img src="../../../images/home.png" alt="ícone de Página Inicial" class="icone_botao">Página Inicial</a></li>
                <li><a href="#" class="negrito"><img src="../../../images/cadastrar.png" alt="ícone de Cadastro" class="icone_botao">Cadastrar</a>
                    <ul>
                        <li><a href="../../cadastrar/cadastrar-venda.php" class="borda-corrigida">Venda</a></li>
                        <li><a href="../../cadastrar/cadastrar-cliente.html" class="borda-corrigida">Cliente</a></li>
                        <li><a href="../../cadastrar/cadastrar-funcionario.html" class="borda-corrigida">Funcionário</a></li>
                        <li><a href="../../cadastrar/cadastrar-produto.html" class="borda-corrigida">Produto</a></li>
                        <li><a href="../../cadastrar/cadastrar-endereco.php" class="borda-corrigida">Endereço</a></li>
                    </ul>
                </li>
                <li><a href="#" class="negrito"><img src="../../../images/consultar.png" alt="ícone de Consulta" class="icone_botao">Consultar</a>
                    <ul>
                        <li><a href="../../consultar/consultar-venda.php" class="borda-corrigida">Venda</a></li>
                        <li><a href="../../consultar/consultar-cliente.php" class="borda-corrigida">Cliente</a></li>
                        <li><a href="../../consultar/consultar-funcionario.php" class="borda-corrigida">Funcionário</a></li>
                        <li><a href="../../consultar/consultar-produto.php" class="borda-corrigida">Produto</a></li>
                        <li><a href="../../consultar/consultar-endereco.php" class="borda-corrigida">Endereço</a></li>
                        <li><a href="../../consultar/consultar-endereco-cliente.php" class="borda-corrigida">Endereço de Cliente</a></li>
                        <li><a href="../../consultar/consultar-endereco-funcionario.php" class="borda-corrigida">Endereço de Funcionário</a></li>
                    </ul>
                </li>
                <li><a href="#" class="negrito"><img src="../../../images/atualizar.png" alt="ícone de Atualização" class="icone_botao">Atualizar</a>
                    <ul>
                        <li><a href="../atualizar-venda.php" class="borda-corrigida">Venda</a></li>
                        <li><a href="../atualizar-cliente.php" class="borda-corrigida">Cliente</a></li>
                        <li><a href="../atualizar-funcionario.php" class="borda-corrigida">Funcionário</a></li>
                        <li><a href="../atualizar-produto.php" class="borda-corrigida">Produto</a></li>
                        <li><a href="../atualizar-endereco.php" class="borda-corrigida">Endereço</a></li>
                        <li><a href="../atualizar-endereco-cliente.php" class="borda-corrigida">Endereço de Cliente</a></li>
                        <li><a href="../atualizar-endereco-funcionario.php" class="borda-corrigida">Endereço de Funcionário</a></li>
                    </ul>
                </li>
                <li><a href="#" class="negrito"><img src="../../../images/deletar.png" alt="ícone de Exclusão" class="icone_botao">Deletar</a>
                    <ul>
                        <li><a href="../../deletar/deletar-venda.php" class="borda-corrigida">Venda</a></li>
                        <li><a href="../../deletar/deletar-cliente.php" class="borda-corrigida">Cliente</a></li>
                        <li><a href="../../deletar/deletar-funcionario.php" class="borda-corrigida">Funcionário</a></li>
                        <li><a href="../../deletar/deletar-produto.php" class="borda-corrigida">Produto</a></li>
                        <li><a href="../../deletar/deletar-endereco.php" class="borda-corrigida">Endereço</a></li>
                        <li><a href="../../deletar/deletar-endereco-cliente.php" class="borda-corrigida">Endereço e Cliente</a></li>
                        <li><a href="../../deletar/deletar-endereco-funcionario.php" class="borda-corrigida">Endereço e Funcionário</a></li>
                    </ul>
                </li>
            </ul>
        </nav>

        <section>
            <article>
                <div class="box">
                    <form action="submit/endereco-funcionario-submit-update.php" method="POST">
                        <fieldset>
                            <legend><strong>Atualizar Endereços de Funcionários</strong></legend>
                            <input type="hidden" name="FuncionarioId" value="<?= aes_encriptar($endereco['FuncionarioId'])?>">
                            <div class="inputBox">
                                <input type="text" name="NomeFuncionario" id="NomeFuncionario" class="inputUser" maxlength="100" value="<?= $endereco['Nome'] ?>" readonly>
                                <label for="NomeFuncionario" class="labelInputValido">Nome</label>
                            </div>
                            <div class="inputBox">
                                <input type="text" name="CpfFuncionario" id="CpfFuncionario" class="inputUser" maxlength="14" onKeyPress="MascaraGenerica(this, 'CPF');" value="<?= $endereco['Cpf'] ?>" readonly valid>
                                <label for="CpfFuncionario" class="labelInputValido">CPF</label>
                            </div>
                            <div class="inputBox">
                                <input type="tel" name="TelefoneFuncionario" id="TelefoneFuncionario" class="inputUser" maxlength="15" onKeyPress="MascaraGenerica(this, 'TELEFONE');" value="<?= $endereco['Telefone'] ?>" readonly>
                                <label for="TelefoneFuncionario" class="labelInputValido">Número de Telefone</label>
                            </div>
                            <div class="inputBox">
                                <label for="DataNascimentoFuncionario">Data de Nascimento</label>
                                <input type="date" name="DataNascimentoFuncionario" id="DataNascimentoFuncionario" class="campoespecial" value="<?= $endereco['DataNascimento'] ?>" readonly>
                            </div>

                            <legend><strong>Endereço</strong></legend>

                            <div class="inputBox">
                                <label for="CepFuncionario">CEP, Logradouro, Cidade e Estado</label>
                                <select name="CepFuncionario" id="CepFuncionario" class="campoespecial">
                                    <option value="<?= $endereco['Cep'] ?>" selected><?= $endereco['Cep'] . ', ' . $endereco['Logradouro'] . ', ' . $endereco['Cidade'] . ', ' . $endereco['Estado'] ?></option>
                                    <?php foreach ($ceps as $cep) : ?>
                                        <?php if ($endereco['Cep'] != $cep['Cep']) : ?>
                                            <option value="<?= $cep['Cep'] ?>"><?= $cep['Cep'] . ', ' . $cep['Logradouro'] . ', ' . $cep['Cidade'] . ', ' . $cep['Estado'] ?></option>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="inputBox">
                                <input type="number" name="NumeroEnderecoFuncionario" id="NumeroEnderecoFuncionario" class="inputUser" min="0" max="65535" onKeyPress="MascaraInteiro(this);" value="<?= $endereco['NumeroEndereco'] ?>" required>
                                <label for="NumeroEnderecoFuncionario" class="labelInput">Número de Endereço</label>
                            </div>
                            <input type="reset" value="Resetar" name="limpar" id="submit_limpar">
                            <input type="submit" value="Atualizar" name="enviar" id="submit">
                        </fieldset>
                    </form>
                </div>
            </article>
        </section>
    </main>

    <footer>
        <p>Desenvolvido por <a href="#" target="_blank" rel="external">Thiago Gomes</a></p>
    </footer>
</body>

</html>