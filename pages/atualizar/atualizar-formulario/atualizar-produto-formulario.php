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
    
    $produto = $select->select("SELECT * FROM tbProduto WHERE CodigoBarras = :CodigoBarras", ['CodigoBarras' => aes_desencriptar($_GET['id'])])[0];

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
                        <form action="submit/produto-submit-update.php" method="POST">
                            <fieldset>
                            <legend><strong>Atualizar Produtos</strong></legend>
                                <input type="hidden" name="CodigoBarras" value="<?= aes_encriptar($produto['CodigoBarras'])?>">
                                <div class="inputBox">
                                    <input type="number" name="CodigoBarrasInput" id="CodigoBarrasInput" class="inputUser"  min="0" max="9999999999999" onKeyPress="MascaraInteiro(this);" value="<?= $produto['CodigoBarras']?>" required>
                                    <label for="CodigoBarrasInput" class="labelInput">Código de Barras</label>
                                </div>
                                <div class="inputBox">
                                    <input type="text" name="NomeProduto" id="NomeProduto" class="inputUser" maxlength="80" value="<?= $produto['Nome']?>" required>
                                    <label for="NomeProduto" class="labelInput">Nome</label>
                                </div>
                                <div class="inputBox">
                                    <input type="text" name="Marca" id="Marca" class="inputUser" maxlength="50" value="<?= $produto['Marca']?>" required>
                                    <label for="Marca" class="labelInput">Marca</label>
                                </div>
                                <div class="inputBox">
                                    <input type="text" name="Tipo" id="Tipo" class="inputUser" maxlength="50" value="<?= $produto['Tipo']?>" required>
                                    <label for="Tipo" class="labelInput">Tipo</label>
                                </div>
                                <div class="inputBox">
                                    <input type="number" name="ValorProduto" id="ValorProduto" class="inputUser" min="0" max="9999999" step="0.01" onKeyPress="MascaraFloat(this);"  value="<?= $produto['Valor']?>" required>
                                    <label for="ValorProduto" class="labelInput">Valor</label>
                                </div>
                                <div class="inputBox">
                                    <input type="number" name="QtdEstoque" id="QtdEstoque" class="inputUser" min="0" max="65535" onKeyPress="MascaraInteiro(this);" value="<?= $produto['QtdEstoque']?>" required>
                                    <label for="QtdEstoque" class="labelInput">Quantidade em estoque</label>
                                </div>
                                <div class="inputBox">
                                    <label for="Validade">Data de Validade</label>
                                    <input type="date" name="Validade" id="Validade" class="campoespecial" value="<?= $produto['Validade']?>" required>
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