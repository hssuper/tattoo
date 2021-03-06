<?php
include_once "include/menuadm.php";
include_once 'C:/xampp/htdocs/tattoo/controller/orcamentoController.php';
include_once 'C:/xampp/htdocs/tattoo/controller/usuarioController.php';
include_once 'C:/xampp/htdocs/tattoo/controller/agendamentoController.php';
include_once 'C:/xampp/htdocs/tattoo/model/orcamento.php';
include_once 'C:/xampp/htdocs/tattoo/model/usuario.php';
include_once 'C:/xampp/htdocs/tattoo/model/PedidoAgendamento.php';
include_once 'C:/xampp/htdocs/tattoo/model/mensagem.php';
include_once 'C:/xampp/htdocs/tattoo/email.php';
$msg = new mensagem();
$or = new Orcamento();

$agendamento = new Agendamento();
$or->setFkImagem($agendamento);
$ac = new agendamentoController();

$usuario = new Usuario();
$or->setFkusuario($usuario);
$uc =  new cadastroFuncionarioController();
$btEnviar = FALSE;
$btAtualizar = FALSE;
$btExcluir = FALSE;
?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Busca - Agenda PHP</title>
    <!-- CSS do Bootstrap e CSS customizado -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="bootstrap/css/style.css">
    <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rye&display=swap" rel="stylesheet">
</head>


