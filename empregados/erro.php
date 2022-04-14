<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Página de Erro</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 750px;
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
                    <h1>Ocorreu um Erro</h1>
                </div>
                <div class="alert alert-danger fade in">
                    <?php 
                    $destino = "listar.php";
                    $mensagem = "retorne à página principal";
                    if (empty($_SESSION["usuario"])) { 
                        $destino = "login.php";
                        $mensagem = "refaça seu login";
                    }
                    ?>
                    <p>Desculpe, ocorreu um erro. Por favor, <a href="<?php echo $destino;?>" 
                         class="alert-link"><?php echo $mensagem;?></a> e tente novamente.</p>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>