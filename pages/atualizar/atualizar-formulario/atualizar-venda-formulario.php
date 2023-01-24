<?php
    // Verifica se existe o id:
    if(!isset($_GET['id'])){
        die('Acesso inválido');
    }

    // Criptografia:
    require_once('../../biblioteca/config.php');

    // PDO:
    require_once('../../biblioteca/EasyPDO.php');
    $select = new EasyPDO\EasyPDO(); 
    
    
    $select = new EasyPDO\EasyPDO();
    $select1 = new EasyPDO\EasyPDO();
    $select2 = new EasyPDO\EasyPDO();
    $select3 = new EasyPDO\EasyPDO();

    $clientes = $select->select("SELECT Cpf, Nome, ClienteId FROM tbCliente");
    $funcionarios = $select1->select("SELECT Cpf, Nome, FuncionarioId FROM tbFuncionario");
    $produtos = $select2->select("SELECT CodigoBarras, Nome FROM tbProduto");

    $vendas = $select3->select("SELECT tbVenda.NfId AS NfIdVenda, tbFuncionario.FuncionarioId AS IdFuncionario, tbCliente.ClienteId AS IdCliente, tbFuncionario.Nome AS NomeFuncionario, tbFuncionario.Cpf AS CpfFuncionario, tbCliente.Nome AS NomeCliente, tbCliente.Cpf AS CpfCliente, tbProduto.Nome AS NomeProduto, tbProduto.CodigoBarras AS CodigoBarras, Quantidade, tbItem.Valor AS ValorVenda, DataVenda FROM tbVenda INNER JOIN tbFuncionario on tbVenda.FuncionarioId = tbFuncionario.FuncionarioId INNER JOIN tbCliente on tbVenda.ClienteId = tbCliente.ClienteId INNER JOIN tbItem on tbVenda.NfId = tbItem.NfId INNER JOIN tbProduto on tbItem.CodigoBarras = tbProduto.CodigoBarras WHERE tbVenda.NfId = :NfId", ['NfId' => aes_desencriptar($_GET['id'])])[0]; 

    if(aes_desencriptar($_GET['id']) == -1){ 
        die('Acesso inválido.');
    };
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
                        <form action="submit/venda-submit-update.php" method="POST">
                            <fieldset>
                                <legend><strong>Atualizar Vendas</strong></legend>
                                <input type="hidden" name="NfId" value="<?= aes_encriptar($vendas['NfIdVenda'])?>">
                                <input type="hidden" name="CodigoBarras" value="<?= aes_encriptar($vendas['CodigoBarras'])?>">
                                <div class="inputBox">
                                    <label for="CpfFuncionario">CPF do Funcionário</label>
                                    <select name="CpfFuncionario" id="CpfFuncionario" class="campoespecial">
                                        <option value="<?= $vendas['IdFuncionario'] ?>"><?= $vendas['NomeFuncionario'] . ', ' . $vendas['CpfFuncionario']?></option>
                                        <?php foreach ($funcionarios as $funcionario) : ?>
                                            <?php if ($vendas['IdFuncionario'] != $funcionario['FuncionarioId']) : ?>
                                                <option value="<?= $funcionario['FuncionarioId'] ?>"><?= $funcionario['Nome'] . ', ' . $funcionario['Cpf']?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="inputBox">
                                    <label for="CpfCliente">CPF do Cliente</label>
                                    <select name="CpfCliente" id="CpfCliente" class="campoespecial">
                                        <option value="<?= $vendas['IdCliente'] ?>"><?= $vendas['NomeCliente'] . ', ' . $vendas['CpfCliente']?></option>
                                        <?php foreach ($clientes as $cliente) : ?>
                                            <?php if ($vendas['IdCliente'] != $cliente['ClienteId']) : ?>
                                                <option value="<?= $cliente['ClienteId'] ?>"><?= $cliente['Nome'] . ', ' . $cliente['Cpf']?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="inputBox">
                                    <label for="DataVenda">Data e Hora da Venda</label>
                                    <input type="datetime-local" name="DataVenda" id="DataVenda" class="campoespecial" value="<?= str_replace(' ', 'T', $vendas['DataVenda']); ?>" required>
                                </div>
                                <div class="inputBox">
                                    <label for="CodigoBarras">Código de Barras</label>
                                    <select name="CodigoBarrasNovo" id="CodigoBarras" class="campoespecial">
                                        <option value="<?= $vendas['CodigoBarras'] ?>"><?= $vendas['NomeProduto']?></option>
                                        <?php foreach ($produtos as $produtos) : ?>
                                            <?php if ($vendas['CodigoBarras'] != $produtos['CodigoBarras']) : ?>
                                                <option value="<?= $produtos['CodigoBarras'] ?>"><?= $produtos['Nome']?></option>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="inputBox">
                                    <input type="number" name="Quantidade" id="Quantidade" class="inputUser" min="0" max="65535" onKeyPress="MascaraInteiro(this);" value="<?= $vendas['Quantidade'] ?>" required>
                                    <label for="Quantidade" class="labelInput">Quantidade</label>
                                </div>
                                <div class="inputBox">
                                    <input type="number" name="ValorVenda" id="ValorVenda" class="inputUser" min="0" max="9999999" step="0.01" onKeyPress="MascaraFloat(this);" value="<?= $vendas['ValorVenda'] ?>" required>
                                    <label for="ValorVenda" class="labelInput">Valor</label>
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