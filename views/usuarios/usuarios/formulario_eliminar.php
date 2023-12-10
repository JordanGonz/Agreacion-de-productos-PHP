<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Usuarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }

        .confirmation-container {
            margin-top: 50px;
        }

        .confirmation-box {
            border: 1px solid #d9534f;
            background-color: #f2dede;
            color: #a94442;
            text-align: center;
            padding: 20px;
            border-radius: 5px;
        }

        .confirmation-buttons {
            margin-top: 20px;
        }

        .btn-confirm {
            background-color: #d9534f;
            color: #fff;
        }

        .btn-cancel {
            background-color: #5bc0de;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container confirmation-container">
        <div class="row">
            <div class="col-sm-6 offset-sm-3">
                <div class="confirmation-box">
                    <p>¿Desea confirmar la eliminación del registro?</p>
                </div>

                <div class="confirmation-buttons">
                    <form action="../../includes/_functions.php" method="POST">
                        <input type="hidden" name="accion" value="eliminar_usuarios">
                        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                        <button type="submit" class="btn btn-confirm">Eliminar</button>
                        <a href="./" class="btn btn-cancel">Cancelar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
