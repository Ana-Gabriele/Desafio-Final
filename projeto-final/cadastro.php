<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $nome = $_POST['usuario'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $senhaConf = $_POST['senhaConfirma'];


    if ($senha !== $senhaConf) {

        echo "<script> alert('Verique se as senhas correspondem!')</script>";
        header('Location:cadastro.html');

    } else {

        require "Conexao.php";

        $pdo = Conexao::conectar("conf.ini");

        $sql = "INSERT INTO cadastro(nome, email, senha) VALUES(:nome, :email, :senha)" ;

        $stmt = $pdo->prepare($sql);

        $qtdLinhas = $stmt->execute([
        ':nome' => $nome,
        ':email' => $email,
        ':senha' => $senha,
        ]);

        header("location:painel.html");
    }
}