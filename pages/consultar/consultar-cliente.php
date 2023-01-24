<?php
    // PDO:
    require_once('../biblioteca/EasyPDO.php');
    $select = new EasyPDO\EasyPDO();

    // Verifica se foi feito um post para decidir qual consulta será feita:
    if(isset($_POST['CpfCliente'])){
        // Consulta com filtro:
        $clientes = $select->select("SELECT * FROM tbCliente WHERE Cpf= :CpfCliente ORDER BY Nome", ['CpfCliente' => $_POST['CpfCliente']]);
    }else{
        // Consulta sem filtro:
        $clientes = $select->select("SELECT * FROM tbCliente ORDER BY Nome");
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
        col.nome{
            width: 280px;
        }
        col.cpf{
            width: 105px;
        }

        col.telefone{
            width: 110px;
        }

        col.datanasc{
            width: 95px;
        }

        col.cep{
            width: 80px;
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
                        <li><a href="consultar-venda.php" class="borda-corrigida">Venda</a></li>
                        <li><a href="consultar-cliente.php" class="borda-corrigida">Cliente</a></li>
                        <li><a href="consultar-funcionario.php" class="borda-corrigida">Funcionário</a></li>
                        <li><a href="consultar-produto.php" class="borda-corrigida">Produto</a></li>
                        <li><a href="consultar-endereco.php" class="borda-corrigida">Endereço</a></li>
                        <li><a href="consultar-endereco-cliente.php" class="borda-corrigida">Endereço Cliente</a></li>
                        <li><a href="consultar-endereco-funcionario.php" class="borda-corrigida">Endereço Funcionário</a></li>
                    </ul>
                </li>
                <li><a href="#" class="negrito"><img src="../../images/atualizar.png" alt="ícone de Atualização" class="icone_botao">Atualizar</a>
                    <ul>
                        <li><a href="../atualizar/atualizar-venda.php" class="borda-corrigida">Venda</a></li>
                        <li><a href="../atualizar/atualizar-cliente.php" class="borda-corrigida">Cliente</a></li>
                        <li><a href="../atualizar/atualizar-funcionario.php" class="borda-corrigida">Funcionário</a></li>
                        <li><a href="../atualizar/atualizar-produto.php" class="borda-corrigida">Produto</a></li>
                        <li><a href="../atualizar/atualizar-endereco.php" class="borda-corrigida">Endereço</a></li>
                        <li><a href="../atualizar/atualizar-endereco-cliente.php" class="borda-corrigida">Endereço Cliente</a></li>
                        <li><a href="../atualizar/atualizar-endereco-funcionario.php" class="borda-corrigida">Endereço Funcionário</a></li>
                    </ul>
                </li>
                <li><a href="#" class="negrito"><img src="../../images/deletar.png" alt="ícone de Exclusão" class="icone_botao">Deletar</a>
                    <ul>
                        <li><a href="../deletar/deletar-venda.php" class="borda-corrigida">Venda</a></li>
                        <li><a href="../deletar/deletar-cliente.php" class="borda-corrigida">Cliente</a></li>
                        <li><a href="../deletar/deletar-funcionario.php" class="borda-corrigida">Funcionário</a></li>
                        <li><a href="../deletar/deletar-produto.php" class="borda-corrigida">Produto</a></li>
                        <li><a href="../deletar/deletar-endereco.php" class="borda-corrigida">Endereço</a></li>
                        <li><a href="../deletar/deletar-endereco-cliente.php" class="borda-corrigida">Endereço Cliente</a></li>
                        <li><a href="../deletar/deletar-endereco-funcionario.php" class="borda-corrigida">Endereço Funcionário</a></li>
                    </ul>
                </li>
            </ul>
        </nav>

        <section>
            <article>
                <div class="box">
                    <form action="consultar-cliente.php" method="POST">
                        <fieldset>
                            <!-- Aplicação de filtro -->
                            <legend><strong>Pesquisar Clientes</strong></legend>
                            <div class="inputBox">
                                <input type="text" name="CpfCliente" id="CpfCliente" class="inputUser" maxlength="14"
                                    onKeyPress="MascaraGenerica(this, 'CPF');" required>
                                <label for="CpfCliente" class="labelInput">Filtrar pelo CPF</label>
                            </div>
                            <input type="submit" value="Filtrar" name="enviar" id="submit">
                        </fieldset>
                    </form>
                </div>

                <hr>

                <?php if(count($clientes) == 0):?>
                    <p>Não foram encontrados clientes.</p>
                <?php else:?>
                    <div class="rolagem">
                        <table>
                            <colgroup>
                                <col class="nome">
                                <col class="cpf">
                                <col class="telefone">
                                <col class="datanasc">
                                <col class="cep">
                            </colgroup> 
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>CPF</th>
                                    <th>Telefone</th>
                                    <th>Data de Nascimento</th>
                                    <th>CEP</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($clientes as $cliente): ?>
                                <tr>
                                    <td>
                                        <?= $cliente['Nome']?>
                                    </td>
                                    <td>
                                        <?= $cliente['Cpf']?>
                                    </td>
                                    <td>
                                        <?= $cliente['Telefone']?>
                                    </td>
                                    <td>
                                        <?php
                                            // Formatação da data
                                            $data = explode('-', $cliente['DataNascimento']);
                                            echo $data[2] . '/' . $data[1] . '/' . $data[0]
                                        ?>
                                    </td>
                                    <td>
                                        <?= $cliente['Cep']?>
                                    </td>
                                </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                <?php endif;?>
            </article>
        </section>
    </main>

    <footer>
        <p>Desenvolvido por <a href="#" target="_blank" rel="external">Thiago Gomes</a></p>
    </footer>
</body>

</html>