<?php

require_once 'C:/xampp/htdocs/tattoo/model/cadastro.php';
require_once 'C:/xampp/htdocs/tattoo/bd/bd.php';
require_once 'C:/xampp/htdocs/tattoo/model/mensagem.php';


class DaoCadastro{
 
    public function inserir(Cadastro $cadastro){
$conn = new Conecta();
$msg = new Mensagem();
$conecta = $conn->conectadb();

if($conecta){
    $nome = $cadastro->getNome();
    $contato = $cadastro->getContato();
    $email = $cadastro->getEmail();
    $senha = $cadastro->getSenha();
    $cpf = $cadastro->getCpf();
    $dtNasc = $cadastro->getDtNasc();
   
    $stmt = $conecta->prepare("insert into cadastro values (null,?,?,?,?,?,?)");
    $stmt->bindParam(1, $nome);
    $stmt->bindParam(2, $contato);
    $stmt->bindParam(3, $email);
    $stmt->bindParam(4, $senha);
    $stmt->bindParam(5, $cpf);
    $stmt->bindParam(6, $dtNasc);
    $stmt->execute();




} else {
    $msg->setMsg("<p style='color:red;'>Erro na conexão com o banco de dados.</p>");
}
$conn = null;
return $msg;

    }







}