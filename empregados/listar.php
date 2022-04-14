<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Empregados - Listagem</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.js"></script>
    <style type="text/css">
        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header clearfix">
                        <h2 class="pull-left">Empregados</h2>
                        <a href="criar.php" class="btn btn-warning pull-right">Inserir um Novo Empregado</a>
                    </div>
                    <?php
                    require_once "conexao.php";

                    session_start();
                    if (empty($_SESSION["usuario"])) {
                        header("location: erro.php"); 
                        die();
                    }

                    $sql = "SELECT * FROM empregados";

                    if($result = mysqli_query($conexao, $sql)){

                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Nome</th>";
                                        echo "<th>Endereço</th>";
                                        echo "<th>Salário</th>";
                                        echo "<th>Ação</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($registro = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $registro['id'] . "</td>";
                                        echo "<td>" . $registro['nome'] . "</td>";
                                        echo "<td>" . $registro['endereco'] . "</td>";
                                        echo "<td>" . $registro['salario'] . "</td>";
                                        echo "<td>";
                                            echo "<a href='consultar.php?id=". $registro['id'] ."' title='Ver o Registro' data-toggle='tooltip'><span class='glyphicon glyphicon-eye-open'></span></a>";
                                            echo "<a href='atualizar.php?id=". $registro['id'] ."' title='Atualizar o Registro' data-toggle='tooltip'><span class='glyphicon glyphicon-pencil'></span></a>";
                                            echo "<a href='excluir.php?id=". $registro['id'] ."' title='Excluir o Registro' data-toggle='tooltip'><span class='glyphicon glyphicon-trash'></span></a>";
                                            echo "<a href='upload.php?id=". $registro['id'] ."' title='Enviar foto' data-toggle='tooltip'><span class='glyphicon glyphicon-user'</spa></a>";
                                        echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";
                            echo "</table>";

                            mysqli_free_result($result);

                        } else{
                            echo "<p class='lead'><em>Não há empregados cadastrados.</em></p>";
                        }
                    } else{
                        echo "ERRO: Não foi poss[vel executar o comando SQL: $sql. " . mysqli_error($conexao);
                    }

                    mysqli_close($conexao);
                    ?>
                    <div class="page-header clearfix">
                        <a href="logout.php" class="btn btn-warning pull-right">Sair</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>