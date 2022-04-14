<?php

session_start();
if (empty($_SESSION["usuario"])) {
    header("location: login.php"); 
    die();
}

// verifica se o id informado existe
if(isset($_POST["id"]) && !empty($_POST["id"])){
    
    require_once "conexao.php";
    
    $sql = "DELETE FROM empregados WHERE id = ?";

    if($stmt = mysqli_prepare($conexao, $sql)){

        mysqli_stmt_bind_param($stmt, "i", $param_id);

        $param_id = trim($_POST["id"]);

        if(mysqli_stmt_execute($stmt)){
            header("location: listar.php");
            exit();
        } else{
            echo "Erro na leitura do registro. Tente mais tarde.";
        }
    }

    mysqli_stmt_close($stmt);

    mysqli_close($conexao);

} else{

    // verifica se o atributo ID foi informado e o processa
    if(empty(trim($_GET["id"]))){
        header("location: erro.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Empregado - Exclusão</title>
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
                    <h1>Empregado - Exlcuir</h1>
                </div>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <div class="alert alert-danger fade in">
                        <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                        <p>Você deseja, realmente, excluir este empregado?</p><br>
                        <p>
                            <input type="submit" value="Yes" class="btn btn-danger">
                            <a href="listar.php" class="btn btn-default">No</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>