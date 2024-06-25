<?php

if (isset($_POST["adicionar"])) {

    require "Conexao.php";

    $autor = $_POST["autor"];
    $titulo = $_POST["titulo"];
    $subtitulo = $_POST["subtitulo"];
    $edicao = $_POST["edicao"];        $editora = $_POST["editora"];
    $publi = $_POST["ano_publicacao"];

    $pdo = Conexao::conectar("conf.ini");

    $sql = "INSERT INTO livros(autor, titulo, subtitulo, edicao, editora, ano_publicacao) VALUES(:autor, :titulo, :subtitulo, :edicao, :editora, :publi)" ;

    $stmt = $pdo->prepare($sql);

        $qtdLinhas = $stmt->execute([
        ':autor' => $autor,
        ':titulo' => $titulo,
        ':subtitulo' => $subtitulo,
        ':edicao' => $edicao,
        ':editora' => $editora,
        ':publi' => $publi
        ]);

        header("location:painel.html");
    
}