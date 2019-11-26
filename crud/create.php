<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <title>CRUD PHP POO</title>
</head>
<body>
    <div class="container">
        <div class="table-warapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Agregar <b>articulo</b></h2></div>
                    <div class="col-sm-4">
                        <a href="index.php" class="btn btn-info add-new"><i class="fa fa-arrow-left"></i>Regresar</a>
                    </div>
                </div>
            </div>

            <?php
                include("database.php");
                $clientes = new Database();
                if(isset($_POST) && !empty($_POST)){
                    $nombre = $clientes->sanitize($_POST["nombre"]);
                    $cantidad = $clientes->sanitize($_POST["cantidad"]);

                    $res = $clientes->create($nombre, $cantidad);
                    if ($res) {
                        $message = "Datos insertados con éxito";
                        $class = "alert alert-success";
                    } else {
                        $message = "No se pudieron insertar los datos";
                        $class = "alert alert-danger";
                    }

            ?>
            <div class="<?php echo $class ?>">
                <?php echo $message ?>
            </div>
                <?php }?>

            <div class="row">
                <form method="post">
                    <div class="col-md-3">
                        <label>Articulo:</label>
                        <input type="text" name="nombre" id="nombre" class='form-control' maxlength="50" required >
                    </div>
                    <div class="col-md-3">
                        <label>Cantidad:</label>
                        <input type="text" name="cantidad" id="cantidad" class='form-control' maxlength="8" required>
                    </div>
                    <div class="col-md-12 pull-right">
                    <hr>
                        <button type="submit" name="button" class="btn btn-success">Guardar datos</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
