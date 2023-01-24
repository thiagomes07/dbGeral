<?php
    require_once('../biblioteca/EasyPDO.php');
  
    $select = new EasyPDO\EasyPDO();

    // Verifica se foi feito um post para decidir qual consulta será feita:
    if(isset($_POST['CpfFuncionario'])){
        // Consulta com filtro:
        $funcionarios = $select->select("SELECT * FROM tbFuncionario WHERE Cpf= :CpfFuncionario ORDER BY Nome", ['CpfFuncionario' => $_POST['CpfFuncionario']]);
    }else{
        // Consulta sem filtro:
        $funcionarios = $select->select("SELECT * FROM tbFuncionario ORDER BY Nome");
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

        col.nome{
            width: 165px;
        } 

        col.cpf{
            width: 105px;
        }

        col.telefone{
            width: 110px;
        }

        col.data{
            width: 95px;
        }

        col.cep{
            width: 75px;
        }

        col.funcao{
            width: 120px;
        }

        col.salario{
            width: 95px;
        }

        col.turno{
            width: 105px;
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
                    <form action="consultar-funcionario.php" method="POST">
                        <fieldset>
                            <!-- Aplicação de filtro -->
                            <legend><strong>Pesquisar Funcionários</strong></legend>
                            <div class="inputBox">
                                <input type="text" name="CpfFuncionario" id="CpfFuncionario" class="inputUser" maxlength="14"
                                    onKeyPress="MascaraGenerica(this, 'CPF');" required>
                                <label for="CpfFuncionario" class="labelInput">Filtrar pelo CPF</label>
                            </div>
                            <input type="submit" value="Filtrar" name="enviar" id="submit">
                        </fieldset>
                    </form>
                </div>

                <hr>

                <?php if(count($funcionarios) == 0):?>
                    <p>Não foram encontrados funcionários.</p>
                <?php else:?>
                    <div class="rolagem">
                        <table>
                            <colgroup>
                                <col class="deletar">
                                <col class="nome">
                                <col class="cpf">
                                <col class="telefone">
                                <col class="data">
                                <col class="cep">
                                <col class="funcao">
                                <col class="salario">
                                <col class="turno">
                            </colgroup> 
                            <thead>
                                <tr>
                                    <th>Deletar</th>
                                    <th>Nome</th>
                                    <th>CPF</th>
                                    <th>Telefone</th>
                                    <th>Data de Nascimento</th>
                                    <th>CEP</th>
                                    <th>Função</th>
                                    <th>Salário</th>
                                    <th>Turno</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($funcionarios as $funcionario): ?>
                                <tr>
                                    <td>
                                        <!-- Link com criptografia para atualizar os dados: -->
                                        <a href="deletar-submit/deletar-funcionario-submit.php?id=<?= aes_encriptar($funcionario['FuncionarioId'])?>" class="imgdel"><img src="../../images/deletar-peq.png" alt="ícone de Cadastro" class="icone_botao_peq"></a>
                                    </td>
                                    <td>
                                        <?= $funcionario['Nome']?>
                                    </td>
                                    <td>
                                        <?= $funcionario['Cpf']?>
                                    </td>
                                    <td>
                                        <?= $funcionario['Telefone']?>
                                    </td>
                                    <td>
                                        <?php
                                            // Formatação de data:
                                            $data = explode('-', $funcionario['DataNascimento']);
                                            echo $data[2] . '/' . $data[1] . '/' . $data[0]
                                        ?>
                                    </td>
                                    <td>
                                        <?= $funcionario['Cep']?>
                                    </td>
                                    <td>
                                        <?= $funcionario['Funcao']?>
                                    </td>
                                    <td>
                                        <?= 'R$ ' . number_format($funcionario['Salario'], 2, ',', '.');?>
                                    </td>
                                    <td>
                                        <?= strstr($funcionario['HorarioEntrada'], ':00', true)  . ' ás ' . strstr($funcionario['HorarioSaida'], ':00', true) // Formatação de hora?>
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