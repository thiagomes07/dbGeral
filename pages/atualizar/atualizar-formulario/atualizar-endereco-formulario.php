<?php
    // Verifica se existe o id:
    if (!isset($_GET['cep'])) {
        die('Acesso inválido');
    }

    // PDO:
    require_once('../../biblioteca/EasyPDO.php');
    $select = new EasyPDO\EasyPDO();
    $select1 = new EasyPDO\EasyPDO();

    // Pegar o endereço do cliente especificado:
    $enderecos = $select->select("SELECT * FROM tbEndereco INNER JOIN tbCidade ON tbEndereco.CidadeId = tbCidade.CidadeId INNER JOIN tbEstado ON tbCidade.EstadoId = tbEstado.EstadoId
    WHERE Cep = :Cep", ['Cep' => $_GET['cep']])[0]; 


    $cidades = $select1->select("SELECT Cidade FROM tbcidade");
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
                        <form action="submit/endereco-submit-update.php" method="POST">
                            <fieldset>
                                <legend><strong>Atualizar Endereços</strong></legend>
                                <input type="hidden" name="Cep" value="<?= $enderecos['Cep']?>">
                                <div class="inputBox">
                                    <label for="Cep">CEP</label>
                                    <select name="Cep" id="Cep" class="campoespecial" disabled="disabled">
                                        <option value="<?= $enderecos['Cep'] ?>" selected><?= $enderecos['Cep']?></option>
                                    </select>
                                </div>
                                <div class="inputBox">
                                    <input type="text" name="Logradouro" id="Logradouro" class="inputUser" maxlength="120" value="<?= $enderecos['Logradouro']?>" required>
                                    <label for="Logradouro" class="labelInput">Logradouro</label>
                                </div>
                                <div class="inputBox">
                                    <input type="text" name="Cidade" id="Cidade" class="inputUser" maxlength="80" list="cidades" value="<?= $enderecos['Cidade']?>" required>
                                    <datalist id="cidades">
                                        <?php foreach ($cidades as $cidade) : ?>
                                            <option value="<?= $cidade['Cidade']?>"></option>
                                        <?php endforeach; ?>
                                    </datalist>
                                    <label for="Cidade" class="labelInput">Cidade</label>
                                </div>
                                <div class="inputBox">
                                    <label for="Estado">Estado</label>
                                    <select name="Estado" id="Estado" class="campoespecial">
                                        <option value="<?= $enderecos['Estado'] ?>" selected><?= $enderecos['Estado']?></option>
                                        <optgroup class="alternarcor1" label="Região Sul">
                                            <option value="PR">Paraná</option>
                                            <option value="RS">Rio Grande do Sul</option>
                                            <option value="SC">Santa Catarina</option>
                                        </optgroup>
                                        <optgroup label="Região Centro-Oeste">
                                            <option value="GO">Goiás</option>
                                            <option value="MT">Mato Grosso</option>
                                            <option value="MS">Mato Grosso do Sul</option>
                                        </optgroup>
                                        <optgroup class="alternarcor1" label="Região Sudeste">
                                            <option value="ES">Espirito Santo</option>
                                            <option value="MG">Minas Gerais</option>
                                            <option value="RJ">Rio de Janeiro</option>
                                            <option value="SP">São Paulo</option>
                                        </optgroup>
                                        <optgroup label="Região Norte">
                                            <option value="AC">Acre</option>
                                            <option value="AM">Amazonas</option>
                                            <option value="AP">Amapá</option>
                                            <option value="PA">Pará</option>
                                            <option value="RO">Rondônia</option>
                                            <option value="RR">Roraima</option>
                                            <option value="TO">Tocantins</option>
                                        </optgroup>
                                        <optgroup class="alternarcor1" label="Região Nordeste">
                                            <option value="AL">Alagoas</option>
                                            <option value="BA">Bahia</option>
                                            <option value="CE">Ceará</option>
                                            <option value="MA">Maranhão</option>
                                            <option value="PB">Paraíba</option>
                                            <option value="PE">Pernambuco</option>
                                            <option value="PI">Piauí</option>
                                            <option value="RN">Rio Grande do Norte</option>
                                            <option value="SE">Sergipe</option>
                                        </optgroup>
                                        <option value="DF">Distrito Federal</option>
                                    </select>
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