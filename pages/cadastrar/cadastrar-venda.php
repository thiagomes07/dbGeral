<?php
    // PDO:
    require_once('../biblioteca/EasyPDO.php');
    $select = new EasyPDO\EasyPDO();
    $select1 = new EasyPDO\EasyPDO();
    $select2 = new EasyPDO\EasyPDO();

    // Variável para erro:
    $erro = null;

    $clientes = $select->select("SELECT Cpf, Nome, ClienteId FROM tbCliente");
    if(count($clientes) == 0) $erro = 1;
    $funcionarios = $select1->select("SELECT Cpf, Nome, FuncionarioId FROM tbFuncionario");
    if(count($funcionarios) == 0) $erro = 1;
    $produtos = $select2->select("SELECT CodigoBarras, Nome FROM tbProduto");
    if(count($produtos) == 0) $erro = 1;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../../images/bd.ico" type="image/x-icon">
    <link rel="stylesheet" href="../../css/estilo.css">
    <link rel="stylesheet" href="../../css/estilo-formulario.css">
    <script language="javascript" src="../biblioteca/mascaras.js"></script>
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
                <li><a href="../../index.html" class="borda-corrigida3 negrito"><img src="../../images/home.png" alt="ícone de Página Inicial" class="icone_botao">Página Inicial</a></li>
                <li><a href="#" class="negrito"><img src="../../images/cadastrar.png" alt="ícone de Cadastro" class="icone_botao">Cadastrar</a>
                    <ul>
                        <li><a href="cadastrar-venda.php" class="borda-corrigida">Venda</a></li>
                        <li><a href="cadastrar-cliente.html" class="borda-corrigida">Cliente</a></li>
                        <li><a href="cadastrar-funcionario.html" class="borda-corrigida">Funcionário</a></li>
                        <li><a href="cadastrar-produto.html" class="borda-corrigida">Produto</a></li>
                        <li><a href="cadastrar-endereco.php" class="borda-corrigida">Endereço</a></li>
                    </ul>
                </li>
                <li><a href="#" class="negrito"><img src="../../images/consultar.png" alt="ícone de Consulta" class="icone_botao">Consultar</a>
                    <ul>
                        <li><a href="../consultar/consultar-venda.php" class="borda-corrigida">Venda</a></li>
                        <li><a href="../consultar/consultar-cliente.php" class="borda-corrigida">Cliente</a></li>
                        <li><a href="../consultar/consultar-funcionario.php" class="borda-corrigida">Funcionário</a></li>
                        <li><a href="../consultar/consultar-produto.php" class="borda-corrigida">Produto</a></li>
                        <li><a href="../consultar/consultar-endereco.php" class="borda-corrigida">Endereço</a></li>
                        <li><a href="../consultar/consultar-endereco-cliente.php" class="borda-corrigida">Endereço de Cliente</a></li>
                        <li><a href="../consultar/consultar-endereco-funcionario.php" class="borda-corrigida">Endereço de Funcionário</a></li>
                    </ul>
                </li>
                <li><a href="#" class="negrito"><img src="../../images/atualizar.png" alt="ícone de Atualização" class="icone_botao">Atualizar</a>
                    <ul>
                        <li><a href="../atualizar/atualizar-venda.php" class="borda-corrigida">Venda</a></li>
                        <li><a href="../atualizar/atualizar-cliente.php" class="borda-corrigida">Cliente</a></li>
                        <li><a href="../atualizar/atualizar-funcionario.php" class="borda-corrigida">Funcionário</a></li>
                        <li><a href="../atualizar/atualizar-produto.php" class="borda-corrigida">Produto</a></li>
                        <li><a href="../atualizar/atualizar-endereco.php" class="borda-corrigida">Endereço</a></li>
                        <li><a href="../atualizar/atualizar-endereco-cliente.php" class="borda-corrigida">Endereço de Cliente</a></li>
                        <li><a href="../atualizar/atualizar-endereco-funcionario.php" class="borda-corrigida">Endereço de Funcionário</a></li>
                    </ul>
                </li>
                <li><a href="#" class="negrito"><img src="../../images/deletar.png" alt="ícone de Exclusão" class="icone_botao">Deletar</a>
                    <ul>
                        <li><a href="../deletar/deletar-venda.php" class="borda-corrigida">Venda</a></li>
                        <li><a href="../deletar/deletar-cliente.php" class="borda-corrigida">Cliente</a></li>
                        <li><a href="../deletar/deletar-funcionario.php" class="borda-corrigida">Funcionário</a></li>
                        <li><a href="../deletar/deletar-produto.php" class="borda-corrigida">Produto</a></li>
                        <li><a href="../deletar/deletar-endereco.php" class="borda-corrigida">Endereço</a></li>
                        <li><a href="../deletar/deletar-endereco-cliente.php" class="borda-corrigida">Endereço e Cliente</a></li>
                        <li><a href="../deletar/deletar-endereco-funcionario.php" class="borda-corrigida">Endereço e Funcionário</a></li>
                    </ul>
                </li>
            </ul>
        </nav>

        <section>
            <article>
                <?php if ($erro == 1) : ?>
                    <p>Não foi encontrado funcionário, cliente ou endereço. Registre no mínimo 1 funcionário, 1 cliente e 1 produto para que seja possível registrar uma venda</p>
                <?php else : ?>
                    <div class="box">
                        <form action="php/venda_submit.php" method="POST">
                            <fieldset>
                                <legend><strong>Cadastro de Venda</strong></legend>
                                <div class="inputBox">
                                    <label for="FuncionarioId">Funcionário</label>
                                    <select name="FuncionarioId" id="FuncionarioId" class="campoespecial">
                                        <?php foreach ($funcionarios as $funcionario) : ?>
                                            <option value="<?= $funcionario['FuncionarioId'] ?>"><?= $funcionario['Nome'] . ', ' . $funcionario['Cpf']?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="inputBox">
                                    <label for="ClienteId">Cliente</label>
                                    <select name="ClienteId" id="ClienteId" class="campoespecial">
                                        <?php foreach ($clientes as $cliente) : ?>
                                            <option value="<?= $cliente['ClienteId'] ?>"><?= $cliente['Nome'] . ', ' . $cliente['Cpf']?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="inputBox">
                                    <label for="DataVenda">Data e Hora da Venda</label>
                                    <input type="datetime-local" name="DataVenda" id="DataVenda" class="campoespecial" required>
                                </div>
                                <div class="inputBox">
                                    <label for="CodigoBarras">Código de Barras</label>
                                    <select name="CodigoBarras" id="CodigoBarras" class="campoespecial">
                                        <?php foreach ($produtos as $produtos) : ?>
                                                <option value="<?= $produtos['CodigoBarras'] ?>"><?= $produtos['Nome']?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="inputBox">
                                    <input type="number" name="Quantidade" id="Quantidade" class="inputUser" min="0" max="65535" onKeyPress="MascaraInteiro(this);" required>
                                    <label for="Quantidade" class="labelInput">Quantidade</label>
                                </div>
                                <div class="inputBox">
                                    <input type="number" name="ValorVenda" id="ValorVenda" class="inputUser" min="0" max="9999999" step="0.01" onKeyPress="MascaraFloat(this);" required>
                                    <label for="ValorVenda" class="labelInput">Valor</label>
                                </div>
                                <input type="reset" value="Limpar" name="limpar" id="submit_limpar">
                                <input type="submit" value="Enviar" name="enviar" id="submit">
                            </fieldset>
                        </form>
                    </div>
                <?php endif; ?>
            </article>
        </section>
    </main>

    <footer>
        <p>Desenvolvido por <a href="#" target="_blank" rel="external">Thiago Gomes</a></p>
    </footer>
</body>
</html>