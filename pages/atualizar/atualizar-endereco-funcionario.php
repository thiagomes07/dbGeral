<?php
    // PDO:
    require_once('../biblioteca/EasyPDO.php');
    $select = new EasyPDO\EasyPDO();

    // Verifica se foi feito um post para decidir qual consulta será feita:
    if(isset($_POST['CpfFuncionario'])){
        $enderecos = $select->select("SELECT * FROM tbFuncionario INNER JOIN tbEndereco ON tbFuncionario.Cep = tbEndereco.Cep
        INNER JOIN tbCidade ON tbEndereco.CidadeId = tbCidade.CidadeId INNER JOIN tbEstado ON tbCidade.EstadoId = tbEstado.EstadoId WHERE Cpf= :CpfFuncionario ORDER BY Nome", [
            'CpfFuncionario' => $_POST['CpfFuncionario']
        ]);
    }else{
        // Consulta com filtro:
        $enderecos = $select->select("SELECT * FROM tbFuncionario INNER JOIN tbEndereco ON tbFuncionario.Cep = tbEndereco.Cep
        INNER JOIN tbCidade ON tbEndereco.CidadeId = tbCidade.CidadeId INNER JOIN tbEstado ON tbCidade.EstadoId = tbEstado.EstadoId ORDER BY Nome");
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
        col.nome {
            width: 180px;
        }

        col.cpf {
            width: 105px;
        }

        col.estado {
            width: 60px;
        }

        col.cidade {
            width: 110px;
        }

        col.logradouro {
            width: 200px;
        }

        col.cep {
            width: 80px;
        }

        col.numerores {
            width: 93px;
        }

        col.atualizar {
            width: 75px;
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
                        <li><a href="atualizar-venda.php" class="borda-corrigida">Venda</a></li>
                        <li><a href="atualizar-cliente.php" class="borda-corrigida">Cliente</a></li>
                        <li><a href="atualizar-funcionario.php" class="borda-corrigida">Funcionário</a></li>
                        <li><a href="atualizar-produto.php" class="borda-corrigida">Produto</a></li>
                        <li><a href="atualizar-endereco.php" class="borda-corrigida">Endereço</a></li>
                        <li><a href="atualizar-endereco-cliente.php" class="borda-corrigida">Endereço de Cliente</a></li>
                        <li><a href="atualizar-endereco-funcionario.php" class="borda-corrigida">Endereço de Funcionário</a></li>
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
            <div class="box">
                    <form action="consultar-endereco-funcionario.php" method="POST">
                        <fieldset>
                            <legend><strong>Pesquisar Endereços de Funcionários</strong></legend>
                                <div class="inputBox">
                                    <input type="text" name="CpfFuncionario" id="CpfFuncionario" class="inputUser" maxlength="14" onKeyPress="MascaraGenerica(this, 'CPF');" required>
                                    <label for="CpfFuncionario" class="labelInput">Filtrar pelo CPF</label>
                                </div>
                            <input type="submit" value="Filtrar" name="enviar" id="submit">
                        </fieldset>
                    </form>
                </div>

                <hr>

                <?php if(count($enderecos) == 0):?>
                    <p>Não foram encontrados endereços de funcionários.</p>
                <?php else:?>
                    <div class="rolagem">
                        <table>
                            <colgroup>
                               <col class="atualizar">
                                <col class="nome">
                                <col class="cpf">
                                <col class="estado">
                                <col class="cidade">
                                <col class="logradouro">
                                <col class="cep">
                                <col class="numerores">
                            </colgroup> 
                            <thead>
                                <tr>
                                    <th>Atualizar</th>
                                    <th>Nome</th>
                                    <th>CPF</th>
                                    <th>Estado</th>
                                    <th>Cidade</th>
                                    <th>Logradouro</th>
                                    <th>CEP</th>
                                    <th>Número Residencial</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($enderecos as $endereco): ?>
                                <tr>
                                    <td>
                                        <!-- Link com criptografia para atualizar os dados: -->
                                        <a href="atualizar-formulario/atualizar-endereco-funcionario-formulario.php?id=<?= aes_encriptar($endereco['FuncionarioId']) ?>" class="img"><img src="../../images/atualizar-peq.png" alt="ícone de Cadastro" class="icone_botao_peq"></a>
                                    </td>
                                    <td>
                                        <?= $endereco['Nome']?>
                                    </td>
                                    <td>
                                        <?= $endereco['Cpf']?>
                                    </td>
                                    <td>
                                        <?= $endereco['Estado']?>
                                    </td>
                                    <td>
                                        <?= $endereco['Cidade']?>
                                    </td>
                                    <td>
                                        <?= $endereco['Logradouro']?>
                                    </td>
                                    <td>
                                        <?= $endereco['Cep']?>
                                    </td>
                                    <td>
                                        <?= $endereco['NumeroEndereco']?>
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