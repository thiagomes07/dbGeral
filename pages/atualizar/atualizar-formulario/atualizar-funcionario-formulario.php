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
    
    $funcionario = $select->select("SELECT * FROM tbFuncionario WHERE FuncionarioId = :FuncionarioId", ['FuncionarioId' => aes_desencriptar($_GET['id'])])[0];

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
                        <form action="submit/funcionario-submit-update.php" method="POST">
                            <fieldset>
                                <legend><strong>Atualizar Funcionários</strong></legend>
                                <input type="hidden" name="FuncionarioId" value="<?= aes_encriptar($funcionario['FuncionarioId'])?>">
                                <div class="inputBox">
                                    <input type="text" name="NomeFuncionario" id="NomeFuncionario" class="inputUser" maxlength="100" value="<?= $funcionario['Nome']?>" required>
                                    <label for="NomeFuncionario" class="labelInput">Nome</label>
                                </div>
                                <div class="inputBox">
                                    <input type="text" name="CpfFuncionario" id="CpfFuncionario" class="inputUser" maxlength="14" onKeyPress="MascaraGenerica(this, 'CPF');" value="<?= $funcionario['Cpf']?>" required>
                                    <label for="CpfFuncionario" class="labelInput">CPF</label>
                                </div>
                                <div class="inputBox">
                                    <input type="tel" name="TelefoneFuncionario" id="TelefoneFuncionario" class="inputUser" maxlength="15" onKeyPress="MascaraGenerica(this, 'TELEFONE');" value="<?= $funcionario['Telefone']?>" required>
                                    <label for="TelefoneFuncionario" class="labelInput">Número de Telefone</label>
                                </div>
                                <div class="inputBox">
                                    <label for="DataNascimentoFuncionario">Data de Nascimento</label>
                                    <input type="date" name="DataNascimentoFuncionario" id="DataNascimentoFuncionario" class="campoespecial" value="<?= $funcionario['DataNascimento']?>" required>
                                </div>
                                <div class="inputBox">
                                    <input type="number" name="Salario" id="Salario" class="inputUser" min="0" max="99999999" step="0.01" onKeyPress="MascaraFloat(this);" value="<?= $funcionario['Salario']?>" required>
                                    <label for="Salario" class="labelInput">Salário</label>
                                </div>
                                <div class="inputBox">
                                    <input type="text" name="Funcao" id="Funcao" class="inputUser" maxlength="65" value="<?= $funcionario['Funcao']?>" required>
                                    <label for="Funcao" class="labelInput">Função</label>
                                </div>
                                <div class="inputBox">
                                    <label for="HorarioEntrada">Horário de Entrada</label>
                                    <input type="time" name="HorarioEntrada" id="HorarioEntrada" class="campoespecial" value="<?= $funcionario['HorarioEntrada']?>" required>
                                </div>
                                <div class="inputBox">
                                    <label for="HorarioSaida">Horário da Saída</label>
                                    <input type="time" name="HorarioSaida" id="HorarioSaida" class="campoespecial" value="<?= $funcionario['HorarioSaida']?>" required>
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