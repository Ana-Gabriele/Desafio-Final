<?php

require "Conexao.php";

if(!empty($_GET["id"])) {
    
    $pdo = Conexao::conectar("conf.ini");

    $id = $_GET["id"];

    $sql = "SELECT * FROM livros WHERE id=:id";

    $stmt = $pdo->prepare($sql);

    $result = $stmt->execute([
        ":id" => $id
    ]);

    $banco = $stmt->fetch(PDO::FETCH_ASSOC);

    if($banco) {
        
        $autor = $banco["autor"];
        $titulo = $banco["titulo"];
        $subtitulo = $banco["subtitulo"];
        $edicao = $banco["edicao"];
        $editora = $banco["editora"];
        $publi = $banco["ano_publicacao"];
    
    } else {
        header("Location: painel.html");
    }

    if(isset($_POST["editar"])) {
        
        $autor = $_POST["autor"];
        $titulo = $_POST["titulo"];
        $subtitulo = $_POST["subtitulo"];
        $edicao = $_POST["edicao"];
        $editora = $_POST["editora"];
        $publi = $_POST["ano_publicacao"];

        $pdo = Conexao::conectar("conf.ini");

        $sql = "UPDATE livros SET autor='$autor', titulo='$titulo', subtitulo='$subtitulo', edicao='$edicao', editora='$editora', ano_publicacao='$publi' WHERE id='$id'";

        $stmt = $pdo->prepare($sql);

        $qtdLinhas = $stmt->execute();

        header("Location:painel.html");
    }
}
