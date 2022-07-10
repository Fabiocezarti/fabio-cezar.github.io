<?php

class Usuario
{
    private $pdo;
    public $msgErro = "";

    public function conectar($nome, $host, $usuario, $senha)
    {
        global $pdo;
        try
        {
            $pdo = new PDO("mysql:dbname=".$nome, $usuario, $senha);
        }
        catch(PDOException $e)
        {
            $msgErro = $e->getMessage();

        }
    }

    public function cadastrar($nome, $telefone, $email, $senha)
    {
        global $pdo;
        //Verificar se o email já existe
        $sql = $pdo->prepare("SELECT id_usuarios FROM usuarios WHERE email = :e");
        $sql->bindValue(":e",$email);
        $sql->execute();
        if($sql->rowCount()>0)
        {
            return false; //email já cadastrado
        }
        else
        {
            //caso o email não estaja cadastrado, cadastrar:
            $sql = $pdo->prepare("INSERT INTO usuarios(nome, telefone, email, senha) VALUES (:n, :t, :e, :s)");
            $sql->bindValue(":n", $nome);
            $sql->bindValue(":t", $telefone);
            $sql->bindValue(":e", $email);
            $sql->bindValue(":s", md5($senha));
            $sql->execute();
            return true;//tudo ok
        }

    }

    public function logar($email,$senha)
    {
        global $pdo;
        //verificar se o email e senha estão corretos, se sim....
        $sql = $pdo->prepare("SELECT id_usuarios FROM usuarios WHERE email = :e AND senha = :s");
        $sql->bindValue(":e",$email);
        $sql->bindValue(":s",md5($senha));
        $sql->execute();
        if($sql->rowCount()>0)
        {
            $dado = $sql->fetch();
            session_start();
            $_SESSION['id_usuarios'] = $dado['id_usuarios'];
            return true;
        }
        else
        {
            return false;
        }

    }

}
?>