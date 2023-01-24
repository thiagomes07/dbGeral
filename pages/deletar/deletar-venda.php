<?php
    // PDO:
    require_once('../biblioteca/EasyPDO.php');

    $select = new EasyPDO\EasyPDO();
    $select1 = new EasyPDO\EasyPDO();
    $select2 = new EasyPDO\EasyPDO();
    $select3 = new EasyPDO\EasyPDO();
    $select4 = new EasyPDO\EasyPDO();
    $select5 = new EasyPDO\EasyPDO();
    $select6 = new EasyPDO\EasyPDO();

    // Verifica se foi feito um post para decidir qual consulta será feita:
    if(isset($_POST['CpfFuncionario']) && isset($_POST['CpfCliente']) && isset($_POST['CodigoBarras']) && isset($_POST['DataVenda'])){
        // Consulta com filtro:

        // Pegar id do funcionário pelo cpf:
        $funcionarioid = $select->select("SELECT FuncionarioId FROM tbFuncionario WHERE Cpf = :CpfFuncionario", ['CpfFuncionario' => $_POST['CpfFuncionario']]);

        // Pegar id do cliente pelo cpf:
        $clienteid = $select1->select("SELECT ClienteId FROM tbCliente WHERE Cpf = :CpfCliente", ['CpfCliente' => $_POST['CpfCliente']]);

        $vendas = $select2->select("SELECT tbVenda.NfId AS NfIdVenda, tbFuncionario.Nome AS NomeFuncionario, tbFuncionario.Cpf AS CpfFuncionario, tbCliente.Nome AS NomeCliente, tbCliente.Cpf AS CpfCliente, tbProduto.Nome AS NomeProduto, Quantidade, tbItem.Valor AS ValorVenda, DataVenda, tbItem.CodigoBarras FROM tbVenda INNER JOIN tbFuncionario on tbVenda.FuncionarioId = tbFuncionario.FuncionarioId INNER JOIN tbCliente on tbVenda.ClienteId = tbCliente.ClienteId INNER JOIN tbItem on tbVenda.NfId = tbItem.NfId INNER JOIN tbProduto on tbItem.CodigoBarras = tbProduto.CodigoBarras ORDER BY DataVenda WHERE FuncionarioId= :FuncionarioId AND ClienteId= :ClienteId ORDER BY DataVenda", [
            'FuncionarioId' => $funcionarioid[0]['FuncionarioId'],
            'ClienteId' => $clienteid[0]['ClienteId']
        ]);
    }else{
        // Consulta sem filtro:
        $vendas = $select3->select("SELECT tbVenda.NfId AS NfIdVenda, tbFuncionario.Nome AS NomeFuncionario, tbFuncionario.Cpf AS CpfFuncionario, tbCliente.Nome AS NomeCliente, tbCliente.Cpf AS CpfCliente, tbProduto.Nome AS NomeProduto, Quantidade, tbItem.Valor AS ValorVenda, DataVenda, tbItem.CodigoBarras FROM tbVenda INNER JOIN tbFuncionario on tbVenda.FuncionarioId = tbFuncionario.FuncionarioId INNER JOIN tbCliente on tbVenda.ClienteId = tbCliente.ClienteId INNER JOIN tbItem on tbVenda.NfId = tbItem.NfId INNER JOIN tbProduto on tbItem.CodigoBarras = tbProduto.CodigoBarras ORDER BY DataVenda");
    }
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
    <link rel="stylesheet" href="../../css/estilo-tabela.css">
    <script language="javascript" src="../biblioteca/mascaras.js"></script>
    <style>
        col.deletar{
            width: 63px;
        }

        col.cpfvendedor{
            width: 105px;
        }

        col.nomecliente{
            width: 150px;
        }

        col.cpfcliente{
            width: 105px;
        }

        col.produto{
            width: 175px;
        } 

        col.quantidade{
            width: 93px;
        }

        col.valor{
            width: 90px;
        }

        col.datahora{
            width: 135px;
        }
    </style>
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
                        <li><a href="../cadastrar/cadastrar-venda.php" class="borda-corrigida">Venda</a></li>
                        <li><a href="../cadastrar/cadastrar-cliente.html" class="borda-corrigida">Cliente</a></li>
                        <li><a href="../cadastrar/cadastrar-funcionario.html" class="borda-corrigida">Funcionário</a></li>
                        <li><a href="../cadastrar/cadastrar-produto.html" class="borda-corrigida">Produto</a></li>
                        <li><a href="../cadastrar/cadastrar-endereco.php" class="borda-corrigida">Endereço</a></li>
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
                        <li><a href="deletar-venda.php" class="borda-corrigida">Venda</a></li>
                        <li><a href="deletar-cliente.php" class="borda-corrigida">Cliente</a></li>
                        <li><a href="deletar-funcionario.php" class="borda-corrigida">Funcionário</a></li>
                        <li><a href="deletar-produto.php" class="borda-corrigida">Produto</a></li>
                        <li><a href="deletar-endereco.php" class="borda-corrigida">Endereço</a></li>
                        <li><a href="deletar-endereco-cliente.php" class="borda-corrigida">Endereço e Cliente</a></li>
                        <li><a href="deletar-endereco-funcionario.php" class="borda-corrigida">Endereço e Funcionário</a></li>
                    </ul>
                </li>
            </ul>
        </nav>

        <section>
            <article>
                <div class="box">
                    <form action="consultar-venda.php" method="POST">
                        <fieldset>
                            <!-- Aplicação de filtro -->
                            <legend><strong>Pesquisar Vendas</strong></legend>
                            <div class="inputBox">
                                <input type="text" name="CpfFuncionario" id="CpfFuncionario" class="inputUser" maxlength="14" onKeyPress="MascaraGenerica(this, 'CPF');" required>
                                <label for="CpfFuncionario" class="labelInput">CPF do Funcionário</label>
                            </div>
                            <div class="inputBox">
                                <input type="text" name="CpfCliente" id="CpfCliente" class="inputUser" maxlength="14" onKeyPress="MascaraGenerica(this, 'CPF');" required>
                                <label for="CpfCliente" class="labelInput">CPF do Cliente</label>
                            </div>
                            <input type="submit" value="Filtrar" name="enviar" id="submit">
                        </fieldset>
                    </form>
                </div>

                <hr>

                <?php if (count($vendas) == 0) : ?>
                    <p>Não foram encontradas vendas.</p>
                <?php else : ?>
                    <div class="rolagem">
                        <table>
                            <colgroup>
                                <col class="deletar">
                                <col class="nomevendedor">
                                <col class="cpfvendedor">
                                <col class="nomecliente">
                                <col class="cpfcliente">
                                <col class="produto">
                                <col class="quantidade">
                                <col class="valor">
                                <col class="datahora">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th>Deletar</th>
                                    <th>Nome do Vendedor</th>
                                    <th>CPF do Vendedor</th>
                                    <th>Nome do Cliente</th>
                                    <th>CPF do Cliente</th>
                                    <th>Produto</th>
                                    <th>Quantidade</th>
                                    <th>Valor</th>
                                    <th>Data e hora</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($vendas as $venda) : ?>
                                    <tr>
                                        <td>
                                            <!-- Link com criptografia para atualizar os dados: -->
                                            <a href="deletar-submit/deletar-venda-submit.php?nfid=<?= aes_encriptar($venda['NfIdVenda']) . ';' . aes_encriptar($venda['CodigoBarras'])?>" class="imgdel"><img src="../../images/deletar-peq.png" alt="ícone de Cadastro" class="icone_botao_peq"></a>
                                        </td>
                                        <td>
                                            <?= $venda['NomeFuncionario'];?>
                                        </td>
                                        <td>
                                            <?= $venda['CpfFuncionario'];?>
                                        </td>
                                        <td>
                                            <?= $venda['NomeCliente'];?>
                                        </td>
                                        <td>
                                            <?= $venda['CpfCliente'];?>
                                        </td>
                                        <td>
                                            <?= $venda['NomeProduto']; ?>
                                        </td>
                                        <td>
                                            <?= $venda['Quantidade']; ?>
                                        </td>
                                        <td>
                                            <?= 'R$ ' . number_format($venda['ValorVenda'], 2, ',', '.'); ?>
                                        </td>
                                        <td>
                                            <?php
                                            // Formatação de data e hora
                                            $data = strstr($venda['DataVenda'], ' ', true);
                                            $data1 = explode('-', $data);
                                            $hora = strstr($venda['DataVenda'], ' ');
                                            $hora = strstr($hora, ':00', true);
                                            echo $data1[2] . '/' . $data1[1] . '/' . $data1[0] . ' ás ' . $hora; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
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