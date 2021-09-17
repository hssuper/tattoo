<?php
require_once "C:/xampp/htdocs/tattoo/bd/bd.php";
require_once "C:/xampp/htdocs/tattoo/model/mensagem.php";
require_once "C:/xampp/htdocs/tattoo/model/cadastro.php";

class DaoLogin
{
    public function validarLogin($cpf, $senha)
    {
        $conn = new Conecta();
        $conecta = $conn->conectadb();
        $cadastro = new Cadastro();
        if ($conecta) {
            try {
                $conecta->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $st = $conecta->prepare("select * from cadastro where cpf = ? and senha = ? limit 1");
                $st->bindParam(1, $cpf);
                $st->bindParam(2, $senha);
                if ($st->rowCount() > 0) {
                    while ($linha = $st->fetch(PDO::FETCH_OBJ)) {
                        $cadastro->setIdcadastro($linha->idcadastro);
                        $cadastro->setNome($linha->nome);
                        $cadastro->setContato($linha->contato);
                        $cadastro->setEmail($linha->email);
                        $cadastro->setSenha($linha->senha);
                        $cadastro->setCpf($linha->cpf);
                        $cadastro->setDtNasc($linha->dtNasc);
                    }
                    return $cadastro;
                } else {
                    return "<p style='color: red;'>"
                        . "Usuário inexistente.</p>";
                }
            } catch (PDOException $ex) {

                return "<p style='color: red;'>Não foi possível acessar os dados!</p>";
            }
        } else {
            return "<p style='color: red;'>"
                . "Erro na conexão com o banco de dados.</p>";
        }
    }
}