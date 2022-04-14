<?php
require_once "conexao.php";

session_start();
if (empty($_SESSION["usuario"])) {
    header("location: login.php"); 
    die();
}

$nome = $endereco = $salario = "";
$nome_err = $endereco_err = $salario_err = "";

// verifica se o id informado existe
if(isset($_POST["id"]) && !empty($_POST["id"])){
    $id = $_POST["id"];

    // validar nome
    $form_nome = trim($_POST["nome"]);
    if(empty($form_nome)){
        $nome_err = "Informe um nome.";
        
    } elseif(!filter_var($form_nome, FILTER_VALIDATE_REGEXP, array("options"=>array("regexp"=>"/^[a-zA-Z\s]+$/")))){
        $nome_err = "Informe um nome válido.";
        
    } else{
        $nome = $form_nome;
        
    }

    // validar endereco
    $form_endereco = trim($_POST["endereco"]);
    if(empty($form_endereco)){
        $endereco_err = "Informe um endereço.";
        
    } else{
        $endereco = $form_endereco;
        
    }

    // validar salario
    $form_salario = trim($_POST["salario"]);
    if(empty($form_salario)){
        $salario_err = "Informe um valor de salário.";
        
    } elseif(!ctype_digit($form_salario)){
        $salario_err = "Informe um número positivo.";
        
    } else{
        $salario = $form_salario;
        
    }

    // atualiza o registro selecionado se nao houver erro na validacao
    if(empty($nome_err) && empty($endereco_err) && empty($salario_err)){
        
        $sql = "UPDATE empregados SET nome=?, endereco=?, salario=? WHERE id=?";
        
        echo $sql;

        if($stmt = mysqli_prepare($conexao, $sql)){

            mysqli_stmt_bind_param($stmt, "sssi", $param_name, $param_address, $param_salario, $param_id);

            $param_name = $nome;
            $param_address = $endereco;
            $param_salario = $salario;
            $param_id = $id;

            if(mysqli_stmt_execute($stmt)){
                header("location: listar.php");
                exit();
                
            } else{
                echo "Erro na atualização do registro. Tente mais tarde.";
                
            }
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_close($conexao);

} else {

    // verifica se o atributo ID foi informado e processa
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){

        $id =  trim($_GET["id"]);

        $sql = "SELECT * FROM empregados WHERE id = ?";
        if($stmt = mysqli_prepare($conexao, $sql)){

            mysqli_stmt_bind_param($stmt, "i", $param_id);

            $param_id = $id;

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

        // Close statement
        mysqli_stmt_close($stmt);

        // Close connection
        mysqli_close($conexao);
        
    }  else{
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Empregado - Atualização</title>
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
                    <h2>Empregado - Atualizar</h2>
                </div>
                <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                    <div class="form-group <?php echo (!empty($nome_err)) ? 'has-error' : ''; ?>">
                        <label>Nome</label>
                        <input type="text" name="nome" class="form-control" value="<?php echo $nome; ?>">
                        <span class="help-block"><?php echo $nome_err;?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($endereco_err)) ? 'has-error' : ''; ?>">
                        <label>Endereço</label>
                        <textarea name="endereco" class="form-control"><?php echo $endereco; ?></textarea>
                        <span class="help-block"><?php echo $endereco_err;?></span>
                    </div>
                    <div class="form-group <?php echo (!empty($salario_err)) ? 'has-error' : ''; ?>">
                        <label>Salário</label>
                        <input type="text" name="salario" class="form-control" value="<?php echo $salario; ?>">
                        <span class="help-block"><?php echo $salario_err;?></span>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                    <input type="submit" class="btn btn-primary" value="Atualizar">
                    <a href="listar.php" class="btn btn-default">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>