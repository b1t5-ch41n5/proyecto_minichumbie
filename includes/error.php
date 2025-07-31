<!DOCTYPE html>
<html lang="en">


<!-- esta página es para mostrar el error de la página anterior o de alguna seccion que se este trbajando -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body style= "background-color: rgb(112, 24, 13);">
    <div class=" container d-flex justify-content-center p-2 mb-3">  
        <img class ="rounded" src="../img/login_in.png" alt="logo" style="max-width: 200px;">
    </div>

    <div class="container justify-content-center">
        <div class="alert alert-danger text-center" role="alert">
            <h4 class="alert-heading">Error</h4>
            <p>Ocurrió un error al procesar su solicitud. Por favor, inténtelo de nuevo más tarde.</p>
            <hr>
            <p class="mb-0">Si el problema persiste, comuníquese con el administrador.</p>
        </div>

        <button class='btn d-flex btn-danger mb-3' onclick="history.back()">Volver
        </button>
    </div>
    


    <?php
        include "./footer.php";
    ?>
</body>
</html>