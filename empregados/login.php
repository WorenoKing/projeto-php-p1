<?php
require_once "conexao.php";

session_start();

$usuario = $senha = "";
$login_err = "";

// processamento do formulario submetido
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // validar usuario
    $form_usuario = trim($_POST["usuario"]);
    if(empty($form_usuario)) {
        $usuario_err = "Informe um usuário.";
    } else {
        $usuario = $form_usuario;
    }

    // validar senha
    $form_senha = trim($_POST["senha"]);
    if (empty($form_senha)) {
        $senha_err = "Informe uma senha.";
    } else {
        $senha = $form_senha;
    }

    if(empty($usuario_err) && empty($senha_err)){

        $sql = "SELECT id FROM usuarios WHERE usuario = '$usuario' and senha = '$senha'";
        
        $stmt = mysqli_query($conexao, $sql);
        if($stmt !== false){

            $registro = mysqli_fetch_array($stmt, MYSQLI_ASSOC);

            $qtdRegistros = mysqli_num_rows($stmt);

            if($qtdRegistros == 1) {
                $_SESSION["usuario"] = $usuario;
                header("location: listar.php");
                
            } else {
                $login_err = "Usuário ou Senha inválidos.";
            }
            
        } else {            
            // error_log($sql);
            // error_log(mysqli_error($conexao));
            unset($_SESSION["usuario"]);
            header("location: erro.php");
            exit();
            
        }
    }

    mysqli_close($conexao);

}
?>
<!DOCType html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Empregados - Login</title>
    <link rel="stylesheet"  href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper {
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="page-header">
                <h2>Login</h2>
            </div>
        </div>
        <form action="" method="post">
            <div class="form-group <?php echo (!empty($login_err)) ? '- houve um erro' : ''; ?>">
                <label>Usuário</label>
                <input type="text" name="usuario" class="form-control" value="">
            </div>
            <div class="form-group <?php echo (!empty($login_err)) ? '- houve um erro' : ''; ?>">
                <label>Senha</label>
                <input type="text" name="senha" class="form-control" value="">
                <span class="help-block"><?php echo (!empty($login_err)) ? $login_err : ''; ?></span>
            </div>
            <input type="submit" class="btn btn-warning" value="Entrar">
            <input type="reset" class="btn btn-default" value="Limpar">
        </form>
    </div>
</div>
</body>
</html>
