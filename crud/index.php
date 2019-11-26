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
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Listado <b>Articulos</b></h2></div>
                    <div class="col-sm-4">
                        <a href="create.php" class="btn btn-info add-new"><i class="fa fa-plus">Agregar artículo</i></a>
                    </div>
                </div>
            </div>

            <?php
                include("database.php");
                $clientes = new Database();
                $listado = $clientes->read(0);
            ?>

            <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Cantidad</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        while ($row = mysqli_fetch_object($listado)) {
                            $id = $row->idArticulo;
                            $nombre = $row->nombre;
                            $cantidad = $row->cantidad;
                    ?>
                        <tr>
                            <td><?php echo $id; ?></td>
                            <td><?php echo $nombre; ?></td>
                            <td><?php echo $cantidad; ?></td>
                            <td>
                                <a href="update.php?id=<?php echo $id; ?>" class="edit" title="Editar" data-toggle="tooltip"><i class="material-icons">&#xE254;</i></a>
                                <a href="delete.php?id=<?php echo $id;?>" class="delete" title="Eliminar" data-toggle="tooltip"><i class="material-icons">&#xE872;</i></a>
                            </td>
                        </tr>
                    <?php
                        }
                    ?>

                    </tbody>
                </table>
        </div>
    </div>
</body>
</html>
