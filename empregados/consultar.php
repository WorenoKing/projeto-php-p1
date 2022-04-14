<?php

session_start();
if (empty($_SESSION["usuario"])) {
    header("location: login.php"); 
    die();
}

// verifica se o id informado existe
if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
    
    require_once "conexao.php";

    $sql = "SELECT * FROM empregados WHERE id = ?";

    if($stmt = mysqli_prepare($conexao, $sql)){
        
        mysqli_stmt_bind_param($stmt, "i", $param_id);
        
        $param_id = trim($_GET["id"]);

        if(mysqli_stmt_execute($stmt)){
            $result = mysqli_stmt_get_result($stmt);

            if(mysqli_num_rows($result) == 1){
                $registro = mysqli_fetch_array($result, MYSQLI_ASSOC);

                $nome = $registro["nome"];
                $endereco = $registro["endereco"];
                $salario = $registro["salario"];
            } else{
                header("location: erro.php");
                exit();
            }

        } else{
            echo "Erro na leitura do registro. Tente mais tarde.";
        }
    }

    mysqli_stmt_close($stmt);

    mysqli_close($conexao);

} else {
    header("location: erro.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Empregado - Consulta</title>
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
                    <h1>Empregado - Consultar</h1>
                </div>
                <div class="form-group">
                    <label>Nome</label>
                    <p class="form-control-static"><?php echo $registro["nome"]; ?></p>
                </div>
                <div class="form-group">
                    <label>Endereço</label>
                    <p class="form-control-static"><?php echo $registro["endereco"]; ?></p>
                </div>
                <div class="form-group">
                    <label>Salário</label>
                    <p class="form-control-static"><?php echo $registro["salario"]; ?></p>
                </div>
                <p><a href="listar.php" class="btn btn-warning">Retornar</a></p>
            </div>
        </div>
    </div>
</div>
</body>
</html>