<?php
session_start();
if (empty($_SESSION["usuario"])) {
    header("location: login.php"); 
    die();
}

$raiz = $_SERVER['DOCUMENT_ROOT'];
$destino = $raiz . "empregados";
$arquivo = $_FILES['foto']['name'];

if(isset($_POST["enviar"])) {
    
    if ($_FILES['foto']['error'] != 0) {
        $upload_err = "Não foi possível fazer o upload";
       
    } else {

        $arquivo_temp = $_FILES['foto']['tmp_name'];
        
        if (move_uploaded_file($arquivo_temp, $destino.'/'.$arquivo) === TRUE) {
            $upload_err = "Arquivo enviado com sucesso.";
            
        } else {
            $upload_err = "Não foi possível enviar o arquivo.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Empregados - Fotos</title>
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
                    <h2>Empregado - Enviar Foto</h2>
                </div>
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="custom-file-label" >Foto</label>
                        <input type="file" id="upload-arquivo" name="foto" class="custom-file-input"/>
                        <span class="help-block"><?php echo $upload_err;?></span>
                    </div>
                    <input type="submit" class="btn btn-primary" value="Enviar" name="enviar">
                    <a href="listar.php" class="btn btn-default">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>