<body class="img">


    <div class="container">
        <div class="col-lg-offset-8">

            <h3>Orçamento De Tatuagens</h3>
           
            <div class="row">
                <form method="POST" action="">
                    <select class="form-select" name="idimagem">
                        <option>[--Selecione--]</option>
                        <?php
                        $listaAgendamento = $ac->listarAgendamento();
                        if ($listaAgendamento != null) {
                            foreach ($listaAgendamento as $lu) {
                                ?>
                                <option value="<?php echo $lu->getIdimagem(); ?>" <?php
                                $lu->getIdimagem();
                                if ($lu->getIdimagem() != "") {
                                    if (
                                            $lu->getIdimagem() == $lu->getIdimagem()
                                    ) {
                                        echo "selected = 'selected'";
                                    }
                                }
                                ?>>
                                        <?php echo $lu->getEmail(); ?></option>
                                    <?php
                            }
                        }
                        ?>
                    </select>
                    <input type="submit" value="Pesquisar" name="getPesquisa" />
                </form>
            </div>
            <form method="POST" action="email.php">

                <div class="form-group">
                    <label for="orcamento">Imagem</label>
                    <img src="<?php echo $agendamento->getImagem();?>" height="150">
                </div>
                <div class="form-group">
                    <label for="orcamento">Descrição</label>
                    <textarea rows="8" cols="50" name="informacao" maxlength="20000" minlength="20" value=""><?php echo $agendamento->getInformacao(); ?></textarea>
                </div>

                <div class="form-group">
                    <label for="orcamento">Orçamento</label>
                    <input type="text" class="form-control" name="orcamento" placeholder="Informe o Orçamento" value="<?php echo $or->getOrcamento(); ?>">
                </div>

                <div class="form-group">
                    <label for="data">Data da Tatuagem</label>
                    <input type="date" class="form-control" name="data" placeholder="Informe a data do procedimento" value="<?php echo $or->getData(); ?>">
                </div>

                <div class="form-group">
                    <label for="hora">Hora da Tatuagem</label>
                    <input type="time" class="form-control" name="hora" placeholder="Informe a hora do procedimento" value="<?php echo $or->getHora(); ?>">
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <label>Funcionario/Adm</label>
                        <label id="idUsuario" style="color: red; font-size: 11px;"></label>
                        <select class="form-select" name="idUsuario">
                            <option>[--Selecione--]</option>
                            <?php
                            $listaUsuario = $uc->listarUsuario();
                            if ($listaUsuario != null) {
                                foreach ($listaUsuario as $lu) {
                            ?>
                                    <option  <?php
                                                                                        $lu->getIdcadastro();
                                                                                        if ($lu->getIdcadastro() != "") {
                                                                                            if (
                                                                                                $lu->getIdcadastro() ==
                                                                                                $lu->getIdcadastro()
                                                                                            ) {
                                                                                                echo "selected = 'selected'";
                                                                                            }
                                                                                        }
                                                                                        ?>>
                                        <?php echo $lu->getNome(); ?></option>
                            <?php
                                }
                            }
                            ?>
                        </select>
                        <div class="form-group">
                            <div class="col-md-8">
                                <label>Agendamento/Cliente</label>
                                <label id="idimagem" style="color: red; font-size: 11px;"></label>
                                <select class="form-select" name="idimagem">
                                    <option>[--Selecione--]</option>
                                    <?php
                                    $listaAgendamento = $ac->listarAgendamento();
                                    if ($listaAgendamento != null) {
                                        foreach ($listaAgendamento as $lu) {
                                    ?>
                                            <option <?php
                                                                                                $lu->getIdimagem();
                                                                                                if ($lu->getIdimagem() != "") {
                                                                                                    if (
                                                                                                        $lu->getIdimagem() ==
                                                                                                        $lu->getIdimagem()
                                                                                                    ) {
                                                                                                        echo "selected = 'selected'";
                                                                                                    }
                                                                                                }
                                                                                                ?>>
                                                <?php echo $lu->getEmail(); ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>


                    </div>
                </div>

                <input type="submit" name="cadastrar" class="btn btn-success btInput"   value="Enviar" <?php if ($btEnviar == TRUE) echo "disabled = 'disabled'"; ?>>

                    <input type="submit" name="atualizarUsuario" class="btn btn-secondary btInput" value="Atualizar" <?php if ($btAtualizar == false) echo "disabled = 'disabled'"; ?>>
                    <button type="button" class="btn btn-warning btInput" data-bs-toggle="modal" data-bs-target="#ModalExcluir" <?php if ($btExcluir == false) echo "disabled = 'disabled'"; ?>>
                        Excluir
                    </button>
                    </form>
</body> <!-- fecha /container -->
<footer id="myFooter" style="padding-top: 200px;">
    <div class="container">
        <div class="row" style="color: #808080">
            <div class="col-sm-3">
                <h2 class="logo"><a href="tatuagens.php"><img src="img/logo2.jfif" height="80px" width="80px"></h2>
            </div>
            <div class="col-sm-2">
                <h5 style="color: #808080">Inicio</h5>
                <ul>
                    <li><a style="color: #808080" href="home.php">Home</a></li>
                    <li><a style="color: #808080" href="tatuagens.php">tatuagens</a></li>
                    <li><a style="color: #808080" href="login.php">login</a></li>
                </ul>
            </div>
            <div class="col-sm-2">
                <h5 style="color: #808080">Sobre-nós</h5>
                <ul>
                    <li><a style="color: #808080" href="">Informações da Empresa</a></li>
                    <li><a style="color: #808080" href="">Contato</a></li>

                </ul>
            </div>
            <div class="col-sm-2">
                <h5 style="color: #808080">Suporte</h5>
                <ul>
                    <li><a style="color: #808080" href="">FAQ</a></li>
                    <li><a style="color: #808080" href="">Telefones</a></li>
                    <li><a style="color: #808080" href="">Chat</a></li>
                </ul>
            </div>
            <div class="col-sm-3">
                <div class="social-networks">
                    <a style="color: #808080" href="" class="twitter"><i class="fa fa-twitter"></i></a>
                    <a style="color: #808080" href="..." class="facebook"><i class="fa fa-facebook"></i></a>
                    <a style="color: #808080" href="..." class="instagram"><i class="fa fa-instagram"></i></a>
                    <a style="color: #808080" href="..." class="whatsapp"><i class="fa fa-whatsapp"></i></a>
                </div>

            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <p>© 2021 Copyright - FC Estudio</p>
    </div>
</footer>
<!-- jQuery (online) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- JavaScript customizado -->
<script src="js/scripts.js"></script>


</html>