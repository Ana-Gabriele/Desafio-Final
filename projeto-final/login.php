<?php

if (!empty($_REQUEST['email']) && !empty($_REQUEST['senha'])) {

    require "Conexao.php";

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $pdo = Conexao::conectar("conf.ini");

    $sql = "SELECT * FROM cadastro WHERE email = :email";
    
    $stmt = $pdo->prepare($sql);
    
    $stmt->execute([
        ':email' => $email
    ]);
    
    // Verifica se encontrou algum registro

    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($senha == $user['senha']) {

            session_start();
            $_SESSION['user'] = $user;
            header('Location: painel.html');

        } else {
            echo "<script>alert('Senha incorreta.'); window.location.href='index.html';</script>";
        }
    } else {
        echo "<script>alert('Usuário não encontrado.'); window.location.href='index.html';</script>";
    }
} else {
    header('Location:index.html');
}
