<?php

session_start();
if (empty($_SESSION["usuario"])) {
    header("location: login.php"); 
    die();
}

// processamento do formulario submetido
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $conteudo = trim($_POST["conteudo"]);
    echo $conteudo;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Empregados - Pesquisa</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h2>Empregado - Pesquisar</h2>
                </div>
                <form action="listar.php" method="post">
                    <div class="form-group">
                        <label>Conteúdo</label>
                        <input type="text" name="conteudo" class="form-control">
                    </div>
                    <input type="submit" class="btn btn-primary" value="Procurar">
                    <a href="listar.php" class="btn btn-default">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
